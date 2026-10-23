<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_bisa_update_unit_kerja()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create();
        $unitId = DB::table('units')->insertGetId([
            'nama_unit' => 'Nama Lama',
            'kode_unit' => 'OLD-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($admin)->put("/admin/units/{$unitId}", [
            'nama_unit' => 'Nama Baru Revisi',
            'kode_unit' => 'NEW-01',
        ]);

        if (session('errors')) {
            $this->fail("⚠️ UPDATE GAGAL: " . json_encode(session('errors')->all()));
        }

        $response->assertStatus(302);
        $this->assertDatabaseHas('units', [
            'id' => $unitId,
            'nama_unit' => 'Nama Baru Revisi',
            'kode_unit' => 'NEW-01',
        ]);
    }
}
