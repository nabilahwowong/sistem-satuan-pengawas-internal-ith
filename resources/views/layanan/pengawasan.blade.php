<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengawasan | SPI ITH</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="bg-[#f4f6f9] font-sans antialiased text-[#333]">

    @include('partials.header')

    <main class="w-full max-w-[900px] mx-auto mt-[100px] mb-[120px] bg-white p-10 rounded-[20px] shadow-[0_15px_35px_rgba(0,0,0,0.08)]">

        <h1 class="text-[32px] font-bold text-[#003366] mb-5 border-l-[6px] border-[#003366] pl-3.5">
            Pengawasan
        </h1>

        <p class="text-[15px] leading-[1.7]">
            Pengawasan adalah proses audit, evaluasi, dan pemantauan
            untuk memastikan kegiatan organisasi berjalan efektif, efisien,
            dan sesuai dengan peraturan serta tujuan yang ditetapkan.
        </p>

    </main>

    @include('partials.footer')

</body>
</html>
