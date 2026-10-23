<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPI - Institut Teknologi B.J. Habibie</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .submenu { transition: all 0.3s ease-in-out; }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased">
    <nav class="bg-white shadow-sm fixed w-full z-50 top-0 left-0 border-b border-gray-100 h-20" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex justify-between items-center h-full">

                {{-- Bagian Logo --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <img class="h-10 md:h-12 w-auto" src="{{ asset('images/download.png') }}" alt="Logo SPI">
                    </a>
                </div>

                {{-- Bagian Menu Desktop (Ditambahkan pembungkus gap-8 agar jarak semua menu sama rata) --}}
                <div class="hidden md:flex h-full items-center gap-8">

                    {{-- Dropdown Profil SPI --}}
                    <div class="relative h-full flex items-center" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center text-gray-900 hover:text-blue-900 font-bold text-xs uppercase tracking-widest focus:outline-none transition">
                            Profil SPI
                            <svg class="w-3 h-3 ml-1 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="absolute left-0 top-full w-56 bg-white shadow-xl py-2 border-t-4 border-blue-900 rounded-b-md z-60"
                            x-cloak>

                            @if(isset($menu_profil))
                                @foreach($menu_profil as $item)
                                    <a href="{{ route('landing.show', $item->slug) }}" class="block px-4 py-3 text-sm text-gray-600 hover:bg-gray-50 hover:text-blue-900 border-b border-gray-50 last:border-0">
                                        {{ $item->title }}
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- Dropdown Layanan --}}
                    <div class="relative h-full flex items-center" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center text-gray-900 hover:text-blue-900 font-bold text-xs uppercase tracking-widest focus:outline-none transition">
                            Layanan
                            <svg class="w-3 h-3 ml-1 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="absolute left-0 top-full w-56 bg-white shadow-xl py-2 border-t-4 border-blue-900 rounded-b-md z-60"
                            x-cloak>

                            @if(isset($menu_layanan))
                                @foreach($menu_layanan as $item)
                                    <a href="{{ route('landing.show', $item->slug) }}" class="block px-4 py-3 text-sm text-gray-600 hover:bg-gray-50 hover:text-blue-900 border-b border-gray-50 last:border-0">
                                        {{ $item->title }}
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- Dropdown Program Kerja (Dihapus ml-4 nya agar sejajar) --}}
                    <div class="relative h-full flex items-center" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center text-gray-900 hover:text-blue-900 font-bold text-xs uppercase tracking-widest focus:outline-none transition">
                            Program Kerja
                            <svg class="w-3 h-3 ml-1 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="absolute left-0 top-full w-56 bg-white shadow-xl py-2 border-t-4 border-blue-900 rounded-b-md z-60"
                            x-cloak>

                            @if(isset($menu_program) && $menu_program->count() > 0)
                                @foreach($menu_program as $item)
                                    <a href="{{ route('landing.show', $item->slug) }}" class="block px-4 py-3 text-sm text-gray-600 hover:bg-gray-50 hover:text-blue-900 border-b border-gray-50 last:border-0">
                                        {{ $item->title }}
                                    </a>
                                @endforeach
                            @else
                                <span class="block px-4 py-3 text-sm text-gray-400 italic">Belum ada menu</span>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol Kontak & Login --}}
                    <a href="{{ url('kontak') }}" class="text-gray-900 hover:text-blue-900 font-bold text-xs uppercase tracking-widest transition">Kontak</a>
                    <a href="{{ route('login') }}" class="text-white bg-[#1e3a8a] hover:bg-blue-800 px-6 py-2 rounded shadow-sm font-bold text-xs uppercase tracking-widest transition">Login</a>

                </div> {{-- Penutup Pembungkus Menu Desktop --}}

                {{-- Tombol Hamburger Mobile --}}
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-800 p-2 focus:outline-none">
                        <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                        <svg x-show="mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

            </div>
        </div>

        {{-- Menu Mobile --}}
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="md:hidden bg-white border-t border-gray-200 absolute w-full shadow-lg left-0 top-20 pb-10 overflow-y-auto h-screen z-40"
             x-cloak>
            <div class="px-4 pt-4 space-y-2">
                <a href="{{ url('/') }}" class="block px-3 py-3 font-medium text-gray-700 hover:bg-gray-50">Beranda</a>

                <div x-data="{ subOpen: false }">
                    <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center px-3 py-3 font-medium text-gray-700 hover:bg-gray-50 text-left">
                        Profil SPI
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': subOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="subOpen" class="pl-6 space-y-1 bg-gray-50 rounded-md" x-collapse>
                        @if(isset($menu_profil))
                            @foreach($menu_profil as $item)
                                <a href="{{ route('landing.show', $item->slug) }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-blue-900">{{ $item->title }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div x-data="{ subOpen: false }">
                    <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center px-3 py-3 font-medium text-gray-700 hover:bg-gray-50 text-left">
                        Layanan
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': subOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="subOpen" class="pl-6 space-y-1 bg-gray-50 rounded-md" x-collapse>
                        @if(isset($menu_layanan))
                            @foreach($menu_layanan as $item)
                                <a href="{{ route('landing.show', $item->slug) }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-blue-900">{{ $item->title }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div x-data="{ subOpen: false }">
                    <button @click="subOpen = !subOpen" class="w-full flex justify-between items-center px-3 py-3 font-medium text-gray-700 hover:bg-gray-50 text-left">
                        Program Kerja
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': subOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="subOpen" class="pl-6 space-y-1 bg-gray-50 rounded-md" x-collapse>
                        @if(isset($menu_program))
                            @foreach($menu_program as $item)
                                <a href="{{ route('landing.show', $item->slug) }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-blue-900">{{ $item->title }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <a href="{{ url('kontak') }}" class="block px-3 py-3 font-medium text-gray-700 hover:bg-gray-50">Kontak</a>
                <a href="{{ route('login') }}" class="block px-3 py-3 mt-4 text-center font-bold text-white bg-[#1e3a8a] rounded shadow">LOGIN</a>
            </div>
        </div>
    </nav>
