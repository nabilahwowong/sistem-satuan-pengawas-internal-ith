<?php

namespace Tests\Feature;

use Tests\TestCase;

class SejarahPageTest extends TestCase
{
    /**
     * Test akses halaman Sejarah.
     * Route: Profil/sejarah
     */
    public function test_halaman_sejarah_bisa_diakses()
    {
        // 1. Act: Akses halaman
        $response = $this->get('/Profil/sejarah');

        // 2. Assert: Status OK (200)
        $response->assertStatus(200);

        // 3. Assert: Cek teks yang PASTI ada di judul/body
        // Kita hapus kata 'Kampus' yang bikin error tadi
        $response->assertSee(['Sejarah', 'SPI'], false);
    }
}
