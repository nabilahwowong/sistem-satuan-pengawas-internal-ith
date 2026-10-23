<!DOCTYPE html>
<html lang="id">
<head>
    <title>SPI - Dashboard Anggota</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] } } } }
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        @include('anggota.components.anggota-sidebar')

        <main class="flex-1 overflow-y-auto no-scrollbar">
            {{-- Header Tetap --}}
            <header class="mx-8 mt-6 bg-white px-8 py-5 rounded-[30px] shadow-sm border border-gray-100 flex justify-between items-center relative z-20">
                <div>
                <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Dashboard Anggota</h1>
                <p class="text-gray-500 mt-1">Pantau progres pekerjaan dan aktivitas audit Anda.</p>
            </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-3 hover:bg-gray-50 p-2 rounded-2xl transition-colors focus:outline-none">
                        <div class="text-right hidden md:block">
                            <div class="text-sm font-bold text-gray-800">{{ Auth::user()->name ?? 'Anggota SPI' }}</div>
                            <div class="text-xs text-blue-600 font-medium">{{ ucfirst(Auth::user()->role ?? 'Auditor') }}</div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold border border-blue-200">
                            {{ substr(Auth::user()->name ?? 'A', 0, 2) }}
                        </div>
                        <i class="fa-solid fa-chevron-down text-xs text-gray-400"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-[20px] shadow-lg border border-gray-100 py-2 z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:rounded-b-[20px]">
                                <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- Slot untuk konten dinamis (Dashboard Utama atau Kelola Landing) --}}
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
