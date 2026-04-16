<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SeoSettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::set('seo_meta_pixel',         '', 'seo');
        Setting::set('seo_google_tag_manager', '', 'seo');
    }
}
