@extends('admin.layout')

@section('title', 'Tambah Barang Keluar')

@section('content')

    <div class="max-w-4xl bg-white p-8 border border-gray-300 rounded-lg shadow-lg">
        <div class="relative justify-between items-center">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Barang Keluar</h2>
            @if (session()->has('success'))
                <div id="alert-message"
                    class="absolute top-0 right-0 items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border-green-900 border"
                    role="alert">
                    <div class="inline-flex items-center">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                </div>
            @endif
            @if (session()->has('error'))
                <div id="alert-message"
                    class="absolute right-8 items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-900"
                    role="alert">
                    <div class="inline-flex items-center">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="flex flex-col gap-6">
            <form id="searchForm">
                @csrf
                <input type="text" id="search" name="search" placeholder="Masukkan Kode ..."
                    class="border uppercase border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <button type="submit"
                    class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Cari</button>
            </form>
            <form action="{{ route('barang-keluar.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input type="text" id="kode_barang" name="kode_barang"
                        class="w-full hidden uppercase px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        readonly>
                    <div>
                        <label for="nama_laptop" class="block text-sm font-medium text-gray-700 mb-2">Nama Laptop</label>
                        <input type="text" id="nama_laptop" name="nama_laptop"
                            class="w-full uppercase px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            readonly>
                    </div>
                    <div>
                        <label for="brand_laptop" class="block text-sm font-medium text-gray-700 mb-2">Brand Laptop</label>
                        <input type="text" id="brand_laptop" name="brand_laptop"
                            class="w-full uppercase px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            readonly>
                    </div>
                    <div>
                        <label for="jumlah_laptop" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Barang
                            Keluar
                            <span id="jumlah-laptop-masuk" class="text-xs text-gray-500"></span>
                        </label>
                        <input type="number" id="jumlah_laptop" name="jumlah_laptop"
                            class="w-full uppercase px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="kondisi_laptop" class="block text-sm font-medium text-gray-700 mb-2">Kondisi
                            Laptop</label>
                        <select id="kondisi_laptop" name="kondisi_laptop"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            <option value="Baru">Baru
                            </option>
                            <option value="Bekas">Bekas
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="sumber_laptop" class="block text-sm font-medium text-gray-700 mb-2">Sumber
                            Laptop</label>
                        <input type="text" id="sumber_laptop" name="sumber_laptop"
                            class="w-full uppercase px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                    </div>
                    <div>
                        <label for="harga_laptop" class="block text-sm font-medium text-gray-700 mb-2">Harga Laptop</label>
                        <input type="number" id="harga_laptop" name="harga_laptop"
                            class="w-full uppercase px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                    </div>
                    <div>
                        <label for="tanggal_pengeluaran" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                            Pengeluaran</label>
                        <input type="date" id="tanggal_pengeluaran" name="tanggal_pengeluaran"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                    </div>
                    
                </div>
                <div class="flex gap-4 justify-end mt-6">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        setTimeout(function() {
            const alert = document.getElementById('alert-message');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000);

        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form submit biasa

            const searchQuery = document.getElementById('search').value;

            fetch(`{{ route('barang-keluar.search') }}?search=${searchQuery}`, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Isi form dengan data yang ditemukan
                        document.getElementById('kode_barang').value = data.data.kode_barang;
                        document.getElementById('nama_laptop').value = data.data.nama_laptop;
                        document.getElementById('jumlah-laptop-masuk').textContent = `(Jumlah laptop masuk: ${data.data.jumlah_laptop})`;
                    } else {
                        alert(data.message); // Tampilkan pesan error jika data tidak ditemukan
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>


@endsection
