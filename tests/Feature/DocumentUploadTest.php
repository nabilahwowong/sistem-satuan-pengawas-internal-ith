<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_upload_dokumen_tersimpan()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create();

        Storage::fake('public');

        $file = UploadedFile::fake()->create('laporan.pdf', 100);

        // --- PERBAIKAN FINAL ---
        // Berdasarkan screenshot migration kamu, kategori adalah ENUM.
        // Kita WAJIB pilih salah satu: 'pedoman_audit', 'pedoman_reviu', atau 'template'.
        $dataDokumen = [
            'judul'    => 'Dokumen Test Audit',
            'kategori' => 'pedoman_audit', // <-- INI KUNCINYA (Harus persis sama dengan Enum)
            'file'     => $file,           // Input name di form
            'keterangan' => 'Ini dokumen testing',
        ];

        // 1. Act: Post ke route documents
        $response = $this->actingAs($admin)->post('/admin/documents', $dataDokumen);

        // --- DEBUGGING ---
        if (session('errors')) {
            $this->fail("⚠️ VALIDASI GAGAL: " . json_encode(session('errors')->all()));
        }

        // 2. Assert: Redirect Sukses
        $response->assertStatus(302);

        // 3. Assert: Cek Database
        // Pastikan data tersimpan dengan kategori yang benar
        $this->assertDatabaseHas('documents', [
            'judul' => 'Dokumen Test Audit',
            'kategori' => 'pedoman_audit'
        ]);
    }
}
