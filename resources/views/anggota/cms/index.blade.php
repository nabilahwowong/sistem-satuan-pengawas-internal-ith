<!DOCTYPE html>
<html lang="id">
<head>
    <title>Manajemen Konten Landing Page</title>
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
</head>

<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden">
    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar --}}
        <aside class="w-64 h-full shrink-0 overflow-hidden">
            @include('anggota.components.anggota-sidebar')
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 overflow-y-auto p-8 relative z-0">

            {{-- Header Khusus Halaman Ini --}}
            <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Manajemen Konten Landing Page</h1>
                    <p class="text-gray-500 text-sm mt-1">Pilih menu navigasi yang ingin Anda ubah, tambahkan, atau hapus kontennya.</p>
                </div>

                {{-- Tombol Tambah Menu Baru --}}
                <a href="{{ route('anggota.cms.create') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-md shadow-blue-200 transition-all hover:-translate-y-0.5 shrink-0">
                    <i class="fa-solid fa-plus mr-2"></i> Tambah Menu Baru
                </a>
            </div>

            @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center shadow-sm">
                <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
            @endif

            {{-- Grid Menu (Semua menu harus ada di dalam div ini) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- Panel Profil SPI --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-spi-dark px-6 py-4">
                        <h2 class="text-white font-semibold flex items-center text-sm">
                            <i class="fa-regular fa-user mr-2"></i> Menu Profil SPI
                        </h2>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @foreach($profils as $item)
                        <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition-colors">
                            <div>
                                <span class="text-gray-800 font-medium text-sm">{{ $item->title }}</span>
                                <p class="text-[10px] text-gray-400 mt-0.5">Slug: /informasi/{{ $item->slug }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('anggota.cms.edit', $item->id) }}" class="inline-flex items-center px-4 py-1.5 bg-blue-50 text-blue-600 rounded border border-blue-100 hover:bg-blue-100 transition text-xs font-bold shadow-sm">
                                    <i class="fa-regular fa-pen-to-square mr-1.5"></i> Edit
                                </a>
                                {{-- Form Hapus --}}
                                <form action="{{ route('anggota.cms.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu {{ $item->title }}? Tindakan ini tidak dapat dibatalkan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 rounded border border-red-100 hover:bg-red-100 transition text-xs font-bold shadow-sm" title="Hapus Menu">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Panel Layanan --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-emerald-700 px-6 py-4">
                        <h2 class="text-white font-semibold flex items-center text-sm">
                            <i class="fa-solid fa-briefcase mr-2"></i> Menu Layanan
                        </h2>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @foreach($layanans as $item)
                        <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition-colors">
                            <div>
                                <span class="text-gray-800 font-medium text-sm">{{ $item->title }}</span>
                                <p class="text-[10px] text-gray-400 mt-0.5">Slug: /informasi/{{ $item->slug }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('anggota.cms.edit', $item->id) }}" class="inline-flex items-center px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded border border-emerald-100 hover:bg-emerald-100 transition text-xs font-bold shadow-sm">
                                    <i class="fa-regular fa-pen-to-square mr-1.5"></i> Edit
                                </a>
                                {{-- Form Hapus --}}
                                <form action="{{ route('anggota.cms.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu {{ $item->title }}? Tindakan ini tidak dapat dibatalkan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 rounded border border-red-100 hover:bg-red-100 transition text-xs font-bold shadow-sm" title="Hapus Menu">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Panel Program Kerja (Full Width) --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden lg:col-span-2">
                    <div class="bg-amber-600 px-6 py-4">
                        <h2 class="text-white font-semibold flex items-center text-sm">
                            <i class="fa-solid fa-list-check mr-2"></i> Menu Program Kerja
                        </h2>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @forelse($programs as $item)
                        <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition-colors">
                            <div>
                                <span class="text-gray-800 font-medium text-sm">{{ $item->title }}</span>
                                <p class="text-[10px] text-gray-400 mt-0.5">Slug: /informasi/{{ $item->slug }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('anggota.cms.edit', $item->id) }}" class="inline-flex items-center px-4 py-1.5 bg-amber-50 text-amber-600 rounded border border-amber-100 hover:bg-amber-100 transition text-xs font-bold shadow-sm">
                                    <i class="fa-regular fa-pen-to-square mr-1.5"></i> Edit
                                </a>
                                {{-- Form Hapus --}}
                                <form action="{{ route('anggota.cms.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu {{ $item->title }}? Tindakan ini tidak dapat dibatalkan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 rounded border border-red-100 hover:bg-red-100 transition text-xs font-bold shadow-sm" title="Hapus Menu">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="px-6 py-4 text-sm text-gray-500 italic">Belum ada data program kerja.</div>
                        @endforelse
                    </div>
                </div>

            </div> {{-- Akhir dari Grid Menu --}}

        </main>
    </div>
</body>
</html>
