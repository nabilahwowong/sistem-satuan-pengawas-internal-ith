<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kinerja SAKIP - Dashboard Pimpinan</title>
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

            <a href="{{ route('pimpinan.sakip.index') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-600 text-white rounded-xl text-sm font-medium shadow-lg shadow-blue-900/50 transition-all hover:scale-105 mb-1">
                <i class="fa-solid fa-chart-line w-5 text-center"></i> Kinerja (SAKIP)
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
                <h1 class="text-2xl font-bold text-gray-800">Evaluasi Akuntabilitas Kinerja (SAKIP)</h1>
                <p class="text-gray-500 text-xs mt-1">Hasil evaluasi implementasi SAKIP sesuai Pedoman Teknis SPI.</p>
            </div>
            <form method="GET" class="flex gap-2">
                <select name="tahun" class="bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-2.5 outline-none" onchange="this.form.submit()">
                    @for($i = date('Y'); $i >= date('Y')-4; $i--)
                        <option value="{{ $i }}" {{ request('tahun', date('Y')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </form>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="absolute right-0 top-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>
                <div class="relative z-10">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Rata-rata Nilai AKIP</p>
                    <div class="flex items-baseline gap-2 mt-1">
                        <h3 class="text-3xl font-bold text-gray-800">{{ number_format($avgNilai, 2) }}</h3>
                        <span class="text-sm text-gray-500 font-medium">/ 100</span>
                    </div>
                    <div class="mt-2 text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded inline-block font-bold">Tahun {{ request('tahun', date('Y')) }}</div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="absolute right-0 top-0 w-24 h-24 bg-green-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>
                <div class="relative z-10">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Predikat Terbanyak</p>
                    <h3 class="text-3xl font-bold text-green-600 mt-1">{{ $predikatDominan->predikat ?? '-' }}</h3>
                    <p class="text-xs text-gray-400 mt-1">
                        {{ $predikatDominan->total ?? 0 }} Unit Kerja
                    </p>
                </div>
            </div>

            @php
                // Cari nilai terendah dari array komponen
                $minVal = min(array_filter($avgKomponen) ?: [0]);
                $minKey = array_search($minVal, $avgKomponen);
                $labelKey = ucfirst($minKey);
            @endphp
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-l-4 border-l-yellow-400">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Area Perlu Perbaikan</p>
                <h3 class="text-lg font-bold text-gray-800 mt-2">Komponen {{ $labelKey }}</h3>
                <p class="text-xs text-gray-500 mt-1">Rata-rata skor komponen ini terendah ({{ number_format($minVal, 2) }}) dibanding komponen lain.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-lg font-bold text-gray-800">Detail Evaluasi Unit Kerja</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100 text-[10px] uppercase text-gray-500 font-bold">
                        <tr>
                            <th class="px-6 py-4">Unit Kerja</th>
                            <th class="px-6 py-4 text-center">Nilai Akhir</th>
                            <th class="px-6 py-4 text-center">Predikat</th>
                            <th class="px-4 py-4 text-center w-24">Perencanaan<br><span class="text-[9px] text-gray-400">(30%)</span></th>
                            <th class="px-4 py-4 text-center w-24">Pengukuran<br><span class="text-[9px] text-gray-400">(25%)</span></th>
                            <th class="px-4 py-4 text-center w-24">Pelaporan<br><span class="text-[9px] text-gray-400">(15%)</span></th>
                            <th class="px-4 py-4 text-center w-24">Evaluasi<br><span class="text-[9px] text-gray-400">(10%)</span></th>
                            <th class="px-4 py-4 text-center w-24">Capaian<br><span class="text-[9px] text-gray-400">(20%)</span></th>
                            <th class="px-6 py-4 text-right">LHE</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs">
                        @forelse($reviews as $item)
                        <tr class="hover:bg-blue-50/20 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800 text-sm">{{ $item->unit->nama_unit ?? 'Nama Unit' }}</div>
                                <div class="text-gray-400 mt-0.5">{{ $item->judul_evaluasi }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-bold text-gray-800">{{ $item->nilai_akhir }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2.5 py-1 rounded font-bold border {{ $item->predikat_badge }}">
                                    {{ $item->predikat }}
                                </span>
                            </td>

                            {{-- PROGRESS BAR KOMPONEN (Visualisasi Bobot) --}}
                            {{-- PERENCANAAN (Bobot 30%) --}}
                            <td class="px-4 py-4 text-center">
                                <div class="font-semibold">{{ $item->nilai_perencanaan }}</div>
                                <div class="w-full bg-gray-200 h-1 rounded-full mt-1">
                                    <div class="bg-blue-500 h-1 rounded-full"
                                        :style="{ width: '{{ ($item->nilai_perencanaan/30)*100 }}%' }">
                                    </div>
                                </div>
                            </td>

                            {{-- PENGUKURAN (Bobot 25%) --}}
                            <td class="px-4 py-4 text-center">
                                <div class="font-semibold">{{ $item->nilai_pengukuran }}</div>
                                <div class="w-full bg-gray-200 h-1 rounded-full mt-1">
                                    <div class="bg-blue-500 h-1 rounded-full"
                                        :style="{ width: '{{ ($item->nilai_pengukuran/25)*100 }}%' }">
                                    </div>
                                </div>
                            </td>

                            {{-- PELAPORAN (Bobot 15%) --}}
                            <td class="px-4 py-4 text-center">
                                <div class="font-semibold">{{ $item->nilai_pelaporan }}</div>
                                <div class="w-full bg-gray-200 h-1 rounded-full mt-1">
                                    <div class="bg-blue-500 h-1 rounded-full"
                                        :style="{ width: '{{ ($item->nilai_pelaporan/15)*100 }}%' }">
                                    </div>
                                </div>
                            </td>

                            {{-- EVALUASI (Bobot 10%) --}}
                            <td class="px-4 py-4 text-center">
                                <div class="font-semibold">{{ $item->nilai_evaluasi }}</div>
                                <div class="w-full bg-gray-200 h-1 rounded-full mt-1">
                                    <div class="bg-blue-500 h-1 rounded-full"
                                        :style="{ width: '{{ ($item->nilai_evaluasi/10)*100 }}%' }">
                                    </div>
                                </div>
                            </td>

                            {{-- CAPAIAN (Bobot 20%) --}}
                            <td class="px-4 py-4 text-center">
                                <div class="font-semibold">{{ $item->nilai_capaian }}</div>
                                <div class="w-full bg-gray-200 h-1 rounded-full mt-1">
                                    <div class="bg-blue-500 h-1 rounded-full"
                                        :style="{ width: '{{ ($item->nilai_capaian/20)*100 }}%' }">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-gray-400">Belum ada data evaluasi SAKIP tahun ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-100">{{ $reviews->links() }}</div>
        </div>
    </main>
</body>
</html>
