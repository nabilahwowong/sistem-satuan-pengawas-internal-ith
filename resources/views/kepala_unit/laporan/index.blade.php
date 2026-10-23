<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Unit - Kepala Unit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] }, colors: { 'spi-blue': '#1e4bbc', 'spi-bg': '#f4f6fa' } } } }
    </script>
</head>
<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden">

    @include('kepala_unit.components.sidebar')

    <main class="ml-[275px] h-full flex flex-col overflow-hidden relative transition-all duration-300">

        <header class="bg-white mx-8 mt-8 px-8 py-5 rounded-[20px] shadow-sm shrink-0 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Laporan Unit</h1>
                <p class="text-xs text-gray-500 mt-1">Arsip laporan hasil audit yang diterima dari SPI.</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</span>
                <div class="w-9 h-9 rounded-full bg-spi-blue text-white flex items-center justify-center text-xs shadow-md">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase">Judul Laporan</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase">Kegiatan Audit</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase">Auditor Pengirim</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase text-center">Tanggal</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase text-right">File</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($reports as $report)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $report->judul }}</div>
                                @if($report->keterangan)
                                <div class="text-xs text-gray-500 mt-1 italic">"{{ Str::limit($report->keterangan, 50) }}"</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-xs font-medium text-spi-blue">{{ $report->schedule->nama_kegiatan ?? '-' }}</div>
                                <div class="text-[10px] text-gray-400">{{ $report->schedule->no_surat ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-600">
                                        {{ substr($report->auditor->name ?? 'A', 0, 1) }}
                                    </div>
                                    <span class="text-xs text-gray-600">{{ $report->auditor->name ?? 'Auditor' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center text-xs text-gray-500">
                                {{ $report->tanggal_laporan ? $report->tanggal_laporan->format('d M Y') : '-' }}
                                </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ asset('storage/'.$report->file_path) }}" target="_blank" class="inline-flex items-center gap-2 bg-green-50 text-green-700 px-3 py-1.5 rounded-lg border border-green-200 text-xs font-bold hover:bg-green-100 transition">
                                    <i class="fa-solid fa-download"></i> Unduh
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <i class="fa-regular fa-file-lines text-3xl mb-2"></i>
                                <p class="text-sm">Belum ada laporan yang diterima.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </main>
</body>
</html>
