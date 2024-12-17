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
        Schema::table('laptops', function (Blueprint $table) {
            $table->dropColumn('kode_barang');
            $table->dropColumn('nama_laptop');
            $table->unsignedBigInteger('masuk_id');
            $table->foreign('masuk_id')->references('id')->on('barang_masuks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laptops', function (Blueprint $table) {
            $table->dropColumn('masuk_id');
            $table->string('kode_barang');
            $table->string('nama_laptop');
        });
    }
};