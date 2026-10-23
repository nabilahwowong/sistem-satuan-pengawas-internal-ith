<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class UnitDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_hapus_unit_kerja()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create();

        // 1. Arrange: Masukkan data dummy MANUAL ke DB
        // KITA HAPUS baris 'description' karena tabelmu tidak punya kolom itu.
        $unitId = DB::table('units')->insertGetId([
            'nama_unit' => 'Unit Hapus',
            'kode_unit' => 'DEL-99',
            // 'description' => 'Akan dihapus',  <-- INI YANG BIKIN ERROR, KITA HAPUS
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Act: Request Delete ke URL
        $response = $this->actingAs($admin)->delete("/admin/units/{$unitId}");

        // --- DEBUG JIKA ERROR ---
        if ($response->status() === 404) {
             $this->fail("🔥 URL Delete salah. Pastikan route 'admin/units/{id}' ada.");
        }

        // 3. Assert: Redirect (Sukses)
        $response->assertStatus(302);

        // 4. Assert: Cek DB, pastikan data hilang
        $this->assertDatabaseMissing('units', [
            'id' => $unitId
        ]);
    }
}
