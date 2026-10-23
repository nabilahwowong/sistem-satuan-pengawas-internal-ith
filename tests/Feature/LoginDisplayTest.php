<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginDisplayTest extends TestCase
{
    public function test_halaman_login_dapat_diakses()
    {
        // 1. Kunjungi halaman login
        $response = $this->get('/login');

        // 2. Assert Status 200 (OK)
        $response->assertStatus(200);

        // 3. Assert ada tulisan "Login" atau "Masuk"
        $response->assertSee('Login');
    }
}
