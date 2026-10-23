<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Jadwal Reviu</title>
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

        <aside class="w-64 h-full shrink-0 overflow-hidden">
            @include('anggota.components.anggota-sidebar')
        </aside>

        <main class="flex-1 overflow-y-auto p-6">

            <header class="bg-white px-6 py-4 rounded-[20px] shadow-sm mb-6 shrink-0 border border-gray-100 flex justify-between items-center gap-4">

                <div>
                    <h1 class="text-xl font-bold text-gray-800">Jadwal Reviu</h1>
                    <p class="text-xs text-gray-500 mt-1">Agenda kegiatan reviu unit kerja.</p>
                </div>

                @if(Auth::user()->role !== 'kepala_unit')
                <div class="shrink-0">
                    <a href="{{ route('anggota.schedules.create') }}" class="inline-flex items-center bg-spi-blue hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl shadow-sm text-sm font-medium transition-colors">
                        <i class="fa-solid fa-plus mr-2"></i> Buat Jadwal Baru
                    </a>
                </div>
                @endif

            </header>

            <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Kegiatan</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Unit Kerja</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Waktu Pelaksanaan</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Jenis</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($schedules as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $item->nama_kegiatan }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->unit->nama_unit ?? 'Unit Dihapus' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <div>{{ $item->tanggal_mulai->format('d M Y') }}</div>
                                <div class="text-xs text-gray-400">s/d {{ $item->tanggal_selesai->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-xs rounded-full bg-blue-50 text-blue-600 font-medium border border-blue-100">
                                    {{ $item->jenis_penugasan }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClass = match($item->status) {
                                        'Terjadwal' => 'bg-yellow-50 text-yellow-600 border-yellow-100',
                                        'Berjalan' => 'bg-blue-50 text-blue-600 border-blue-100',
                                        'Selesai' => 'bg-green-50 text-green-600 border-green-100',
                                        default => 'bg-gray-50 text-gray-600'
                                    };
                                @endphp
                                <span class="px-2.5 py-1 text-xs rounded-full border {{ $statusClass }} font-medium">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center opacity-60">
                                    <i class="fa-regular fa-folder-open text-2xl mb-2 text-gray-400"></i>
                                    <span>Belum ada jadwal reviu yang tersedia.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $schedules->links() }}
                </div>
            </div>

        </main>
    </div>
</body>
</html>
