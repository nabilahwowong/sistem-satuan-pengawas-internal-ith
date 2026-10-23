<!DOCTYPE html>
<html lang="id">
<head>
    <title>Keuangan & Anggaran - Dashboard Pimpinan</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Font & Icon --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind Config --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif']
                    },
                    colors: {
                        dark: {
                            800: '#1e1e1e',
                            900: '#121212'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800 font-sans antialiased">

{{-- SIDEBAR --}}
    <aside class="fixed top-0 left-0 h-screen w-64 bg-gray-900 text-white py-6 px-5 border-r border-gray-800 shadow-xl z-50 overflow-y-auto custom-scrollbar">

    <div class="flex items-center gap-3 mb-8 px-2">
        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center font-bold text-white">
            P
        </div>
        <div>
            <h2 class="text-sm font-bold">PIMPINAN</h2>
            <p class="text-[10px] text-gray-400">Monitoring SPI</p>
        </div>
    </div>

    <nav class="space-y-1">
        <a href="{{ route('pimpinan.dashboard') }}"
           class="flex items-center gap-3 px-4 py-2.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl text-sm font-medium">
            <i class="fa-solid fa-house w-5 text-center"></i>
            Beranda
        </a>

        <div class="px-4 mt-6 mb-2 text-[10px] font-bold text-gray-500 uppercase">
            Pengawasan Internal
        </div>

        <a href="{{ route('pimpinan.laporan.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl text-sm font-medium">
            <i class="fa-solid fa-file-contract w-5 text-center"></i>
            Laporan Audit
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

        <div class="pt-6 mt-6 border-t border-gray-700">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-2.5 text-red-400 hover:bg-red-500/10 rounded-xl text-sm font-medium">
                    <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
                    Logout
                </button>
            </form>
        </div>
    </nav>
</aside>

{{-- MAIN --}}
<main class="ml-64 p-8 min-h-screen transition-all duration-300">

    {{-- HEADER --}}
    <header class="flex justify-between items-center mb-8 bg-white p-5 rounded-2xl shadow-sm border">
        <div>
            <h1 class="text-2xl font-bold">Reviu Keuangan & Anggaran</h1>
            <p class="text-xs text-gray-500 mt-1">
                Monitoring serapan anggaran dan kepatuhan laporan keuangan
            </p>
        </div>

        <form method="GET">
            <select name="tahun"
                    onchange="this.form.submit()"
                    class="bg-gray-50 border rounded-xl p-2.5 text-sm">
                <option value="">Semua Tahun</option>
                @for ($i = date('Y'); $i >= date('Y') - 4; $i--)
                    <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </form>
    </header>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
        <table class="w-full border-collapse text-sm">
            <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase">Dokumen</th>
                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase">Periode</th>
                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase">Ringkasan</th>
                <th class="px-6 py-4 text-center text-[10px] font-bold uppercase">Status</th>
                <th class="px-6 py-4 text-right text-[10px] font-bold uppercase">Aksi</th>
            </tr>
            </thead>

            <tbody class="divide-y">
            @forelse ($reviews as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="font-bold">{{ $item->judul_dokumen }}</div>
                        <div class="text-xs text-gray-400">
                            Unit: {{ $item->unit->nama_unit ?? 'Pusat' }}
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->periode }} {{ $item->tahun_anggaran }}
                    </td>

                @php
                    $isAnggaran = $item->kategori === 'anggaran';
                    $isValidKeuangan = $item->is_lra_valid && $item->is_neraca_valid;
                @endphp

                <td class="px-6 py-4">
                    @if ($isAnggaran)
                        <div class="flex items-center gap-2">
                            <div class="w-24 bg-gray-200 rounded-full h-1.5">
                                <div class="h-1.5 rounded-full {{ $item->serapan_badge }} bg-current"
                                    :style="{ width: '{{ $item->persentase_serapan }}%' }">
                                </div>
                            </div>
                            <span class="text-xs font-bold">
                                {{ $item->persentase_serapan }}%
                            </span>
                        </div>
                        <div class="text-[10px] text-gray-400 mt-1">
                            Serapan Anggaran
                        </div>

                    @elseif ($isValidKeuangan)
                        <span class="text-green-600 text-xs font-bold">
                            <i class="fa-solid fa-check-circle"></i>
                            Wajar/Sesuai
                        </span>

                    @else
                        <span class="text-red-500 text-xs font-bold">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $item->jumlah_temuan_kepatuhan }} Catatan
                        </span>
                    @endif
                </td>


                    <td class="px-6 py-4 text-center">
                        <span class="px-2 py-1 rounded text-[10px] font-bold bg-green-100 text-green-700">
                            Final
                        </span>
                    </td>

                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('pimpinan.keuangan.download', $item->id) }}"
                           class="text-blue-600 font-bold text-xs">
                            <i class="fa-solid fa-download mr-1"></i>
                            Unduh
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                        Tidak ada data reviu
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4 border-t">
            {{ $reviews->links() }}
        </div>
    </div>

</main>
</body>
</html>
