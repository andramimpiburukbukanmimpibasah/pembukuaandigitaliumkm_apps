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
        Schema::table('products', function (Blueprint $table) {
            $table->string('foto_produk')->nullable()->after('nama_produk');
            $table->string('nama_brand')->nullable()->after('foto_produk');
            $table->string('kategori_produk')->nullable()->after('nama_brand');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['foto_produk', 'nama_brand', 'kategori_produk']);
        });
    }
};
