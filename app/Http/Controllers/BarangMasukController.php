<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Alert;

use function Laravel\Prompts\error;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $laptops = BarangMasuk::query()
            ->where('kode_barang', 'LIKE', "%{$search}%")
            ->orWhere('kategory', 'LIKE', "%{$search}%")
            ->paginate(5);
        $title = 'Hapus data';
        $text = "Apakah anda yakin ingin menghapus data barang masuk?";
        confirmDelete($title, $text);
        return view('admin.barang-masuk.home', compact('laptops'));
    }

    public function form(Request $request)
    {
        $id = null;

        if ($request != null) {
            $id = $request->id;
        }
        $barangMasuk = BarangMasuk::find($id);
        $kategori = [
            ['label' => 'Pembelian', 'value' => 'Pembelian'], 
            ['label' => 'Peminjaman', 'value' => 'Peminjaman'],
            ['label' => 'Hadiah', 'value' => 'Hadiah'], 
            ['label' => 'Donasi', 'value' => 'Donasi']
        ];
        return view('admin.barang-masuk.form', compact('kategori', 'barangMasuk'));
    }

    public function store(Request $request)
    {
        $masukId = '';
        $jlhLaptop = '';
        // dd($request->all());

        $request->validate([
            'kode_barang' => 'required',
            'nama_laptop' => 'required',
            'jlh_laptop' => 'required',
            'sumber_laptop' => 'required',
            'tanggal_masuk' => 'required',
            'kategory' => 'required|in:Pembelian,Peminjaman,Hadiah,Donasi',
            'file' => 'required|mimes:jpg,jpeg,png|max:512',
        ]);
        try {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            Storage::disk('public')->put('uploads/' . $fileName, $file->getContent());
            $jlhLaptop = $request->jlh_laptop;
            BarangMasuk::create([
                'kode_barang' => $request->kode_barang,
                'nama_laptop' => $request->nama_laptop,
                'jlh_laptop' => $request->jlh_laptop,
                'sumber_laptop' => $request->sumber_laptop,
                'kategory' => $request->kategory,
                'tanggal_masuk' => $request->tanggal_masuk,
                'file' => $fileName,
            ]);
            $masukId = BarangMasuk::latest()->first()->id;
            Laptop::create([
                'masuk_id' => $masukId,
                'total_laptop' => $jlhLaptop,
            ]);
            return redirect()->route('barang-masuk.index')->with('success', 'Data barang masuk berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('barang-masuk.index')->with('error', 'Data barang masuk gagal ditambahkan' . $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $barangmasuk = BarangMasuk::find($id);
        $tanggal_masuk_old = $barangmasuk->tanggal_masuk;
        $file_old = $barangmasuk->file;
        try {
            $request->validate([
                'nama_laptop' => 'required',
                'jlh_laptop' => 'required',
                'sumber_laptop' => 'required',
            ]);
            $fileName = '';
            $file = $request->file('file');
            $date = $request->tanggal_masuk;
            if ($file) {
                $file_old = time() . '_' . $file->getClientOriginalName();
                Storage::disk('public')->put('uploads/' . $file_old, $file->getContent());
            } else if ($date) {
                $tanggal_masuk_old = $date;
            }

            $barangmasuk->update([
                'nama_laptop' => $request->nama_laptop,
                'jlh_laptop' => $request->jlh_laptop,
                'sumber_laptop' => $request->sumber_laptop,
                'tanggal_masuk' => $tanggal_masuk_old,
                'file' => $file_old
            ]);
            return redirect()->route('barang-masuk.index')->with('success', 'Data barang masuk berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->route('barang-masuk.index')->with('error', 'Data barang masuk gagal diupdate' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        $barangmasuk = BarangMasuk::find($id);

        if (!$barangmasuk) {
            return redirect()->route('barang-masuk.index')->with('error', 'Data barang masuk tidak ditemukan');
        }

        $file_barang_masuk = $barangmasuk->file;

        try {
            DB::transaction(function () use ($barangmasuk, $file_barang_masuk) {
                if (Storage::disk('public')->exists('uploads/' . $file_barang_masuk)) {
                    Storage::disk('public')->delete('uploads/' . $file_barang_masuk);
                }

                $barangkeluar = BarangKeluar::where('masuk_id', $barangmasuk->id)->first();
                if ($barangkeluar) {
                    $barangkeluar->delete();
                }

                $laptop = Laptop::where('masuk_id', $barangmasuk->id)->first();
                if ($laptop) {
                    $laptop->delete();
                }

                $barangmasuk->delete();
            });

            return redirect()->route('barang-masuk.index')->with('success', 'Data barang masuk berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('barang-masuk.index')->with('error', 'Data barang masuk gagal dihapus: ' . $th->getMessage());
        }
    }
}