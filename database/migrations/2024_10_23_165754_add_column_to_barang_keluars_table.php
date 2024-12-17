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
        Schema::table('barang_keluars', function (Blueprint $table) {
            $table->dropColumn('kode_barang');
            $table->dropColumn('nama_laptop');
            $table->dropColumn('brand_laptop');
            $table->dropColumn('jumlah_laptop');
            $table->dropColumn('kondisi_laptop');
            $table->dropColumn('harga_laptop');
            $table->dropColumn('sumber_laptop');
            $table->integer('jlh_laptop');
            $table->string('bidang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang_keluars', function (Blueprint $table) {
            $table->string('kode_barang');
            $table->string('nama_laptop');
            $table->string('brand_laptop');
            $table->string('jumlah_laptop');
            $table->string('kondisi_laptop');
            $table->string('sumber_laptop');
            $table->string('harga_laptop');
            $table->dropColumn('bidang');
            $table->dropColumn('jlh_laptop');
        });
    }
};