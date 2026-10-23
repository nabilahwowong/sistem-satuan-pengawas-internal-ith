<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring dan Evaluasi | SPI ITH</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="bg-[#f4f6f9] font-sans antialiased text-gray-800">

    @include('partials.header')

    <main class="w-full max-w-[900px] mx-auto mt-24 mb-32 bg-white p-10 rounded-[20px] shadow-[0_15px_35px_rgba(0,0,0,0.08)]">

        <h1 class="text-[32px] font-bold text-[#003366] mb-5 border-l-[6px] border-[#003366] pl-3.5">
            Monitoring dan Evaluasi
        </h1>

        <p class="text-[15px] leading-relaxed text-gray-800">
            Monitoring dan Evaluasi adalah kegiatan
            mengamati kemajuan, mengidentifikasi masalah,
            serta mengevaluasi pencapaian tujuan agar dapat diberikan
            rekomendasi perbaikan untuk kinerja di masa mendatang
        </p>

    </main>

    @include('partials.footer')

</body>
</html>
