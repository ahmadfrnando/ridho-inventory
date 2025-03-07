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
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_laptop');
            $table->string('brand_laptop');
            $table->string('jumlah_laptop');
            $table->string('kondisi_laptop');
            $table->string('sumber_laptop');
            $table->string('harga_laptop');
            $table->string('tanggal_pembelian');
            $table->string('foto_laptop');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};