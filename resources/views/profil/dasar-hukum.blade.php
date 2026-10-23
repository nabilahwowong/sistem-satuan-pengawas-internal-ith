<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasar Hukum | SPI ITH</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&display=swap" rel="stylesheet">
</head>

<body class="bg-[#f4f6f9] font-['Inter',sans-serif] antialiased">

    @include('partials.header')

    <main class="max-w-[980px] mx-auto mt-[100px] md:mt-[120px] mb-[130px] p-[32px_22px] md:p-[40px_40px_50px] bg-white rounded-[20px] md:rounded-[30px] shadow-[0_12px_38px_rgba(0,0,0,0.06)] relative overflow-hidden">

        <div class="absolute inset-0 bg-white opacity-90 pointer-events-none"></div>

        <div class="relative z-10">

            <div class="page-label"></div>

            <h1 class="text-[26px] md:text-[32px] font-extrabold text-[#002347] mb-3">
                Dasar Hukum
            </h1>

            <p class="text-[14.5px] md:text-[15.5px] text-black max-w-[760px] leading-[1.7]">
                Halaman ini memuat landasan hukum yang menjadi acuan dalam pembentukan serta
                penyelenggaraan Satuan Pengawas Internal (SPI) di Institut Teknologi Bacharuddin Jusuf Habibie,
                sehingga setiap aktivitas pengawasan memiliki dasar yang jelas dan dapat dipertanggungjawabkan.
            </p>

            <div class="h-px w-full bg-gray-300 my-8"></div>

            <ol class="flex flex-col gap-y-4">

                <li class="flex items-start text-[15px] md:text-[16px] text-black leading-[1.8]">
                    <span class="font-bold text-[#003366] w-8 shrink-0">1.</span>
                    <span>Undang-Undang Nomor 17 Tahun 2003 tentang Keuangan Negara.</span>
                </li>

                <li class="flex items-start text-[15px] md:text-[16px] text-black leading-[1.8]">
                    <span class="font-bold text-[#003366] w-8 shrink-0">2.</span>
                    <span>Undang-Undang Nomor 1 Tahun 2004 tentang Perbendaharaan Negara.</span>
                </li>

                <li class="flex items-start text-[15px] md:text-[16px] text-black leading-[1.8]">
                    <span class="font-bold text-[#003366] w-8 shrink-0">3.</span>
                    <span>Undang-Undang Nomor 15 Tahun 2004 tentang Pemeriksaan, Pengelolaan dan Tanggung Jawab Keuangan Negara.</span>
                </li>

                <li class="flex items-start text-[15px] md:text-[16px] text-black leading-[1.8]">
                    <span class="font-bold text-[#003366] w-8 shrink-0">4.</span>
                    <span>Undang-Undang Republik Indonesia Nomor 5 Tahun 2014 Tentang Aparatur Sipil Negara.</span>
                </li>

                <li class="flex items-start text-[15px] md:text-[16px] text-black leading-[1.8]">
                    <span class="font-bold text-[#003366] w-8 shrink-0">5.</span>
                    <span>Peraturan Pemerintah Nomor 60 Tahun 2008 Tentang Sistem Pengendalian Intern Pemerintah.</span>
                </li>

                <li class="flex items-start text-[15px] md:text-[16px] text-black leading-[1.8]">
                    <span class="font-bold text-[#003366] w-8 shrink-0">6.</span>
                    <span>Peraturan Presiden Nomor 72 tahun 2019 tentang Kementerian Pendidikan dan Kebudayaan.</span>
                </li>

                <li class="flex items-start text-[15px] md:text-[16px] text-black leading-[1.8]">
                    <span class="font-bold text-[#003366] w-8 shrink-0">7.</span>
                    <span>Peraturan Menteri Pendidikan dan Kebudayaan Nomor 22 Tahun 2017 Tentang Satuan Pengawasan Intern.</span>
                </li>

                <li class="flex items-start text-[15px] md:text-[16px] text-black leading-[1.8]">
                    <span class="font-bold text-[#003366] w-8 shrink-0">8.</span>
                    <span>Peraturan Menteri Pendidikan dan Kebudayaan Nomor 45 Tahun 2019 Tentang Organisasi dan Tata Kerja Kementerian Pendidikan Dan Kebudayaan.</span>
                </li>

                <li class="flex items-start text-[15px] md:text-[16px] text-black leading-[1.8]">
                    <span class="font-bold text-[#003366] w-8 shrink-0">9.</span>
                    <span>Peraturan Menteri Pendidikan dan Kebudayaan Nomor 47 Tahun 2018 tentang Rincian Tugas Unit Kerja di lingkungan Inspektorat Jenderal.</span>
                </li>

                <li class="flex items-start text-[15px] md:text-[16px] text-black leading-[1.8]">
                    <span class="font-bold text-[#003366] w-8 shrink-0">10.</span>
                    <span>Peraturan Inspektur Jenderal Nomor 3205/F.Fl/HK/2019 tentang Pedoman Teknis Pengawasan Bagi Satuan Pengawasan Intern di Lingkungan Kementerian Pendidikan dan Kebudayaan.</span>
                </li>

                <li class="flex items-start text-[15px] md:text-[16px] text-black leading-[1.8]">
                    <span class="font-bold text-[#003366] w-8 shrink-0">11.</span>
                    <span>Surat Keputusan Rektor ITH Nomor <strong>35/IT13.A.SK/SU.01.00/2022</strong> tentang Pembentukan Satuan Pengawas Internal dan Susunan Keanggotaan Satuan Pengawas Internal Institut Teknologi Bacharuddin Jusuf Habibie Periode Tahun 2022 - 2025.</span>
                </li>

            </ol>
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
