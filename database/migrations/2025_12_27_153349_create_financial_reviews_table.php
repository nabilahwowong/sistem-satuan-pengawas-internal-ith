<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('financial_reviews', function (Blueprint $table) {
            $table->id();

            // Relasi
            $table->foreignId('unit_id')->nullable()->constrained('units')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');

            // Identitas Reviu
            $table->enum('kategori', ['keuangan', 'anggaran']); // Pembeda Bab III.B vs III.E/F
            $table->year('tahun_anggaran');
            $table->enum('periode', ['Triwulan I', 'Triwulan II', 'Triwulan III', 'Triwulan IV', 'Tahunan']);

            // Data Anggaran (Khusus Kategori 'anggaran')
            $table->decimal('pagu_anggaran', 15, 2)->default(0); // Max 999 Triliun
            $table->decimal('realisasi_anggaran', 15, 2)->default(0);
            $table->float('persentase_serapan')->default(0); // Di Pedoman ada target >90%

            // Data Kepatuhan (Khusus Kategori 'keuangan')
            // Menyimpan status Checklist (Sesuai/Tidak) dari Pedoman Hal 23-28
            $table->boolean('is_lra_valid')->default(false);
            $table->boolean('is_neraca_valid')->default(false);
            $table->boolean('is_calk_valid')->default(false);
            $table->integer('jumlah_temuan_kepatuhan')->default(0);

            // Dokumen Fisik
            $table->string('judul_dokumen');
            $table->string('nomor_surat')->nullable();
            $table->string('file_path'); // File PDF LHR Keuangan/Anggaran

            $table->enum('status', ['draft', 'final'])->default('final');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financial_reviews');
    }
};
