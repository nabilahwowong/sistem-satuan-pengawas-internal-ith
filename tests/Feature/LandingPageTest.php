<?php

namespace Tests\Feature;

use Tests\TestCase;

class LandingPageTest extends TestCase
{
    public function test_halaman_depan_bisa_dibuka()
    {
        // 1. Act: Buka halaman utama (root)
        $response = $this->get('/');

        // 2. Assert: Status harus 200 (OK)
        // Kalau error, berarti server mati total.
        $response->assertStatus(200);
    }
}
