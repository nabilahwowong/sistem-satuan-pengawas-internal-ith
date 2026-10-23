<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer SPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>

    <footer class="bg-blue-900 text-white pt-16 pb-8 border-t-4 border-yellow-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">

                <div class="space-y-4">
                    <h3 class="text-2xl font-bold text-white tracking-wide">
                        Satuan Pengawasan Internal (SPI)
                    </h3>
                    <p class="text-gray-300 text-sm leading-relaxed text-justify">
                        SPI berkomitmen untuk menjaga transparansi, akuntabilitas, dan tata kelola yang baik
                        dalam mendukung tercapainya visi dan misi institusi.
                    </p>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-white mb-6 uppercase tracking-wider border-b-2 border-yellow-500 inline-block pb-1">
                        Tautan Cepat
                    </h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white hover:translate-x-2 transition-transform duration-300 inline-block text-sm">
                                <i class="fa-solid fa-chevron-right text-yellow-500 text-xs mr-2"></i> Beranda
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white hover:translate-x-2 transition-transform duration-300 inline-block text-sm">
                                <i class="fa-solid fa-chevron-right text-yellow-500 text-xs mr-2"></i> Tentang SPI
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white hover:translate-x-2 transition-transform duration-300 inline-block text-sm">
                                <i class="fa-solid fa-chevron-right text-yellow-500 text-xs mr-2"></i> Struktur Organisasi
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white hover:translate-x-2 transition-transform duration-300 inline-block text-sm">
                                <i class="fa-solid fa-chevron-right text-yellow-500 text-xs mr-2"></i> Berita & Artikel
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kontak') }}" class="text-gray-300 hover:text-white hover:translate-x-2 transition-transform duration-300 inline-block text-sm">
                                <i class="fa-solid fa-chevron-right text-yellow-500 text-xs mr-2"></i> Kontak
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-white mb-6 uppercase tracking-wider border-b-2 border-yellow-500 inline-block pb-1">
                        Hubungi Kami
                    </h4>
                    <ul class="space-y-4">
                        <li class="flex items-start text-gray-300 text-sm">
                            <i class="fa-solid fa-location-dot mt-1 mr-3 text-yellow-500 w-5"></i>
                            <span> Jl. Balaikota No.1, Bumi Harapan, Kec. Bacukiki Bar.,<br>
                        Kota Parepare, Sulawesi Selatan 91122</span>
                        </li>
                        <li class="flex items-center text-gray-300 text-sm">
                            <i class="fa-solid fa-envelope mr-3 text-yellow-500 w-5"></i>
                            <a href="mailto:spi@kampus.ac.id" class="hover:text-white transition">spi@ith.ac.id</a>
                        </li>
                        <li class="flex items-center text-gray-300 text-sm">
                            <i class="fa-solid fa-phone mr-3 text-yellow-500 w-5"></i>
                            <span>(0251) 123456</span>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="border-t border-blue-800 mt-12 pt-8 text-center">
                <p class="text-gray-400 text-sm">
                    &copy; 2025 <span class="text-white font-semibold">Satuan Pengawasan Internal</span>. Semua Hak Dilindungi.
                </p>
            </div>
        </div>
    </footer>

</body>
</html>
