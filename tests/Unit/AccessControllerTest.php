<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccessControllerTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat user admin untuk simulasi login
        $this->admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => 1
        ]);
    }

    /** @test */
    public function halaman_index_bisa_diakses_dan_menampilkan_data()
    {
        // Setup data dummy
        User::factory()->count(3)->create();

        // Action
        $response = $this->actingAs($this->admin)
                         ->get(route('admin.access.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('admin.access.index');
        $response->assertViewHas('users');
    }

    /** @test */
    public function halaman_edit_bisa_diakses()
    {
        $targetUser = User::factory()->create();
        Unit::factory()->create(); // Pastikan ada unit untuk view

        $response = $this->actingAs($this->admin)
                         ->get(route('admin.access.edit', $targetUser->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.access.edit');
        $response->assertViewHasAll(['user', 'units']);
    }

    /** @test */
    public function user_bisa_diupdate_hak_aksesnya()
    {
        // 1. Setup User & Unit
        $targetUser = User::factory()->create([
            'role' => 'anggota',
            'is_active' => 0
        ]);

        $newUnit = Unit::factory()->create();

        // 2. Data Request
        $updateData = [
            'role' => 'kepala_unit',
            'unit_id' => $newUnit->id,
            'status_akun' => '1', // Sesuai validasi request
        ];

        // 3. Action
        $response = $this->actingAs($this->admin)
                         ->put(route('admin.access.update', $targetUser->id), $updateData);

        // 4. Assert Redirect & Session
        $response->assertRedirect(route('admin.access.index'));
        $response->assertSessionHas('success', 'Hak akses pengguna berhasil diperbarui!');

        // 5. Assert Database (Pastikan is_active berubah jadi 1)
        $this->assertDatabaseHas('users', [
            'id' => $targetUser->id,
            'role' => 'kepala_unit',
            'unit_id' => $newUnit->id,
            'is_active' => 1
        ]);
    }

    /** @test */
    public function update_gagal_jika_role_tidak_valid()
    {
        $targetUser = User::factory()->create();

        $invalidData = [
            'role' => 'role_palsu',
            'unit_id' => null,
            'status_akun' => '1',
        ];

        $response = $this->actingAs($this->admin)
                         ->put(route('admin.access.update', $targetUser->id), $invalidData);

        $response->assertSessionHasErrors('role');
    }
}
