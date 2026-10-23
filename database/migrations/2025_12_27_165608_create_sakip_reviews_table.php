<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sakip_reviews', function (Blueprint $table) {
            $table->id();

            // Relasi
            $table->foreignId('unit_id')->nullable()->constrained('units')->onDelete('cascade'); // Bisa per unit atau Institusi
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');

            // Identitas
            $table->year('tahun');
            $table->string('judul_evaluasi'); // Misal: Evaluasi SAKIP 2024

            // Nilai Komponen (Sesuai Pedoman Bab III.D)
            // Menggunakan decimal agar presisi
            $table->decimal('nilai_perencanaan', 5, 2)->default(0); // Bobot 30% [cite: 472]
            $table->decimal('nilai_pengukuran', 5, 2)->default(0);  // Bobot 25% [cite: 491]
            $table->decimal('nilai_pelaporan', 5, 2)->default(0);   // Bobot 15% [cite: 506]
            $table->decimal('nilai_evaluasi', 5, 2)->default(0);    // Bobot 10% [cite: 516]
            $table->decimal('nilai_capaian', 5, 2)->default(0);     // Bobot 20% [cite: 521]

            // Hasil Akhir
            $table->decimal('nilai_akhir', 5, 2)->default(0); // Total dari komponen
            $table->string('predikat', 5); // AA, A, BB, B, CC, C, D
            $table->text('catatan_rekomendasi')->nullable();

            // File LHE (Laporan Hasil Evaluasi)
            $table->string('file_path');

            $table->enum('status', ['draft', 'final'])->default('final');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sakip_reviews');
    }
};
