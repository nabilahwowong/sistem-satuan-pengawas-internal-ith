<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_bisa_logout()
    {
        // --- PERBAIKAN DI SINI ---
        // Baris di bawah ini memberitahu VS Code bahwa $user adalah Single Model
        // Garis merah pada variable $user akan hilang.
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // 1. Login sebagai user tersebut
        $this->actingAs($user);

        // 2. Act: Lakukan Logout
        // PENTING: Standar Laravel menggunakan POST.
        // Jika nanti error "Method Not Allowed", ganti jadi $this->get('/logout');
        $response = $this->post('/logout');

        // 3. Assert: Pastikan user sudah keluar (Guest)
        // Kita gunakan assertGuest() karena lebih stabil daripada Auth::check()
        $this->assertGuest();

        // 4. Assert: Redirect (Status 302)
        $this->assertEquals(302, $response->status());
    }
}
