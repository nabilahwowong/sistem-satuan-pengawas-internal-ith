<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: { sans: ['Poppins', 'inter', 'sans-serif'] },
                colors: {
                    'spi-blue': '#1e4bbc',
                    'spi-dark': '#1e3a8a',
                    'spi-bg': '#f4f6fa',
                }
            }
        }
    }
</script>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden flex">

<aside class="w-60 h-full p-4 shrink-0 z-50">
    <div class="bg-spi-blue text-white w-full h-full rounded-[20px] flex flex-col shadow-2xl overflow-hidden">

        <div class="flex flex-col items-center py-5 border-b border-white/10 shrink-0">
            <div class="bg-white p-1.5 rounded-full w-[50px] h-[50px] flex items-center justify-center shadow-md mb-2">
                 <img src="{{ asset('images/download.png') }}" onerror="this.src='https://ui-avatars.com/api/?name=Anggota+SPI&background=random&color=fff'" class="w-full h-full object-contain rounded-full">
            </div>
            <h3 class="font-bold text-sm tracking-wide uppercase text-center leading-tight">ANGGOTA SPI</h3>
            <span class="text-[10px] text-blue-100 bg-white/10 px-2 py-0.5 rounded mt-1">Auditor</span>
        </div>

        <nav class="flex-1 overflow-y-auto py-3 px-2 space-y-1 no-scrollbar">

    <a href="{{ route('anggota.dashboard') }}"
       class="flex items-center px-3 py-2 rounded-lg transition-colors group {{ request()->routeIs('anggota.dashboard') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'hover:bg-white/10 text-white/80' }}">
        <div class="w-5 text-center"><i class="fa-solid fa-gauge-high text-sm"></i></div>
        <span class="ml-2.5 text-xs">Dashboard</span>
    </a>

    <div x-data="{ open: {{ request()->routeIs('anggota.schedules.*') ? 'true' : 'false' }} }">
        <button @click="open = !open"
                class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition-colors group text-left {{ request()->routeIs('anggota.schedules.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">
            <div class="flex items-center">
                <div class="w-5 text-center"><i class="fa-solid fa-calendar-check text-sm"></i></div>
                <span class="ml-2.5 text-xs font-medium">Jadwal Reviu</span>
            </div>
            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="{'rotate-180': open}"></i>
        </button>
        <div x-show="open" class="pl-9 pr-2 py-1 space-y-1" x-cloak>
            <a href="{{ route('anggota.schedules.create') }}" class="block px-2 py-1.5 rounded-md text-[11px] {{ request()->routeIs('anggota.schedules.create') ? 'text-white bg-white/20 font-bold' : 'text-white/70 hover:text-white' }}">Buat Jadwal Reviu</a>
            <a href="{{ route('anggota.schedules.index') }}" class="block px-2 py-1.5 rounded-md text-[11px] {{ request()->routeIs('anggota.schedules.index') ? 'text-white bg-white/20 font-bold' : 'text-white/70 hover:text-white' }}">Data Jadwal Reviu</a>
        </div>
    </div>

    <div x-data="{ open: {{ request()->routeIs('anggota.audit.*') ? 'true' : 'false' }} }">
        <button @click="open = !open"
                class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition-colors group text-left {{ request()->routeIs('anggota.audit.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">
            <div class="flex items-center">
                <div class="w-5 text-center"><i class="fa-solid fa-briefcase text-sm"></i></div>
                <span class="ml-2.5 text-xs font-medium">Pekerjaan Audit</span>
            </div>
            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="{'rotate-180': open}"></i>
        </button>
        <div x-show="open" class="pl-9 pr-2 py-1 space-y-1" x-cloak>
            <a href="{{ route('anggota.audit.pedoman') }}" class="block px-2 py-1.5 rounded-md text-[11px] {{ request()->routeIs('anggota.audit.pedoman') ? 'text-white bg-white/20 font-bold' : 'text-white/70 hover:text-white' }}">Pedoman Kerja</a>
            <a href="{{ route('anggota.audit.templates') }}" class="block px-2 py-1.5 rounded-md text-[11px] {{ request()->routeIs('anggota.audit.templates') ? 'text-white bg-white/20 font-bold' : 'text-white/70 hover:text-white' }}">Template Dokumen</a>
            <a href="{{ route('anggota.audit.kka-index') }}" class="block px-2 py-1.5 rounded-md text-[11px] {{ request()->routeIs('anggota.audit.kka-index') ? 'text-white bg-white/20 font-bold' : 'text-white/70 hover:text-white' }}">KKA</a>
            <a href="{{ route('anggota.audit.kda-index') }}" class="block px-2 py-1.5 rounded-md text-[11px] {{ request()->routeIs('anggota.audit.kda-index') ? 'text-white bg-white/20 font-bold' : 'text-white/70 hover:text-white' }}">KDA</a>
        </div>
    </div>

    <div x-data="{ open: {{ request()->routeIs('anggota.documents.*') ? 'true' : 'false' }} }">
        <button @click="open = !open"
                class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition-colors group text-left {{ request()->routeIs('anggota.documents.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">
            <div class="flex items-center">
                <div class="w-5 text-center"><i class="fa-solid fa-folder-open text-sm"></i></div>
                <span class="ml-2.5 text-xs font-medium">Dokumen</span>
            </div>
            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="{'rotate-180': open}"></i>
        </button>
        <div x-show="open" class="pl-9 pr-2 py-1 space-y-1" x-cloak>
            <a href="{{ route('anggota.documents.request.create') }}" class="block px-2 py-1.5 rounded-md text-[11px] {{ request()->routeIs('anggota.documents.request.create') ? 'text-white bg-white/20 font-bold' : 'text-white/70 hover:text-white' }}">Kirim Permintaan</a>

            <a href="{{ route('anggota.documents.responses.index') }}" class="block px-2 py-1.5 rounded-md text-[11px] {{ request()->routeIs('anggota.documents.responses.index') ? 'text-white bg-white/20 font-bold' : 'text-white/70 hover:text-white' }}">Data Tanggapan</a>
        </div>
    </div>

    <a href="{{ route('anggota.findings.index') }}"
       class="flex items-center px-3 py-2 rounded-lg transition-colors group {{ request()->routeIs('anggota.findings.*') ? 'bg-white/20 text-white font-semibold shadow-sm' : 'hover:bg-white/10 text-white/80' }}">
        <div class="w-5 text-center"><i class="fa-solid fa-magnifying-glass text-sm"></i></div>
        <span class="ml-2.5 text-xs">Data Temuan</span>
    </a>

    <div x-data="{ open: {{ request()->routeIs('anggota.reports.*') ? 'true' : 'false' }} }">
        <button @click="open = !open"
                class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition-colors group text-left {{ request()->routeIs('anggota.reports.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">
            <div class="flex items-center">
                <div class="w-5 text-center"><i class="fa-solid fa-file-arrow-up text-sm"></i></div>
                <span class="ml-2.5 text-xs font-medium">Ajukan Laporan</span>
            </div>
            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="{'rotate-180': open}"></i>
        </button>
        <div x-show="open" class="pl-9 pr-2 py-1 space-y-1" x-cloak>
            <a href="{{ route('anggota.reports.lha') }}" class="block px-2 py-1.5 rounded-md text-[11px] {{ request()->routeIs('anggota.reports.lha') ? 'text-white bg-white/20 font-bold' : 'text-white/70 hover:text-white' }}">LHA (Hasil Audit)</a>
            <a href="{{ route('anggota.reports.lhr') }}" class="block px-2 py-1.5 rounded-md text-[11px] {{ request()->routeIs('anggota.reports.lhr') ? 'text-white bg-white/20 font-bold' : 'text-white/70 hover:text-white' }}">LHR (Hasil Reviu)</a>
        </div>
    </div>

    <div x-data="{ open: {{ request()->routeIs('anggota.portal.*') ? 'true' : 'false' }} }">
        <button @click="open = !open"
                class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition-colors group text-left {{ request()->routeIs('anggota.portal.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">
            <div class="flex items-center">
                <div class="w-5 text-center"><i class="fa-solid fa-newspaper text-sm"></i></div>
                <span class="ml-2.5 text-xs font-medium">Portal Berita</span>
            </div>
            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="{'rotate-180': open}"></i>
        </button>
        <div x-show="open" class="pl-9 pr-2 py-1 space-y-1" x-cloak>
            <a href="{{ route('anggota.portal.create') }}" class="block px-2 py-1.5 rounded-md text-[11px] {{ request()->routeIs('anggota.portal.create') ? 'text-white bg-white/20 font-bold' : 'text-white/70 hover:text-white' }}">Tulis Berita</a>
            <a href="{{ route('anggota.portal.index') }}" class="block px-2 py-1.5 rounded-md text-[11px] {{ request()->routeIs('anggota.portal.index') ? 'text-white bg-white/20 font-bold' : 'text-white/70 hover:text-white' }}">Data Berita</a>
        </div>
    </div>

   <a href="{{ route('anggota.cms.index') }}"
       class="flex items-center px-3 py-2 rounded-lg transition-colors group {{ request()->routeIs('anggota.cms.*') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'hover:bg-white/10 text-white/80' }}">
        <div class="w-5 text-center"><i class="fa-solid fa-pen-to-square text-sm"></i></div>
        <span class="ml-2.5 text-xs">Edit Landing Page</span>
    </a>
</nav>

        <div class="p-2 border-t border-white/10 shrink-0">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-3 py-2 rounded-lg hover:bg-red-500/20 text-white/90 hover:text-white transition-colors cursor-pointer text-left">
                    <div class="w-5 text-center"><i class="fa-solid fa-right-from-bracket text-sm"></i></div>
                    <span class="ml-2.5 text-xs font-medium">Keluar (Logout)</span>
                </button>
            </form>
        </div>
    </div>
</aside>
