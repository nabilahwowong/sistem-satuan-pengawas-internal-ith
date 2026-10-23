<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminAccessListTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_bisa_melihat_daftar_user()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create();

        // Buat user target yang akan dicari di tabel
        /** @var \App\Models\User $targetUser */
        $targetUser = User::factory()->create([
            'name' => 'Target Operasi SPI',
            'email' => 'target@spi.ith.ac.id'
        ]);
        // 1. Act: Akses route index (Lihat screenshot baris 5: admin/access)
        $response = $this->actingAs($admin)->get('/admin/access');

        // --- DEBUG JIKA 403 (FORBIDDEN) ---
        if ($response->status() === 403) {
            $this->fail("⛔ ERROR 403: User ditolak. Pastikan user factory memiliki role 'admin' atau permission yang sesuai.");
        }
        // 2. Assert: Status OK
        $response->assertStatus(200);
        // 3. Assert: Pastikan data user muncul di tabel
        // Ini membuktikan Controller berhasil mengambil data dari Model dan menampilkannya di View
        $response->assertSee('Target Operasi SPI');
        $response->assertSee('target@spi.ith.ac.id');
    }
}
