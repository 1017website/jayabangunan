<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        $seo = Setting::getGroup('seo');
        return view('admin.seo.index', compact('seo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings.seo_title'       => 'required|string|max:70',
            'settings.seo_description' => 'required|string|max:160',
            'settings.seo_keywords'    => 'nullable|string|max:500',
        ]);

        foreach ($request->input('settings', []) as $key => $value) {
            Setting::set($key, $value, 'seo');
        }

        return redirect()->route('admin.seo.index')
            ->with('success', 'Pengaturan SEO berhasil disimpan.');
    }
}
