<!DOCTYPE html>
<html lang="id">
<head>
    <title>Jadwal Reviu - Kepala Unit</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: { 'spi-blue': '#1e4bbc', 'spi-bg': '#f4f6fa' }
                }
            }
        }
    </script>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .fc-toolbar-title { font-size: 1.1rem !important; font-weight: 700; color: #374151; }
        .fc-button-primary { background-color: #1e4bbc !important; border-color: #1e4bbc !important; box-shadow: none !important; }
        .fc-button-active { background-color: #1e3a8a !important; }
        .fc-daygrid-day.fc-day-today { background-color: #eff6ff !important; }
        .fc-col-header-cell { padding: 8px 0 !important; background-color: #f9fafb; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; }
    </style>
</head>
<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden flex">

    @include('kepala_unit.components.sidebar')

    <main class="ml-[275px] flex-1 h-full flex flex-col overflow-hidden relative transition-all duration-300"
          x-data="{ view: 'list' }"
          x-init="$watch('view', value => { if(value === 'calendar' && window.calendar) { setTimeout(() => { window.calendar.render() }, 200); } })">

        <header class="bg-white mx-8 mt-6 px-8 py-5 rounded-[20px] shadow-sm shrink-0 flex justify-between items-center z-10">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Jadwal Reviu</h1>
                <p class="text-xs text-gray-500 mt-1">Agenda kegiatan pemeriksaan pada unit Anda.</p>
            </div>

            <div class="flex items-center gap-6">
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

                <div class="flex items-center gap-3 border-l border-gray-200 pl-6">
                    <span class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</span>
                    <div class="w-9 h-9 rounded-full bg-spi-blue text-white flex items-center justify-center text-xs shadow-md font-bold">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 no-scrollbar">

            <div x-show="view === 'list'"
                 x-transition.opacity.duration.300ms
                 class="bg-white rounded-[20px] shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase">Nama Kegiatan</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase">Jenis Penugasan</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase">Periode</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($schedules as $schedule)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $schedule->nama_kegiatan }}</div>
                                <div class="text-[10px] text-gray-400 mt-1 flex items-center gap-1">
                                    <i class="fa-solid fa-user-pen"></i> Oleh: {{ $schedule->creator->name ?? 'Admin' }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs font-medium border border-gray-200">
                                    {{ $schedule->jenis_penugasan }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-2 text-xs text-gray-600">
                                        <i class="fa-regular fa-calendar text-spi-blue"></i>
                                        {{ \Carbon\Carbon::parse($schedule->tanggal_mulai)->format('d M Y') }}
                                    </div>
                                    <div class="flex items-center gap-2 text-xs text-gray-400">
                                        <i class="fa-solid fa-arrow-right text-[10px] ml-0.5"></i>
                                        {{ \Carbon\Carbon::parse($schedule->tanggal_selesai)->format('d M Y') }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusClass = match($schedule->status) {
                                        'Selesai' => 'bg-green-100 text-green-700 border-green-200',
                                        'Sedang Berjalan' => 'bg-blue-100 text-blue-700 border-blue-200',
                                        'Terjadwal' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                        default => 'bg-gray-100 text-gray-600 border-gray-200'
                                    };
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border uppercase {{ $statusClass }}">
                                    {{ $schedule->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <i class="fa-regular fa-calendar-xmark text-3xl mb-2 text-gray-300"></i>
                                    <p class="text-sm">Belum ada jadwal kegiatan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @php
                // Proses data PHP di sini, lalu encode ke JSON
                $eventsData = $schedules->map(function($s) {
                    return [
                        'title'           => $s->nama_kegiatan,
                        'start'           => $s->tanggal_mulai,
                        'end'             => \Carbon\Carbon::parse($s->tanggal_selesai)->addDay()->format('Y-m-d'),
                        'backgroundColor' => $s->status == 'Selesai' ? '#10b981' : ($s->status == 'Sedang Berjalan' ? '#3b82f6' : '#f59e0b'),
                        'borderColor'     => 'transparent',
                        'textColor'       => '#ffffff',
                        'allDay'          => true
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

            // Ambil data dari atribut HTML
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
                    list: 'List'
                },
                height: '100%',
                events: events // Gunakan variabel events yang sudah diparsing
            });

            window.calendar.render();
        });
    </script>
</body>
</html>
