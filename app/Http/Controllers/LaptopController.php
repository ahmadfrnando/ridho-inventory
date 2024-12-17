<?php

namespace App\Http\Controllers;

use App\Exports\DataLaptopExport;
use App\Models\Laptop;
use App\Models\BarangMasuk;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use function Laravel\Prompts\error;

class LaptopController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $laptops = Laptop::with('barangMasuk')
            ->whereHas('barangMasuk', function ($query) use ($search) {
                $query->where('kode_barang', 'LIKE', "%{$search}%")
                    ->orWhere('nama_laptop', 'LIKE', "%{$search}%");
            })->paginate(5);
        return view('admin.laptop.home', compact('laptops'));
    }

    public function export() 
    {
        return Excel::download(new DataLaptopExport, 'data_laptop.xlsx');
    }
}