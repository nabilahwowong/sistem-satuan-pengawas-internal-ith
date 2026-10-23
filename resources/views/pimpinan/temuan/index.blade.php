<!DOCTYPE html>
<html lang="id">
<head>
    <title>Status Temuan - Dashboard Pimpinan</title>
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

            <a href="{{ route('pimpinan.unit.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl text-sm font-medium transition-all group">
                <i class="fa-solid fa-building-columns w-5 text-center group-hover:text-purple-400"></i> Unit Kerja
            </a>

            <div class="pt-6 mt-6 border-t border-gray-700">
                <form action="{{ route('logout') }}" method="POST">@csrf <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-xl text-sm font-medium transition-all group"><i class="fa-solid fa-right-from-bracket w-5 text-center"></i> Logout</button></form>
            </div>
        </nav>
    </aside>

    <main class="ml-64 p-8 min-h-screen transition-all duration-300">

        <header class="flex justify-between items-center mb-8 bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Monitoring Tindak Lanjut Temuan</h1>
                <p class="text-gray-500 text-xs mt-1">Pantau status penyelesaian temuan audit dari unit kerja.</p>
            </div>
            <div class="text-right">
                <p class="text-[10px] text-gray-400 font-bold uppercase">Total Temuan Tercatat</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</p>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-l-4 border-l-red-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Belum Ditindaklanjuti</p>
                        <h3 class="text-3xl font-bold text-red-600 mt-2">{{ $stats['open'] }}</h3>
                        <p class="text-xs text-red-400 mt-1 font-medium">Status: Open</p>
                    </div>
                    <div class="p-2 bg-red-50 rounded-lg text-red-500">
                        <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-l-4 border-l-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Selesai / Sesuai</p>
                        <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $stats['closed'] }}</h3>
                        <p class="text-xs text-green-500 mt-1 font-medium">Status: Closed</p>
                    </div>
                    <div class="p-2 bg-green-50 rounded-lg text-green-500">
                        <i class="fa-solid fa-check-double text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-l-4 border-l-blue-500">
                <div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Rasio Penyelesaian</p>
                    <div class="flex items-end gap-2 mt-2">
                        <h3 class="text-3xl font-bold text-blue-600">{{ $stats['ratio'] }}%</h3>
                    </div>
                    <div class="w-full bg-gray-100 h-2 rounded-full mt-3 overflow-hidden">
                         {{-- FIX: Use simple style attribute to avoid Alpine/Blade conflict --}}
                        <div class="bg-blue-600 h-2 rounded-full transition-all duration-1000"
                            :style="{ width: '{{ $stats['ratio'] }}%' }">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-lg font-bold text-gray-800">Daftar Detil Temuan (KDA)</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100 text-[10px] uppercase text-gray-500 font-bold">
                        <tr>
                            <th class="px-6 py-4 w-16 text-center">No</th>
                            <th class="px-6 py-4">Kode & Unit Kerja</th>
                            <th class="px-6 py-4 w-1/3">Kondisi (Temuan)</th>
                            <th class="px-6 py-4 w-1/3">Rekomendasi SPI</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($findings as $index => $item)
                        <tr class="hover:bg-blue-50/20 transition-colors align-top">
                            <td class="px-6 py-4 text-center text-gray-400">
                                {{ $findings->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-gray-100 text-gray-600 text-[10px] px-2 py-0.5 rounded font-mono font-bold">
                                    {{ $item->kode_temuan ?? 'TM-NEW' }}
                                </span>
                                <div class="font-bold text-gray-800 mt-2">
                                     {{-- FIX: Use schedule->unit instead of report->unit --}}
                                    {{ $item->schedule->unit->nama_unit ?? 'Unit Umum' }}
                                </div>
                                <div class="text-[10px] text-gray-400 mt-0.5">
                                    Tgl: {{ $item->created_at->format('d M Y') }}
                                </div>
                            </td>

                            {{-- Kondisi (Inputan Anggota) --}}
                            <td class="px-6 py-4">
                                <div class="text-gray-700 text-xs leading-relaxed line-clamp-3 hover:line-clamp-none transition-all">
                                    {{ $item->kondisi }}
                                </div>
                                @if($item->akibat)
                                    <div class="mt-2 text-[10px] text-red-500 font-medium bg-red-50 px-2 py-1 rounded inline-block">
                                        <i class="fa-solid fa-triangle-exclamation mr-1"></i> Dampak: {{ Str::limit($item->akibat, 50) }}
                                    </div>
                                @endif
                            </td>

                            {{-- Rekomendasi (Inputan Anggota) --}}
                            <td class="px-6 py-4">
                                <div class="text-gray-600 text-xs leading-relaxed italic bg-blue-50/50 p-2 rounded border border-blue-100">
                                    <i class="fa-solid fa-lightbulb text-yellow-500 mr-1"></i>
                                    {{ $item->rekomendasi }}
                                </div>
                            </td>

                            {{-- Status Badge (Otomatis dari Model) --}}
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase border {{ $item->status_badge }}">
                                    {{ $item->status == 'open' ? 'Belum Selesai' : 'Selesai' }}
                                </span>
                            </td>

                            {{-- Aksi (Lihat Detail) --}}
                            <td class="px-6 py-4 text-right">
                                <button class="text-gray-400 hover:text-blue-600 transition" title="Lihat Detail KDA">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                <div class="mb-3"><i class="fa-regular fa-clipboard text-3xl opacity-30"></i></div>
                                Belum ada temuan yang diinput oleh Anggota SPI.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $findings->links() }}
            </div>
        </div>

    </main>
</body>
</html>
