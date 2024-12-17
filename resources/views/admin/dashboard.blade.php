@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-2 xl:grid-cols-3">
        <div class="flex justify-between p-6 bg-white rounded-lg shadow-md">
            <div>
                <h3 class="text-lg font-semibold text-gray-600">Data Laptop Tersedia</h3>
                <h3 class="text-xl font-bold mt-2 text-gray-800">{{ $totalLaptop }}</h3>
            </div>
            <div class="flex items-center justify-center w-16 h-16 bg-blue-300 rounded-full">
                <x-fas-laptop />
            </div>
        </div>
        <div class="flex justify-between p-6 bg-white rounded-lg shadow-md">
            <div>
                <h3 class="text-lg font-semibold text-gray-600">Data Barang Masuk</h3>
                <p class="text-xl font-bold mt-2 text-gray-800">{{ $totalBarangMasuk }}</p>
            </div>
            <div class="flex items-center justify-center w-16 h-16 bg-red-300 rounded-full">
                <x-fas-inbox />
            </div>
        </div>
        <div class="flex justify-between p-6 bg-white rounded-lg shadow-md">
            <div>
                <h3 class="text-lg font-semibold text-gray-600">Data Barang Keluar</h3>
                <p class="text-xl font-bold mt-2 text-gray-800">{{ $totalBarangKeluar }}</p>
            </div>
            <div class="flex items-center justify-center w-16 h-16 bg-orange-300 rounded-full">
                <x-fas-inbox />
            </div>
        </div>
    </div>
@endsection
