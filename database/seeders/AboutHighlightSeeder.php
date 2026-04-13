<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutHighlightSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan dulu agar tidak duplikat
        DB::table('about_highlights')->truncate();

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
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
