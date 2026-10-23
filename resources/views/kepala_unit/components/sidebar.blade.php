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
</head>
<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden">

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <aside class="fixed top-5 left-5 w-60 h-[calc(100vh-40px)] bg-spi-blue text-white flex flex-col shadow-2xl z-50 rounded-[20px] overflow-hidden">

        <div class="flex flex-col items-center py-6 border-b border-white/10 shrink-0">
            <div class="bg-white p-1.5 rounded-full w-[55px] h-[55px] flex items-center justify-center shadow-md mb-2">
                 <img src="{{ asset('images/download.png') }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff'" class="w-full h-full object-contain rounded-full">
            </div>
            <h3 class="font-bold text-base tracking-wide uppercase text-center leading-tight">KEPALA UNIT</h3>
            <span class="text-[10px] text-blue-100 bg-white/10 px-2 py-0.5 rounded mt-1 text-center">
                {{ Auth::user()->unit ? Auth::user()->unit->nama_unit : 'Unit Belum Diatur' }}
            </span>
        </div>

        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1 no-scrollbar">

            <a href="{{ route('kepala_unit.dashboard') }}"
               class="flex items-center px-3 py-2 rounded-lg transition-colors group {{ request()->routeIs('kepala_unit.dashboard') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'hover:bg-white/10 text-white/80' }}">
                <div class="w-5 text-center"><i class="fa-solid fa-gauge-high text-sm"></i></div>
                <span class="ml-2.5 text-xs">Dashboard</span>
            </a>

            <a href="{{ route('kepala_unit.jadwal') }}"
               class="flex items-center px-3 py-2 rounded-lg transition-colors group {{ request()->routeIs('kepala_unit.jadwal*') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'hover:bg-white/10 text-white/80' }}">
                <div class="w-5 text-center"><i class="fa-solid fa-calendar-days text-sm"></i></div>
                <span class="ml-2.5 text-xs">Jadwal Reviu</span>
            </a>

            <a href="{{ route('kepala_unit.dokumen') }}"
                class="flex items-center px-3 py-2 rounded-lg transition-colors group {{ request()->routeIs('kepala_unit.dokumen*') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'hover:bg-white/10 text-white/80' }}">
                    <div class="w-5 text-center"><i class="fa-solid fa-file-import text-sm"></i></div>
                    <span class="ml-2.5 text-xs">Permintaan Dokumen</span>

                   @if(isset($reqCount) && $reqCount > 0)
                    <span class="ml-auto bg-rose-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-lg border border-white/20 min-w-[18px] text-center flex items-center justify-center">
                        {{ $reqCount }}
                    </span>
                @endif
            </a>

            <a href="{{ route('kepala_unit.temuan') }}"
               class="flex items-center px-3 py-2 rounded-lg transition-colors group {{ request()->routeIs('kepala_unit.temuan*') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'hover:bg-white/10 text-white/80' }}">
                <div class="w-5 text-center"><i class="fa-solid fa-comments text-sm"></i></div>
                <span class="ml-2.5 text-xs">Tanggapan Temuan</span>
            </a>

            <a href="{{ route('kepala_unit.laporan') }}"
               class="flex items-center px-3 py-2 rounded-lg transition-colors group {{ request()->routeIs('kepala_unit.laporan*') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'hover:bg-white/10 text-white/80' }}">
                <div class="w-5 text-center"><i class="fa-solid fa-file-invoice text-sm"></i></div>
                <span class="ml-2.5 text-xs">Laporan Unit</span>
            </a>

        </nav>

        <div class="p-2 border-t border-white/10 shrink-0">
            <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="w-full flex items-center px-3 py-2 rounded-lg hover:bg-red-500/20 text-white/90 hover:text-white transition-colors cursor-pointer text-left">
                <div class="w-5 text-center"><i class="fa-solid fa-right-from-bracket text-sm"></i></div>
                <span class="ml-2.5 text-xs font-medium">Keluar (Logout)</span>
            </button>
        </div>

    </aside>
</body>
