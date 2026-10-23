<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Arsip| Admin SPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'inter', 'sans-serif'] },
                    colors: { 'spi-blue': '#1e4bbc', 'spi-dark': '#1e3a8a', 'spi-bg': '#f4f6fa' }
                }
            }
        }
    </script>

    {{-- CSS KHUSUS UNTUK HILANGKAN SCROLLBAR --}}
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden">

@include('admin.components.admin-sidebar')

    <main class="ml-[260px] h-full p-6 flex flex-col overflow-y-auto transition-all duration-300 relative z-0">

        <header class="bg-white px-6 py-4 rounded-[20px] shadow-sm mb-6 shrink-0 border border-gray-100 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold">{{ $pageTitle }}</h1>
                [cite_start]<p class="text-xs text-gray-500">Arsip dokumen final yang telah disahkan[cite: 156, 420].</p>
            </div>
            <a href="{{ route('admin.archives.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 shadow-lg shadow-blue-200 transition">
                <i class="fa-solid fa-file-arrow-up"></i> Arsipkan Laporan Baru
            </a>
        </header>

        <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 flex-1 flex flex-col min-h-0 overflow-hidden">
            {{-- Filter & Search --}}
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 bg-gray-50/50 shrink-0">
                <div class="flex gap-2">
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider py-1">Filter:</span>
                    <a href="{{ route('admin.archives.index', ['kategori' => 'lha']) }}" class="px-3 py-0.5 rounded-full text-xs font-medium border transition {{ request('kategori') == 'lha' ? 'bg-purple-100 text-purple-700 border-purple-200' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">LHA</a>
                    <a href="{{ route('admin.archives.index', ['kategori' => 'lhr']) }}" class="px-3 py-0.5 rounded-full text-xs font-medium border transition {{ request('kategori') == 'lhr' ? 'bg-teal-100 text-teal-700 border-teal-200' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">LHR</a>
                </div>
                <form action="{{ route('admin.archives.index') }}" method="GET">
                    @if(request('kategori')) <input type="hidden" name="kategori" value="{{ request('kategori') }}"> @endif
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Judul/No..." class="text-xs border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:border-blue-500 w-64">
                </form>
            </div>

            {{-- Tabel dengan Scroll sendiri --}}
            <div class="overflow-y-auto flex-1">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b sticky top-0 z-10 shadow-sm">
                        <tr>
                            <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600 w-20">Tahun</th>
                            <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600">Judul Laporan</th>
                            <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600">Nomor</th>
                            <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600">Unit</th>
                            <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600 text-right">File</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($archives as $file)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-3 text-xs font-bold text-gray-500">{{ $file->tahun }}</td>
                            <td class="px-6 py-3">
                                <div class="font-bold text-sm text-gray-800">{{ $file->judul }}</div>
                                <span class="text-[10px] px-2 py-0.5 rounded font-bold uppercase tracking-wider {{ $file->kategori == 'lha' ? 'bg-purple-100 text-purple-600' : 'bg-teal-100 text-teal-600' }}">
                                    {{ strtoupper($file->kategori) }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-xs font-mono text-gray-600">{{ $file->nomor_laporan }}</td>
                            <td class="px-6 py-3 text-xs text-gray-600">{{ $file->unit->nama_unit ?? '-' }}</td>
                            <td class="px-6 py-3 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ asset('storage/archives/' . $file->file_path) }}" target="_blank" class="text-red-600 hover:text-red-800 text-xs font-bold flex items-center gap-1 bg-red-50 px-3 py-1.5 rounded-lg border border-red-100 hover:bg-red-100 transition">
                                        <i class="fa-solid fa-file-pdf"></i> PDF
                                    </a>
                                    <form action="{{ route('admin.archives.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Hapus arsip ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 transition" title="Hapus">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm">
                                <div class="flex flex-col items-center">
                                    <i class="fa-regular fa-folder-open text-3xl mb-2 opacity-50"></i>
                                    <p>Belum ada laporan diarsipkan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($archives->hasPages())
                <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">
                    {{ $archives->links() }}
                </div>
            @endif
        </div>
    </main>
</body>
</html>
