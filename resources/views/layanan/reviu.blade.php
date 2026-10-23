<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviu | SPI ITH</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="bg-[#f4f6f9] font-sans antialiased text-[#333]">

    @include('partials.header')

    <main class="w-full max-w-[900px] mx-auto mt-[100px] mb-[120px] bg-white p-10 rounded-[20px] shadow-[0_15px_35px_rgba(0,0,0,0.08)]">

        <h1 class="text-[32px] font-bold text-[#002347] mb-3 border-l-[6px] border-[#003366] pl-3.5">
            Reviu
        </h1>

        <p class="text-[15px] leading-[1.7]">
            Reviu adalah proses penelaahan ulang bukti-bukti suatu kegiatan
            untuk memberikan keyakinan terbatas bahwa kegiatan tersebut telah
            dilaksanakan sesuai ketentuan, standar, atau rencana yang ditetapkan.
        </p>

        <h3 class="text-[20px] font-bold text-[#003366] mt-[30px] mb-2 flex items-center gap-2">
            <i class="bi bi-clipboard-check"></i> Reviu yang dilakukan SPI
        </h3>

        <ol class="list-decimal ml-[30px] text-[15px] leading-[1.7] space-y-1">
            <li>Pelaksanaan Reviu Laporan Keuangan</li>
            <li>Pelaksanaan Reviu RKAKL Indikatif dan Definitif</li>
            <li>Pelaksanaan Reviu Stock Opname Akhir tahun</li>
            <li>Pelaksanaan Reviu LAKIN</li>
            <li>Pelaksanaan Reviu SAKIP</li>
            <li>Pelaksanaan Reviu laporan Serapan Anggaran Tri-Wulan</li>
            <li>Pelaksanaan Reviu Kehadiran</li>
        </ol>

    </main>

    {{-- Footer --}}
    @include('partials.footer')

</body>
</html>
