<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPI Content</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>

<main class="w-full pt-20">
        <div class="relative w-full h-[500px] md:h-[600px] overflow-hidden group">

            <div id="slider-track" class="flex transition-transform duration-700 ease-in-out h-full z-0">
                <div class="w-full h-full shrink-0 relative">
                    <img src="{{ asset('images/WhatsApp Image 2025-10-26 at 21.03.11_d9f2e37e.jpg') }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40"></div>
                </div>
                <div class="w-full h-full shrink-0 relative">
                    <img src="{{ asset('images/Institut-Teknologi-Habibie-atau-ITH-Parepare-3949162294_67d4f6254b8f2.jpg') }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40"></div>
                </div>
                <div class="w-full h-full shrink-0 relative">
                    <img src="{{ asset('images/WhatsApp Image 2025-11-17 at 11.40.45_beedd39d.jpg') }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40"></div>
                </div>
            </div>

            <div class="absolute inset-0 z-20 flex items-center pl-8 md:pl-20 pointer-events-none">
                <div class="max-w-3xl text-white pointer-events-auto">
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6 drop-shadow-lg">
                        Transparansi & <br>
                        Akuntabilitas Melalui <br>
                        Pengawasan Internal
                    </h1>

                </div>
            </div>

            <button id="prevBtn" class="absolute top-1/2 left-4 z-30 transform -translate-y-1/2 bg-white/20 hover:bg-white/50 text-white p-3 rounded-full focus:outline-none transition backdrop-blur-sm shadow-lg hidden md:block">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button id="nextBtn" class="absolute top-1/2 right-4 z-30 transform -translate-y-1/2 bg-white/20 hover:bg-white/50 text-white p-3 rounded-full focus:outline-none transition backdrop-blur-sm shadow-lg hidden md:block">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </main>

    <script>
        const track = document.getElementById('slider-track');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        // Pastikan elemen ada sebelum dijalankan
        if (track) {
            const slides = track.children;
            const totalSlides = slides.length;
            let currentIndex = 0;

            function updateSlider() {
                track.style.transform = `translateX(-${currentIndex * 100}%)`;
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateSlider();
            }

            function prevSlide() {
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                updateSlider();
            }

            if(nextBtn) {
                nextBtn.addEventListener('click', () => { nextSlide(); resetTimer(); });
            }
            if(prevBtn) {
                prevBtn.addEventListener('click', () => { prevSlide(); resetTimer(); });
            }

            // Auto Slide 5 Detik
            let slideInterval = setInterval(nextSlide, 5000);

            function resetTimer() {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, 5000);
            }

            // Inisialisasi awal
            updateSlider();
        }
    </script>



<body class="bg-gray-50 font-sans antialiased">

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900">Tentang SPI</h2>
                <div class="w-20 h-1 bg-yellow-500 mx-auto mt-2 rounded"></div> </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 border-t-4 border-blue-900 text-center">
                    <div class="w-14 h-14 bg-blue-100 text-blue-900 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Misi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        SPI bertugas melaksanakan pengawasan independen dan memberikan rekomendasi perbaikan untuk mewujudkan tata kelola yang transparan, akuntabel, dan berintegritas.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 border-t-4 border-blue-900 text-center">
                    <div class="w-14 h-14 bg-blue-100 text-blue-900 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Visi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Mewujudkan sistem pengawasan internal yang profesional, transparan, dan akuntabel untuk mendukung tata kelola yang baik (good governance) di lingkungan institusi.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 border-t-4 border-blue-900 text-center">
                    <div class="w-14 h-14 bg-blue-100 text-blue-900 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                        <i class="fa-solid fa-gears"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Fungsi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        SPI berfungsi melakukan audit internal, evaluasi kinerja, serta memastikan kepatuhan aturan guna mencegah penyimpangan dan meningkatkan kualitas pengelolaan institusi.
                    </p>
                </div>

            </div>
        </div>
    </section>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <span class="text-blue-600 font-semibold tracking-wider uppercase text-sm">Informasi Terkini</span>
            <h2 class="mt-2 text-3xl md:text-4xl font-extrabold text-gray-900">Kabar & Artikel SPI</h2>
            <div class="w-24 h-1.5 bg-yellow-500 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            @forelse($articles as $article)
            <article class="flex flex-col bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden group">

                <div class="relative h-56 overflow-hidden">
                    <a href="{{ route('berita.show', $article->slug) }}" class="block w-full h-full">
                        @if($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                 alt="{{ $article->judul }}"
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-blue-50 flex items-center justify-center text-blue-200">
                                <i class="fa-regular fa-image text-5xl"></i>
                            </div>
                        @endif

                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-blue-600 text-white text-xs font-bold rounded-full shadow-md">
                                {{ $article->kategori ?? 'Umum' }}
                            </span>
                        </div>
                    </a>
                </div>

                <div class="flex-1 p-6 flex flex-col">
                    <div class="flex items-center text-xs text-gray-500 mb-3 space-x-4">
                        <div class="flex items-center">
                            <i class="fa-regular fa-calendar mr-2 text-yellow-500"></i>
                            {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                        </div>
                        <div class="flex items-center">
                            <i class="fa-regular fa-user mr-2 text-yellow-500"></i>
                            {{ $article->author->name ?? 'Admin' }}
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3 leading-snug group-hover:text-blue-700 transition-colors">
                        <a href="{{ route('berita.show', $article->slug) }}">
                            {{ $article->judul }}
                        </a>
                    </h3>

                    <p class="text-gray-600 text-sm line-clamp-3 mb-6">
                        {{ Str::limit(strip_tags($article->konten), 100) }}
                    </p>

                    <div class="mt-auto border-t border-gray-100 pt-4 flex items-center justify-between">
                        <a href="{{ route('berita.show', $article->slug) }}" class="text-blue-700 font-semibold text-sm group-hover:translate-x-2 transition-transform duration-300 flex items-center">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500">Belum ada berita yang dipublikasikan.</p>
            </div>
            @endforelse

        </div>
    </div>
</section>

</body>
</html>
