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
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->string('file');
            $table->enum('kategory', ['Pembelian', 'Pengembalian', 'Hadiah', 'Donasi']);
            $table->dropColumn('foto_laptop');
            $table->dropColumn('brand_laptop');
            $table->dropColumn('kondisi_laptop');
            $table->dropColumn('harga_laptop');
            $table->dropColumn('tanggal_pembelian');
            $table->date('tanggal_masuk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->dropColumn('file');
            $table->dropColumn('tanggal_masuk');
        });
    }
};