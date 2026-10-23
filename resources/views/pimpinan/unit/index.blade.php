<!DOCTYPE html>
<html lang="id">
<head>
    <title>Unit Kerja - Dashboard Pimpinan</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] }, colors: { dark: { 800: '#1e1e1e', 900: '#121212' } } } }
        }
    </script>
    <style> .custom-scrollbar::-webkit-scrollbar { width: 4px; } .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; } </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    <aside class="fixed top-0 left-0 h-screen w-64 bg-gray-900 text-white py-6 px-5 border-r border-gray-800 shadow-xl z-50 overflow-y-auto custom-scrollbar">
        <div class="flex items-center gap-3 mb-8 px-2">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center font-bold text-white shadow-lg">P</div>
            <div><h2 class="text-sm font-bold tracking-wide">PIMPINAN</h2><p class="text-[10px] text-gray-400">Monitoring SPI</p></div>
        </div>

        <nav class="space-y-1">
            <a href="{{ route('pimpinan.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl text-sm font-medium transition-all group">
                <i class="fa-solid fa-house w-5 text-center group-hover:text-blue-400"></i> Beranda
            </a>

            <div class="px-4 mt-6 mb-2 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Pengawasan Internal</div>

            <a href="{{ route('pimpinan.laporan.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl text-sm font-medium transition-all group">
                <i class="fa-solid fa-file-contract w-5 text-center group-hover:text-blue-400"></i> Laporan Audit
            </a>

            <a href="{{ route('pimpinan.keuangan.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl text-sm font-medium transition-all group">
                <i class="fa-solid fa-wallet w-5 text-center group-hover:text-green-400"></i> Keuangan & Anggaran
            </a>

            <a href="{{ route('pimpinan.sakip.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl text-sm font-medium transition-all group">
                <i class="fa-solid fa-chart-line w-5 text-center group-hover:text-yellow-400"></i> Kinerja (SAKIP)
            </a>

            <div class="px-4 mt-6 mb-2 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Data Master</div>

            <a href="{{ route('pimpinan.unit.index') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-600 text-white rounded-xl text-sm font-medium shadow-lg shadow-blue-900/50 transition-all hover:scale-105 mb-1">
                <i class="fa-solid fa-building-columns w-5 text-center"></i> Unit Kerja
            </a>

            <div class="pt-6 mt-6 border-t border-gray-700">
                <form action="{{ route('logout') }}" method="POST">@csrf <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-xl text-sm font-medium transition-all group"><i class="fa-solid fa-right-from-bracket w-5 text-center"></i> Logout</button></form>
            </div>
        </nav>
    </aside>

    <main class="ml-64 p-8 min-h-screen transition-all duration-300">

        <header class="flex justify-between items-center mb-8 bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Profil Unit Kerja</h1>
                <p class="text-gray-500 text-xs mt-1">Pantau performa dan kepatuhan setiap unit kerja.</p>
            </div>
            <div class="relative w-72">
                <form action="{{ route('pimpinan.unit.index') }}" method="GET">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama unit..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all shadow-sm">
                </form>
            </div>
        </header>

        <div class="flex gap-4 mb-8">
            <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-xl shadow-sm border border-gray-100">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-lg">{{ $stats['total_unit'] }}</div>
                <div><p class="text-xs text-gray-400 uppercase font-bold">Total Unit</p><p class="text-sm font-semibold text-gray-800">Terdaftar</p></div>
            </div>
            <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-xl shadow-sm border border-gray-100">
                <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-600 font-bold text-lg">{{ $stats['unit_patuh'] }}</div>
                <div><p class="text-xs text-gray-400 uppercase font-bold">Nihil Temuan</p><p class="text-sm font-semibold text-gray-800">Sangat Baik</p></div>
            </div>
            <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-xl shadow-sm border border-gray-100">
                <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-red-600 font-bold text-lg">{{ $stats['perlu_pembinaan'] }}</div>
                <div><p class="text-xs text-gray-400 uppercase font-bold">Banyak Temuan</p><p class="text-sm font-semibold text-gray-800">Perlu Atensi</p></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($units as $unit)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all group">
                <div class="p-5 border-b border-gray-50 flex justify-between items-start">
                    <div class="flex gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gray-50 flex items-center justify-center text-gray-500 text-lg font-bold uppercase shrink-0">
                            {{ substr($unit->nama_unit, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-blue-600 transition">{{ $unit->nama_unit }}</h3>
                            <p class="text-[10px] text-gray-400 mt-1">Ka. {{ $unit->kepala->name ?? 'Belum Ada' }}</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 rounded text-[10px] font-bold uppercase border {{ $unit->status_color }}">
                        {{ $unit->status_label }}
                    </span>
                </div>

                <div class="p-5 grid grid-cols-2 gap-4">
                    <div class="text-center p-3 bg-gray-50 rounded-xl">
                        <p class="text-[10px] text-gray-400 font-bold uppercase">Temuan Aktif</p>
                        <p class="text-xl font-bold {{ $unit->total_temuan > 0 ? 'text-red-500' : 'text-green-500' }} mt-1">
                            {{ $unit->total_temuan }}
                        </p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-xl">
                        <p class="text-[10px] text-gray-400 font-bold uppercase">Nilai SAKIP</p>
                        <div class="flex items-center justify-center gap-1 mt-1">
                            <span class="text-xl font-bold text-gray-800">{{ $unit->predikat_sakip }}</span>
                            <span class="text-[10px] text-gray-500">({{ number_format($unit->nilai_sakip, 1) }})</span>
                        </div>
                    </div>
                </div>

                <div class="px-5 py-3 bg-gray-50/50 border-t border-gray-50 flex justify-between items-center">
                    <div class="text-[10px] text-gray-400">
                        Update: {{ $unit->updated_at->diffForHumans() }}
                    </div>
                    <a href="#" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                        Lihat Detail <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400">
                    <i class="fa-solid fa-building-circle-xmark text-2xl"></i>
                </div>
                <h3 class="text-gray-800 font-bold">Tidak Ada Unit Ditemukan</h3>
                <p class="text-sm text-gray-400 mt-1">Coba kata kunci pencarian lain.</p>
            </div>
            @endforelse
        </div>

    </main>
</body>
</html>
