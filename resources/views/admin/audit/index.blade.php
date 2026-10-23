<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kertas Kerja Audit | Admin SPI</title>
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


    <main class="ml-[260px] p-6">
        <header class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-xl font-bold">Kertas Kerja Audit</h1>
                <p class="text-xs text-gray-500">Daftar temuan audit dan kertas kerja.</p>
            </div>
            <a href="{{ route('admin.audit.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                <i class="fa-solid fa-plus"></i> Buat KKA Baru
            </a>
        </header>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600">No Ref</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600">Judul Temuan</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600">Unit</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600">Lampiran</th>
                        <th class="px-6 py-3 text-xs font-bold uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($findings as $f)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-sm font-mono text-blue-600">{{ $f->no_referensi }}</td>
                        <td class="px-6 py-3 text-sm font-bold">{{ $f->judul }}</td>
                        <td class="px-6 py-3 text-xs text-gray-500">{{ $f->unit->nama_unit }}</td>
                        <td class="px-6 py-3 text-xs">
                            @if($f->file_path)
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-[10px] font-bold"><i class="fa-solid fa-paperclip"></i> Ada</span>
                            @else
                                <span class="text-gray-400 text-[10px]">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-right">
                            <a href="{{ route('admin.audit.show', $f->id) }}" class="text-blue-600 hover:underline text-xs font-bold">Buka / Cetak</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-xs">Belum ada data audit.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $findings->links() }}</div>
    </main>
</body>
</html>
