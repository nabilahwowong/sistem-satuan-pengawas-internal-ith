<!DOCTYPE html>
<html lang="id">
<head>
    <title>Cetak {{ $finding->no_referensi }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .page { shadow: none; border: none; margin: 0; padding: 0; }
        }
    </style>
</head>
<body class="bg-gray-100 p-8 font-serif text-gray-900">

    <div class="max-w-[21cm] mx-auto mb-4 text-right no-print flex justify-between items-center">
        <a href="{{ route('admin.audit.index') }}" class="text-gray-500 text-sm underline">< Kembali</a>
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 text-sm font-sans">
            <i class="fa-solid fa-print mr-2"></i> Cetak / PDF
        </button>
    </div>

    <div class="page max-w-[21cm] min-h-[29.7cm] mx-auto bg-white p-[2cm] shadow-xl relative">

        <div class="border-b-2 border-black pb-4 mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold uppercase tracking-wider">Satuan Pengawas Internal</h1>
                <p class="text-sm">Institut Teknologi B.J. Habibie</p>
            </div>
            <div class="text-right">
                <h2 class="text-lg font-bold text-gray-600">KERTAS KERJA AUDIT</h2>
                <p class="text-xs font-mono">No: {{ $finding->no_referensi }}</p>
            </div>
        </div>

        <table class="w-full mb-6 text-sm">
            <tr><td class="w-32 font-bold py-1">Unit</td><td class="py-1">: {{ $finding->unit->nama_unit }}</td></tr>
            <tr><td class="font-bold py-1">Auditor</td><td class="py-1">: {{ $finding->auditor->name }}</td></tr>
            <tr><td class="font-bold py-1">Tanggal</td><td class="py-1">: {{ $finding->created_at->format('d F Y') }}</td></tr>
        </table>

        <div class="bg-gray-100 p-2 border border-gray-300 font-bold text-center mb-6 uppercase">
            {{ $finding->judul }}
        </div>

        <div class="space-y-6 text-justify leading-relaxed text-sm">
            <div><h3 class="font-bold border-b border-gray-400 mb-1 inline-block">1. KONDISI</h3><p class="whitespace-pre-line">{{ $finding->kondisi }}</p></div>
            <div><h3 class="font-bold border-b border-gray-400 mb-1 inline-block">2. KRITERIA</h3><p class="whitespace-pre-line">{{ $finding->kriteria }}</p></div>
            <div><h3 class="font-bold border-b border-gray-400 mb-1 inline-block">3. SEBAB</h3><p class="whitespace-pre-line">{{ $finding->sebab }}</p></div>
            <div><h3 class="font-bold border-b border-gray-400 mb-1 inline-block">4. AKIBAT</h3><p class="whitespace-pre-line">{{ $finding->akibat }}</p></div>
            <div class="bg-blue-50 p-4 border border-blue-100 rounded">
                <h3 class="font-bold text-blue-800 mb-1">5. REKOMENDASI</h3>
                <p class="whitespace-pre-line font-medium">{{ $finding->rekomendasi }}</p>
            </div>
        </div>

        @if($finding->file_path)
        <div class="mt-8 pt-4 border-t border-gray-300 no-print">
            <h3 class="font-bold text-gray-700 mb-2 text-sm">Lampiran Digital:</h3>
            <a href="{{ asset('storage/audit_files/' . $finding->file_path) }}" target="_blank" class="inline-flex items-center gap-2 text-blue-600 hover:underline text-sm">
                <i class="fa-solid fa-paperclip"></i> Download Lampiran ({{ $finding->tipe_file }})
            </a>
        </div>
        @endif

        <div class="mt-16 flex justify-end">
            <div class="text-center w-48">
                <p class="mb-16 text-sm">Parepare, {{ date('d M Y') }}<br>Auditor,</p>
                <p class="font-bold underline text-sm">{{ $finding->auditor->name }}</p>
                <p class="text-xs">NIP. {{ $finding->auditor->nip }}</p>
            </div>
        </div>
    </div>
</body>
</html>
