<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuditFindingListTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_temuan_audit_bisa_diakses()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create();

        // 1. Act: Akses route index temuan audit
        // Berdasarkan screenshot route:list, URL-nya adalah 'admin/audit-findings'
        $response = $this->actingAs($admin)->get('/admin/audit-findings');

        // --- DEBUG: Jika status 404/500 ---
        if ($response->status() !== 200) {
            $this->fail("🔥 Gagal akses: Status Code " . $response->status() . ". Pastikan route '/admin/audit-findings' benar.");
        }

        // 2. Assert: Status OK
        $response->assertStatus(200);

        // 3. Assert: Pastikan ada teks relevan
        // Kita cari kata umum yang pasti ada di halaman itu
        $response->assertSee(['Audit', 'Temuan', 'Data'], false);
    }
}
