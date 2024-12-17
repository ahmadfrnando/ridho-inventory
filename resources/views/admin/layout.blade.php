<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Inventaris Laptop</title>
    @vite('resources/css/app.css')
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    @include('sweetalert::alert')
</head>

<body class="bg-gray-100 flex select-none">

    <!-- Sidebar -->
    <div class="flex flex-col w-64 h-screen px-4 py-8 bg-white border-r">
        <h2
            class="text-2xl text-center font-bold text-white bg-blue-600 rounded-lg py-4 shadow-lg border-2 border-blue-700">
            ADMIN
        </h2>
        <div class="flex flex-col justify-between flex-1 mt-6">
            <nav>
                <a href="{{ route('dashboard') }}">
                    <x-bladewind.button icon="home" size="medium" class="w-full text-left mb-4" color="indigo">
                        Dashboard
                    </x-bladewind.button>
                </a>
                <a href="{{ route('data-laptop.index') }}">
                    <x-bladewind.button icon="computer-desktop" size="medium" class="w-full text-left mb-4"
                        color="indigo">
                        Data Laptop
                    </x-bladewind.button>
                </a>
                <a href="{{ route('barang-masuk.index') }}">
                    <x-bladewind.button icon="document-arrow-down" size="medium" class="w-full text-left mb-4"
                        color="indigo">
                        Barang Masuk
                    </x-bladewind.button>
                </a>
                <a href="{{ route('barang-keluar.index') }}">
                    <x-bladewind.button icon="document-arrow-up" size="medium" class="w-full text-left mb-4"
                        color="indigo">
                        Barang Keluar
                    </x-bladewind.button>
                </a>
                <a href="{{ route('ubah-password') }}">
                    <x-bladewind.button icon="key" size="medium" class="w-full text-left mb-4" color="indigo">
                        Ubah Kata Sandi
                    </x-bladewind.button>
                </a>
                <a href="/logout">
                    <x-bladewind.button icon="power" size="medium" class="w-full text-left mb-4" color="indigo">
                        Log Out
                    </x-bladewind.button>
                </a>
                {{-- <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-200 transform rounded-md hover:bg-gray-200 {{ request()->routeIs('data-laptop.index') ? 'bg-gray-200' : '' }}"
                    href={{ route('data-laptop.index') }}>
                    <span class="mx-4 font-medium">Data Laptop</span>
                </a>
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-200 transform rounded-md hover:bg-gray-200 {{ request()->routeIs('barang-masuk.index') ? 'bg-gray-200' : '' }}"
                    href="{{ route('barang-masuk.index') }}">
                    <span class="mx-4 font-medium">Barang Masuk</span>
                </a>
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-200 transform rounded-md hover:bg-gray-200 {{ request()->routeIs('barang-keluar.index') ? 'bg-gray-200' : '' }}"
                    href="{{ route('barang-keluar.index') }}">
                    <span class="mx-4 font-medium">Barang Keluar</span>
                </a>
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-200 transform rounded-md hover:bg-gray-200 {{ request()->routeIs('pengguna.index') ? 'bg-gray-200' : '' }}"
                    href="{{ route('ubah-password') }}">
                    <span class="mx-4 font-medium">Ubah Password</span>
                </a>
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-200 transform rounded-md hover:bg-gray-200"
                    href="/logout">
                    <span class="mx-4 font-medium">Logout</span>
                </a> --}}
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col flex-1 h-screen p-8">
        <header class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-800">@yield('title')</h1>
        </header>
        <main class="mt-8">
            @yield('content')
        </main>
    </div>

</body>

</html>
