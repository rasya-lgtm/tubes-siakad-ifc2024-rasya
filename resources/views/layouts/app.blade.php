<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD UNSUR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Navbar Atas --}}
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo UNSUR" class="h-10 w-10">
                <div>
                    <p class="font-bold text-gray-800 text-sm">Universitas Suryakancana</p>
                    <p class="text-xs text-gray-500">Sistem Informasi Akademik</p>
                </div>
            </div>
            @auth
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <span>{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="ml-2 text-red-500 hover:text-red-700">Logout</button>
                </form>
            </div>
            @endauth
        </div>
    </nav>

    {{-- Navbar Menu --}}
    <nav class="bg-blue-700 text-white shadow">
        <div class="max-w-7xl mx-auto px-6 flex gap-1">
            @auth
                <a href="{{ route('dashboard') }}" class="px-4 py-3 text-sm hover:bg-blue-600 flex items-center gap-1">🏠 Beranda</a>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('dosen.index') }}" class="px-4 py-3 text-sm hover:bg-blue-600">Dosen</a>
                    <a href="{{ route('mahasiswa.index') }}" class="px-4 py-3 text-sm hover:bg-blue-600">Mahasiswa</a>
                    <a href="{{ route('matakuliah.index') }}" class="px-4 py-3 text-sm hover:bg-blue-600">Mata Kuliah</a>
                    <a href="{{ url('jadwal') }}" class="px-4 py-3 text-sm hover:bg-blue-600">Jadwal</a>
                    <a href="{{ route('krs.index') }}" class="px-4 py-3 text-sm hover:bg-blue-600">KRS</a>
                @else
                    <a href="{{ url('jadwal') }}" class="px-4 py-3 text-sm hover:bg-blue-600">Jadwal</a>
                    <a href="{{ route('krs.index') }}" class="px-4 py-3 text-sm hover:bg-blue-600">KRS</a>
                @endif
            @endauth
        </div>
    </nav>

    {{-- Alert --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto mt-4 px-6">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded flex justify-between">
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    {{-- Konten --}}
    <main class="max-w-7xl mx-auto px-6 py-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center text-xs text-gray-400 py-4 mt-10 border-t">
        © {{ date('Y') }} Universitas Suryakancana. All rights reserved.
    </footer>

</body>
</html>