<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_konten_dashboard_muncul_setelah_login()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // URL Dashboard (Sudah benar berdasarkan log error kamu)
        $urlDashboard = '/pimpinan/dashboard';

        $response = $this->actingAs($user)->get($urlDashboard);

        // 1. Pastikan Status OK
        $this->assertEquals(200, $response->status());

        // 2. Pastikan teks yang muncul sesuai dengan HTML kamu
        // Kita cari kata: "Dashboard Pimpinan", "Hasil Audit", dan "Total Audit"
        $response->assertSee(['Dashboard Pimpinan', 'Hasil Audit', 'Total Audit'], false);
    }
}
