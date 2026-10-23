<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tanggapan Temuan - Kepala Unit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] }, colors: { 'spi-blue': '#1e4bbc', 'spi-bg': '#f4f6fa' } } } }
    </script>
</head>
<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden">

    @include('kepala_unit.components.sidebar')

    <main class="ml-[275px] h-full flex flex-col overflow-hidden relative transition-all duration-300">

        <header class="bg-white mx-8 mt-8 px-8 py-5 rounded-[20px] shadow-sm shrink-0 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Tanggapan Temuan</h1>
            <p class="text-xs text-gray-500 mt-1">Berikan tanggapan atas 5 unsur temuan audit.</p>
        </header>

        <div class="flex-1 overflow-y-auto p-8">

            {{-- Alert --}}
            @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center shadow-sm">
                <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
            @endif

            <div class="grid gap-6">
                @forelse($findings as $finding)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ expanded: false }">

                    {{-- Header Kartu --}}
                    <div class="bg-gray-50/50 px-6 py-4 border-b border-gray-100 flex justify-between items-center cursor-pointer" @click="expanded = !expanded">
                        <div class="flex items-center gap-3">
                            <span class="px-2.5 py-1 rounded text-[10px] font-bold border uppercase {{ $finding->status_badge }}">
                                {{ $finding->status }}
                            </span>
                            <div>
                                <h3 class="font-bold text-gray-800 text-sm">{{ $finding->judul }}</h3>
                                <div class="text-[10px] text-gray-400 mt-0.5">{{ $finding->no_referensi ?? 'Ref: -' }}</div>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-down text-gray-400 transition-transform duration-300" :class="expanded ? 'rotate-180' : ''"></i>
                    </div>

                    {{-- Isi Kartu --}}
                    <div class="p-6">

                        {{-- 5 Unsur Temuan --}}
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-4">
                                <div><h4 class="text-[10px] font-bold text-gray-400 uppercase">1. Kondisi</h4> <p class="text-sm bg-red-50 p-2 rounded border border-red-100">{{ $finding->kondisi }}</p></div>
                                <div><h4 class="text-[10px] font-bold text-gray-400 uppercase">2. Kriteria</h4> <p class="text-sm text-gray-600">{{ $finding->kriteria }}</p></div>
                                <div><h4 class="text-[10px] font-bold text-gray-400 uppercase">3. Sebab</h4> <p class="text-sm text-gray-600">{{ $finding->sebab }}</p></div>
                            </div>
                            <div class="space-y-4">
                                <div><h4 class="text-[10px] font-bold text-gray-400 uppercase">4. Akibat</h4> <p class="text-sm text-gray-600">{{ $finding->akibat }}</p></div>
                                <div><h4 class="text-[10px] font-bold text-gray-400 uppercase">5. Rekomendasi</h4> <p class="text-sm bg-blue-50 p-2 rounded border border-blue-100 font-medium">{{ $finding->rekomendasi }}</p></div>
                            </div>
                        </div>

                        <hr class="border-gray-100 mb-6">

                        {{-- Form Tanggapan --}}
                        <div>
                            <h4 class="text-xs font-bold text-gray-800 mb-3 uppercase tracking-wider">Tanggapan Manajemen</h4>

                            @if($finding->tanggapan_auditi)
                                <div class="bg-green-50 p-4 rounded-lg border border-green-100 text-sm text-gray-700">
                                    <i class="fa-solid fa-quote-left text-green-300 mr-2"></i>
                                    {{ $finding->tanggapan_auditi }}
                                </div>
                                <div class="text-right mt-1 text-[10px] text-gray-400">
                                    Dijawab: {{ $finding->tanggal_tanggapan->format('d M Y, H:i') }}
                                </div>
                            @else
                                <form action="{{ route('kepala_unit.temuan.update', $finding->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <textarea name="tanggapan_auditi" rows="3" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-spi-blue focus:border-transparent" placeholder="Tuliskan tanggapan dan rencana tindak lanjut..." required></textarea>
                                    <div class="mt-3 text-right">
                                        <button type="submit" class="bg-spi-blue text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-blue-800 transition">
                                            Kirim Tanggapan <i class="fa-solid fa-paper-plane ml-1"></i>
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <p class="text-gray-500 text-sm">Belum ada temuan audit.</p>
                </div>
                @endforelse

                <div class="mt-4">{{ $findings->links() }}</div>
            </div>
        </div>
    </main>
</body>
</html>
