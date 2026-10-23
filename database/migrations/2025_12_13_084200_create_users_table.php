<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Lengkap

            // EMAIL (Wajib ada & Unik untuk Login)
            $table->string('email')->unique();

            // Data Pendukung (Opsional/Nullable)
            $table->string('nip')->unique()->nullable();
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();

            $table->string('password');

            // Role: admin, anggota, kepala_unit, pimpinan
            $table->string('role')->default('anggota');

            // Relasi ke Unit Kerja
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->nullOnDelete();

            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
