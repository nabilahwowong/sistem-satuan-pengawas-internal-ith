<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedoman & Template | Admin SPI</title>
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

    <main class="ml-[260px] h-full p-6 flex flex-col overflow-hidden">

        <header class="bg-white px-6 py-4 rounded-[20px] shadow-sm mb-6 shrink-0 border border-gray-100 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold text-gray-800">{{ $pageTitle }}</h1>
                <p class="text-gray-500 text-xs mt-1">Daftar arsip dokumen untuk kategori ini.</p>
            </div>
            <a href="{{ route('admin.documents.create') }}" class="bg-spi-blue text-white px-4 py-2 rounded-lg text-xs font-medium hover:bg-blue-800 transition shadow-lg flex items-center gap-2">
                <i class="fa-solid fa-upload"></i> Upload Baru
            </a>
        </header>

        <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 flex-1 flex flex-col min-h-0 overflow-hidden">
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 shrink-0">
                <div class="text-xs text-gray-500 font-medium">
                    Filter Aktif: <span class="text-spi-blue bg-blue-50 px-2 py-1 rounded">{{ $pageTitle }}</span>
                </div>
                <form action="{{ route('admin.documents.index') }}" method="GET" class="relative w-64">
                    @if(request('kategori'))
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari dokumen..." class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-spi-blue">
                    <i class="fa-solid fa-search absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                </form>
            </div>

            <div class="overflow-y-auto p-0 flex-1">
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-gray-50 z-10">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase w-10">No</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase">Judul</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase">Keterangan</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase">Tipe</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($documents as $index => $doc)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 text-xs text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-3">
                                <div class="font-bold text-sm text-gray-800">{{ $doc->judul }}</div>
                                <div class="text-[10px] text-gray-400">{{ $doc->created_at->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-600 truncate max-w-xs">
                                {{ $doc->keterangan ?? '-' }}
                            </td>
                            <td class="px-6 py-3">
                                @php $ext = strtolower($doc->tipe_file); @endphp
                                @if(in_array($ext, ['pdf'])) <span class="text-red-600 font-bold text-xs"><i class="fa-solid fa-file-pdf"></i> PDF</span>
                                @elseif(in_array($ext, ['doc', 'docx'])) <span class="text-blue-600 font-bold text-xs"><i class="fa-solid fa-file-word"></i> Word</span>
                                @elseif(in_array($ext, ['xls', 'xlsx'])) <span class="text-green-600 font-bold text-xs"><i class="fa-solid fa-file-excel"></i> Excel</span>
                                @else <span class="text-gray-600 font-bold text-xs"><i class="fa-solid fa-file"></i> {{ strtoupper($ext) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ asset('storage/documents/' . $doc->file_path) }}" target="_blank" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-green-600 hover:bg-green-50 transition" title="Download">
                                        <i class="fa-solid fa-download text-xs"></i>
                                    </a>
                                    <a href="{{ route('admin.documents.edit', $doc->id) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Hapus dokumen ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 transition">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500 text-xs">Tidak ada dokumen ditemukan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">{{ $documents->links() }}</div>
        </div>
    </main>
</body>
</html>
