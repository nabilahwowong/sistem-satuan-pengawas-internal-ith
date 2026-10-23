<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $content->title }} | SPI ITH</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* CSS ini memastikan teks yang diinput dari CMS (enter, list) tetap rapi sesuai formatmu */
        .content-area p { margin-bottom: 1.5rem; line-height: 1.7; font-size: 15px; color: #333; }
        .content-area h1, .content-area h2, .content-area h3 { color: #002347; font-weight: 800; margin-top: 2rem; margin-bottom: 1rem; }
        .content-area ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.5rem; }
        .content-area ol { list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 1.5rem; }
        .content-area strong { font-weight: 700; color: #002347; }
    </style>
</head>

<body class="bg-[#f4f6f9] font-sans antialiased text-[#333]">

    {{-- Panggil Header Kamu --}}
    @include('partials.header')

    <main class="w-full max-w-[900px] mx-auto mt-[100px] mb-[120px] bg-white p-10 rounded-[20px] shadow-[0_15px_35px_rgba(0,0,0,0.08)]">

        {{-- 1. Judul --}}
        <h1 class="text-[32px] font-extrabold text-[#002347] mb-3">
            {{ $content->title }}
        </h1>

        {{-- 2. Garis Pemisah --}}
        <div class="h-px w-full bg-[#a19b9b] mb-6"></div>

        {{-- Opsional: Badge Kategori & Waktu Update agar terlihat profesional --}}
        <div class="flex items-center gap-2 mb-8 text-sm text-gray-500 font-medium">
            <span class="bg-blue-50 text-[#002347] px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest border border-blue-100">
                {{ $content->category }}
            </span>
            <span class="ml-2 text-xs">Diperbarui {{ $content->updated_at->diffForHumans() }}</span>
        </div>

        {{-- 3. Gambar (Hanya muncul jika anggota mengunggah gambar di CMS) --}}
        @if($content->image)
        <div class="mb-10 text-center">
            <img src="{{ asset('storage/' . $content->image) }}"
                 alt="Gambar {{ $content->title }}"
                 class="w-full h-auto rounded-lg border border-gray-200 shadow-sm mx-auto object-cover max-h-[500px]">
            <p class="text-xs text-gray-500 mt-2 italic">Ilustrasi: {{ $content->title }}</p>
        </div>
        @endif

        {{-- 4. Isi Konten Teks dari Database --}}
        <div class="content-area text-[15px] leading-[1.7] text-justify">
            {!! $content->content !!}
        </div>

    </main>

    {{-- Panggil Footer Kamu --}}
    @include('partials.footer') {{-- Ubah menjadi 'partials.footer' jika file-nya ada di dalam folder partials --}}

</body>
</html>
