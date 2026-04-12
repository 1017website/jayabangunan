<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'upload_seo_og_image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // Handle OG image upload
        if ($request->hasFile('upload_seo_og_image') && $request->file('upload_seo_og_image')->isValid()) {
            $old = Setting::get('seo_og_image');
            if ($old && !str_starts_with($old, 'http') && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            $path = $request->file('upload_seo_og_image')->store('settings', 'public');
            Setting::set('seo_og_image', asset('storage/' . $path), 'seo');
        }

        // Simpan semua setting teks
        foreach ($request->input('settings', []) as $key => $value) {
            // Skip og_image jika pakai upload
            if ($key === 'seo_og_image' && $request->hasFile('upload_seo_og_image')) {
                continue;
            }
            if ($key === 'seo_og_image' && empty($value)) {
                continue;
            }
            Setting::set($key, $value, 'seo');
        }

        return redirect()->route('admin.seo.index')
            ->with('success', 'Pengaturan SEO berhasil disimpan.');
    }
}
