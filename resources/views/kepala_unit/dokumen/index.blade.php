<!DOCTYPE html>
<html lang="id">
<head>
    <title>Permintaan Dokumen - Kepala Unit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: { 'spi-blue': '#1e4bbc', 'spi-bg': '#f4f6fa' }
                }
            }
        }
    </script>
    <style>
        /* Sembunyikan scrollbar default agar lebih rapi */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden">

    @include('kepala_unit.components.sidebar')

    <main class="ml-[275px] h-full flex flex-col overflow-hidden relative transition-all duration-300">

        <header class="bg-white mx-8 mt-8 px-8 py-5 rounded-[20px] shadow-sm shrink-0 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Permintaan Dokumen</h1>
                <p class="text-xs text-gray-500 mt-1">Daftar dokumen yang diminta oleh Auditor SPI.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right hidden md:block leading-tight">
                    <div class="text-xs font-bold text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-[10px] text-gray-500 font-medium">Kepala Unit</div>
                </div>
                <div class="w-9 h-9 rounded-full bg-spi-blue text-white flex items-center justify-center text-xs shadow-md border-2 border-white ring-1 ring-gray-100">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 no-scrollbar">

            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center shadow-sm">
                <i class="fa-solid fa-check-circle mr-3 text-lg"></i>
                <div>
                    <span class="font-bold">Berhasil!</span> {{ session('success') }}
                </div>
                <button @click="show = false" class="ml-auto text-green-500 hover:text-green-700"><i class="fa-solid fa-xmark"></i></button>
            </div>
            @endif

            <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Nama Dokumen</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Kegiatan Audit</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Deadline</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider text-center">Status</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse($requests as $req)
                            <tr class="hover:bg-blue-50/40 transition-colors group">
                                <td class="px-6 py-4 align-top">
                                    <div class="font-bold text-gray-800 text-sm group-hover:text-spi-blue transition-colors">{{ $req->nama_dokumen }}</div>
                                    @if($req->keterangan)
                                        <div class="text-[11px] text-gray-400 mt-1 italic leading-tight">
                                            <i class="fa-solid fa-circle-info mr-1 text-[9px]"></i>"{{ Str::limit($req->keterangan, 50) }}"
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-top">
                                    <div class="text-xs text-gray-700 font-medium">{{ $req->schedule->nama_kegiatan ?? '-' }}</div>
                                    <span class="inline-block mt-1 px-1.5 py-0.5 rounded text-[9px] bg-gray-100 text-gray-500 border border-gray-200">
                                        {{ $req->schedule->jenis_penugasan ?? '' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 align-top">
                                    <div class="flex items-center gap-2 text-xs font-medium {{ \Carbon\Carbon::parse($req->deadline)->isPast() && $req->status == 'pending' ? 'text-red-500 bg-red-50 px-2 py-1 rounded-lg border border-red-100' : 'text-gray-600' }}">
                                        <i class="fa-regular fa-calendar text-[10px]"></i>
                                        {{ \Carbon\Carbon::parse($req->deadline)->translatedFormat('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-top text-center">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold border uppercase tracking-wide {{ $req->status_badge }}">
                                        {{ $req->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 align-top text-right" x-data="{ showModal: false }">

                                    @if($req->status == 'pending' || $req->status == 'ditolak')
                                        <button @click="showModal = true" class="bg-spi-blue hover:bg-blue-800 text-white px-3 py-1.5 rounded-lg text-xs font-medium shadow-sm shadow-blue-200 transition-all hover:-translate-y-0.5">
                                            <i class="fa-solid fa-cloud-arrow-up mr-1.5"></i>Upload
                                        </button>
                                    @else
                                        <div class="flex justify-end items-center gap-2">
                                            <a href="{{ asset('storage/'.$req->file_path_auditi) }}" target="_blank" class="text-gray-500 hover:text-spi-blue hover:bg-blue-50 transition text-xs border border-gray-200 w-8 h-8 flex items-center justify-center rounded-lg" title="Lihat File">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <button @click="showModal = true" class="text-gray-400 hover:text-yellow-600 hover:bg-yellow-50 transition text-xs border border-gray-200 w-8 h-8 flex items-center justify-center rounded-lg" title="Ganti File">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                        </div>
                                    @endif

                                    <template x-teleport="body">
                                        <div x-show="showModal" class="fixed inset-0 z-999 flex items-center justify-center" style="display: none;">
                                            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" @click="showModal = false" x-transition.opacity></div>

                                            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-0 transform transition-all relative z-10 overflow-hidden"
                                                 x-show="showModal"
                                                 x-transition:enter="transition ease-out duration-300"
                                                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                                 x-transition:leave="transition ease-in duration-200"
                                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                                 x-transition:leave-end="opacity-0 scale-95 translate-y-4">

                                                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                                                    <h3 class="text-base font-bold text-gray-800">Upload Dokumen</h3>
                                                    <button @click="showModal = false" class="text-gray-400 hover:text-red-500 w-8 h-8 rounded-full hover:bg-red-50 flex items-center justify-center transition-colors"><i class="fa-solid fa-xmark"></i></button>
                                                </div>

                                                <div class="p-6">
                                                    <div class="mb-5 bg-blue-50 p-4 rounded-xl border border-blue-100 flex gap-3 items-start">
                                                        <div class="bg-white p-2 rounded-lg text-spi-blue shadow-sm shrink-0">
                                                            <i class="fa-solid fa-file-lines"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-[10px] text-blue-600 font-bold uppercase tracking-wider mb-0.5">Dokumen diminta</p>
                                                            <p class="text-sm font-semibold text-gray-800 leading-tight">{{ $req->nama_dokumen }}</p>
                                                        </div>
                                                    </div>

                                                    <form action="{{ route('kepala_unit.dokumen.upload', $req->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="mb-6">
                                                            <label class="block text-xs font-bold text-gray-700 mb-2">Pilih File</label>
                                                            <div class="relative group">
                                                                <input type="file" name="file_dokumen" required class="block w-full text-sm text-gray-500
                                                                    file:mr-4 file:py-2.5 file:px-4
                                                                    file:rounded-l-lg file:border-0
                                                                    file:text-xs file:font-bold
                                                                    file:bg-spi-blue file:text-white
                                                                    hover:file:bg-blue-800 cursor-pointer border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-spi-blue transition-all h-10 shadow-sm"
                                                                />
                                                            </div>
                                                            <p class="text-[10px] text-gray-400 mt-2 flex items-center">
                                                                <i class="fa-solid fa-circle-info mr-1.5"></i>Format: PDF, Word, Excel (Max 10MB)
                                                            </p>
                                                        </div>

                                                        <div class="flex justify-end gap-3">
                                                            <button type="button" @click="showModal = false" class="px-4 py-2 text-xs font-semibold text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition">Batal</button>
                                                            <button type="submit" class="bg-spi-blue text-white px-6 py-2 rounded-lg text-xs font-bold shadow-lg shadow-blue-500/30 hover:bg-blue-800 hover:shadow-blue-500/50 transition-all transform hover:-translate-y-0.5">
                                                                <i class="fa-solid fa-paper-plane mr-2"></i>Kirim Dokumen
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                            <i class="fa-regular fa-folder-open text-2xl text-gray-300"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-500">Belum ada permintaan dokumen.</p>
                                        <p class="text-xs text-gray-400 mt-1">Permintaan dari auditor akan muncul di sini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($requests->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $requests->links() }}
                </div>
                @endif
            </div>

        </div>
    </main>
</body>
</html>
