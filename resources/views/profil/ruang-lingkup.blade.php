
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Lingkup | SPI ITH</title>

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
                Ruang lingkup
            </h1>

            <p class="text-[14.5px] md:text-[15.5px] text-black max-w-[760px] leading-[1.7] mb-[26px]">
                Ruang lingkup kegiatan yang dilakukan Satuan Pengawas Internal ITH
                untuk tahun 2022 adalah sebagai berikut:
            </p>

            <div class="h-px w-full bg-linear-to-r from-black mb-6 opacity-25"></div>

            <ol class="list-none mt-2.5 space-y-3.5">

                <li class="relative pl-9 md:pl-[42px] text-[15px] md:text-[16px] text-black leading-[1.8]">
                    <span class="absolute left-0 top-0 font-bold text-[#003366]">1.</span>
                    Pengawasan terhadap kebijakan dan program.
                </li>

                <li class="relative pl-9 md:pl-[42px] text-[15px] md:text-[16px] text-black leading-[1.8]">
                    <span class="absolute left-0 top-0 font-bold text-[#003366]">2.</span>
                    Pengawasan terhadap pengelolaan keuangan.
                </li>

                <li class="relative pl-9 md:pl-[42px] text-[15px] md:text-[16px] text-black leading-[1.8]">
                    <span class="absolute left-0 top-0 font-bold text-[#003366]">3.</span>
                    Pengawasan terhadap pengelolaan Barang Milik Negara (BMN).
                </li>

            </ol>
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
