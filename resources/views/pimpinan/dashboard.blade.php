<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Pimpinan</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                }
            }
        }
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    <aside class="fixed top-0 left-0 h-screen w-64 bg-gray-900 text-white py-6 px-5 border-r border-gray-800 shadow-xl z-50 overflow-y-auto custom-scrollbar">

        {{-- HEADER LOGO --}}
        <div class="flex items-center gap-3 mb-8 px-2">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center font-bold text-white shadow-lg shadow-blue-500/30">P</div>
            <div>
                <h2 class="text-sm font-bold tracking-wide text-white">PIMPINAN</h2>
                <p class="text-[10px] text-gray-400">Monitoring SPI</p>
            </div>
        </div>

        {{-- NAVIGASI --}}
        <nav class="space-y-2">

            {{-- 1. BERANDA --}}
            <a href="{{ route('pimpinan.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200
               {{ request()->routeIs('pimpinan.dashboard')
                  ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50 scale-105'
                  : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <i class="fa-solid fa-house w-5 text-center"></i>
                Beranda
            </a>

            {{-- LABEL KATEGORI --}}
            <div class="px-4 mt-6 mb-2 text-[10px] font-bold text-gray-500 uppercase tracking-wider">
                Pengawasan Internal
            </div>

            {{-- 2. LAPORAN AUDIT --}}
            <a href="{{ route('pimpinan.laporan.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group
               {{ request()->routeIs('pimpinan.laporan.*')
                  ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50'
                  : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <i class="fa-solid fa-file-contract w-5 text-center {{ request()->routeIs('pimpinan.laporan.*') ? 'text-white' : 'group-hover:text-blue-400' }} transition-colors"></i>
                <span class="flex-1">Laporan Audit</span>
            </a>

            {{-- 4. KEUANGAN --}}
            <a href="{{ route('pimpinan.keuangan.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group
               {{ request()->routeIs('pimpinan.keuangan.*')
                  ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50'
                  : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <i class="fa-solid fa-wallet w-5 text-center {{ request()->routeIs('pimpinan.keuangan.*') ? 'text-white' : 'group-hover:text-green-400' }} transition-colors"></i>
                Keuangan & Anggaran
            </a>

            {{-- 5. KINERJA --}}
            <a href="{{ route('pimpinan.sakip.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl text-sm font-medium transition-all duration-200 group">
                <i class="fa-solid fa-chart-line w-5 text-center group-hover:text-yellow-400 transition-colors"></i>
                Kinerja (SAKIP)
            </a>

            {{-- LABEL KATEGORI --}}
            <div class="px-4 mt-6 mb-2 text-[10px] font-bold text-gray-500 uppercase tracking-wider">
                Data Master
            </div>

            {{-- 6. UNIT KERJA --}}
            <a href="{{ route('pimpinan.unit.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl text-sm font-medium transition-all duration-200 group">
                <i class="fa-solid fa-building-columns w-5 text-center group-hover:text-purple-400 transition-colors"></i>
                Unit Kerja
            </a>

            {{-- LOGOUT --}}
            <div class="pt-6 mt-6 border-t border-gray-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-xl text-sm font-medium transition-all duration-200 group">
                        <i class="fa-solid fa-right-from-bracket w-5 text-center group-hover:rotate-180 transition-transform"></i>
                        Logout
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="ml-64 p-8 min-h-screen relative z-0 transition-all duration-300">

        <header class="flex justify-between items-center mb-10 bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Hasil Audit SPI Kampus</h1>
                <p class="text-gray-500 text-xs mt-1">Laporan terkini kinerja audit internal Tahun {{ date('Y') }}.</p>
            </div>

            <div class="relative">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" placeholder="Cari laporan..." class="pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-64 text-sm transition-all shadow-sm">
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

            {{-- KARTU 1: TOTAL AUDIT --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-500 font-bold text-xs uppercase tracking-wider">Total Audit</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalAudit }}</p>
                    </div>
                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs text-gray-400">
                    <span class="text-blue-600 font-bold bg-blue-50 px-1.5 py-0.5 rounded mr-2">Tahun {{ date('Y') }}</span>
                </div>
            </div>

            {{-- KARTU 2: SELESAI --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-500 font-bold text-xs uppercase tracking-wider">Selesai</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $auditSelesai }}</p>
                    </div>
                    <div class="p-2 bg-green-50 rounded-lg text-green-600">
                        <i class="fa-solid fa-check-circle"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs">
                    <span class="text-green-600 font-bold flex items-center gap-1">
                        <i class="fa-solid fa-chart-pie"></i> {{ $persenSelesai }}%
                    </span>
                    <span class="text-gray-400 ml-1">penyelesaian</span>
                </div>
            </div>

            {{-- KARTU 3: TEMUAN AKTIF --}}
            <a href="{{ route('pimpinan.temuan.index') }}"
            class="block bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group cursor-pointer relative overflow-hidden">

                {{-- Efek Hover Halus (Opsional: Membuat border merah saat dihover) --}}
                <div class="absolute inset-0 border-2 border-transparent group-hover:border-red-100 rounded-2xl transition-colors pointer-events-none"></div>

                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-500 font-bold text-xs uppercase tracking-wider group-hover:text-red-500 transition-colors">Temuan Aktif</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-2 group-hover:scale-110 origin-left transition-transform duration-300">
                            {{ $temuanAktif }}
                        </p>
                    </div>
                    <div class="p-2 bg-red-50 rounded-lg text-red-600 group-hover:bg-red-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs text-red-500 font-medium">
                    <span>Menunggu tindak lanjut unit</span>
                    <i class="fa-solid fa-arrow-right opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-1 transition-all ml-auto"></i>
                </div>
            </a>

            {{-- KARTU 4: KEPATUHAN --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-500 font-bold text-xs uppercase tracking-wider">Kepatuhan</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $persenKepatuhan }}%</p>
                    </div>
                    <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs">
                    <span class="text-gray-400 ml-1">Rasio temuan selesai</span>
                </div>
            </div>
        </div>

        {{-- TABEL AUDIT AKTIF --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h2 class="text-lg font-bold text-gray-800">Daftar Audit Aktif (On Progress)</h2>
                <a href="{{ route('pimpinan.laporan.index') }}" class="text-sm text-blue-600 font-medium hover:underline">Lihat Semua</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                            <th class="py-4 px-6 font-semibold">Unit Kerja</th>
                            <th class="py-4 px-6 font-semibold">Auditor</th>
                            <th class="py-4 px-6 font-semibold">Status</th>
                            <th class="py-4 px-6 font-semibold w-1/3">Estimasi Progress</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($activeAudits as $audit)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="py-4 px-6 font-medium text-gray-800">
                                {{ $audit->unit->nama_unit ?? 'Unit Umum' }}
                            </td>
                            <td class="py-4 px-6 text-gray-500">
                                {{ $audit->auditor->name ?? 'Tim Audit' }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $audit->status_color }}">
                                    {{ $audit->status_label }}
                                </span>
                            </td>
                            <td class="py-4 px-6 align-middle">
                                <div class="flex items-center gap-3">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        {{-- Menggunakan style width secara dinamis --}}
                                        <div class="bg-blue-500 h-2 rounded-full shadow-sm shadow-blue-200"
                                            :style="{ width: '{{ $audit->progress_percent }}%' }">
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-gray-600">{{ $audit->progress_percent }}%</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fa-regular fa-circle-check text-4xl mb-2 opacity-30"></i>
                                    <p>Tidak ada audit yang sedang berjalan saat ini.</p>
                                    <p class="text-xs mt-1">Semua pekerjaan telah berstatus Final.</p>
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
