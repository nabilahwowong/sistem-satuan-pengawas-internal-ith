<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak | SPI ITH</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

{{-- Body Background --}}
<body class="bg-[#f4f6f9] font-sans text-gray-800 flex flex-col min-h-screen">

    {{-- Navbar --}}
    @include('partials.header')

    {{-- Main Container --}}
    {{-- my-24 = margin atas bawah sekitar 96px (mendekati 100px) --}}
    <main class="grow container mx-auto px-4 my-24">

        {{-- Card Kontak --}}
        <div class="w-full max-w-3xl mx-auto bg-white p-10 rounded-[20px] shadow-xl">

            {{-- Judul Halaman --}}
            {{-- border-l-[6px] = border kiri tebal 6px --}}
            <h1 class="text-3xl font-bold text-[#003366] mb-8 border-l-[6px] border-[#003366] pl-4">
                Kontak
            </h1>

            {{-- Wrapper untuk Box Kontak (Space Y untuk jarak antar box) --}}
            <div class="space-y-4">

                {{-- Box 1: Alamat --}}
                <div class="bg-[#eef3f8] p-5 rounded-[15px]">
                    <h3 class="text-xl font-bold text-[#003366] flex items-center gap-2 mb-2">
                        <i class="bi bi-geo-alt"></i> ALAMAT
                    </h3>
                    <p class="leading-relaxed">
                        Jl. Balaikota No.1, Bumi Harapan, Kec. Bacukiki Bar.,<br>
                        Kota Parepare, Sulawesi Selatan 91122
                    </p>
                </div>

                {{-- Box 2: Email --}}
                <div class="bg-[#eef3f8] p-5 rounded-[15px]">
                    <h3 class="text-xl font-bold text-[#003366] flex items-center gap-2 mb-2">
                        <i class="bi bi-envelope"></i> EMAIL
                    </h3>
                    <p>spi@ith.ac.id</p>
                </div>

                {{-- Box 3: Telepon --}}
                <div class="bg-[#eef3f8] p-5 rounded-[15px]">
                    <h3 class="text-xl font-bold text-[#003366] flex items-center gap-2 mb-2">
                        <i class="bi bi-telephone"></i> TELEPON
                    </h3>
                    <p>(0251) 123456</p>
                </div>

            </div>
        </div>

    </main>

    {{-- Footer --}}
    @include('partials.footer')

</body>
</html>
