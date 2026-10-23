<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_anggota_bisa_upload_berita_portal()
    {
        /** @var \App\Models\User $anggota */
        $anggota = User::factory()->create(['role' => 'anggota']);

        // 1. Fake Storage (Agar folder asli aman)
        Storage::fake('public');

        // 2. Buat file gambar dummy
        $fileGambar = UploadedFile::fake()->image('kegiatan.jpg');

        // 3. Data Input (Sesuai kolom di Migration news_articles)
        $input = [
            'judul'     => 'Kegiatan Seminar SPI',
            'konten'    => 'Ini adalah isi berita lengkap tentang seminar...',
            'thumbnail' => $fileGambar,     // Sesuai nama kolom di migration
            'kategori'  => 'Kegiatan',      // Sesuai default value
            'status'    => 'published',     // Sesuai enum
        ];

        // 4. Act: POST ke route store yang benar
        $response = $this->actingAs($anggota)->post('/anggota/portal/store', $input);

        // 5. Assert Redirect (Biasanya redirect balik atau ke list)
        $response->assertStatus(302);

        // 6. Assert Database (Cek tabel 'news_articles')
        $this->assertDatabaseHas('news_articles', [
            'judul'     => 'Kegiatan Seminar SPI',
            'status'    => 'published',
            'author_id' => $anggota->id, // Pastikan controller mengisi ini otomatis
        ]);
    }

  
    public function test_gagal_upload_jika_judul_kosong()
    {
        /** @var \App\Models\User $anggota */
        $anggota = User::factory()->create(['role' => 'anggota']);

        // Kirim data tanpa judul
        $response = $this->actingAs($anggota)->post('/anggota/portal/store', [
            'judul'   => '',
            'konten'  => 'Isi berita...',
        ]);

        // Harusnya error validasi pada field 'judul'
        $response->assertSessionHasErrors(['judul']);
    }
}
