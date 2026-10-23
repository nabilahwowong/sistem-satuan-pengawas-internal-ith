<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Temuan Audit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] }, colors: { 'spi-blue': '#1e4bbc', 'spi-bg': '#f4f6fa' } } } }
    </script>
</head>
<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden flex">

    @include('anggota.components.anggota-sidebar')

    <main class="flex-1 h-full flex flex-col overflow-hidden relative transition-all duration-300">

        <header class="bg-white mx-6 mt-6 px-6 py-4 rounded-[20px] shadow-sm shrink-0 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Data Temuan</h1>
                <p class="text-xs text-gray-500 mt-1">Daftar temuan audit dan tanggapan unit.</p>
            </div>
            <a href="{{ route('anggota.findings.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-red-700 transition-colors shadow-red-100 shadow-lg hover:shadow-red-300">
                <i class="fa-solid fa-plus mr-2"></i> Catat Temuan
            </a>
        </header>

        <div class="flex-1 overflow-y-auto p-6">

            @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center shadow-sm">
                <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
            @endif

            <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left text-sm border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-gray-600 text-xs uppercase">Kode & Unit</th>
                            <th class="px-6 py-4 font-semibold text-gray-600 text-xs uppercase">Judul Temuan</th>
                            <th class="px-6 py-4 font-semibold text-gray-600 text-xs uppercase">Kategori</th>
                            <th class="px-6 py-4 font-semibold text-gray-600 text-xs uppercase text-center">Status</th>
                            <th class="px-6 py-4 font-semibold text-gray-600 text-xs uppercase text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($findings as $finding)
                        <tr class="hover:bg-blue-50/40 transition-colors">
                            <td class="px-6 py-4 align-top">
                                <div class="font-bold text-gray-800 text-xs">{{ $finding->no_referensi }}</div>
                                <div class="text-xs text-blue-600 font-bold mt-1">{{ $finding->unit->nama_unit ?? '-' }}</div>
                                <div class="text-[10px] text-gray-400 leading-tight">{{ $finding->schedule->nama_kegiatan ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 align-top">
                                <div class="font-medium text-gray-800">{{ Str::limit($finding->judul, 50) }}</div>
                                <div class="text-[10px] text-gray-400 mt-1">{{ $finding->created_at->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-4 align-top">
                                @php
                                    $catClass = match($finding->kategori) {
                                        'ringan' => 'bg-green-100 text-green-700 border-green-200',
                                        'sedang' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                        'berat'  => 'bg-red-100 text-red-700 border-red-200',
                                        default => 'bg-gray-100 text-gray-700',
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded border text-[10px] uppercase font-bold {{ $catClass }}">
                                    {{ $finding->kategori ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 align-top text-center">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border uppercase tracking-wide {{ $finding->status_badge }}">
                                    {{ $finding->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 align-top text-right">
                                <div x-data="{ open: false }">
                                    <button @click="open = true" class="text-spi-blue hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs font-medium transition border border-blue-100">
                                        <i class="fa-solid fa-eye mr-1"></i> Detail
                                    </button>

                                    <template x-teleport="body">
                                        <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none;">
                                            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" @click="open = false" x-transition.opacity></div>
                                            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-0 relative z-10 overflow-hidden max-h-[90vh] flex flex-col"
                                                 x-show="open" x-transition.scale.origin.center>
                                                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                                                    <div>
                                                        <h3 class="text-base font-bold text-gray-800">Detail Temuan</h3>
                                                        <p class="text-xs text-gray-500">{{ $finding->no_referensi }}</p>
                                                    </div>
                                                    <button @click="open = false" class="text-gray-400 hover:text-red-500 transition"><i class="fa-solid fa-xmark text-lg"></i></button>
                                                </div>
                                                <div class="p-6 overflow-y-auto text-left">
                                                    <div class="grid grid-cols-2 gap-4 text-sm mb-6">
                                                        <div class="col-span-2 bg-red-50 p-3 rounded-lg border border-red-100">
                                                            <strong class="text-red-600 text-xs uppercase block mb-1">Kondisi (Masalah)</strong>
                                                            {{ $finding->kondisi }}
                                                        </div>
                                                        <div><strong class="block text-xs text-gray-400 uppercase">Kriteria</strong> {{ $finding->kriteria }}</div>
                                                        <div><strong class="block text-xs text-gray-400 uppercase">Sebab</strong> {{ $finding->sebab }}</div>
                                                        <div><strong class="block text-xs text-gray-400 uppercase">Akibat</strong> {{ $finding->akibat }}</div>
                                                        <div class="col-span-2 bg-blue-50 p-3 rounded-lg border border-blue-100">
                                                            <strong class="text-blue-600 text-xs uppercase block mb-1">Rekomendasi</strong>
                                                            {{ $finding->rekomendasi }}
                                                        </div>
                                                    </div>
                                                    <hr class="border-gray-100 my-4">
                                                    <h4 class="font-bold text-gray-800 mb-2 text-sm">Tanggapan Unit</h4>
                                                    @if($finding->tanggapan_auditi)
                                                        <div class="bg-yellow-50 p-4 rounded-xl border border-yellow-200">
                                                            <div class="flex gap-3">
                                                                <div class="shrink-0 pt-1"><i class="fa-solid fa-comment-dots text-yellow-500"></i></div>
                                                                <div>
                                                                    <p class="text-sm text-gray-800">{{ $finding->tanggapan_auditi }}</p>
                                                                    <div class="mt-2 text-[10px] text-gray-400 flex items-center gap-1">
                                                                        <i class="fa-regular fa-clock"></i>
                                                                        Dijawab: {{ $finding->tanggal_tanggapan ? $finding->tanggal_tanggapan->format('d M Y H:i') : '-' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="text-center py-4 bg-gray-50 rounded-lg border border-dashed border-gray-300 text-gray-400 text-xs italic">
                                                            Belum ada tanggapan dari Kepala Unit.
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                                                    <button @click="open = false" class="px-4 py-2 text-xs font-semibold text-gray-500 hover:bg-gray-200 rounded-lg transition">Tutup</button>
                                                    @if($finding->status == 'responded')
                                                        <form action="{{ route('anggota.findings.close', $finding->id) }}" method="POST">
                                                            @csrf @method('PATCH')
                                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-xs font-bold shadow-lg shadow-green-200 transition">
                                                                <i class="fa-solid fa-check-double mr-1.5"></i> Verifikasi & Selesai
                                                            </button>
                                                        </form>
                                                    @elseif($finding->status == 'closed')
                                                        <span class="flex items-center text-green-600 text-xs font-bold px-3">
                                                            <i class="fa-solid fa-circle-check mr-1.5"></i> Selesai
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                        <i class="fa-solid fa-clipboard-check text-gray-300 text-xl"></i>
                                    </div>
                                    <p>Belum ada data temuan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4 bg-gray-50 border-t border-gray-100">{{ $findings->links() }}</div>
            </div>
        </div>
    </main>
</body>
</html>
