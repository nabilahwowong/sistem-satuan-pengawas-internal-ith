<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kertas Data Audit (KDA)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <div class="flex h-screen overflow-hidden">
        @include('anggota.components.anggota-sidebar')

        <main class="flex-1 overflow-y-auto p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Kertas Data Audit (KDA)</h1>
                    <p class="text-sm text-gray-500">Rangkuman temuan yang dikirim ke Auditee.</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-gray-600">Kode Temuan</th>
                            <th class="px-6 py-3 font-semibold text-gray-600">Jadwal/Unit</th>
                            <th class="px-6 py-3 font-semibold text-gray-600">Uraian Masalah</th>
                            <th class="px-6 py-3 font-semibold text-gray-600">Status Tanggapan</th>
                            <th class="px-6 py-3 text-right font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($kdas as $paper)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-bold text-blue-600">
                                {{ $paper->kode_temuan }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">{{ $paper->schedule->nama_kegiatan }}</div>
                                <div class="text-xs text-gray-500">{{ $paper->schedule->unit->nama_unit }}</div>
                            </td>
                            <td class="px-6 py-4 max-w-xs truncate">
                                {{ Str::limit($paper->uraian_masalah, 60) }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClass = match($paper->status_tanggapan) {
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'responded' => 'bg-blue-100 text-blue-700',
                                        'completed' => 'bg-green-100 text-green-700',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                                    {{ ucfirst($paper->status_tanggapan) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-gray-500 hover:text-blue-600 transition-colors">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                Belum ada Kertas Data Audit yang diterbitkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4 border-t border-gray-100">
                    {{ $kdas->links() }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>
