@extends('admin.layout')

@section('title', 'Data Barang Masuk')

@section('content')
    @include('sweetalert::alert')

    <x-bladewind::button tag="a" href="{{ route('barang-masuk.create') }}" size="regular" icon="plus"
        class="w-auto mb-2">Tambah Barang
        Masuk</x-bladewind::button>
    <div class="overflow-hidden rounded-lg shadow-lg bg-white">
        <form action="{{ route('barang-masuk.index') }}" method="GET" class="flex w-auto gap-2 justify-end py-4 pr-2">
            <div class="flex gap-2">
                <x-bladewind.input placeholder="Cari Barang..." name="search" size="small"/>
                <div><x-bladewind.button can_submit="true" icon="magnifying-glass" class="flex">Cari</x-bladewind.button></div>
                <a href="{{ route('barang-masuk.index') }}"><x-bladewind.button icon="arrow-path" color="red"
                        class="flex">Reset</x-bladewind.button></a>
            </div>
        </form>
        <x-bladewind::table compact="true" divider="thin">
            <x-slot name="header">
                <th>#</th>
                <th>Kode Barang</th>
                <th>Nama Laptop</th>
                <th>Kategori</th>
                <th>Jumlah Laptop</th>
                <th>Sumber</th>
                <th>Tanggal Masuk</th>
                <th>Aksi</th>
            </x-slot>
            @if (count($laptops) === 0)
                <tr>
                    <td colspan="8">
                        <x-bladewind::empty-state message="Tidak ada data barang keluar">
                        </x-bladewind::empty-state>
                    </td>
                </tr>
            @endif
            @foreach ($laptops as $laptop)
                <tr class="uppercase">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $laptop->kode_barang }}</td>
                    <td>{{ $laptop->nama_laptop }}</td>
                    <td>{{ $laptop->kategory }}</td>
                    <td>{{ $laptop->jlh_laptop }}</td>
                    <td>{{ $laptop->sumber_laptop }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($laptop->tanggal_masuk)->translatedFormat('d F Y') }}
                    </td>
                    <td class="flex gap-2">
                        <a href="{{ '/storage/uploads/' . $laptop->file }}" target="_blank"><x-bladewind::button.circle
                                size="tiny" color="orange" icon="document" /></a>
                        <a href="{{ route('barang-masuk.show', $laptop->id) }}"><x-bladewind::button.circle size="tiny"
                                icon="pencil-square" /></a>
                        <a href="{{ route('barang-masuk.destroy', $laptop->id) }}"
                            data-confirm-delete="true"><x-bladewind::button.circle size="tiny" can_submit="true"
                                color="red" icon="trash" /></a>

                    </td>
                </tr>
            @endforeach
        </x-bladewind::table>
    </div>
    <div class="mt-4">
        {{ $laptops->links() }}
    </div>
@endsection
