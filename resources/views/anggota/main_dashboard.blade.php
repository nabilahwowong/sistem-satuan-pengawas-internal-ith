@extends('anggota.dashboard')

@section('content')
<div class="px-2 pb-8">
    {{-- 1. Header Section --}}

    {{-- 2. Stats Cards Grid (Responsif & Clickable) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <a href="{{ route('anggota.schedules.index') }}" class="bg-white p-7 rounded-[35px] shadow-sm border border-gray-100 flex justify-between items-center transition-all duration-300 hover:shadow-md hover:border-blue-200 hover:-translate-y-1 group cursor-pointer">
            <div>
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest leading-none">PEKERJAAN</p>
                <h3 class="text-4xl font-extrabold text-gray-900 mt-3 group-hover:text-blue-600 transition-colors">{{ $countPekerjaan ?? 0 }}</h3>
                <p class="text-[11px] text-gray-500 mt-5 font-medium">Jadwal Audit & Reviu</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl shadow-inner group-hover:bg-blue-600 group-hover:text-white transition-colors">
                <i class="fa-solid fa-briefcase"></i>
            </div>
        </a>

        <a href="{{ route('anggota.documents.responses.index') }}" class="bg-white p-7 rounded-[35px] shadow-sm border border-gray-100 flex justify-between items-center transition-all duration-300 hover:shadow-md hover:border-purple-200 hover:-translate-y-1 group cursor-pointer">
            <div>
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest leading-none">TANGGAPAN</p>
                <h3 class="text-4xl font-extrabold text-gray-900 mt-3 group-hover:text-purple-600 transition-colors">{{ $countDokumen ?? 0 }}</h3>
                <p class="text-[11px] text-gray-500 mt-5 font-medium">Respon Tindak Lanjut</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl shadow-inner group-hover:bg-purple-600 group-hover:text-white transition-colors">
                <i class="fa-solid fa-reply-all"></i>
            </div>
        </a>

        <a href="{{ route('anggota.findings.index') }}" class="bg-white p-7 rounded-[35px] shadow-sm border border-gray-100 flex justify-between items-center transition-all duration-300 hover:shadow-md hover:border-red-200 hover:-translate-y-1 group cursor-pointer">
            <div>
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest leading-none">TEMUAN</p>
                <h3 class="text-4xl font-extrabold text-gray-900 mt-3 group-hover:text-red-600 transition-colors">{{ $countTemuan ?? 0 }}</h3>
                <p class="text-[11px] text-gray-500 mt-5 font-medium">Temuan Audit Aktif</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center text-2xl shadow-inner group-hover:bg-red-600 group-hover:text-white transition-colors">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
        </a>

        <a href="{{ route('anggota.reports.lha') }}" class="bg-white p-7 rounded-[35px] shadow-sm border border-gray-100 flex justify-between items-center transition-all duration-300 hover:shadow-md hover:border-yellow-200 hover:-translate-y-1 group cursor-pointer">
            <div>
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest leading-none">LAPORAN</p>
                <h3 class="text-4xl font-extrabold text-gray-900 mt-3 group-hover:text-yellow-600 transition-colors">{{ $countLaporan ?? 0 }}</h3>
                <p class="text-[11px] text-gray-500 mt-5 font-medium">Laporan Selesai</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-yellow-50 text-yellow-600 flex items-center justify-center text-2xl shadow-inner group-hover:bg-yellow-600 group-hover:text-white transition-colors">
                <i class="fa-solid fa-file-invoice"></i>
            </div>
        </a>

    </div>

    <div class="mb-8">
    <div class="flex justify-between items-end mb-4">
        <div>
            <h3 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                <i class="fa-solid fa-bolt text-yellow-500"></i>
                Aktivitas Terbaru
            </h3>
        </div>
        <a href="#" class="text-[11px] font-bold text-blue-600 hover:underline">Lihat Semua</a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 max-h-64 overflow-y-auto no-scrollbar">
        <ul class="divide-y divide-gray-50">
            @forelse($recentActivities as $activity)
                <li class="p-4 hover:bg-gray-50/50 transition-colors flex items-start gap-3">
                    <div class="shrink-0 mt-0.5">
                        @if($activity->user->foto_profil)
                            <img src="{{ asset('storage/' . $activity->user->foto_profil) }}"
                                 class="w-8 h-8 rounded-full object-cover border border-gray-100">
                        @else
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-[10px] uppercase">
                                {{ substr($activity->user->name, 0, 2) }}
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-[12px] text-gray-700 leading-tight">
                            <span class="font-bold text-gray-900">{{ $activity->user->name }}</span>
                            {{ strtolower($activity->activity) }}
                        </p>
                        <div class="flex items-center gap-2 mt-1.5">
                            <span class="text-[10px] text-gray-400 flex items-center gap-1">
                                <i class="fa-regular fa-clock"></i>
                                {{ $activity->created_at->diffForHumans() }}
                            </span>

                            @if($activity->section)
                                <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                <span class="text-[9px] uppercase font-bold text-blue-500 tracking-wider">
                                    {{ $activity->section }}
                                </span>
                            @endif
                        </div>
                    </div>
                </li>
            @empty
                <li class="p-6 text-center">
                    <p class="text-xs text-gray-400 italic">Belum ada aktivitas hari ini.</p>
                </li>
            @endforelse
        </ul>
    </div>
</div>


    {{-- 3. Area Chart & Tabel (Responsif 1-3 Kolom) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-[30px] shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-1">Status Pekerjaan</h3>
            <p class="text-xs text-gray-500 mb-8">Persentase penyelesaian tugas.</p>

            <div class="relative flex items-center justify-center h-52">
                <canvas id="jobStatusChart"></canvas>
                <div class="absolute text-center">
                    <div class="text-4xl font-extrabold text-gray-800">75%</div>
                </div>
            </div>
            <div class="flex justify-center mt-8">
                <span class="flex items-center gap-2 text-[11px] font-bold text-blue-600 bg-blue-50 px-4 py-1.5 rounded-full">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span> On Progress
                </span>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white rounded-[30px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Tugas Terbaru</h3>
                    <p class="text-xs text-gray-500">Daftar pekerjaan yang perlu diselesaikan.</p>
                </div>
                <a href="{{ route('anggota.schedules.index') }}" class="text-xs font-bold text-blue-600 bg-blue-50 px-4 py-2 rounded-xl hover:bg-blue-600 hover:text-white transition-all">Lihat Semua</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">NAMA TUGAS</th>
                            <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">UNIT / AUDITEE</th>
                            <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">DEADLINE</th>
                            <th class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentTasks as $task)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-8 py-5 font-bold text-sm text-gray-800">{{ $task->title ?? 'Audit Operasional' }}</td>
                            <td class="px-8 py-5 text-sm text-gray-600">{{ $task->unit->name ?? 'N/A' }}</td>
                            <td class="px-8 py-5 text-sm text-gray-600">{{ $task->created_at->addDays(7)->format('d M Y') }}</td>
                            <td class="px-8 py-5 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-blue-50 text-blue-600 border border-blue-100">
                                    ON PROGRESS
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-folder-open text-gray-200 text-3xl"></i>
                                    </div>
                                    <p class="text-sm text-gray-400 font-medium">Belum ada tugas aktif saat ini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Script Chart --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('jobStatusChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Selesai', 'On Progress'],
                    datasets: [{
                        data: [75, 25],
                        backgroundColor: ['#2563eb', '#f1f5f9'],
                        hoverOffset: 4,
                        borderWidth: 0,
                        cutout: '85%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    animation: { animateScale: true, animateRotate: true }
                }
            });
        }
    });
</script>
@endsection
