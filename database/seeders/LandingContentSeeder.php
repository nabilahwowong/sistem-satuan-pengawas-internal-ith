<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandingContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
    $data = [
        ['category' => 'profil', 'slug' => 'struktur-organisasi', 'title' => 'Struktur Organisasi'],
        ['category' => 'profil', 'slug' => 'sejarah', 'title' => 'Sejarah'],
        ['category' => 'profil', 'slug' => 'visi-misi', 'title' => 'Visi & Misi'],
        ['category' => 'profil', 'slug' => 'dasar-hukum', 'title' => 'Dasar Hukum'],
        ['category' => 'profil', 'slug' => 'ruang-lingkup', 'title' => 'Ruang Lingkup'],
        ['category' => 'profil', 'slug' => 'program-kerja', 'title' => 'Program Kerja'],
        ['category' => 'layanan', 'slug' => 'audit', 'title' => 'Audit'],
        ['category' => 'layanan', 'slug' => 'reviu', 'title' => 'Reviu'],
        ['category' => 'layanan', 'slug' => 'pendampingan', 'title' => 'Pendampingan'],
        ['category' => 'layanan', 'slug' => 'monitoring-evaluasi', 'title' => 'Monitoring & Evaluasi'],
        ['category' => 'layanan', 'slug' => 'pengawasan', 'title' => 'Pengawasan'],
    ];
    foreach ($data as $item) {
        \App\Models\LandingContent::create($item + ['content' => 'Isi konten ' . $item['title']]);
    }
    }
}
