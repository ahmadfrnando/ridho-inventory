@extends('admin.layout')

@section('title', 'Data Laptop')

@section('content')
    @include('sweetalert::alert')
    <a href="{{ route('data-laptop.export') }}">
        <x-bladewind::button size="regular" icon="plus" class="w-auto mb-2" icon="printer">Export</x-bladewind::button>
    </a>
    <div class="overflow-hidden rounded-lg shadow-lg bg-white">
        <form action="{{ route('data-laptop.export') }}" method="GET" class="flex w-auto gap-2 justify-end py-4 pr-2">
            <div class="flex gap-2">
                <div><x-bladewind.input placeholder="Cari Barang..." name="search" size="small"/></div>
                <div><x-bladewind.button can_submit="true" icon="magnifying-glass" class="flex">Cari</x-bladewind.button>
                </div>
                <a href="{{ route('data-laptop.index') }}"><x-bladewind.button icon="arrow-path" color="red"
                        class="flex">Reset</x-bladewind.button></a>
            </div>
        </form>
        <x-bladewind::table compact="true" divider="thin">

            <x-slot name="header">
                <th>#</th>
                <th>Kode Barang</th>
                <th>Nama Laptop</th>
                <th>Jumlah Tersedia</th>
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
                    <td>{{ $laptop->barangMasuk->kode_barang }}</td>
                    <td>{{ $laptop->barangMasuk->nama_laptop }}</td>
                    <td>{{ $laptop->total_laptop }}</td>
                </tr>
            @endforeach
        </x-bladewind::table>

    </div>
    <div class="mt-4">
        {{ $laptops->links() }}
    </div>
@endsection
