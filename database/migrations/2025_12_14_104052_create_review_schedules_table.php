<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('review_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan'); // Contoh: Reviu Laporan Keuangan Semester 1
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade'); // Unit yang akan direviu
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('jenis_penugasan'); // Audit, Reviu, Monitoring, dll
            $table->enum('status', ['Terjadwal', 'Berjalan', 'Selesai', 'Ditunda'])->default('Terjadwal');
            $table->foreignId('created_by')->constrained('users'); // Siapa yang membuat jadwal
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('review_schedules');
    }
};
