<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard - Kepala Unit</title>
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
            <div>
                <h1 class="text-xl font-bold text-gray-800">Selamat Datang, Kepala Unit</h1>
                <p class="text-xs text-gray-500 mt-1">Pantau permintaan dokumen dan tanggapan temuan.</p>
            </div>

            {{-- Profil Dropdown (Sesuai gambar Anda) --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-3 focus:outline-none">
                    <div class="text-right hidden md:block">
                        <div class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] text-gray-400">NIP. {{ Auth::user()->nip ?? '-' }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-spi-blue text-white flex items-center justify-center text-sm font-bold shadow-md overflow-hidden border border-white">
                        @if(Auth::user()->foto_profil)
                            {{-- Jika ada foto, tampilkan foto --}}
                            <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" alt="Foto Profil" class="w-full h-full object-cover">
                        @else
                            {{-- Jika tidak ada, tampilkan inisial --}}
                            {{ substr(Auth::user()->name, 0, 2) }}
                        @endif
                    </div>
                    <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                </button>

                {{-- Dropdown Menu --}}
                <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50" style="display: none;">
                    <a href="{{ route('kepala_unit.profil') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        <i class="fa-regular fa-user mr-2 text-gray-400"></i> Profil Saya
                    </a>
                    <div class="border-t border-gray-100 my-1"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                            <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">

            {{-- 1. KARTU STATISTIK (CLICKABLE) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                {{-- Card 1: Jadwal --}}
                <a href="{{ route('kepala_unit.jadwal') }}" class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all group cursor-pointer">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Audit</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $counts['jadwal'] }}</h3>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i class="fa-regular fa-calendar-check"></i>
                        </div>
                    </div>
                    <div class="text-[10px] text-gray-400">Jadwal kegiatan tahun ini</div>
                </a>

                {{-- Card 2: Dokumen (Permintaan) --}}
                <a href="{{ route('kepala_unit.dokumen') }}" class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all group cursor-pointer">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Dokumen</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $counts['dokumen'] }}</h3>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-yellow-50 text-yellow-600 flex items-center justify-center group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                            <i class="fa-regular fa-folder-open"></i>
                        </div>
                    </div>
                    <div class="text-[10px] text-gray-400">Permintaan dokumen masuk</div>
                </a>

                {{-- Card 3: Tanggapan (Temuan) --}}
                <a href="{{ route('kepala_unit.temuan') }}" class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all group cursor-pointer">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Tanggapan</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $counts['temuan'] }}</h3>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-red-50 text-red-600 flex items-center justify-center group-hover:bg-red-500 group-hover:text-white transition-colors">
                            <i class="fa-regular fa-comments"></i>
                        </div>
                    </div>
                    <div class="text-[10px] text-gray-400">Temuan butuh respon</div>
                </a>

                {{-- Card 4: Selesai --}}
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Selesai</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $counts['selesai'] }}</h3>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-green-50 text-green-600 flex items-center justify-center">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </div>
                    <div class="text-[10px] text-gray-400">Dokumen disetujui</div>
                </div>
            </div>

            {{-- 2. TABEL PERMINTAAN DOKUMEN TERBARU (CLICKABLE ROWS) --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Permintaan Dokumen Terbaru</h3>
                    <a href="{{ route('kepala_unit.dokumen') }}" class="text-xs font-bold text-spi-blue hover:underline">Lihat Semua</a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase">Dokumen</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase">Tgl Request</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase">Deadline</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase text-center">Status</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($recentDocuments as $doc)
                        <tr @click="window.location.href = '{{ route('kepala_unit.dokumen') }}'"
                            class="hover:bg-blue-50/50 transition-colors cursor-pointer group relative">

                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $doc->judul }}</div>
                                <div class="text-[10px] text-gray-400 mt-0.5">
                                    {{ $doc->schedule->nama_kegiatan ?? 'Kegiatan Umum' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-600">
                                {{ $doc->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-xs">
                                @if($doc->deadline)
                                    <span class="{{ $doc->deadline < now() && $doc->status != 'fulfilled' ? 'text-red-500 font-bold' : 'text-gray-600' }}">
                                        {{ \Carbon\Carbon::parse($doc->deadline)->format('d M Y') }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $badgeClass = match($doc->status) {
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'terkirim' => 'bg-blue-100 text-blue-700',
                                        'fulfilled' => 'bg-green-100 text-green-700',
                                        'rejected' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $badgeClass }}">
                                    {{ $doc->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($doc->status == 'pending' || $doc->status == 'rejected')
                                    {{--
                                        BUTTON UPLOAD (MODAL)
                                        x-data: Membuat scope data baru untuk modal baris ini
                                        @click.stop: MENCEGAH klik tembus ke baris tr (agar tidak pindah halaman)
                                    --}}
                                    <div x-data="{ openUpload: false }" @click.stop class="inline-block">
                                        <button @click="openUpload = true" type="button" class="px-3 py-1.5 bg-spi-blue text-white rounded-lg text-xs font-bold shadow-sm shadow-blue-200 hover:bg-blue-800 transition z-10 relative">
                                            <i class="fa-solid fa-upload mr-1"></i> Upload
                                        </button>

                                        <template x-teleport="body">
                                            <div x-show="openUpload" class="fixed inset-0 z-9999 flex items-center justify-center" style="display: none;">
                                                <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" @click="openUpload = false"></div>

                                                <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-6 relative z-10 animate-fade-in-up">
                                                    <div class="flex justify-between items-center mb-4">
                                                        <h3 class="font-bold text-gray-800">Upload Dokumen</h3>
                                                        <button @click="openUpload = false" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
                                                    </div>

                                                    <div class="mb-4 text-left bg-blue-50 p-3 rounded border border-blue-100">
                                                        <p class="text-[10px] text-gray-500 uppercase font-bold">Dokumen diminta:</p>
                                                        <p class="text-sm font-semibold text-gray-800">{{ $doc->judul }}</p>
                                                    </div>

                                                    {{-- Form Upload (Mengarah ke Route Upload) --}}
                                                    <form action="{{ route('kepala_unit.dokumen.upload', $doc->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf @method('PATCH')

                                                        <label class="block mb-2 text-xs font-bold text-gray-700">Pilih File (PDF/Office)</label>
                                                        <input type="file" name="file_dokumen" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-spi-blue hover:file:bg-blue-100 cursor-pointer border border-gray-300 rounded-lg mb-4" required>

                                                        <div class="flex justify-end gap-2">
                                                            <button type="button" @click="openUpload = false" class="px-4 py-2 text-xs font-bold text-gray-500 hover:bg-gray-100 rounded-lg">Batal</button>
                                                            <button type="submit" class="bg-spi-blue text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-blue-800 transition">Kirim</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                @else
                                    {{-- Jika status selain pending/rejected, tampilkan ikon mata saja --}}
                                    <span class="text-gray-300" title="Menunggu Verifikasi / Selesai"><i class="fa-regular fa-eye"></i></span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                <i class="fa-regular fa-folder-open text-2xl mb-2 block"></i>
                                Belum ada permintaan dokumen terbaru.
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
