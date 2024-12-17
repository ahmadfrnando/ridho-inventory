@extends('admin.layout')

@section('title', 'Data Barang Keluar')

@section('content')

    <div class="flex justify-between items-center mb-4">
        <div class="flex gap-6">
            <a href="{{ route('barang-keluar.create') }}"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Tambah Barang Keluar
            </a>
            @if (session()->has('success'))
                <div id="alert-message"
                    class="flex items-center py-2 px-4 text-sm text-green-800 rounded-lg bg-green-50 border-green-900 border"
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
                    class="flex items-center py-2 px-4 text-sm text-red-800 rounded-lg bg-red-50 border-red-900 border"
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
        <form action="{{ route('barang-keluar.index') }}" method="GET" class="flex items-center">
            <input type="text" name="search" value="{{ request()->get('search') }}" placeholder="Cari Laptop..."
                class="border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <button type="submit"
                class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Cari</button>
        </form>
    </div>

    <table class="min-w-full bg-white border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">No</th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Kode Barang</th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Nama Laptop</th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Brand Laptop</th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Jumlah Laptop
                </th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Kondisi Laptop
                </th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Sumber Laptop
                </th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Harga Laptop
                </th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Tanggal Pengeluaran
                </th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if(count($laptops) === 0)
            <tr class="hover:bg-gray-100 uppercase">
                <td colspan="10" class="px-6 py-4 border-b border-gray-300 text-sm text-gray-900 text-center uppercase italic">tidak ada data</td>
            </tr>
            @endif
            @foreach ($laptops as $laptop)
                <tr class="hover:bg-gray-100 uppercase">
                    <td class="px-6 py-4 border-b border-gray-300 text-sm text-gray-900">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 border-b border-gray-300 text-sm text-gray-900">{{ $laptop->kode_barang }}</td>
                    <td class="px-6 py-4 border-b border-gray-300 text-sm text-gray-900">{{ $laptop->nama_laptop }}</td>
                    <td class="px-6 py-4 border-b border-gray-300 text-sm text-gray-900">{{ $laptop->brand_laptop }}</td>
                    <td class="px-6 py-4 border-b border-gray-300 text-sm text-gray-900">{{ $laptop->jumlah_laptop }}</td>
                    <td class="px-6 py-4 border-b border-gray-300 text-sm text-gray-900">{{ $laptop->kondisi_laptop }}</td>
                    <td class="px-6 py-4 border-b border-gray-300 text-sm text-gray-900">{{ $laptop->sumber_laptop }}</td>
                    <td class="px-6 py-4 border-b border-gray-300 text-sm text-gray-900">
                        {{ 'Rp ' . number_format($laptop->harga_laptop, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 border-b border-gray-300 text-sm text-gray-900">
                        {{ \Carbon\Carbon::parse($laptop->tanggal_pengeluaran)->translatedFormat('d F Y') }}
                    </td>
                    {{-- <td class="px-6 py-4 border-b border-gray-300 text-sm text-gray-900">
                        <a href="{{ route('barang-keluar.show', $laptop->id) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Ubah</a>
                        <a href="{{ route('barang-keluar.destroy', $laptop->id) }}"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Hapus</a>
                    </td> --}}
                    <td class="gap-2 px-6 py-4 border-b border-gray-300 text-sm text-gray-900">
                        <a href="{{ route('barang-keluar.show', $laptop->id) }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Ubah</a>
                        <form action="{{ route('barang-keluar.destroy', $laptop->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $laptops->links() }}
    </div>
    <script>
        // Menghilangkan notifikasi setelah 30 detik (30000 ms)
        setTimeout(function() {
            const alert = document.getElementById('alert-message');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000);
    </script>
@endsection
