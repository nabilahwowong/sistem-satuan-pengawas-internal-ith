<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi dan Misi | SPI ITH</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

@include('partials.header')

<body class="bg-[#f4f6f9] font-sans antialiased text-[#333]">

    <main class="w-full max-w-[900px] mx-auto mt-[120px] mb-[120px] bg-white p-10 rounded-[30px] shadow-[0_15px_35px_rgba(0,0,0,0.08)]">

        <h1 class="text-[32px] font-extrabold text-[#003366] mb-5">
            Visi dan Misi
        </h1>

        <div class="h-px w-full bg-[#a19b9b] opacity-75 mb-6"></div>

        <h3 class="text-[20px] font-bold text-[#003366] mt-[30px] mb-2 flex items-center gap-2">
            <i class="bi bi-check-circle"></i> Visi
        </h3>

        <p class="text-[15px] leading-[1.7]">
            Menjadi unit pengawasan internal yang profesional,
            independen, dan berkontribusi nyata dalam
            terwujudnya Good University Governance di ITH.
        </p>

        <h3 class="text-[20px] font-bold text-[#003366] mt-[30px] mb-2 flex items-center gap-2">
            <i class="bi bi-clipboard-check"></i> Misi
        </h3>

        <ol class="list-decimal ml-6 text-[15px] leading-[1.7] space-y-1">
            <li>Melaksanakan pengawasan internal yang efektif, efisien, dan akuntabel.</li>
            <li>Menyediakan informasi dan rekomendasi yang berguna bagi pimpinan dalam peningkatan tata kelola.</li>
            <li>Mendorong tindak lanjut perbaikan berdasarkan temuan pengawasan.</li>
        </ol>

    </main>

    @include('partials.footer')

</body>
</html>
