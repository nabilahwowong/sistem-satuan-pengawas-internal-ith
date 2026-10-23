<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Hasil Audit (LHA)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <div class="flex h-screen overflow-hidden">
        @include('anggota.components.anggota-sidebar')

        <main class="flex-1 overflow-y-auto p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Laporan Hasil Audit (LHA)</h1>
                <a href="{{ route('anggota.reports.create', ['jenis' => 'LHA']) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700">
                    <i class="fa-solid fa-upload mr-2"></i> Unggah LHA
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3">No. Laporan</th>
                            <th class="px-6 py-3">Judul & Unit</th>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3 text-right">File</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($reports as $rpt)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-bold text-gray-600">{{ $rpt->nomor_laporan }}</td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $rpt->judul_laporan }}</div>
                                    <div class="text-xs text-blue-600">{{ $rpt->unit->nama_unit ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">{{ $rpt->tanggal_laporan->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ asset('storage/' . $rpt->file_path) }}" target="_blank" class="text-red-600 hover:text-red-800 font-bold text-xs border border-red-200 bg-red-50 px-3 py-1 rounded">
                                    <i class="fa-solid fa-file-pdf mr-1"></i> PDF
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada LHA diunggah.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
