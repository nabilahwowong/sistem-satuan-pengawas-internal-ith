<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::table('landing_contents', function (Blueprint $table) {
        $table->string('image')->nullable()->after('content'); // Kolom untuk simpan nama file
    });
}

public function down() {
    Schema::table('landing_contents', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}
};
