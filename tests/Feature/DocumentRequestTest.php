<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper: Buat Unit Kerja Dummy (Induk)
     */
    private function createUnit()
    {
        return DB::table('units')->insertGetId([
            'nama_unit' => 'Unit Teknologi',
            'kode_unit' => 'TI-01',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function test_halaman_request_menampilkan_data_yang_benar()
    {
        // 1. Arrange: Siapkan Aktor & Data Induk
        /** @var \App\Models\User $anggota */
        $anggota = User::factory()->create(['role' => 'anggota']);
        $userLain = User::factory()->create(['role' => 'anggota']);
        $adminPembuat = User::factory()->create(['role' => 'admin']);

        $unitId = $this->createUnit();

        // 2. Buat Jadwal Aktif
        $jadwalAktifId = DB::table('review_schedules')->insertGetId([
            'nama_kegiatan'   => 'Audit 2024 (Aktif)',
            'unit_id'         => $unitId,
            'tanggal_mulai'   => now()->toDateString(),
            'tanggal_selesai' => now()->addDays(30)->toDateString(),
            'jenis_penugasan' => 'Rutin',
            'status'          => 'Berjalan',
            'created_by'      => $adminPembuat->id,
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 3. Buat Jadwal Selesai (Biar ketahuan kalau ke-filter)
        DB::table('review_schedules')->insert([
            'nama_kegiatan'   => 'Audit 2023 (Selesai)',
            'unit_id'         => $unitId,
            'tanggal_mulai'   => now()->subYear()->toDateString(),
            'tanggal_selesai' => now()->subMonths(11)->toDateString(),
            'jenis_penugasan' => 'Khusus',
            'status'          => 'Selesai',
            'created_by'      => $adminPembuat->id,
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 4. Buat Request Dummy
        DB::table('document_requests')->insert([
            'judul'              => 'Request Punya Saya',
            'review_schedule_id' => $jadwalAktifId,
            'created_by'         => $anggota->id,
            'status'             => 'pending',
            'created_at'         => now(),
            'updated_at'         => now()
        ]);

        // Act: Akses URL yang BENAR (Sesuai Screenshot Route List)
        $response = $this->actingAs($anggota)->get('/anggota/documents/request');

        // Assert
        $response->assertStatus(200);
        $response->assertSee('Audit 2024 (Aktif)');
        $response->assertSee('Request Punya Saya');
    }

    /**
     * Test 2: Proses Store (Simpan)
     */
    public function test_simpan_permintaan_dokumen_berhasil()
    {
        /** @var \App\Models\User $anggota */
        $anggota = User::factory()->create(['role' => 'anggota']);
        $admin = User::factory()->create();

        $unitId = $this->createUnit();

        // Buat Jadwal Target
        $scheduleId = DB::table('review_schedules')->insertGetId([
            'nama_kegiatan'   => 'Jadwal Test Simpan',
            'unit_id'         => $unitId,
            'tanggal_mulai'   => now()->toDateString(),
            'tanggal_selesai' => now()->addDays(7)->toDateString(),
            'jenis_penugasan' => 'Rutin',
            'status'          => 'Berjalan',
            'created_by'      => $admin->id,
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        $input = [
            'review_schedule_id' => $scheduleId,
            'judul'              => 'Permintaan SK',
            'deskripsi'          => 'Mohon dikirimkan SK terbaru',
        ];

        // Act: POST ke URL yang BENAR
        $response = $this->actingAs($anggota)->post('/anggota/documents/request', $input);

        // Assert
        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Permintaan dokumen berhasil dikirim ke Unit.');

        $this->assertDatabaseHas('document_requests', [
            'judul'      => 'Permintaan SK',
            'created_by' => $anggota->id
        ]);
    }

    /**
     * Test 3: Validasi Gagal
     */
    public function test_gagal_simpan_jika_form_kosong()
    {
        /** @var \App\Models\User $anggota */
        $anggota = User::factory()->create(['role' => 'anggota']);

        // Act: POST data kosong ke URL yang BENAR
        $response = $this->actingAs($anggota)->post('/anggota/documents/request', []);

        $response->assertSessionHasErrors(['review_schedule_id', 'judul']);
    }
}
