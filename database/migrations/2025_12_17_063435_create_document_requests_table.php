<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('document_requests', function (Blueprint $table) {
            $table->id();

            // 1. RELASI UTAMA
            // Link ke Jadwal Audit
            $table->foreignId('review_schedule_id')->constrained('review_schedules')->onDelete('cascade');
            // Link ke Unit (PENTING: Agar Kepala Unit bisa filter data miliknya)
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');

            // 2. BAGIAN PERMINTAAN (Diisi Auditor)
            $table->string('judul'); // Cth: "Laporan Keuangan Semester 1"
            $table->text('deskripsi')->nullable(); // Penjelasan detail
            $table->date('deadline')->nullable(); // PENTING: Untuk sorting prioritas
            $table->string('file_path_auditor')->nullable(); // Template dari auditor (opsional)
            $table->foreignId('created_by')->constrained('users'); // Auditor pembuat

            // 3. BAGIAN TANGGAPAN (Diisi Auditi / Kepala Unit)
            $table->text('catatan_auditi')->nullable(); // Keterangan saat upload
            $table->string('file_path_auditi')->nullable(); // File hasil upload
            $table->timestamp('responded_at')->nullable(); // Waktu upload

            // 4. STATUS
            // pending: baru dibuat auditor
            // terkirim: sudah diupload auditi (menunggu review)
            // fulfilled: diterima/oke oleh auditor
            // rejected: ditolak auditor (minta perbaikan)
            $table->enum('status', ['pending', 'terkirim', 'fulfilled', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('document_requests');
    }
};
