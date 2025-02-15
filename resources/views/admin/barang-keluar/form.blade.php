@extends('admin.layout')

@section('title', 'Barang Keluar')

@section('content')
@include('sweetalert::alert')
<div class="max-w-4xl">
    <x-bladewind.card>
        <h1 class="my-2 text-2xl font-light text-blue-900/80">Silahkan Isi Form</h1>
        <p class="mt-3 mb-6 text-blue-900/80 text-sm">
            Lengkapi form dibawah ini
        </p>
        @if (!$barangKeluar)
        <form method="post" action="{{ route('barang-keluar.store') }} " class="uppercase"
            enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <x-bladewind::select name="kode_barang" id="kode_barang" required="true" :data="$barangMasuk"
                    placeholder="Pilih Kode Barang" error_message="Kode Barang Harus Diisi" />
                <x-bladewind::input name="jlh_laptop" id="jlh_laptop" required="true" numeric="true" label="Jumlah Laptop"
                    error_message="Jumlah Laptop Harus Diisi" value="{{ old('jlh_laptop') }}" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <x-bladewind::input name="bidang" required="true" label="Bidang"
                    error_message="Bidang Harus Diisi" />
                <x-bladewind::datepicker name="tanggal_pengeluaran" required="true"
                    error_message="Tanggal Keluar Harus Diisi" />
            </div>
            <div class="row gap-4">
                <x-bladewind::input name="info" required="true" label="Keterangan"
                    error_message="Keterangan Laptop Harus Diisi" value="{{ old('info') }}" />
                <x-bladewind::filepicker name="file" required="true" label="File"
                    error_message="File Harus Diisi" />
            </div>
            <div class="text-center flex flex-col gap-2">
                <x-bladewind::button can_submit="true" class="block">Simpan</x-bladewind::button>
                <x-bladewind::button can_submit="false" class="block" color="red" tag="a"
                    href="{{ route('barang-keluar.index') }}">Kembali</x-bladewind::button>
            </div>
        </form>
        @else
        <form method="post" action="{{ route('barang-keluar.update', $barangKeluar->id) }} "
            enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <x-bladewind::input name="kode_barang" value="{{ optional($barangKeluar->barangMasuk)->kode_barang }}" disabled="true" />
                <x-bladewind::input name="jlh_laptop" required="true" numeric="true" label="Jumlah Laptop"
                    error_message="Jumlah Laptop Harus Diisi" value="{{ $barangKeluar->jlh_laptop }}" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <x-bladewind::input name="bidang" required="true" label="Bidang"
                    error_message="Bidang Harus Diisi" value="{{ $barangKeluar->bidang }}" />
                <x-bladewind::datepicker name="tanggal_pengeluaran" required="true"
                    error_message="Tanggal Keluar Harus Diisi" default_date="{{ $barangKeluar->tanggal_pengeluaran }}" />
            </div>
            <div class="row gap-4">
                <x-bladewind::input name="info" required="true" label="Keterangan"
                    error_message="Keterangan Laptop Harus Diisi" value="{{ $barangKeluar->info }}" />
                <x-bladewind::filepicker name="file" required="true" label="File"
                    error_message="File Harus Diisi" />
            </div>
            @if ($barangKeluar->file && $barangKeluar->file != '')
            <img src="{{ url('storage/uploads/barang-keluar/' . $barangKeluar->file) }}" alt="{{ $barangKeluar->nama_laptop }}">
            @endif
            <div class="text-center flex flex-col gap-2">
                <x-bladewind::button can_submit="true" class="block">Simpan</x-bladewind::button>
                <x-bladewind::button can_submit="false" class="block" color="red" tag="a"
                    href="{{ route('barang-keluar.index') }}">Kembali</x-bladewind::button>
            </div>
        </form>
        @endif
    </x-bladewind.card>
</div>
@endsection