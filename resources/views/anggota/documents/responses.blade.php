<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Tanggapan - Anggota SPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] } } } }
    </script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar Anggota --}}
        @include('anggota.components.anggota-sidebar')

        <main class="flex-1 overflow-y-auto p-8 relative z-0">

            <div class="mb-6 flex justify-between items-end">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Data Tanggapan</h1>
                    <p class="text-gray-500 text-sm mt-1">Validasi dokumen yang telah dikirimkan oleh Unit Auditi.</p>
                </div>
            </div>

            {{-- Alert Success --}}
            @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center shadow-sm">
                <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
            @endif

            <div class="grid gap-4">
                @forelse($responses as $res)
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex flex-col md:flex-row items-start justify-between hover:shadow-md transition-shadow gap-4">

                    {{-- Bagian Kiri: Info Dokumen --}}
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide">
                                {{ $res->unit->nama_unit ?? 'Unit Tidak Dikenal' }}
                            </span>
                            <span class="text-xs text-gray-400">
                                <i class="fa-regular fa-clock mr-1"></i>
                                Diupload: {{ $res->updated_at->format('d M Y, H:i') }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $res->judul }}</h3>
                        <div class="text-xs text-gray-500 mb-3">
                            <span class="font-medium text-gray-400">Kegiatan:</span> {{ $res->schedule->nama_kegiatan ?? '-' }}
                        </div>

                        {{-- Status Badge --}}
                        <div class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold border uppercase tracking-wide {{ $res->status_badge }}">
                            {{ $res->status }}
                        </div>
                    </div>

                    {{-- Bagian Kanan: Aksi & File --}}
                    <div class="flex flex-col gap-3 items-end w-full md:w-auto">

                        {{-- Tombol Lihat File --}}
                        @if($res->file_path_auditi)
                            <a href="{{ asset('storage/' . $res->file_path_auditi) }}" target="_blank" class="flex items-center justify-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-xs font-bold hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 border border-transparent transition-all w-full md:w-auto">
                                <i class="fa-regular fa-file-pdf text-base"></i> Lihat File
                            </a>
                        @else
                            {{-- Jika file_path_auditi kosong --}}
                            <span class="text-xs text-red-500 font-bold bg-red-50 px-3 py-1 rounded border border-red-100">
                                File Tidak Ditemukan
                            </span>
                        @endif

                        {{-- Tombol Verifikasi (Hanya muncul jika status 'terkirim') --}}
                        @if($res->status == 'terkirim')
                        <div class="flex gap-2 w-full md:w-auto">
                            {{-- Tolak --}}
                            <form action="{{ route('anggota.documents.verify', $res->id) }}" method="POST" class="w-full">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="w-full md:w-auto px-4 py-2 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 text-xs font-bold transition flex items-center justify-center gap-2" title="Tolak Dokumen">
                                    <i class="fa-solid fa-xmark"></i> Tolak
                                </button>
                            </form>

                            {{-- Terima --}}
                            <form action="{{ route('anggota.documents.verify', $res->id) }}" method="POST" class="w-full">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="fulfilled">
                                <button type="submit" class="w-full md:w-auto px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 shadow-sm shadow-green-200 text-xs font-bold transition flex items-center justify-center gap-2" title="Verifikasi Selesai">
                                    <i class="fa-solid fa-check"></i> Terima
                                </button>
                            </form>
                        </div>
                        @endif

                    </div>
                </div>
                @empty
                <div class="text-center py-16 bg-white rounded-xl border border-dashed border-gray-300">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-regular fa-folder-open text-3xl text-gray-300"></i>
                    </div>
                    <h3 class="text-gray-800 font-bold">Belum ada tanggapan</h3>
                    <p class="text-gray-500 text-sm mt-1">Belum ada dokumen yang dikirim oleh Unit Auditi saat ini.</p>
                </div>
                @endforelse

                <div class="mt-6">
                    {{ $responses->links() }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>
