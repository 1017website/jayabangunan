<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.form', ['testimonial' => new Testimonial()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'role'      => 'required|string|max:100',
            'company'   => 'nullable|string|max:100',
            'content'   => 'required|string',
            'rating'    => 'required|integer|min:1|max:5',
            'order'     => 'required|integer|min:0',
            'is_active' => 'boolean',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'avatar_url'=> 'nullable|url',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        } elseif ($request->filled('avatar_url')) {
            $data['avatar'] = $request->input('avatar_url');
        }

        $data['is_active'] = $request->boolean('is_active');
        unset($data['avatar_url']);
        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'role'      => 'required|string|max:100',
            'company'   => 'nullable|string|max:100',
            'content'   => 'required|string',
            'rating'    => 'required|integer|min:1|max:5',
            'order'     => 'required|integer|min:0',
            'is_active' => 'boolean',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'avatar_url'=> 'nullable|url',
        ]);

        if ($request->hasFile('avatar')) {
            if ($testimonial->avatar && !str_starts_with($testimonial->avatar, 'http')) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        } elseif ($request->filled('avatar_url')) {
            $data['avatar'] = $request->input('avatar_url');
        }

        $data['is_active'] = $request->boolean('is_active');
        unset($data['avatar_url']);
        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->avatar && !str_starts_with($testimonial->avatar, 'http')) {
            Storage::disk('public')->delete($testimonial->avatar);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
