<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna | Admin SPI</title>
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

    <main class="ml-[260px] h-full p-6 flex flex-col overflow-hidden">

        <header class="bg-white px-6 py-4 rounded-[20px] shadow-sm flex justify-between items-center mb-6 shrink-0 border border-gray-100">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Data Pengguna</h1>
                <p class="text-gray-500 text-xs mt-1">Kelola data Anggota SPI dan Kepala Unit.</p>
            </div>
            {{-- REVISI: Link diperbaiki ke route create --}}
            <a href="{{ route('admin.users.create') }}" class="bg-spi-blue text-white px-4 py-2 rounded-lg text-xs font-medium hover:bg-spi-dark transition shadow-lg shadow-blue-200 flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Pengguna
            </a>
        </header>

        <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 flex-1 flex flex-col min-h-0 overflow-hidden">

            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 shrink-0">
                <div class="relative w-64">
                    {{-- Form Pencarian (Opsional: Tambahkan form action ke index jika ingin fitur search jalan) --}}
                    <form action="{{ route('admin.users.index') }}" method="GET">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIP..." class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-spi-blue">
                        <i class="fa-solid fa-search absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                    </form>
                </div>

                {{-- REVISI: Tombol Filter Dropdown --}}
                <div class="relative">
                    <button onclick="document.getElementById('filterDropdown').classList.toggle('hidden')" class="px-3 py-2 border border-gray-200 rounded-lg text-xs hover:bg-gray-50 text-gray-600 flex items-center gap-2">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>

                    <div id="filterDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 z-50">
                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Semua Role</a>
                        <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Admin</a>
                        <a href="{{ route('admin.users.index', ['role' => 'anggota']) }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Anggota SPI</a>
                        <a href="{{ route('admin.users.index', ['role' => 'kepala_unit']) }}" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Kepala Unit</a>
                    </div>
                </div>
            </div>

            <div class="overflow-y-auto p-0 flex-1 no-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-gray-50 z-10">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase w-10">No</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase">Nama & NIP</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase">Role</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase">Unit Kerja</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase text-center">Status</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $index => $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 text-xs text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-3">
                                <div class="font-bold text-gray-800 text-sm">{{ $user->name }}</div>
                                <div class="text-[11px] text-gray-400 font-mono">NIP. {{ $user->nip }}</div>
                            </td>
                            <td class="px-6 py-3">
                                @if($user->role == 'admin')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-medium bg-purple-100 text-purple-700">
                                        <i class="fa-solid fa-crown"></i> Admin
                                    </span>
                                @elseif($user->role == 'anggota')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-medium bg-blue-100 text-blue-700">
                                        <i class="fa-solid fa-user-shield"></i> Anggota SPI
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-medium bg-orange-100 text-orange-700">
                                        <i class="fa-solid fa-user-tie"></i> Kepala Unit
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-600">
                                {{ $user->unit->nama_unit ?? '-' }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                @if($user->is_active)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-green-100 text-green-600 border border-green-200">Aktif</span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-red-100 text-red-600 border border-red-200">Non-Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- REVISI: Tombol Edit Mengarah ke Route --}}
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition" title="Edit">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 transition" title="Hapus">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-3 border-t border-gray-100 bg-gray-50 flex justify-between items-center shrink-0">
                <span class="text-[10px] text-gray-500">Menampilkan 1-10 dari 50 data</span>
                {{ $users->links() }}
            </div>
        </div>

    </main>

    {{-- Script Dropdown Filter --}}
    <script>
        // Menutup dropdown jika klik di luar
        window.onclick = function(event) {
            if (!event.target.closest('.relative')) {
                var dropdowns = document.querySelectorAll('[id^="filterDropdown"]');
                dropdowns.forEach(function(openDropdown) {
                    if (!openDropdown.classList.contains('hidden')) {
                        openDropdown.classList.add('hidden');
                    }
                });
            }
        }
    </script>
</body>
</html>
