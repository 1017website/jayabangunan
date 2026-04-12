<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $hero    = Setting::getGroup('hero');
        $about   = Setting::getGroup('about');
        $company = Setting::getGroup('company');
        $social  = Setting::getGroup('social');
        return view('admin.settings.index', compact('hero', 'about', 'company', 'social'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'upload_hero_bg_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'upload_about_image_main' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'upload_about_image_sub'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ], [
            'upload_hero_bg_image.max'    => 'File hero maksimal 4MB.',
            'upload_about_image_main.max' => 'File foto utama maksimal 4MB.',
            'upload_about_image_sub.max'  => 'File foto kecil maksimal 4MB.',
        ]);

        // Mapping: input file name → setting key
        $uploadFields = [
            'upload_hero_bg_image'    => 'hero_bg_image',
            'upload_about_image_main' => 'about_image_main',
            'upload_about_image_sub'  => 'about_image_sub',
        ];

        foreach ($uploadFields as $inputName => $settingKey) {
            if ($request->hasFile($inputName) && $request->file($inputName)->isValid()) {
                // Hapus file lama jika ada & bukan URL eksternal
                $old = Setting::get($settingKey);
                if ($old && !str_starts_with($old, 'http') && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }
                // Simpan file baru
                $path = $request->file($inputName)->store('settings', 'public');
                $group = str_starts_with($settingKey, 'hero_') ? 'hero' : 'about';
                Setting::set($settingKey, asset('storage/' . $path), $group);
            }
        }

        // Simpan semua setting teks (hanya jika field upload kosong / pakai URL)
        $settings = $request->input('settings', []);
        foreach ($settings as $key => $value) {
            // Skip field gambar jika ada file yang diupload (sudah ditangani di atas)
            $skipIfUploaded = [
                'hero_bg_image'    => 'upload_hero_bg_image',
                'about_image_main' => 'upload_about_image_main',
                'about_image_sub'  => 'upload_about_image_sub',
            ];

            if (isset($skipIfUploaded[$key]) && $request->hasFile($skipIfUploaded[$key])) {
                continue; // skip — sudah pakai file upload
            }

            // Kosong & field gambar → jangan overwrite dengan string kosong
            if (empty($value) && in_array($key, array_keys($skipIfUploaded))) {
                continue;
            }

            $group = 'general';
            if (str_starts_with($key, 'hero_'))    $group = 'hero';
            if (str_starts_with($key, 'about_'))   $group = 'about';
            if (str_starts_with($key, 'company_')) $group = 'company';
            if (str_starts_with($key, 'social_'))  $group = 'social';

            Setting::set($key, $value, $group);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil disimpan.');
    }
}
