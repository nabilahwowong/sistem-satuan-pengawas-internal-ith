<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>

<aside class="fixed top-4 left-4 w-[230px] h-[calc(100vh-32px)] bg-blue-900 bg-spi-blue text-white flex flex-col shadow-2xl z-[999] rounded-[20px] overflow-hidden">

    <div class="flex flex-col items-center py-5 border-b border-white/10 shrink-0">
        <div class="bg-white p-1.5 rounded-full w-[50px] h-[50px] flex items-center justify-center shadow-md mb-2">
             <img src="{{ asset('images/download.png') }}" onerror="this.src='https://ui-avatars.com/api/?name=Admin+SPI&background=random&color=fff'" class="w-full h-full object-contain rounded-full">
        </div>
        <h3 class="font-bold text-sm tracking-wide uppercase text-center leading-tight">ADMIN SPI</h3>
        <span class="text-[10px] text-blue-100 bg-white/10 px-2 py-0.5 rounded mt-1">Administrator</span>
    </div>

    <nav class="flex-1 overflow-y-auto py-3 px-2 space-y-1 no-scrollbar">

        <a href="{{ url('/admin/dashboard') }}"
           class="flex items-center px-3 py-2 rounded-lg transition-colors group {{ request()->is('admin/dashboard') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'hover:bg-white/10 text-white/80' }}">
            <div class="w-5 text-center"><i class="fa-solid fa-gauge-high text-sm"></i></div>
            <span class="ml-2.5 text-xs">Dashboard</span>
        </a>

        <div x-data="{ open: {{ (request()->routeIs('admin.users.*') || request()->routeIs('admin.access.*')) ? 'true' : 'false' }} }">
            <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition-colors group text-left {{ (request()->routeIs('admin.users.*') || request()->routeIs('admin.access.*')) ? 'bg-white/10 text-white' : 'text-white/80' }}">
                <div class="flex items-center">
                    <div class="w-5 text-center"><i class="fa-solid fa-users-gear text-sm"></i></div>
                    <span class="ml-2.5 text-xs font-medium">Manajemen Pengguna</span>
                </div>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="{'rotate-180': open}"></i>
            </button>
            <div x-show="open" class="pl-9 pr-2 py-1 space-y-1" style="display: none;">
                <a href="{{ route('admin.users.index') }}"
                   class="block px-2 py-1.5 rounded-md text-[11px] transition-colors {{ request()->routeIs('admin.users.*') ? 'text-white bg-white/20 font-bold shadow-sm' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                    Data Pengguna
                </a>
                <a href="{{ route('admin.access.index') }}"
                   class="block px-2 py-1.5 rounded-md text-[11px] transition-colors {{ request()->routeIs('admin.access.*') ? 'text-white bg-white/20 font-bold shadow-sm' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                    Hak Akses
                </a>
            </div>
        </div>

        <a href="{{ route('admin.units.index') }}"
           class="flex items-center px-3 py-2 rounded-lg transition-colors group {{ request()->routeIs('admin.units.*') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'hover:bg-white/10 text-white/80' }}">
            <div class="w-5 text-center"><i class="fa-solid fa-sitemap text-sm"></i></div>
            <span class="ml-2.5 text-xs">Daftar Unit Kerja</span>
        </a>

        <a href="{{ route('admin.schedules.index') }}"
           class="flex items-center px-3 py-2 rounded-lg transition-colors group {{ request()->routeIs('admin.schedules.*') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'hover:bg-white/10 text-white/80' }}">
            <div class="w-5 text-center"><i class="fa-solid fa-calendar-check text-sm"></i></div>
            <span class="ml-2.5 text-xs">Jadwal Reviu</span>
        </a>

        <div x-data="{ open: {{ request()->routeIs('admin.archives.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3 py-2 rounded-lg transition-colors group text-left mt-1 {{ request()->routeIs('admin.archives.*') ? 'bg-white/10 text-white' : 'hover:bg-white/10 text-white/80' }}">
                <div class="flex items-center">
                    <div class="w-5 text-center"><i class="fa-solid fa-box-archive text-sm"></i></div>
                    <span class="ml-2.5 text-xs font-medium">Laporan Arsip</span>
                </div>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="{'rotate-180': open}"></i>
            </button>

            <div x-show="open" class="pl-9 pr-2 py-1 space-y-1" style="display: none;">
                <a href="{{ route('admin.archives.index', ['kategori' => 'lha']) }}"
                   class="block px-2 py-1.5 rounded-md text-[11px] transition-colors {{ request('kategori') == 'lha' ? 'text-white bg-white/20 font-bold shadow-sm' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                    Arsip LHA (Audit)
                </a>
                <a href="{{ route('admin.archives.index', ['kategori' => 'lhr']) }}"
                   class="block px-2 py-1.5 rounded-md text-[11px] transition-colors {{ request('kategori') == 'lhr' ? 'text-white bg-white/20 font-bold shadow-sm' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                    Arsip LHR (Reviu)
                </a>
            </div>
        </div>

        <div x-data="{ open: {{ request()->routeIs('admin.documents.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                    class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition-colors group text-left {{ request()->routeIs('admin.documents.*') ? 'bg-white/10 text-white' : 'text-white/80' }}">
                <div class="flex items-center">
                    <div class="w-5 text-center"><i class="fa-solid fa-book-bookmark text-sm"></i></div>
                    <span class="ml-2.5 text-xs font-medium">Pedoman & Template</span>
                </div>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="{'rotate-180': open}"></i>
            </button>
            <div x-show="open" class="pl-9 pr-2 py-1 space-y-1" style="display: none;">
                <a href="{{ route('admin.documents.index', ['kategori' => 'pedoman_audit']) }}"
                   class="block px-2 py-1.5 rounded-md text-[11px] transition-colors {{ request('kategori') == 'pedoman_audit' ? 'text-white bg-white/20 font-bold shadow-sm' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                    Pedoman Audit
                </a>
                <a href="{{ route('admin.documents.index', ['kategori' => 'pedoman_reviu']) }}"
                   class="block px-2 py-1.5 rounded-md text-[11px] transition-colors {{ request('kategori') == 'pedoman_reviu' ? 'text-white bg-white/20 font-bold shadow-sm' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                    Pedoman Reviu
                </a>
                <a href="{{ route('admin.documents.index', ['kategori' => 'template']) }}"
                   class="block px-2 py-1.5 rounded-md text-[11px] transition-colors {{ request('kategori') == 'template' ? 'text-white bg-white/20 font-bold shadow-sm' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                    Template Dokumen
                </a>
            </div>
        </div>

        <a href="{{ route('admin.audit.index') }}"
           class="flex items-center px-3 py-2 rounded-lg transition-colors group {{ request()->routeIs('admin.audit.*') ? 'bg-white/20 text-white shadow-sm font-semibold' : 'hover:bg-white/10 text-white/80' }}">
            <div class="w-5 text-center"><i class="fa-solid fa-magnifying-glass-chart text-sm"></i></div>
            <span class="ml-2.5 text-xs">Kertas Kerja Audit</span>
        </a>

    </nav>

    <div class="p-2 border-t border-white/10 shrink-0">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center px-3 py-2 rounded-lg hover:bg-red-500/20 text-white/90 hover:text-white transition-colors">
                <div class="w-5 text-center"><i class="fa-solid fa-right-from-bracket text-sm"></i></div>
                <span class="font-medium ml-2.5 text-xs">Logout</span>
            </button>
        </form>
    </div>
</aside>

<script src="//unpkg.com/alpinejs" defer></script>
