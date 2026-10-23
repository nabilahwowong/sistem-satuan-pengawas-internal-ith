<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi | SPI ITH</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

    @include('partials.header')


<body class="bg-[#f4f6f9] font-sans antialiased text-[#333]">

    <main class="w-full max-w-[900px] mx-auto mt-[100px] mb-[120px] bg-white p-10 rounded-[20px] shadow-[0_15px_35px_rgba(0,0,0,0.08)]">

        <h1 class="text-[32px] font-extrabold text-[#002347] mb-3">
            Struktur Organisasi
        </h1>

        <div class="h-px w-full bg-[#a19b9b] mb-6"></div>

        <p class="text-[15px] leading-[1.7] mb-8">
            Berikut adalah struktur organisasi Satuan Pengawas Internal (SPI) Institut Teknologi Bacharuddin Jusuf Habibie, yang bertugas memastikan pelaksanaan pengawasan internal di lingkungan institut.
        </p>

        <div class="mb-10 text-center">
            <img src="{{ asset('images/struktur-organisasi-SPI.png') }}"
                 alt="Bagan Struktur Organisasi SPI ITH"
                 class="w-full h-auto rounded-lg border border-gray-200 shadow-sm mx-auto">
            <p class="text-xs text-gray-500 mt-2 italic">Bagan Struktur Organisasi SPI ITH</p>
        </div>

    </main>

    @include('partials.footer')

</body>
</html>
