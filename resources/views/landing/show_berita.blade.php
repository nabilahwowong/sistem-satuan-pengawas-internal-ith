<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->judul }} - SPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">

    <nav class="bg-blue-900 text-white p-4 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('images/download.png') }}"
                    alt="Logo SPI"
                    class="h-10 w-10 bg-white rounded-full p-1 object-contain shadow-sm"
                    onerror="this.style.display='none'">

                <span class="font-bold text-xl tracking-tight group-hover:text-yellow-400 transition-colors">Halaman Berita SPI ITH</span>
            </a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2"> 

                <article class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

                    @if($article->thumbnail)
                    <div class="w-full h-80 md:h-96 relative group">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-10 group-hover:bg-opacity-0 transition duration-500"></div>
                    </div>
                    @endif

                    <div class="p-6 md:p-10">
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-0.5 rounded uppercase tracking-wide">
                                {{ $article->kategori }}
                            </span>
                            <span class="mx-2">•</span>
                            <span>{{ $article->published_at ? $article->published_at->format('d F Y') : '' }}</span>
                        </div>

                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">
                            {{ $article->judul }}
                        </h1>

                        <div class="flex items-center mb-8 pb-8 border-b border-gray-100">
                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Ditulis oleh: {{ $article->author->name ?? 'Tim SPI' }}</p>
                                <p class="text-xs text-gray-500">Satuan Pengawas Internal</p>
                            </div>
                        </div>

                        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-4">
                            {{-- Gunakan {!! !!} untuk merender HTML dari Summernote/Editor --}}
                            {!! $article->konten !!}
                        </div>

                        <div class="mt-10 pt-6 border-t border-gray-100">
                            <h4 class="text-sm font-bold text-gray-900 mb-3">Bagikan Artikel:</h4>
                            <div class="flex space-x-2">
                                <button class="bg-blue-600 text-white px-3 py-1.5 rounded text-sm hover:bg-blue-700 transition"><i class="fab fa-facebook-f mr-2"></i> Facebook</button>
                                <button class="bg-green-500 text-white px-3 py-1.5 rounded text-sm hover:bg-green-600 transition"><i class="fab fa-whatsapp mr-2"></i> Whatsapp</button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <aside class="lg:col-span-1 space-y-8">

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 border-l-4 border-yellow-500 pl-3">
                        Berita Lainnya
                    </h3>

                    <div class="space-y-4">
                        @foreach($otherArticles as $item)
                        <a href="{{ route('berita.show', $item->slug) }}" class="flex group items-start">
                            <div class="shrink-0 w-20 h-20 bg-gray-200 rounded-md overflow-hidden relative">
                                @if($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" alt="">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <i class="fa-regular fa-image"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-semibold text-gray-800 group-hover:text-blue-600 line-clamp-2 leading-snug transition-colors">
                                    {{ $item->judul }}
                                </h4>
                                <span class="text-xs text-gray-400 mt-1 block items-center">
                                    <i class="fa-regular fa-clock mr-1 text-[10px]"></i>
                                    {{ $item->published_at ? $item->published_at->diffForHumans() : '' }}
                                </span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <div class="bg-blue-900 rounded-xl shadow-sm p-6 text-white text-center">
                    <h3 class="font-bold text-lg mb-2">Butuh Informasi SPI?</h3>
                    <p class="text-blue-100 text-sm mb-4">Hubungi kami untuk pertanyaan terkait pengawasan internal.</p>
                    <button class="bg-yellow-500 text-blue-900 font-bold py-2 px-4 rounded w-full hover:bg-yellow-400 transition transform hover:scale-105">
                        Hubungi Kami
                    </button>
                </div>

            </aside>
        </div>
    </main>
    <footer class="bg-gray-800 text-white py-8 text-center mt-12">
        <p>&copy; 2025 <span class="text-white font-semibold">Satuan Pengawasan Internal</span>. Semua Hak Dilindungi.</p>
    </footer>

</body>
</html>
