<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('audit_reports', function (Blueprint $table) {
            $table->id();

            // Relasi
            // Pastikan tabel 'review_schedules' sudah ada. Jika belum, hapus baris ini atau buat nullable
            $table->foreignId('review_schedule_id')->nullable()->constrained('review_schedules')->onDelete('cascade');
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');

            // Data Laporan
            $table->enum('jenis', ['LHA', 'LHR']); // LHA = Audit (Bab II), LHR = Reviu (Bab III)
            $table->string('nomor_laporan');
            $table->string('judul_laporan');
            $table->date('tanggal_laporan');
            $table->string('file_path');

            // TAMBAHAN: Agar Dashboard Pimpinan bisa menampilkan angka statistik
            $table->integer('jumlah_temuan')->default(0);
            $table->integer('jumlah_rekomendasi')->default(0);

            $table->enum('status', ['draft', 'final'])->default('final');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_reports');
    }
};
