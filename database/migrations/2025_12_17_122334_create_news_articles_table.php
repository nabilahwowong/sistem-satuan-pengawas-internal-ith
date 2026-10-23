<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();

            $table->string('judul');
            $table->string('slug')->unique(); // Untuk URL SEO friendly
            $table->text('konten'); // Isi berita
            $table->string('thumbnail')->nullable(); // Foto utama berita
            $table->string('kategori')->default('Kegiatan'); // Contoh: Kegiatan, Pengumuman

            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->foreignId('author_id')->constrained('users'); // Penulis

            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_articles');
    }
};
