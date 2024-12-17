@extends('admin.layout')

@section('title', 'Barang Masuk')

@section('content')
    @include('sweetalert::alert')
    <div class="max-w-4xl">
        <x-bladewind.card>
            @if (!$barangMasuk)
                <form method="post" action="{{ route('barang-masuk.store') }}" enctype="multipart/form-data">
                    @csrf
                    <h1 class="my-2 text-2xl font-light text-blue-900/80">Silahkan Isi Form</h1>
                    <p class="mt-3 mb-6 text-blue-900/80 text-sm">
                        Lengkapi form dibawah ini
                    </p>
                    <div class="flex gap-4">
                        <x-bladewind::input name="kode_barang" required="true" label="Kode Barang"
                            error_message="Kode Barang Harus Diisi" value="{{ old('kode_barang') }}" />
                        <x-bladewind::input name="nama_laptop" required="true" label="Nama Laptop"
                            error_message="Nama Laptop Harus Diisi" value="{{ old('nama_laptop') }}" />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <x-bladewind::select name="kategory" required="true" :data="$kategori" placeholder="Pilih Kategori"
                            error_message="Kategori Harus Diisi" selected_value="{{ old('kategory') }}" />
                        <x-bladewind::input name="jlh_laptop" required="true" numeric="true" label="Jumlah Laptop"
                            error_message="Jumlah Laptop Harus Diisi" value="{{ old('jlh_laptop') }}" />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <x-bladewind::input name="sumber_laptop" required="true" label="Sumber Laptop"
                            error_message="Sumber Laptop Harus Diisi" value="{{ old('sumber_laptop') }}" />
                        <x-bladewind::datepicker name="tanggal_masuk" required="true"
                            error_message="Tanggal Masuk Laptop Harus Diisi" value="{{ old('tanggal_masuk') }}" />
                    </div>
                    <x-bladewind::filepicker name="file" required="true" label="File"
                        error_message="File Harus Diisi" />
                    <div class="text-center flex flex-col gap-2">
                        <x-bladewind::button can_submit="true" class="block">Simpan</x-bladewind::button>
                        <x-bladewind::button can_submit="false" class="block" color="red" tag="a"
                            href="{{ route('barang-masuk.index') }}">Kembali</x-bladewind::button>
                    </div>

                </form>
            @else
                <form method="post" action="{{ route('barang-masuk.update', $barangMasuk->id) }} "
                    enctype="multipart/form-data">
                    @csrf
                    <h1 class="my-2 text-2xl font-light text-blue-900/80">Silahkan Isi Form</h1>
                    <p class="mt-3 mb-6 text-blue-900/80 text-sm">
                        Lengkapi form dibawah ini
                    </p>
                    <div class="flex gap-4">
                        <x-bladewind::input name="kode_barang" label="Kode Barang" error_message="Kode Barang Harus Diisi"
                            disabled="true" value="{{ $barangMasuk->kode_barang }}" />
                        <x-bladewind::input name="nama_laptop" required="true" label="Nama Laptop"
                            error_message="Nama Laptop Harus Diisi" value="{{ $barangMasuk->nama_laptop }}" />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <x-bladewind::select name="kategory" required="true" :data="$kategori" placeholder="Pilih Kategori"
                            error_message="Kategori Harus Diisi" selected_value="{{ $barangMasuk->kategory }}" />
                        <x-bladewind::input name="jlh_laptop" required="true" numeric="true" label="Jumlah Laptop"
                            error_message="Jumlah Laptop Harus Diisi" value="{{ $barangMasuk->jlh_laptop }}" />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <x-bladewind::input name="sumber_laptop" required="true" label="Sumber Laptop"
                            error_message="Sumber Laptop Harus Diisi" value="{{ $barangMasuk->sumber_laptop }}" />
                        <x-bladewind::datepicker name="tanggal_masuk" error_message="Tanggal Masuk Laptop Harus Diisi"
                            placeholder="{{ $barangMasuk->tanggal_masuk }}" />
                    </div>
                    <x-bladewind::filepicker name="file" label="File" error_message="File Harus Diisi" />
                    @if ($barangMasuk->file && $barangMasuk->file != '')
                        <img src="{{ url('storage/uploads/' . $barangMasuk->file) }}"
                            alt="{{ $barangMasuk->nama_laptop }}">
                    @endif
                    <div class="text-center flex flex-col gap-2">
                        <x-bladewind::button hasSpinner="true" showSpinner="true" can_submit="true" class="block">Simpan</x-bladewind::button>
                        <x-bladewind::button can_submit="false" class="block" color="red" tag="a"
                            href="{{ route('barang-masuk.index') }}">Kembali</x-bladewind::button>
                    </div>

                </form>
            @endif
        </x-bladewind.card>
    </div>
@endsection
