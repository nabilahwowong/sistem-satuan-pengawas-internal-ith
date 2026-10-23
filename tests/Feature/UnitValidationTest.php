<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_gagal_tambah_unit_jika_nama_kosong()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create();

        // 1. Act: Kirim data kosong ke route create unit
        $response = $this->actingAs($admin)->post('/admin/units', [
            'nama_unit' => '', // Sengaja dikosongkan
            'kode_unit' => '',
        ]);

        $response->assertSessionHasErrors(['nama_unit']);
    }
}

