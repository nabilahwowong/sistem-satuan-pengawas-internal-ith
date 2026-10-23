<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginFailedTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_gagal_password_salah()
    {
        $user = User::factory()->create();

        // 1. Lakukan request login dengan password salah
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password-ngawur',
        ]);

        // 2. Assert: Pastikan User TIDAK login (Guest)
        // Ini yang paling penting. Kalau ini lulus, berarti sistem keamanan jalan.
        $this->assertGuest();

        // 3. Assert: Pastikan terjadi Redirect (Status 302)
        // Artinya sistem menendang user kembali, tidak lanjut ke dashboard
        $response->assertStatus(302);

        // 4. Assert: Pastikan lokasi redirect BUKAN dashboard
        // (Optional: Memastikan dia tidak nyasar masuk ke dashboard)
        $this->assertNotEquals(url('/dashboard'), $response->headers->get('Location'));
    }
}
