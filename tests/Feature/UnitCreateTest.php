<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_bisa_tambah_unit_kerja()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create();
        // --- BAGIAN PENTING YANG HARUS DIUBAH ---
        // Controller kamu meminta 'nama_unit' dan 'kode_unit', BUKAN 'name'.
        $dataUnit = [
            'nama_unit' => 'Fakultas Teknik',  // <-- INI WAJIB ADA
            'kode_unit' => 'FT-01',            // <-- INI WAJIB ADA
            'description' => 'Unit akademis teknik',
        ];

        // 1. Act: Post ke route admin/units
        $response = $this->actingAs($admin)->post('/admin/units', $dataUnit);

        // --- DEBUGGING BLOCK ---
        if (session('errors')) {
            // Jika error ini muncul lagi, berarti kamu belum mengganti $dataUnit di atas!
            $this->fail("⚠️ VALIDASI MASIH GAGAL: " . json_encode(session('errors')->all()));
        }

        // 2. Assert: Cek Database
        // Kita coba cari data dengan kolom 'nama_unit'.
        // Jika nanti error "Column not found: nama_unit", ganti kuncinya jadi 'name'.
        $this->assertDatabaseHas('units', [
            'nama_unit' => 'Fakultas Teknik'
        ]);

        // 3. Assert: Redirect
        $response->assertStatus(302);
    }
}
