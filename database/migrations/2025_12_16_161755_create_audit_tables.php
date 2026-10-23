<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Tabel Pedoman Kerja (Master Data - Diisi Admin)
        Schema::create('work_guidelines', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Misal: "Langkah Pemeriksaan Kas", "Cek Fisik Aset"
            $table->text('deskripsi')->nullable(); // Detail langkah kerja
            $table->enum('jenis', ['audit', 'reviu']); // Membedakan pedoman Audit & Reviu
            $table->string('file_path')->nullable(); // Jika ada file PDF/Doc pendukung
            $table->timestamps();
        });

        // 2. Tabel Kertas Kerja Audit/Reviu (KKA - Diisi Anggota)
        Schema::create('audit_working_papers', function (Blueprint $table) {
            $table->id();
            // Terhubung ke Jadwal Reviu yang sudah dibuat sebelumnya
            $table->foreignId('review_schedule_id')->constrained('review_schedules')->onDelete('cascade');

            // Relasi ke Pedoman (Opsional, jika audit berdasarkan langkah kerja tertentu)
            $table->foreignId('work_guideline_id')->nullable()->constrained('work_guidelines');

            // Atribut Temuan (Sesuai Pedoman SPI)
            $table->text('kondisi'); // Temuan di lapangan
            $table->text('kriteria'); // Aturan yang berlaku
            $table->text('sebab'); // Kenapa terjadi
            $table->text('akibat'); // Dampaknya
            $table->text('rekomendasi'); // Saran perbaikan

            $table->string('bukti_path')->nullable(); // Upload bukti foto/dokumen
            $table->enum('status', ['draft', 'submitted', 'reviewed'])->default('draft');

            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });

        // 3. Tabel Kertas Data Audit (KDA - Rangkuman untuk Auditee)
        Schema::create('audit_data_papers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_schedule_id')->constrained('review_schedules')->onDelete('cascade');

            // Data rangkuman dari KKA
            $table->string('kode_temuan')->unique(); // Misal: KDA-001/2025
            $table->text('uraian_masalah');
            $table->text('rekomendasi_final');

            // Tanggapan Auditee (Kepala Unit)
            $table->text('tanggapan_auditee')->nullable();
            $table->enum('status_tanggapan', ['menunggu', 'ditanggapi', 'selesai'])->default('menunggu');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_data_papers');
        Schema::dropIfExists('audit_working_papers');
        Schema::dropIfExists('work_guidelines');
    }
};
