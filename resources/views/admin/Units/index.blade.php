<!DOCTYPE html>
<html lang="id">
<head>
    <title>Daftar Unit Kerja | Admin SPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'inter', 'sans-serif'] },
                    colors: { 'spi-blue': '#1e4bbc', 'spi-bg': '#f4f6fa' }
                }
            }
        }
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden">

@include('admin.components.admin-sidebar')

    <main class="ml-[260px] h-full p-6 flex flex-col overflow-hidden">

        <header class="bg-white px-6 py-4 rounded-[20px] shadow-sm mb-6 shrink-0 border border-gray-100 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Daftar Unit Kerja</h1>
                <p class="text-gray-500 text-xs mt-1">Kelola fakultas, biro, dan unit lainnya.</p>
            </div>

            <a href="{{ route('admin.units.create') }}" class="bg-spi-blue text-white px-4 py-2 rounded-lg text-xs font-medium hover:bg-blue-800 transition shadow-lg shadow-blue-200 flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Unit
            </a>
        </header>

        <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 flex-1 flex flex-col min-h-0 overflow-hidden">

            {{-- Search Bar --}}
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 shrink-0">
                <form action="{{ route('admin.units.index') }}" method="GET" class="relative w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari unit..." class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-spi-blue">
                    <i class="fa-solid fa-search absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                </form>
            </div>

            {{-- Tabel Unit --}}
            <div class="overflow-y-auto p-0 flex-1 no-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-gray-50 z-10">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase w-16">No</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase w-32">Kode</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase">Nama Unit Kerja</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($units as $index => $unit)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 text-xs text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-3">
                                <span class="bg-blue-50 text-spi-blue px-2 py-1 rounded text-[10px] font-bold border border-blue-100">
                                    {{ $unit->kode_unit }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-sm font-medium text-gray-800">
                                {{ $unit->nama_unit }}
                            </td>
                            <td class="px-6 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.units.edit', $unit->id) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.units.destroy', $unit->id) }}" method="POST" onsubmit="return confirm('Hapus unit ini? User di dalamnya akan kehilangan unit.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 transition">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500 text-xs">
                                Belum ada data unit kerja.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">
                {{ $units->links() }}
            </div>
        </div>
    </main>
</body>
</html>
