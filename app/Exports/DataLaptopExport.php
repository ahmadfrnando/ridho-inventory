<?php

namespace App\Exports;

use App\Models\Laptop;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataLaptopExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Laptop::with('barangMasuk') // Asumsi relasi bernama barangMasuk
            ->get()
            ->map(function ($laptop) {
                return [
                    'kode_barang' => $laptop->barangMasuk->kode_barang,
                    'nama_laptop' => $laptop->barangMasuk->nama_laptop,
                    'total_laptop' => $laptop->total_laptop,
                ];
            });
    }

    /**
     * Define the headings for the exported Excel file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Kode Barang',
            'Nama Laptop',
            'Total Laptop'
        ];
    }
}