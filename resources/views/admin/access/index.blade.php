<!DOCTYPE html>
<html lang="id">
<head>
    <title>Hak Akses | Admin SPI</title>
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
</head>
<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden">

@include('admin.components.admin-sidebar')

    <main class="ml-[260px] h-full p-6 flex flex-col overflow-hidden">

        <header class="bg-white px-6 py-4 rounded-[20px] shadow-sm mb-6 shrink-0 border border-gray-100">
            <h1 class="text-xl font-bold text-gray-800">Manajemen Hak Akses</h1>
            <p class="text-gray-500 text-xs mt-1">Atur peran (role) dan status aktif akun pengguna.</p>
        </header>

        {{-- Alert Success --}}
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-sm">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 flex-1 flex flex-col min-h-0 overflow-hidden">
            <div class="overflow-y-auto p-0 flex-1">
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-gray-50 z-10">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase">Pengguna</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase">Role Saat Ini</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase">Unit</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase text-center">Status Akun</th>
                            <th class="px-6 py-3 font-semibold text-gray-600 text-[11px] uppercase text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3">
                                <div class="font-bold text-sm text-gray-800">{{ $user->name }}</div>
                                <div class="text-[10px] text-gray-500">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-1 rounded text-[10px] font-bold uppercase
                                    {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' :
                                      ($user->role == 'anggota' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700') }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-600">
                                {{ $user->unit->nama_unit ?? '-' }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-semibold bg-green-100 text-green-600 border border-green-200">
                                        <i class="fa-solid fa-check-circle"></i> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-semibold bg-red-100 text-red-600 border border-red-200">
                                        <i class="fa-solid fa-ban"></i> Diblokir
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-right">
                                <a href="{{ route('admin.access.edit', $user->id) }}" class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 hover:bg-spi-blue hover:text-white text-gray-600 rounded-lg text-[10px] font-medium transition">
                                    <i class="fa-solid fa-key"></i> Ubah Akses
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">
                {{ $users->links() }}
            </div>
        </div>
    </main>
</body>
</html>
