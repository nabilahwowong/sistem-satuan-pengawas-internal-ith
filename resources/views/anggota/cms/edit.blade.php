<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Konten Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tambahkan CSS dan JS Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

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

    <style>
        /* Sembunyikan tombol attach file bawaan Trix agar tidak rancu dengan upload foto utamamu */
        trix-toolbar [data-trix-button-group="file-tools"] { display: none; }

        /* Modifikasi tampilan Trix agar mirip dengan form Tailwind kamu */
        trix-editor {
            min-height: 300px !important;
            border-radius: 1rem !important;
            border-color: #e5e7eb !important;
            background-color: #f9fafb !important;
            padding: 1rem !important;
        }
        trix-editor:focus-within {
            outline: none !important;
            border-color: #60a5fa !important;
            box-shadow: 0 0 0 4px #eff6ff !important;
            background-color: #ffffff !important;
        }
        /* Rapikan jarak heading di dalam editor */
        trix-editor h1 { font-size: 1.5rem; font-weight: bold; margin-bottom: 0.5rem; }
    </style>
</head>

<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden">
    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar --}}
        <aside class="w-64 h-full shrink-0 overflow-hidden">
            @include('anggota.components.anggota-sidebar')
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 overflow-y-auto p-8 relative z-0">

            {{-- Header Konten Edit --}}
            <div class="mb-8 flex items-center gap-4">
                <a href="{{ route('anggota.cms.index') }}" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-blue-50 hover:text-blue-600 transition shadow-sm hover:shadow">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Edit Konten</h1>
                    <p class="text-sm text-gray-500 mt-1">Halaman: <span class="font-bold text-blue-600">{{ $content->title }}</span></p>
                </div>
            </div>

            {{-- Form Card --}}
            <div class="bg-white p-8 rounded-[30px] shadow-sm border border-gray-100 max-w-5xl">
                <form action="{{ route('anggota.cms.update', $content->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                        {{-- Kolom Kiri: Input Teks --}}
                        <div class="lg:col-span-2 space-y-6">
                            <div>
                                <label class="block text-[11px] font-bold text-gray-400 mb-2 uppercase tracking-widest">Judul Menu</label>
                                <input type="text" name="title" value="{{ old('title', $content->title) }}" class="w-full border border-gray-200 rounded-2xl p-4 text-gray-800 font-medium focus:ring-4 focus:ring-blue-50 focus:border-blue-400 outline-none transition bg-gray-50/50" required>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-gray-400 mb-2 uppercase tracking-widest">Isi Konten</label>

                                {{-- PENGGUNAAN TRIX EDITOR --}}
                                <input id="content_input" type="hidden" name="content" value="{{ old('content', $content->content) }}">
                                <trix-editor input="content_input" class="text-gray-800 leading-relaxed"></trix-editor>

                            </div>
                        </div>

                        {{-- Kolom Kanan: Upload Gambar (AlpineJS Preview) --}}
                        <div x-data="imageViewer('{{ $content->image ? asset('storage/'.$content->image) : '' }}')">
                            <label class="block text-[11px] font-bold text-gray-400 mb-2 uppercase tracking-widest">Foto Representasi</label>

                            {{-- Area Preview --}}
                            <div class="w-full aspect-square bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden relative mb-4 group hover:border-blue-300 transition-colors">
                                <template x-if="imageUrl">
                                    <img :src="imageUrl" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!imageUrl">
                                    <div class="text-center p-6">
                                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm mx-auto mb-3 text-gray-300">
                                            <i class="fa-regular fa-image text-2xl"></i>
                                        </div>
                                        <p class="text-xs font-medium text-gray-500">Belum ada foto</p>
                                    </div>
                                </template>
                            </div>

                            {{-- Tombol File --}}
                            <div class="relative">
                                <input type="file" name="image" accept="image/jpeg, image/png, image/jpg" @change="fileChosen" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 transition cursor-pointer bg-gray-50 rounded-xl border border-gray-100">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-3 leading-relaxed">Pilih gambar resolusi tinggi agar tidak pecah. Format: JPG, PNG. Maks: 2MB.</p>
                        </div>

                    </div>

                    {{-- Footer Form --}}
                    <div class="flex justify-end gap-3 pt-8 mt-8 border-t border-gray-50">
                        <a href="{{ route('anggota.cms.index') }}" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-500 hover:bg-gray-100 transition">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 transition-all hover:-translate-y-0.5">
                            <i class="fa-solid fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </main>
    </div>

    {{-- Script AlpineJS --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('imageViewer', (initialUrl) => ({
                imageUrl: initialUrl,
                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src)
                },
                fileToDataUrl(event, callback) {
                    if (! event.target.files.length) return
                    let file = event.target.files[0],
                        reader = new FileReader()
                    reader.readAsDataURL(file)
                    reader.onload = e => callback(e.target.result)
                }
            }))
        })
    </script>
</body>
</html>
