<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SPI ITH</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- AlpineJS (Wajib untuk Dropdown) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'inter', 'sans-serif'] },
                    colors: {
                        'spi-blue': '#1e4bbc',
                        'spi-dark': '#1e3a8a',
                        'spi-bg': '#f4f6fa',
                    }
                }
            }
        }
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden">

    <aside class="fixed top-4 left-4 w-[230px] h-[calc(100vh-32px)] bg-spi-blue text-white flex flex-col shadow-2xl z-999 rounded-[20px] overflow-hidden">

        <div class="flex flex-col items-center py-5 border-b border-white/10 shrink-0">
            <div class="bg-white p-1.5 rounded-full w-[50px] h-[50px] flex items-center justify-center shadow-md mb-2">
                 <img src="{{ asset('images/download.png') }}" onerror="this.src='https://ui-avatars.com/api/?name=Admin+SPI&background=random&color=fff'" class="w-full h-full object-contain rounded-full">
            </div>
            <h3 class="font-bold text-sm tracking-wide uppercase text-center leading-tight">ADMIN SPI</h3>
            <span class="text-[10px] text-blue-100 bg-white/10 px-2 py-0.5 rounded mt-1">Administrator</span>
        </div>

        <nav class="flex-1 overflow-y-auto py-3 px-2 space-y-1 no-scrollbar">

            <a href="{{ url('/admin/dashboard') }}" class="flex items-center px-3 py-2 rounded-lg {{ request()->is('admin/dashboard') ? 'bg-white/20 text-white shadow-sm' : 'hover:bg-white/10 text-white/80' }} transition-colors group">
                <div class="w-5 text-center"><i class="fa-solid fa-gauge-high text-sm"></i></div>
                <span class="font-medium ml-2.5 text-xs">Dashboard</span>
            </a>

            <div x-data="{ open: {{ request()->is('admin/users*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition-colors group text-left {{ request()->is('admin/users*') ? 'bg-white/10 text-white' : 'text-white/80' }}">
                    <div class="flex items-center">
                        <div class="w-5 text-center"><i class="fa-solid fa-users-gear text-sm"></i></div>
                        <span class="font-medium ml-2.5 text-xs">Manajemen Pengguna</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                <div x-show="open" class="pl-9 pr-2 py-1 space-y-1" style="display: none;">
                    <a href="{{ route('admin.users.index') }}" class="block px-2 py-1.5 rounded-md text-[11px] {{ request()->routeIs('admin.users.index') ? 'text-white bg-white/10 font-bold' : 'text-white/70 hover:text-white hover:bg-white/10' }} transition-colors">
                        Data Pengguna
                    </a>
                    <a href="{{ route('admin.access.index') }}" class="block px-2 py-1.5 rounded-md text-[11px] text-white/70 hover:text-white hover:bg-white/10 transition-colors">
                        Hak Akses
                    </a>
                </div>
            </div>

            <a href="{{ route('admin.units.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-white/10 text-white/80 transition-colors group">
                <div class="w-5 text-center"><i class="fa-solid fa-sitemap text-sm"></i></div>
                <span class="font-medium ml-2.5 text-xs">Daftar Unit Kerja</span>
            </a>

            <a href="{{ route('admin.schedules.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-white/10 text-white/80 transition-colors group {{ request()->routeIs('admin.schedules.*') ? 'bg-white/10 text-white' : '' }}">
                <div class="w-5 text-center"><i class="fa-solid fa-calendar-check text-sm"></i></div>
                <span class="font-medium ml-2.5 text-xs">Jadwal Reviu</span>
            </a>

            {{-- LAPORAN ARSIP --}}
            <div x-data="{ open: {{ request()->routeIs('admin.archives.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2 rounded-lg transition-colors group text-left mt-1 {{ request()->routeIs('admin.archives.*') ? 'bg-white/20 text-white shadow-sm' : 'hover:bg-white/10 text-white/80' }}">
                    <div class="flex items-center">
                        <div class="w-5 text-center"><i class="fa-solid fa-box-archive text-sm"></i></div>
                        <span class="font-medium ml-2.5 text-xs">Laporan Arsip</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                <div x-show="open" class="pl-9 pr-2 py-1 space-y-1" style="display: none;">
                    <a href="{{ route('admin.archives.index', ['kategori' => 'lha']) }}" class="block px-2 py-1.5 rounded-md text-[11px] transition-colors {{ request('kategori') == 'lha' ? 'text-white bg-white/10 font-bold' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                        Arsip LHA (Audit)
                    </a>
                    <a href="{{ route('admin.archives.index', ['kategori' => 'lhr']) }}" class="block px-2 py-1.5 rounded-md text-[11px] transition-colors {{ request('kategori') == 'lhr' ? 'text-white bg-white/10 font-bold' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                        Arsip LHR (Reviu)
                    </a>
                </div>
            </div>

            {{-- PEDOMAN & TEMPLATE --}}
            <div x-data="{ open: {{ request()->routeIs('admin.documents.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 text-white/80 transition-colors group text-left {{ request()->routeIs('admin.documents.*') ? 'bg-white/10 text-white' : '' }}">
                    <div class="flex items-center">
                        <div class="w-5 text-center"><i class="fa-solid fa-book-bookmark text-sm"></i></div>
                        <span class="font-medium ml-2.5 text-xs">Pedoman & Template</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                <div x-show="open" class="pl-9 pr-2 py-1 space-y-1" style="display: none;">
                    <a href="{{ route('admin.documents.index', ['kategori' => 'pedoman_audit']) }}" class="block px-2 py-1.5 rounded-md text-[11px] transition-colors {{ request('kategori') == 'pedoman_audit' ? 'text-white bg-white/10 font-medium' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                        Pedoman Audit
                    </a>
                    <a href="{{ route('admin.documents.index', ['kategori' => 'pedoman_reviu']) }}" class="block px-2 py-1.5 rounded-md text-[11px] transition-colors {{ request('kategori') == 'pedoman_reviu' ? 'text-white bg-white/10 font-medium' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                        Pedoman Reviu
                    </a>
                    <a href="{{ route('admin.documents.index', ['kategori' => 'template']) }}" class="block px-2 py-1.5 rounded-md text-[11px] transition-colors {{ request('kategori') == 'template' ? 'text-white bg-white/10 font-medium' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                        Template Dokumen
                    </a>
                </div>
            </div>

            <a href="{{ route('admin.audit.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-white/10 text-white/80 transition-colors {{ request()->routeIs('admin.audit.*') ? 'bg-white/10 text-white' : '' }}">
                        <div class="w-5 text-center"><i class="fa-solid fa-magnifying-glass-chart text-sm"></i></div>
                        <span class="ml-2.5 text-xs font-medium">Kertas Kerja Audit</span>
            </a>

        </nav>

        <div class="p-2 border-t border-white/10 shrink-0">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-3 py-2 rounded-lg hover:bg-red-500/20 text-white/90 hover:text-white transition-colors">
                    <div class="w-5 text-center"><i class="fa-solid fa-right-from-bracket text-sm"></i></div>
                    <span class="font-medium ml-2.5 text-xs">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="ml-[260px] h-full p-4 flex flex-col overflow-y-auto transition-all duration-300 relative z-0">

       <header class="bg-white px-6 py-4 rounded-[20px] shadow-sm flex justify-between items-center mb-6 shrink-0 border border-gray-100">
            <div>
                <h1 class="text-xl font-bold text-gray-800 leading-none">Dashboard Admin</h1>
                <p class="text-gray-500 text-xs mt-1">Selamat datang kembali, {{ Auth::user()->name }}.</p>
            </div>
        </header>

       <div class="grid grid-cols-4 gap-4 mb-6 shrink-0">

            {{-- CARD 1: TOTAL AUDIT --}}
            <a href="{{ route('admin.schedules.index') }}" class="bg-white p-4 rounded-[20px] shadow-sm border border-gray-100 flex items-center justify-between hover:-translate-y-1 hover:shadow-md transition-all group">
                <div>
                    <h3 class="text-gray-400 text-[10px] font-bold uppercase tracking-wider mb-1">Total Audit</h3>
                    <p class="text-2xl font-bold text-gray-800 leading-none group-hover:text-spi-blue transition-colors">{{ $totalAudit }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-50 text-spi-blue rounded-full flex items-center justify-center text-lg group-hover:bg-spi-blue group-hover:text-white transition-colors">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
            </a>

            {{-- CARD 2: BERJALAN --}}
            {{-- Link dengan filter status=berjalan (Logic filter harus ada di controller schedules jika ingin aktif) --}}
            <a href="{{ route('admin.schedules.index', ['search' => '']) }}" class="bg-white p-4 rounded-[20px] shadow-sm border border-gray-100 flex items-center justify-between hover:-translate-y-1 hover:shadow-md transition-all group">
                <div>
                    <h3 class="text-gray-400 text-[10px] font-bold uppercase tracking-wider mb-1">Berjalan</h3>
                    <p class="text-2xl font-bold text-gray-800 leading-none group-hover:text-yellow-600 transition-colors">{{ $auditBerjalan }}</p>
                </div>
                <div class="w-10 h-10 bg-yellow-50 text-yellow-600 rounded-full flex items-center justify-center text-lg group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-spinner"></i>
                </div>
            </a>

            {{-- CARD 3: TEMUAN --}}
            <a href="{{ route('admin.audit.index') }}" class="bg-white p-4 rounded-[20px] shadow-sm border border-gray-100 flex items-center justify-between hover:-translate-y-1 hover:shadow-md transition-all group">
                <div>
                    <h3 class="text-gray-400 text-[10px] font-bold uppercase tracking-wider mb-1">Temuan</h3>
                    <p class="text-2xl font-bold text-gray-800 leading-none group-hover:text-red-600 transition-colors">{{ $totalTemuan }}</p>
                </div>
                <div class="w-10 h-10 bg-red-50 text-red-600 rounded-full flex items-center justify-center text-lg group-hover:bg-red-500 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
            </a>

            {{-- CARD 4: UNIT KERJA --}}
            <a href="{{ route('admin.units.index') }}" class="bg-white p-4 rounded-[20px] shadow-sm border border-gray-100 flex items-center justify-between hover:-translate-y-1 hover:shadow-md transition-all group">
                <div>
                    <h3 class="text-gray-400 text-[10px] font-bold uppercase tracking-wider mb-1">Unit Kerja</h3>
                    <p class="text-2xl font-bold text-gray-800 leading-none group-hover:text-green-600 transition-colors">{{ $totalUnit }}</p>
                </div>
                <div class="w-10 h-10 bg-green-50 text-green-600 rounded-full flex items-center justify-center text-lg group-hover:bg-green-500 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
            </a>
        </div>

        {{-- TABEL AUDIT TERBARU --}}
        <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 flex-1 flex flex-col min-h-0 overflow-hidden">
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 shrink-0">
                <h2 class="text-sm font-bold text-gray-800">Daftar Audit Terbaru</h2>
                <a href="{{ route('admin.schedules.index') }}" class="text-[11px] text-spi-blue hover:underline font-medium hover:text-blue-700 transition">Lihat Semua</a>
            </div>

            <div class="overflow-y-auto p-0 flex-1">
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-gray-50 z-10">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[10px] uppercase w-10">No</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[10px] uppercase">Nama Audit</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[10px] uppercase">Unit</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[10px] uppercase text-center">Status</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[10px] uppercase text-right">Aksi</th>
                        </tr>
                    </thead>

                   <tbody class="divide-y divide-gray-100">
                        @forelse($latestAudits as $index => $audit)

                        {{--
                            SOLUSI FINAL:
                            1. Kita simpan URL di dalam 'data-href'.
                            2. Di onclick, kita panggil 'this.dataset.href'.
                            Ini mencegah error tanda kutip (' atau ") yang membingungkan browser.
                        --}}
                        <tr class="hover:bg-gray-50 transition-colors group cursor-pointer"
                            data-href="{{ route('admin.schedules.index') }}"
                            onclick="window.location.href = this.dataset.href;">

                            <td class="px-6 py-3 text-xs text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-3">
                                <div class="font-bold text-gray-800 text-xs group-hover:text-spi-blue transition">{{ $audit->nama_kegiatan }}</div>
                                <div class="text-[10px] text-gray-400 mt-0.5">{{ \Carbon\Carbon::parse($audit->tanggal_mulai)->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-600">{{ $audit->unit->nama_unit ?? '-' }}</td>
                            <td class="px-6 py-3 text-center">
                                @php
                                    $statusClass = match($audit->status) {
                                        'dijadwalkan' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                        'berjalan' => 'bg-blue-100 text-blue-700 border-blue-200',
                                        'selesai' => 'bg-green-100 text-green-700 border-green-200',
                                        'ditunda' => 'bg-red-100 text-red-700 border-red-200',
                                        default => 'bg-gray-100 text-gray-700'
                                    };
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $statusClass }} uppercase tracking-wider">
                                    {{ $audit->status }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-right">
                                {{-- Tombol Detail (Opsional) --}}
                                <button class="bg-spi-blue text-white px-3 py-1.5 rounded-lg text-[10px] font-medium hover:bg-spi-dark transition shadow-sm inline-block">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-xs">
                                <div class="flex flex-col items-center">
                                    <i class="fa-regular fa-folder-open text-2xl mb-2 opacity-50"></i>
                                    <p>Belum ada data audit.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

</body>
</html>
