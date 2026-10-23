<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginSuccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_berhasil_login_redirect_dashboard()
    {
        // 1. MATIKAN Exception Handling agar error asli muncul di terminal
        $this->withoutExceptionHandling();

        // 2. Buat User
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        // 3. Coba Login
        try {
            $response = $this->post('/login', [ // Pastikan route ini benar, cek 'php artisan route:list'
                'email' => $user->email,
                'password' => 'password123',
            ]);
        } catch (\Exception $e) {
            // Jika crash, tampilkan errornya
            $this->fail("🔥 ERROR SISTEM: " . $e->getMessage());
        }

        // 4. Cek apakah ada error validasi (misal password kurang panjang)
        if (session('errors')) {
            $this->fail("⚠️ ERROR VALIDASI: " . json_encode(session('errors')->all()));
        }

        // 5. Assertions
        $this->assertTrue(Auth::check(), "User gagal login (Auth Check False)");
        $this->assertEquals(302, $response->status(), "Status bukan Redirect (302), tapi: " . $response->status());
    }
}
