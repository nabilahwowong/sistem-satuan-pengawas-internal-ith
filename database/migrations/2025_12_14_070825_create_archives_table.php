<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Judul Laporan
            $table->string('nomor_laporan'); // No. LHA atau No. LHR

            // Kategori: LHA (Audit) atau LHR (Reviu)
            $table->enum('kategori', ['lha', 'lhr']);

            $table->integer('tahun'); // Tahun Anggaran
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade'); // Unit yang diaudit/direviu

            $table->string('file_path'); // File PDF Final
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('archives');
    }
};
