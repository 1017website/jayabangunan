<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user - update user yang sudah ada atau buat baru
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@jayabangun.co.id'],
            [
                'name'     => 'Admin Jaya Bangun',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        // Site Settings
        $settings = [
            // Hero
            ['key' => 'hero_title',       'value' => 'Membangun',             'group' => 'hero'],
            ['key' => 'hero_subtitle',    'value' => 'Indonesia',              'group' => 'hero'],
            ['key' => 'hero_description', 'value' => 'PT. Jaya Bangun Konstruksi — mitra konstruksi terpadu untuk proyek sipil, bangunan komersial, dan desain arsitektur. Berpengalaman lebih dari 15 tahun dengan standar kualitas tertinggi.', 'group' => 'hero'],
            ['key' => 'hero_badge',       'value' => 'Sejak 2008 · Bersertifikat ISO 9001', 'group' => 'hero'],
            ['key' => 'hero_btn_primary', 'value' => 'Lihat Proyek',          'group' => 'hero'],
            ['key' => 'hero_btn_secondary', 'value' => 'Konsultasi Gratis →',   'group' => 'hero'],
            ['key' => 'hero_bg_image',    'value' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1800&q=85', 'group' => 'hero'],

            // About
            ['key' => 'about_title',      'value' => 'Pondasi kuat, Visi jauh', 'group' => 'about'],
            ['key' => 'about_text1',      'value' => 'PT. Jaya Bangun Konstruksi berdiri sejak 2008 sebagai perusahaan konstruksi terpadu berbasis di Surabaya. Kami melayani proyek skala menengah hingga besar di seluruh Jawa Timur.', 'group' => 'about'],
            ['key' => 'about_text2',      'value' => 'Dengan tiga pilar keahlian — Teknik Sipil, Kontraktor Umum, dan Arsitektur — kami hadir sebagai mitra tunggal yang mampu mengelola proyek dari konsep hingga serah terima.', 'group' => 'about'],
            ['key' => 'about_years',      'value' => '15+',                   'group' => 'about'],
            ['key' => 'about_image_main', 'value' => 'https://images.unsplash.com/photo-1590274853856-f22d5ee3d228?w=900&q=80', 'group' => 'about'],
            ['key' => 'about_image_sub',  'value' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80', 'group' => 'about'],

            // Company Info
            ['key' => 'company_name',     'value' => 'PT. Jaya Bangun Konstruksi', 'group' => 'company'],
            ['key' => 'company_tagline',  'value' => 'Mitra konstruksi terpercaya untuk proyek sipil, gedung komersial, dan arsitektur di Jawa Timur sejak 2008.', 'group' => 'company'],
            ['key' => 'company_address',  'value' => 'Jl. Raya Darmo No. 88, Surabaya 60264, Jatim', 'group' => 'company'],
            ['key' => 'company_phone',    'value' => '+62 31 5678 9012',       'group' => 'company'],
            ['key' => 'company_whatsapp', 'value' => '6231567890',             'group' => 'company'],
            ['key' => 'company_email',    'value' => 'info@jayabangun.co.id',  'group' => 'company'],
            ['key' => 'company_founded',  'value' => '2008',                   'group' => 'company'],

            // Social Media
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/jayabangun', 'group' => 'social'],
            ['key' => 'social_facebook',  'value' => 'https://facebook.com/jayabangun',  'group' => 'social'],
            ['key' => 'social_youtube',   'value' => '',                       'group' => 'social'],

            // SEO
            ['key' => 'seo_title',        'value' => 'PT. Jaya Bangun Konstruksi — Kontraktor Terpercaya Jawa Timur', 'group' => 'seo'],
            ['key' => 'seo_description',  'value' => 'PT. Jaya Bangun Konstruksi adalah perusahaan konstruksi terpadu di Surabaya dengan pengalaman 15+ tahun. Melayani proyek sipil, gedung komersial, desain arsitektur, dan manajemen proyek.', 'group' => 'seo'],
            ['key' => 'seo_keywords',     'value' => 'kontraktor surabaya, konstruksi jawa timur, jasa bangun gedung, kontraktor terpercaya, arsitektur surabaya, teknik sipil', 'group' => 'seo'],
            ['key' => 'seo_og_image',     'value' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1200&q=80', 'group' => 'seo'],
            ['key' => 'seo_og_type',      'value' => 'website',                'group' => 'seo'],
            ['key' => 'seo_robots',       'value' => 'index, follow',          'group' => 'seo'],
            ['key' => 'seo_canonical',    'value' => '',                       'group' => 'seo'],
            ['key' => 'seo_google_analytics', 'value' => '',                   'group' => 'seo'],
            ['key' => 'seo_google_verification', 'value' => '',                'group' => 'seo'],
        ];
        foreach ($settings as $s) {
            DB::table('settings')->insert(array_merge($s, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Services
        $services = [
            ['icon' => '🏗️', 'title' => 'Kontraktor Umum',       'description' => 'Pelaksanaan konstruksi menyeluruh — gedung komersial, perumahan, fasilitas industri, dan infrastruktur publik dari awal hingga selesai.',  'order' => 1],
            ['icon' => '📐', 'title' => 'Teknik Sipil',           'description' => 'Perencanaan struktur, jalan, jembatan, dan drainase. Analisis geoteknik dan pengawasan konstruksi yang presisi.',                          'order' => 2],
            ['icon' => '🏛️', 'title' => 'Desain Arsitektur',     'description' => 'Konsep kreatif, gambar kerja DED, visualisasi 3D realistis, dan pendampingan perizinan IMB lengkap.',                                      'order' => 3],
            ['icon' => '📋', 'title' => 'Manajemen Proyek',       'description' => 'Pengendalian waktu, biaya, mutu, dan K3 secara profesional. Laporan progres berkala yang transparan.',                                      'order' => 4],
            ['icon' => '🔧', 'title' => 'Renovasi & Restorasi',   'description' => 'Revitalisasi bangunan existing — alih fungsi, perluasan, dan pemugaran dengan standar modern.',                                             'order' => 5],
            ['icon' => '📊', 'title' => 'Konsultasi & Studi',     'description' => 'Feasibility study, RAB detail, analisis risiko, dan konsultasi investasi properti untuk keputusan tepat.',                                  'order' => 6],
        ];
        foreach ($services as $s) {
            DB::table('services')->insert(array_merge($s, ['is_active' => true, 'created_at' => now(), 'updated_at' => now()]));
        }

        // Projects
        $projects = [
            ['title' => 'Menara Office Park Surabaya', 'category' => 'Komersial',  'location' => 'Surabaya', 'year' => 2023, 'image' => 'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1000&q=80', 'is_featured' => true, 'order' => 1],
            ['title' => 'Flyover Waru – Sidoarjo',   'category' => 'Sipil',       'location' => 'Sidoarjo', 'year' => 2022, 'image' => 'https://images.unsplash.com/photo-1545558014-8692077e9b5c?w=800&q=80', 'is_featured' => true, 'order' => 2],
            ['title' => 'Cluster Grand Verdana',      'category' => 'Residensial', 'location' => 'Gresik',  'year' => 2023, 'image' => 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=700&q=80', 'is_featured' => true, 'order' => 3],
            ['title' => 'Pabrik Manufaktur Gresik',   'category' => 'Industri',    'location' => 'Gresik',  'year' => 2021, 'image' => 'https://images.unsplash.com/photo-1513467535987-fd81bc7d62f8?w=700&q=80', 'is_featured' => true, 'order' => 4],
        ];
        foreach ($projects as $p) {
            DB::table('projects')->insert(array_merge($p, ['is_active' => true, 'description' => '', 'created_at' => now(), 'updated_at' => now()]));
        }

        // Stats
        $stats = [
            ['value' => '15', 'suffix' => '+',  'label' => 'Tahun Berpengalaman',    'icon' => '📅', 'order' => 1],
            ['value' => '280', 'suffix' => '+',  'label' => 'Proyek Diselesaikan',    'icon' => '🏢', 'order' => 2],
            ['value' => '500', 'suffix' => 'M+', 'label' => 'Nilai Proyek (Rupiah)',  'icon' => '💰', 'order' => 3],
            ['value' => '98', 'suffix' => '%',  'label' => 'Kepuasan Klien',         'icon' => '⭐', 'order' => 4],
        ];
        foreach ($stats as $s) {
            DB::table('stats')->insert(array_merge($s, ['is_active' => true, 'created_at' => now(), 'updated_at' => now()]));
        }

        // Testimonials
        $testimonials = [
            ['name' => 'Hendra Prasetyo', 'role' => 'Direktur', 'company' => 'PT. Sejahtera Abadi',  'content' => 'Tim Jaya Bangun sangat profesional. Gedung kantor kami selesai tepat waktu bahkan lebih cepat dari jadwal, dan kualitasnya luar biasa.', 'rating' => 5, 'avatar' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=200&q=80', 'order' => 1],
            ['name' => 'Ratna Dewi',     'role' => 'Pemilik', 'company' => 'Villa Harmoni Malang', 'content' => 'Desain arsitektur yang mereka buat benar-benar mewujudkan visi kami. Detail finishing-nya sangat apik dan berbeda dari kontraktor lain.', 'rating' => 5, 'avatar' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=200&q=80', 'order' => 2],
            ['name' => 'Budi Santoso',   'role' => 'Manajer', 'company' => 'PT. Indo Logistics',   'content' => 'Laporan progres mingguan yang transparan membuat kami selalu up-to-date. Komunikasi tim mereka responsif dan solutif.', 'rating' => 5, 'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=200&q=80', 'order' => 3],
        ];
        foreach ($testimonials as $t) {
            DB::table('testimonials')->insert(array_merge($t, ['is_active' => true, 'created_at' => now(), 'updated_at' => now()]));
        }

        // About Highlights
        $highlights = [
            ['icon' => '🏅', 'text' => 'Sertifikat ISO 9001:2015',   'order' => 1],
            ['icon' => '🤝', 'text' => 'Anggota GAPENSI & INKINDO',  'order' => 2],
            ['icon' => '📜', 'text' => 'Tim SKA/SKT Bersertifikat',  'order' => 3],
            ['icon' => '🛡️', 'text' => 'SMK3 PP 50/2012 (K3)',      'order' => 4],
            ['icon' => '🏗️', 'text' => 'IUJK Menengah B',            'order' => 5],
            ['icon' => '💼', 'text' => 'Rp 500M+ Nilai Proyek',      'order' => 6],
        ];
        foreach ($highlights as $h) {
            DB::table('about_highlights')->insert(array_merge($h, [
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }
}
