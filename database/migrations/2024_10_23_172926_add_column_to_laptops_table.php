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
            $table->dropColumn('brand_laptop');
            $table->dropColumn('jumlah_laptop');
            $table->integer('total_laptop');
            $table->dropColumn('foto_laptop');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laptops', function (Blueprint $table) {
            $table->string('brand_laptop');
            $table->string('jumlah_laptop');
            $table->dropColumn('total_laptop');
            $table->string('foto_laptop');
        });
    }
};