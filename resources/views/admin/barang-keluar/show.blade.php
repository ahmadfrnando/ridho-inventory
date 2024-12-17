@extends('admin.layout')

@section('title', 'Data Barang Keluar')

@section('content')

    <div class="max-w-4xl bg-white p-8 border border-gray-300 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Data Laptop</h2>
        <form action="{{ route('barang-keluar.update', $laptop->id) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="kode_barang" class="block text-sm font-medium text-gray-700 mb-2">Kode_Barang</label>
                    <input type="text" id="kode_barang" name="kode_barang" value="{{ $laptop->kode_barang }}"
                        class="w-full uppercase px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        readonly>
                </div>
                <div>
                    <label for="nama_laptop" class="block text-sm font-medium text-gray-700 mb-2">Nama Laptop</label>
                    <input type="text" id="nama_laptop" name="nama_laptop" value="{{ $laptop->nama_laptop }}"
                        class="w-full uppercase px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        readonly>
                </div>
                <div>
                    <label for="brand_laptop" class="block text-sm font-medium text-gray-700 mb-2">Brand Laptop</label>
                    <input type="text" id="brand_laptop" name="brand_laptop" value="{{ $laptop->brand_laptop }}"
                        class="w-full uppercase px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        readonly>
                </div>
                <div>
                    <label for="jumlah_laptop" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Laptop</label>
                    <input type="number" id="jumlah_laptop" name="jumlah_laptop" value="{{ $laptop->jumlah_laptop }}"
                        class="w-full uppercase px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div>
                    <label for="kondisi_laptop" class="block text-sm font-medium text-gray-700 mb-2">Kondisi Laptop</label>
                    <select id="kondisi_laptop" name="kondisi_laptop"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        <option value="Baru"
                            {{ old('kondisi_laptop', $laptop->kondisi_laptop) == 'Baru' ? 'selected' : '' }}>Baru</option>
                        <option value="Bekas"
                            {{ old('kondisi_laptop', $laptop->kondisi_laptop) == 'Bekas' ? 'selected' : '' }}>Bekas</option>
                    </select>
                </div>
                <div>
                    <label for="sumber_laptop" class="block text-sm font-medium text-gray-700 mb-2">Sumber Laptop</label>
                    <input type="text" id="sumber_laptop" name="sumber_laptop" value="{{ $laptop->sumber_laptop }}"
                        class="w-full uppercase px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div>
                    <label for="harga_laptop" class="block text-sm font-medium text-gray-700 mb-2">Harga Laptop</label>
                    <input type="number" id="harga_laptop" name="harga_laptop" value="{{ $laptop->harga_laptop }}"
                        class="w-full uppercase px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div>
                    <label for="tanggal_pengeluaran" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                        pengeluaran</label>
                    <input type="date" id="tanggal_pengeluaran" name="tanggal_pengeluaran"
                        value="{{ $laptop->tanggal_pengeluaran }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
            </div>
            <div class="flex gap-4 justify-end mt-6">
                <a href="{{ route('barang-keluar.index') }}"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">Kembali</a>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>


@endsection
