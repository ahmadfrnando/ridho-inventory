<?php

namespace Database\Factories;

use App\Models\BarangMasuk;
use App\Models\Laptop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BarangKeluar>
 */
class BarangKeluarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ambil BarangMasuk dengan jumlah laptop > 0 atau buat baru
        $barangMasuk = BarangMasuk::where('jlh_laptop', '>', 0)->inRandomOrder()->first();
        if (!$barangMasuk) {
            $barangMasuk = BarangMasuk::factory()->create(['jlh_laptop' => 100]);
        }

        $jumlahKeluar = $this->faker->numberBetween(1, $barangMasuk->jlh_laptop);

        return [
            'masuk_id' => $barangMasuk->id,
            'jlh_laptop' => $jumlahKeluar,
            'tanggal_pengeluaran' => $this->faker->dateTimeBetween($barangMasuk->tanggal_masuk, 'now'),
            'info' => $this->faker->sentence,
            'bidang' => $this->faker->company,
            'file' => $this->faker->imageUrl(640, 480, 'electronics', true, 'Laptop'),
        ];
    }

    /**
     * After creating callback to decrement BarangMasuk and update Laptop.
     */
    public function configure()
    {
        return $this->afterCreating(function ($barangKeluar) {
            // Kurangi jumlah laptop di BarangMasuk
            $barangMasuk = $barangKeluar->barangMasuk;
            // if ($barangMasuk) {
            //     $barangMasuk->decrement('jlh_laptop', $barangKeluar->jlh_laptop);
            // }

            // Update total_laptop di tabel Laptop
            $laptop = Laptop::where('masuk_id', $barangMasuk->id)->first();
            if ($laptop) {
                $laptop->decrement('total_laptop', $barangKeluar->jlh_laptop);
            }
        });
    }
}
