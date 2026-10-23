<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Reviu | Admin SPI</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'inter', 'sans-serif'] },
                    colors: { 'spi-blue': '#1e4bbc', 'spi-dark': '#1e3a8a', 'spi-bg': '#f4f6fa' }
                }
            }
        }
    </script>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* FullCalendar Customization */
        .fc-toolbar-title { font-size: 1.1rem !important; font-weight: 700; color: #374151; }
        .fc-button-primary { background-color: #1e4bbc !important; border-color: #1e4bbc !important; box-shadow: none !important; }
        .fc-button-active { background-color: #1e3a8a !important; }
        .fc-daygrid-day.fc-day-today { background-color: #eff6ff !important; }
        .fc-col-header-cell { padding: 8px 0 !important; background-color: #f9fafb; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; }
        .fc-event { cursor: pointer; border: none; font-size: 0.75rem; padding: 2px; }
    </style>
</head>
<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden flex">

    @include('admin.components.admin-sidebar')

    <main class="ml-[260px] flex-1 h-full flex flex-col overflow-hidden relative transition-all duration-300 z-0"
          x-data="{ view: 'list' }"
          x-init="$watch('view', value => { if(value === 'calendar' && window.calendar) { setTimeout(() => { window.calendar.render() }, 200); } })">

        <header class="bg-white px-6 py-4 rounded-[20px] shadow-sm m-6 mb-0 shrink-0 border border-gray-100 flex justify-between items-center z-10">
            <div>
                <h1 class="text-xl font-bold">Jadwal Reviu</h1>
                <p class="text-xs text-gray-500">Agenda kegiatan reviu unit kerja.</p>
            </div>

            <div class="flex bg-gray-100 p-1 rounded-lg border border-gray-200">
                <button @click="view = 'list'"
                        :class="view === 'list' ? 'bg-white shadow-sm text-spi-blue font-bold' : 'text-gray-500 hover:bg-gray-200 font-medium'"
                        class="px-4 py-1.5 rounded-md text-xs transition-all flex items-center gap-2">
                    <i class="fa-solid fa-list"></i> List
                </button>
                <button @click="view = 'calendar'"
                        :class="view === 'calendar' ? 'bg-white shadow-sm text-spi-blue font-bold' : 'text-gray-500 hover:bg-gray-200 font-medium'"
                        class="px-4 py-1.5 rounded-md text-xs transition-all flex items-center gap-2">
                    <i class="fa-regular fa-calendar"></i> Kalender
                </button>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6 no-scrollbar">

            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm relative">
                {{ session('error') }}
            </div>
            @endif

            <div x-show="view === 'list'"
                 x-transition.opacity.duration.300ms
                 class="bg-white rounded-[20px] shadow-sm border border-gray-100 flex-1 flex flex-col min-h-0 overflow-hidden">

                {{-- Search Bar --}}
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 bg-gray-50/50 shrink-0">
                    <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">Daftar Agenda</div>
                    <form action="{{ route('admin.schedules.index') }}" method="GET">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Kegiatan / Unit..." class="text-xs border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:border-blue-500 w-64">
                    </form>
                </div>

                {{-- Tabel --}}
                <div class="overflow-y-auto flex-1">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b sticky top-0 z-10 shadow-sm">
                            <tr>
                                <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600 w-10">No</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600">Kegiatan</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600">Unit & Waktu</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600">Dibuat Oleh</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600 text-center">Status</th>
                                @if(auth()->user()->role == 'anggota')
                                <th class="px-6 py-3 text-xs font-bold uppercase text-gray-600 text-right">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($schedules as $index => $item)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-3 text-xs text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-3">
                                    <div class="font-bold text-sm text-gray-800">{{ $item->nama_kegiatan }}</div>
                                    <div class="text-[11px] text-gray-400 mt-1 truncate max-w-xs">{{ $item->keterangan ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-3">
                                    <div class="flex items-center gap-2 mb-1">
                                        <i class="fa-solid fa-building text-gray-400 text-xs"></i>
                                        <span class="text-xs font-bold text-gray-700">{{ $item->unit->nama_unit }}</span>
                                    </div>
                                    <div class="text-[11px] text-gray-500 bg-blue-50 inline-block px-2 py-0.5 rounded border border-blue-100">
                                        {{ date('d M', strtotime($item->tanggal_mulai)) }} - {{ date('d M Y', strtotime($item->tanggal_selesai)) }}
                                    </div>
                                </td>
                                <td class="px-6 py-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-[10px] font-bold text-gray-600">
                                            {{ substr($item->creator->name ?? '?', 0, 1) }}
                                        </div>
                                        <span class="text-xs text-gray-600">{{ $item->creator->name ?? 'Unknown' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-center">
                                    @php
                                        $statusClass = match($item->status) {
                                            'dijadwalkan' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                            'berjalan' => 'bg-blue-100 text-blue-700 border-blue-200',
                                            'selesai' => 'bg-green-100 text-green-700 border-green-200',
                                            'ditunda' => 'bg-red-100 text-red-700 border-red-200',
                                            default => 'bg-gray-100 text-gray-700'
                                        };
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $statusClass }} uppercase tracking-wider">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                @if(auth()->user()->role == 'anggota')
                                <td class="px-6 py-3 text-right">
                                    <form action="{{ route('admin.schedules.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-600 px-2 transition" title="Hapus">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">
                                    <div class="flex flex-col items-center">
                                        <i class="fa-regular fa-calendar-xmark text-3xl mb-2 opacity-50"></i>
                                        <p>Belum ada jadwal reviu dibuat.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($schedules->hasPages())
                    <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">{{ $schedules->links() }}</div>
                @endif
            </div>

            @php
                $eventsData = $schedules->map(function($item) {
                    // Tentukan warna berdasarkan status admin
                    $color = match($item->status) {
                        'dijadwalkan' => '#f59e0b', // Amber/Yellow
                        'berjalan'    => '#3b82f6', // Blue
                        'selesai'     => '#10b981', // Green
                        'ditunda'     => '#ef4444', // Red
                        default       => '#6b7280'
                    };

                    return [
                        'title' => $item->nama_kegiatan . ' (' . $item->unit->nama_unit . ')',
                        'start' => $item->tanggal_mulai,
                        // FullCalendar butuh end date +1 hari agar visual rentang waktunya pas
                        'end'   => \Carbon\Carbon::parse($item->tanggal_selesai)->addDay()->format('Y-m-d'),
                        'backgroundColor' => $color,
                        'borderColor' => 'transparent',
                        'textColor' => '#ffffff',
                        'allDay' => true
                    ];
                });
            @endphp

            <div x-show="view === 'calendar'"
                 class="bg-white rounded-[20px] shadow-sm border border-gray-100 p-6 h-full min-h-[600px]"
                 style="display: none;">
                 <div id='calendar' class="h-full w-full" data-events="{{ json_encode($eventsData) }}"></div>
            </div>

        </div>
    </main>

    <script>
        window.calendar = null;

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            // Ambil data dari atribut HTML, parse JSON-nya
            // Jika kosong, gunakan array kosong []
            var events = JSON.parse(calendarEl.getAttribute('data-events') || '[]');

            window.calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listWeek'
                },
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan',
                    list: 'Agenda'
                },
                height: '100%',
                events: events, // Gunakan data yang sudah diparsing
                eventClick: function(info) {
                    alert('Detail: ' + info.event.title + '\nMulai: ' + info.event.start.toLocaleDateString());
                }
            });

            // Jika ingin render langsung (opsional, karena sudah dihandle Alpine)
            // window.calendar.render();
        });
    </script>
</body>
</html>
