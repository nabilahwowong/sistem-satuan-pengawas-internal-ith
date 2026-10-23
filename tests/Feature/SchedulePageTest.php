<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchedulePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_bisa_lihat_jadwal()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create();

        // 1. Act: Akses halaman jadwal
        $response = $this->actingAs($admin)->get('/admin/schedules');

        // --- DEBUG ---
        if ($response->status() === 404) {
            $this->fail("🔥 Route '/admin/schedules' tidak ditemukan.");
        }

        // 2. Assert Status 200 OK
        $response->assertStatus(200);

        // 3. Assert Content
      
        $response->assertSee('Jadwal reviu', false);
    }
}
