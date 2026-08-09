<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('nama_usaha');
            $table->string('nama_brand')->nullable()->after('logo');
            $table->string('jenis_usaha')->nullable()->after('no_hp');
            $table->text('deskripsi_usaha')->nullable()->after('jenis_usaha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->dropColumn(['logo', 'nama_brand', 'jenis_usaha', 'deskripsi_usaha']);
        });
    }
};
