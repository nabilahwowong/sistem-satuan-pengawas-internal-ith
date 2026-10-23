<!DOCTYPE html>
<html lang="id">
<head>
    <title>Pedoman Kerja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <div class="flex h-screen overflow-hidden">
        @include('anggota.components.anggota-sidebar')

        <main class="flex-1 overflow-y-auto p-6">
            <h1 class="text-2xl font-bold mb-4">Pedoman Kerja {{ ucfirst($type) }}</h1>

            <div class="flex gap-4 mb-6 border-b">
                <a href="{{ route('anggota.audit.pedoman', ['type' => 'audit']) }}" class="pb-2 {{ $type == 'audit' ? 'border-b-2 border-blue-600 text-blue-600 font-bold' : 'text-gray-500' }}">Audit</a>
                <a href="{{ route('anggota.audit.pedoman', ['type' => 'reviu']) }}" class="pb-2 {{ $type == 'reviu' ? 'border-b-2 border-blue-600 text-blue-600 font-bold' : 'text-gray-500' }}">Reviu</a>
            </div>

            <div class="grid gap-4">
                @forelse($guidelines as $doc)
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                    <h3 class="font-bold text-lg text-gray-800">{{ $doc->judul }}</h3>
                    <p class="text-gray-600 text-sm mt-1">{{ $doc->kategori_label }}</p>
                    @if($doc->file_path)
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="inline-flex items-center gap-2 mt-3 text-sm text-blue-600 hover:underline">
                            <i class="fa-solid fa-file-pdf"></i> Download Dokumen
                        </a>
                    @endif
                </div>
                @empty
                <div class="text-center py-10 text-gray-400">Belum ada pedoman yang diunggah Admin.</div>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>
