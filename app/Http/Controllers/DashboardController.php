<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function dashboard()
    {
        $totalBarangMasuk = DB::table('barang_masuks')->sum('jlh_laptop');
        $totalBarangKeluar = DB::table('barang_keluars')->sum('jlh_laptop');
        $totalLaptop = DB::table('laptops')->sum('total_laptop');

        return view('admin.dashboard', compact('totalBarangMasuk', 'totalBarangKeluar', 'totalLaptop'));
    }
}