<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->get('search');
        $barangKeluar = BarangKeluar::with('barangMasuk')
            ->whereHas('barangMasuk', function ($query) use ($search) {
                $query->where('kode_barang', 'LIKE', "%{$search}%")
                    ->orWhere('nama_laptop', 'LIKE', "%{$search}%");
            })
            ->paginate(10);
            $title = 'Hapus data';
            $text = "Apakah anda yakin ingin menghapus data barang keluar?";
            confirmDelete($title, $text);
        return view('admin.barang-keluar.home', compact('barangKeluar'));
    }


    public function form(Request $request)
    {
        $id = $request->id;
        $barangKeluar = $id ? BarangKeluar::with('barangMasuk')->find($id) : null;

        $barangMasuk = BarangMasuk::all()->map(function ($item) {
            return [
                'label' => $item->kode_barang,
                'value' => $item->id
            ];
        });

        return view('admin.barang-keluar.form', compact('barangKeluar', 'barangMasuk'));
    }


    public function create(Request $request)
    {
        $query = $request->input('search');
        // Cek apakah ada pencarian
        if ($query) {
            // Lakukan pencarian berdasarkan nama laptop
            $laptops = BarangMasuk::where('kode_barang', 'LIKE', '%' . $query . '%');
        } else {
            // Jika tidak ada pencarian, tampilkan semua data
            $laptops = BarangMasuk::all();
        }

        return view('admin.barang-keluar.create', compact('laptops'));
    }

    public function search(Request $request)
    {
        $kode = $request->input('search');
        $laptop = BarangMasuk::where('kode_barang', $kode)->first();

        if ($laptop) {
            return response()->json([
                'success' => true,
                'data' => $laptop
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function store(Request $request)
    {
        $masukId = '';
        try {
            $request->validate([
                'kode_barang' => 'required',
                'jlh_laptop' => 'required',
                'bidang' => 'required',
                'file' => 'required|mimes:jpg,jpeg,png|max:512',
                'tanggal_pengeluaran' => 'required',
                'info' => 'required',
            ]);

            $masukId = $request->kode_barang;
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            Storage::disk('public')->put('uploads/barang-keluar/' . $fileName, $file->getContent());
            $barangkeluar = BarangKeluar::create([
                'masuk_id' => $masukId,
                'jlh_laptop' => $request->jlh_laptop,
                'bidang' => $request->bidang,
                'file' => $fileName,
                'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
                'info' => $request->info,
            ]);
            // dd($masukId);

            $laptop = Laptop::where('masuk_id', $masukId)->first();
            $total_laptop = $laptop->total_laptop - $request->jlh_laptop;
            $laptop->update([
                'total_laptop' => $total_laptop
            ]);
            // $laptop = Laptop::where('kode_barang', $request->kode_barang)->first();
            // $jumlah_awal = $laptop->jumlah_laptop;
            // $total_laptop = $jumlah_awal - $request->jumlah_laptop;
            // $barangkeluar->update([
            //     'jumlah_laptop' => $total_laptop
            // ]);

            // $laptop = new BarangKeluar;
            // $laptop->create($request->all());


            return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('barang-keluar.index')->with('error', 'Data barang keluar gagal ditambahkan' . $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $barangkeluar = BarangKeluar::find($id);
        $file_old = $barangkeluar->file;
        if (!$barangkeluar) {
            return redirect()->route('barang-keluar.index')->with('error', 'Data barang keluar tidak ditemukan');
        }
        try {
            $request->validate([
                'jlh_laptop' => 'required',
                'bidang' => 'required',
                'tanggal_pengeluaran' => 'required',
                'info' => 'required',
            ]);
            
            $file = $request->file('file');
            $date = $request->tanggal_pengeluaran;

            if ($file) {
                $file_old = time() . '_' . $file->getClientOriginalName();
                Storage::disk('public')->put('uploads/barang-keluar/' . $file_old, $file->getContent());
            }
            
            $barangkeluar->update([
                'jlh_laptop' => $request->jlh_laptop,
                'bidang' => $request->bidang,
                'info' => $request->info,
                'file' => $file_old,
                'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            ]);
            return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->route('barang-keluar.index')->with('error', 'Data barang keluar gagal diupdate');
        }
    }
    public function destroy($id)
    {
        try {
            $barangkeluar = BarangKeluar::find($id);
            $laptop = Laptop::where('masuk_id', $barangkeluar->masuk_id)->first();
            $total_laptop = $laptop->total_laptop + $barangkeluar->jlh_laptop;
            $laptop->update([
                'total_laptop' => $total_laptop
            ]);
            $barangkeluar->delete();
        } catch (\Throwable $th) {
            return redirect()->route('barang-keluar.index')->with('error', 'Data barang keluar gagal dihapus');
        }
        return redirect()->route('barang-keluar.index')->with('success', 'Data barang masuk berhasil dihapus');
    }
}