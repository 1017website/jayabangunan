<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('order')->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.form', ['video' => new Video()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'video_file' => 'required|file|mimes:mp4,mov,webm|max:51200', // max 50MB
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ], [
            'video_file.max' => 'Ukuran video maksimal 50MB.',
            'video_file.mimes' => 'Format video harus MP4, MOV, atau WebM.',
        ]);

        $path = $request->file('video_file')->store('videos', 'public');

        $thumbnail = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('videos/thumbnails', 'public');
        }

        Video::create([
            'title' => $request->title,
            'file_path' => $path,
            'thumbnail' => $thumbnail,
            'description' => $request->description,
            'order' => $request->order,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.form', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'video_file' => 'nullable|file|mimes:mp4,mov,webm|max:51200',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('video_file')) {
            Storage::disk('public')->delete($video->file_path);
            $video->file_path = $request->file('video_file')->store('videos', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($video->thumbnail)
                Storage::disk('public')->delete($video->thumbnail);
            $video->thumbnail = $request->file('thumbnail')->store('videos/thumbnails', 'public');
        }

        $video->update([
            'title' => $request->title,
            'file_path' => $video->file_path,
            'thumbnail' => $video->thumbnail,
            'description' => $request->description,
            'order' => $request->order,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        Storage::disk('public')->delete($video->file_path);
        if ($video->thumbnail)
            Storage::disk('public')->delete($video->thumbnail);
        $video->delete();
        return redirect()->route('admin.videos.index')
            ->with('success', 'Video berhasil dihapus.');
    }
}