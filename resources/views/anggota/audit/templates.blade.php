<!DOCTYPE html>
<html lang="id">
<head>
    <title>Template Dokumen Audit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] } } } }
    </script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <div class="flex h-screen overflow-hidden">

        @include('anggota.components.anggota-sidebar')

        <main class="flex-1 overflow-y-auto p-6">

            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Template Dokumen</h1>
                <p class="text-sm text-gray-500 mt-1">Unduh format baku dokumen kerja audit dan reviu di sini.</p>
            </div>

            <div class="space-y-4">
                @forelse($documents as $doc)
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex flex-col md:flex-row items-start md:items-center justify-between hover:shadow-md transition-shadow group">

                        <div class="flex items-center gap-4 mb-4 md:mb-0">
                            <div class="w-12 h-12 rounded-lg bg-yellow-50 text-yellow-600 flex items-center justify-center shrink-0 group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                                @if(in_array($doc->tipe_file, ['xls', 'xlsx']))
                                    <i class="fa-solid fa-file-excel text-xl"></i>
                                @elseif(in_array($doc->tipe_file, ['doc', 'docx']))
                                    <i class="fa-solid fa-file-word text-xl"></i>
                                @else
                                    <i class="fa-solid fa-file-lines text-xl"></i>
                                @endif
                            </div>

                            <div>
                                <h3 class="font-bold text-gray-800 text-base leading-tight">{{ $doc->judul }}</h3>
                                <div class="flex items-center gap-3 mt-1.5">
                                    <span class="bg-gray-100 text-gray-600 text-[10px] uppercase font-bold px-2 py-0.5 rounded border border-gray-200">
                                        TEMPLATE
                                    </span>
                                    <span class="text-xs text-gray-400 flex items-center">
                                        <i class="fa-regular fa-clock mr-1"></i> {{ $doc->created_at->format('d M Y') }}
                                    </span>
                                </div>
                                @if($doc->keterangan)
                                    <p class="text-xs text-gray-500 mt-1 italic line-clamp-1">"{{ $doc->keterangan }}"</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-3 w-full md:w-auto pl-16 md:pl-0">
                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="flex-1 md:flex-none text-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold px-5 py-2.5 rounded-lg shadow-sm shadow-blue-200 transition-all active:scale-95 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-cloud-arrow-down"></i>
                                <span>Unduh Template</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-sm border border-dashed border-gray-300 p-12 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fa-solid fa-file-circle-question text-gray-300 text-2xl"></i>
                        </div>
                        <h3 class="text-gray-800 font-bold text-lg">Belum Ada Template</h3>
                        <p class="text-gray-500 text-sm mt-1">Admin belum mengunggah template dokumen.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $documents->links() }}
            </div>

        </main>
    </div>
</body>
</html>
