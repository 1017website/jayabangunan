<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

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
            'title'       => 'required|string|max:200',
            'youtube_url' => 'required|string',
            'description' => 'nullable|string',
            'order'       => 'required|integer|min:0',
            'is_active'   => 'boolean',
        ]);

        // Validasi URL YouTube valid
        preg_match('/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $request->youtube_url, $matches);
        if (empty($matches[1])) {
            return back()->withErrors(['youtube_url' => 'URL YouTube tidak valid. Pastikan URL dari youtube.com atau youtu.be.'])->withInput();
        }

        Video::create([
            'title'       => $request->title,
            'youtube_url' => $request->youtube_url,
            'description' => $request->description,
            'order'       => $request->order,
            'is_active'   => $request->boolean('is_active'),
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
            'title'       => 'required|string|max:200',
            'youtube_url' => 'required|string',
            'description' => 'nullable|string',
            'order'       => 'required|integer|min:0',
            'is_active'   => 'boolean',
        ]);

        preg_match('/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $request->youtube_url, $matches);
        if (empty($matches[1])) {
            return back()->withErrors(['youtube_url' => 'URL YouTube tidak valid.'])->withInput();
        }

        $video->update([
            'title'       => $request->title,
            'youtube_url' => $request->youtube_url,
            'description' => $request->description,
            'order'       => $request->order,
            'is_active'   => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')
            ->with('success', 'Video berhasil dihapus.');
    }
}
