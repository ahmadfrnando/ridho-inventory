<?php

namespace Database\Factories;

use App\Models\BarangMasuk;
use App\Models\Laptop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BarangMasuk>
 */
class BarangMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_barang' => $this->faker->unique()->regexify('[A-Z]{3}-[0-9]{4}'),
            'nama_laptop' => $this->faker->word . ' Laptop',
            'sumber_laptop' => $this->faker->company,
            'file' => $this->faker->imageUrl(640, 480, 'electronics', true, 'Laptop'),
            'tanggal_masuk' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'jlh_laptop' => $this->faker->numberBetween(1, 100),
            'kategory' => $this->faker->randomElement(['Peminjaman', 'Pengembalian', 'Pembelian', 'Hadiah', 'Donasi']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (BarangMasuk $barangMasuk) {
            // Tambahkan data ke tabel Laptop
            Laptop::create([
                'masuk_id' => $barangMasuk->id,
                'total_laptop' => $barangMasuk->jlh_laptop,
            ]);
        });
    }
}
