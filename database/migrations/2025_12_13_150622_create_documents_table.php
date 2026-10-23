<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('judul');

            // KATEGORI SPESIFIK SESUAI REQUEST
            $table->enum('kategori', ['pedoman_audit', 'pedoman_reviu', 'template']);

            $table->string('file_path');
            $table->string('tipe_file')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
