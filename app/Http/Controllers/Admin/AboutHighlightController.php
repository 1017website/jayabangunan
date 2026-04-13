<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutHighlight;
use Illuminate\Http\Request;

class AboutHighlightController extends Controller
{
    public function index()
    {
        $highlights = AboutHighlight::orderBy('order')->get();
        return view('admin.about-highlights.index', compact('highlights'));
    }

    public function create()
    {
        return view('admin.about-highlights.form', ['highlight' => new AboutHighlight()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon'      => 'required|string|max:10',
            'text'      => 'required|string|max:100',
            'order'     => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        AboutHighlight::create($data);
        return redirect()->route('admin.about-highlights.index')
            ->with('success', 'Highlight berhasil ditambahkan.');
    }

    public function edit(AboutHighlight $aboutHighlight)
    {
        return view('admin.about-highlights.form', ['highlight' => $aboutHighlight]);
    }

    public function update(Request $request, AboutHighlight $aboutHighlight)
    {
        $data = $request->validate([
            'icon'      => 'required|string|max:10',
            'text'      => 'required|string|max:100',
            'order'     => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $aboutHighlight->update($data);
        return redirect()->route('admin.about-highlights.index')
            ->with('success', 'Highlight berhasil diperbarui.');
    }

    public function destroy(AboutHighlight $aboutHighlight)
    {
        $aboutHighlight->delete();
        return redirect()->route('admin.about-highlights.index')
            ->with('success', 'Highlight berhasil dihapus.');
    }
}
