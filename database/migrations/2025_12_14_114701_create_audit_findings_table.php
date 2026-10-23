<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('audit_findings', function (Blueprint $table) {
            $table->id();
            $table->string('no_referensi')->unique()->nullable(); // Boleh null dulu jika auto-generate
            $table->string('judul');

            $table->foreignId('review_schedule_id')->constrained('review_schedules')->onDelete('cascade');
            $table->enum('kategori', ['ringan', 'sedang', 'berat'])->default('sedang');
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->foreignId('auditor_id')->constrained('users')->onDelete('cascade'); // Pembuat temuan

            $table->text('kondisi');      // Fakta
            $table->text('kriteria');     // Aturan
            $table->text('sebab');        // Penyebab
            $table->text('akibat');       // Dampak
            $table->text('rekomendasi');  // Solusi

            // FILE BUKTI (Dari Auditor - Opsional)
            $table->string('file_path')->nullable();

            // --- BAGIAN TANGGAPAN (Diisi Kepala Unit) ---
            $table->text('tanggapan_auditi')->nullable(); // <--- INI WAJIB ADA
            $table->timestamp('tanggal_tanggapan')->nullable();

            // STATUS
            // open: Auditor baru kirim (Kepala unit belum jawab)
            // responded: Kepala unit sudah jawab
            // closed: Auditor sudah setuju/close
            $table->enum('status', ['open', 'responded', 'closed'])->default('open');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_findings');
    }
};
