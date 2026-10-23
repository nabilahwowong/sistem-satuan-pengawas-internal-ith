<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kertas Kerja Audit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <div class="flex h-screen overflow-hidden">
        @include('anggota.components.anggota-sidebar')

        <main class="flex-1 overflow-y-auto p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Kertas Kerja Audit (KKA)</h1>
                <a href="{{ route('anggota.audit.kka-create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                    <i class="fa-solid fa-plus mr-2"></i> Buat KKA Baru
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3">Jadwal/Kegiatan</th>
                            <th class="px-6 py-3">Temuan (Kondisi)</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($papers as $paper)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3">
                                <div class="font-bold">{{ $paper->schedule->nama_kegiatan }}</div>
                                <div class="text-xs text-gray-500">{{ $paper->schedule->unit->nama_unit }}</div>
                            </td>
                            <td class="px-6 py-3 truncate max-w-xs">{{ Str::limit($paper->kondisi, 50) }}</td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-bold {{ $paper->status == 'draft' ? 'bg-gray-100 text-gray-600' : 'bg-green-100 text-green-600' }}">
                                    {{ ucfirst($paper->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-right">
                                <button class="text-blue-600 hover:underline">Detail</button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada KKA dibuat.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
