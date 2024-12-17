@extends('admin.layout')

@section('title', 'Ubah Password')

@section('content')
@include('sweetalert::alert')
<div class="max-w-4xl">
    <x-bladewind.card>
        <form method="post" action="{{ route('ubah-password.update') }}">
            @csrf
            <div class="flex gap-4">
                <x-bladewind::input name="password" required="true" type="password" suffix="eye" viewable="true" label="Password Baru"
                    error_message="Kode Barang Harus Diisi"/>
                <x-bladewind::input name="confirm_password" required="true" type="password" suffix="eye" viewable="true" label="Ulangi Password"
                    error_message="Nama Laptop Harus Diisi" />
            </div>
            <div class="text-center flex flex-col gap-2">
                <x-bladewind::button can_submit="true" class="block">Simpan</x-bladewind::button>
                <x-bladewind::button can_submit="false" class="block" color="red" tag="a"
                    href="{{ route('dashboard') }}">Kembali</x-bladewind::button>
            </div>

        </form>

    </x-bladewind.card>
</div>
@endsection
