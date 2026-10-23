<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Audit - Dashboard Pimpinan</title>
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
                    colors: {
                        dark: { 800: '#1e1e1e', 900: '#121212' }
                    }
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

                {{-- Badge ikut berubah warna jika aktif --}}
                <span class="{{ request()->routeIs('pimpinan.laporan.*') ? 'bg-white text-blue-600' : 'bg-red-500 text-white' }} text-[9px] font-bold px-1.5 py-0.5 rounded-full shadow-sm"></span>
            </a>

            {{-- 3. KEUANGAN --}}
           <a href="{{ route('pimpinan.keuangan.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group
               {{ request()->routeIs('pimpinan.keuangan.*')
                  ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50'
                  : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <i class="fa-solid fa-wallet w-5 text-center {{ request()->routeIs('pimpinan.keuangan.*') ? 'text-white' : 'group-hover:text-green-400' }} transition-colors"></i>
                Keuangan & Anggaran
            </a>

            {{-- 4. KINERJA --}}
            <a href="{{ route('pimpinan.sakip.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl text-sm font-medium transition-all duration-200 group">
                <i class="fa-solid fa-chart-line w-5 text-center group-hover:text-yellow-400 transition-colors"></i>
                Kinerja (SAKIP)
            </a>

            {{-- LABEL KATEGORI --}}
            <div class="px-4 mt-6 mb-2 text-[10px] font-bold text-gray-500 uppercase tracking-wider">
                Data Master
            </div>

            {{-- 5. UNIT KERJA --}}
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

    <main class="ml-64 p-8 min-h-screen transition-all duration-300">

        <header class="flex justify-between items-center mb-8 bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Arsip Laporan Pengawasan</h1>
                <p class="text-gray-500 text-xs mt-1">Daftar Laporan Hasil Audit (LHA) dan Reviu (LHR) Final.</p>
            </div>

            <div class="flex gap-6 text-right">
                <div class="px-2 border-r border-gray-100">
                    <p class="text-[10px] text-gray-400 uppercase font-bold">Total Laporan</p>
                    <p class="text-xl font-bold text-gray-800">{{ $stats['total_laporan'] }}</p>
                </div>
                <div class="px-2 border-r border-gray-100">
                    <p class="text-[10px] text-gray-400 uppercase font-bold">Temuan</p>
                    <p class="text-xl font-bold text-red-500">{{ $stats['total_temuan'] }}</p>
                </div>
                <div class="px-2">
                    <p class="text-[10px] text-gray-400 uppercase font-bold">Audit vs Reviu</p>
                    <div class="flex gap-2 text-xs font-bold mt-1">
                        <span class="text-blue-600 bg-blue-50 px-1.5 rounded">{{ $stats['total_lha'] }}</span>
                        <span class="text-gray-300">/</span>
                        <span class="text-purple-600 bg-purple-50 px-1.5 rounded">{{ $stats['total_lhr'] }}</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex justify-between items-center mb-6">
            <div class="relative w-80">
                <form action="{{ route('pimpinan.laporan.index') }}" method="GET">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau nomor laporan..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all shadow-sm">
                </form>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Judul & Nomor</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Unit Kerja</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider text-center">Temuan</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($reports as $report)
                    <tr class="hover:bg-blue-50/30 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-red-50 text-red-600 rounded-lg shrink-0">
                                    <i class="fa-solid fa-file-pdf text-lg"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-800 group-hover:text-blue-600 transition-colors">{{ $report->judul_laporan }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5">
                                        No: {{ $report->nomor_laporan }} • {{ $report->tanggal_laporan->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-700">{{ $report->unit->nama_unit ?? 'Semua Unit' }}</div>
                            <div class="text-[10px] text-gray-400">Auditor: {{ $report->auditor->name ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded text-[10px] font-bold uppercase border {{ $report->jenis_badge }}">
                                {{ $report->jenis }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($report->jumlah_temuan > 0)
                                <span class="inline-flex items-center justify-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-600 border border-red-200">
                                    {{ $report->jumlah_temuan }}
                                </span>
                            @else
                                <span class="text-gray-400 text-xs"><i class="fa-solid fa-check"></i> Nihil</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('pimpinan.laporan.download', $report->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-bold shadow-md shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5 transition-all">
                                <i class="fa-solid fa-download"></i> Unduh
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <div class="mb-3">
                                <i class="fa-regular fa-folder-open text-3xl opacity-30"></i>
                            </div>
                            <p class="text-sm">Belum ada dokumen laporan yang tersedia.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="px-6 py-4 border-t border-gray-100">
                {{ $reports->links() }}
            </div>
        </div>
    </main>

</body>
</html>
