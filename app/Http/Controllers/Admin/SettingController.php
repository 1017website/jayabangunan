<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

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
        $settings = $request->input('settings', []);
        foreach ($settings as $key => $value) {
            // determine group from key prefix
            $group = 'general';
            if (str_starts_with($key, 'hero_'))    $group = 'hero';
            if (str_starts_with($key, 'about_'))   $group = 'about';
            if (str_starts_with($key, 'company_')) $group = 'company';
            if (str_starts_with($key, 'social_'))  $group = 'social';
            Setting::set($key, $value, $group);
        }
        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan.');
    }
}
