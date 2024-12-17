@extends('admin.layout')

@section('title', 'Data Barang Keluar')

@section('content')
    @include('sweetalert::alert')

    <x-bladewind::button tag="a" href="{{ route('barang-keluar.create') }}" size="regular" icon="plus"
        class="w-auto mb-2">Tambah Barang
        Keluar</x-bladewind::button>
    <div class="overflow-hidden rounded-lg shadow-lg bg-white">
        <form action="{{ route('barang-keluar.index') }}" method="GET" class="flex w-auto gap-2 justify-end py-4 pr-2">
            <div class="flex gap-2">
                <x-bladewind.input placeholder="Cari Barang..." name="search" size="small"/>
                <div><x-bladewind.button can_submit="true" icon="magnifying-glass" class="flex">Cari</x-bladewind.button>
                </div>
                <a href="{{ route('barang-keluar.index') }}"><x-bladewind.button icon="arrow-path" color="red"
                        class="flex">Reset</x-bladewind.button></a>
            </div>
        </form>
        <x-bladewind::table compact="true" divider="thin">

            <x-slot name="header">
                <th>#</th>
                <th>Kode Barang</th>
                <th>Nama Laptop</th>
                <th>Jumlah</th>
                <th>Bidang</th>
                <th>Tanggal Keluar</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </x-slot>
            @if (count($barangKeluar) === 0)
                <tr>
                    <td colspan="8">
                        <x-bladewind::empty-state message="Tidak ada data barang keluar">
                        </x-bladewind::empty-state>
                    </td>
                </tr>
            @endif
            @foreach ($barangKeluar as $laptop)
                <tr class="uppercase">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $laptop->barangMasuk->kode_barang }}</td>
                    <td>{{ $laptop->barangMasuk->nama_laptop }}</td>
                    <td>{{ $laptop->jlh_laptop }}</td>
                    <td>{{ $laptop->bidang }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($laptop->tanggal_pengeluaran)->translatedFormat('d F Y') }}
                    </td>
                    <td>{{ $laptop->info }}</td>
                    <td class="flex gap-2">
                        <a href="{{ '/storage/uploads/barang-keluar/' . $laptop->file }}"
                            target="_blank"><x-bladewind::button.circle size="tiny" color="orange" icon="document" /></a>
                        <a href="{{ route('barang-keluar.show', $laptop->id) }}"><x-bladewind::button.circle size="tiny"
                                icon="pencil-square" /></a>
                        <a href="{{ route('barang-keluar.destroy', $laptop->id) }}"
                            data-confirm-delete="true"><x-bladewind::button.circle size="tiny" can_submit="true"
                                color="red" icon="trash" /></a>
                    </td>
                </tr>
            @endforeach
        </x-bladewind::table>

    </div>
    <div class="mt-4">
        {{ $barangKeluar->links() }}
    </div>
@endsection
