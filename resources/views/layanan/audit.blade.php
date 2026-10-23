<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit | SPI ITH</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="bg-[#f4f6f9] font-sans antialiased text-gray-800">

    @include('partials.header')

    <main class="w-full max-w-[900px] mx-auto mt-28 mb-32 bg-white p-10 rounded-[20px] shadow-[0_15px_35px_rgba(0,0,0,0.08)]">

        <h1 class="text-[32px] font-bold text-[#003366] mb-5 border-l-[6px] border-[#003366] pl-4">
            Audit
        </h1>

        <p class="text-[15px] leading-relaxed mb-6 text-gray-800">
            Audit merupakan salah satu bentuk kegiatan pengawasan internal dalam rangka
            memberikan keyakinan yang memadai bahwa kegiatan telah dilaksanakan sesuai
            dengan tolok ukur yang telah ditetapkan secara efektif dan efisien untuk
            kepentingan pimpinan dalam mewujudkan tata kelola yang baik di lingkungan
            Institut Teknologi Habibie.
        </p>

        <h3 class="text-xl font-bold text-[#003366] mt-8 mb-2 flex items-center gap-2">
            <i class="bi bi-check-circle text-[#003366]"></i> Kegiatan Audit oleh SPI ITH
        </h3>
        <ol class="list-decimal ml-8 text-[15px] leading-relaxed text-gray-800 space-y-1">
            <li>Audit Operasional</li>
            <li>Audit Kinerja</li>
            <li>Audit Tujuan Tertentu</li>
        </ol>

        <h3 class="text-xl font-bold text-[#003366] mt-8 mb-2 flex items-center gap-2">
            <i class="bi bi-clipboard-check text-[#003366]"></i> Ruang Lingkup Pengawasan Non Akademik
        </h3>
        <ol class="list-decimal ml-8 text-[15px] leading-relaxed text-gray-800 space-y-1">
            <li>Pengawasan Keuangan</li>
            <li>Pengawasan Aset</li>
            <li>Pengawasan Sumber Daya Manusia</li>
            <li>Pengawasan Sistem dan Teknologi Informasi</li>
        </ol>

    </main>

    @include('partials.footer')

</body>
</html>
