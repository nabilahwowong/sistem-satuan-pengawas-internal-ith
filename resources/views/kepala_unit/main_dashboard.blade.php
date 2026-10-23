@extends('anggota.dashboard')

@section('content')
<div>

    <div class="mb-8 px-2">
        <h2 class="text-2xl font-bold text-gray-800 tracking-tight">
            Selamat Datang, <span class="text-indigo-600">{{ Auth::user()->name ?? 'Anggota SPI' }}</span>
        </h2>
        <p class="text-sm text-gray-500 mt-1">Berikut adalah ringkasan kinerja dan aktivitas pengawasan SPI Anda hari ini.</p>
    </div>

    <!-- CARD STATISTIK (INTERAKTIF) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <!-- Card 1: Jadwal Audit -->
        <a href="{{ route('anggota.schedules.index') }}" class="group bg-white p-6 rounded-3xl shadow-sm border border-indigo-100 flex flex-col justify-between hover:shadow-xl hover:-translate-y-1.5 hover:border-indigo-300 transition-all duration-300 cursor-pointer relative overflow-hidden">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-indigo-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>

            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>
                <h3 class="text-4xl font-black text-gray-800 group-hover:text-indigo-600 transition-colors duration-300">{{ $countPekerjaan ?? 0 }}</h3>
            </div>
            <div class="flex items-center justify-between mt-2 relative z-10">
                <p class="text-gray-500 text-[11px] font-bold uppercase tracking-widest group-hover:text-indigo-500 transition-colors duration-300">Jadwal Audit</p>
                <i class="fa-solid fa-arrow-right text-indigo-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-300 text-sm"></i>
            </div>
        </a>

        <!-- Card 2: Permintaan Dokumen -->
        <a href="{{ route('anggota.documents.responses.index') }}" class="group bg-white p-6 rounded-3xl shadow-sm border border-sky-100 flex flex-col justify-between hover:shadow-xl hover:-translate-y-1.5 hover:border-sky-300 transition-all duration-300 cursor-pointer relative overflow-hidden">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-sky-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>

            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="w-12 h-12 bg-sky-50 text-sky-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-sky-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <h3 class="text-4xl font-black text-gray-800 group-hover:text-sky-500 transition-colors duration-300">{{ $countDokumen ?? 0 }}</h3>
            </div>
            <div class="flex items-center justify-between mt-2 relative z-10">
                <p class="text-gray-500 text-[11px] font-bold uppercase tracking-widest group-hover:text-sky-500 transition-colors duration-300">Tanggapan Dokumen</p>
                <i class="fa-solid fa-arrow-right text-sky-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-300 text-sm"></i>
            </div>
        </a>

        <!-- Card 3: Temuan Open -->
        <a href="{{ route('anggota.findings.index') }}" class="group bg-white p-6 rounded-3xl shadow-sm border border-rose-100 flex flex-col justify-between hover:shadow-xl hover:-translate-y-1.5 hover:border-rose-300 transition-all duration-300 cursor-pointer relative overflow-hidden">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-rose-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>

            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-rose-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h3 class="text-4xl font-black text-gray-800 group-hover:text-rose-500 transition-colors duration-300">{{ $countTemuan ?? 0 }}</h3>
            </div>
            <div class="flex items-center justify-between mt-2 relative z-10">
                <p class="text-gray-500 text-[11px] font-bold uppercase tracking-widest group-hover:text-rose-500 transition-colors duration-300">Temuan (Open)</p>
                <i class="fa-solid fa-arrow-right text-rose-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-300 text-sm"></i>
            </div>
        </a>

        <!-- Card 4: Laporan Selesai -->
        <a href="{{ route('anggota.reports.lha') }}" class="group bg-white p-6 rounded-3xl shadow-sm border border-emerald-100 flex flex-col justify-between hover:shadow-xl hover:-translate-y-1.5 hover:border-emerald-300 transition-all duration-300 cursor-pointer relative overflow-hidden">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>

            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                    <i class="fa-solid fa-file-contract"></i>
                </div>
                <h3 class="text-4xl font-black text-gray-800 group-hover:text-emerald-500 transition-colors duration-300">{{ $countLaporan ?? 0 }}</h3>
            </div>
            <div class="flex items-center justify-between mt-2 relative z-10">
                <p class="text-gray-500 text-[11px] font-bold uppercase tracking-widest group-hover:text-emerald-500 transition-colors duration-300">Laporan Disusun</p>
                <i class="fa-solid fa-arrow-right text-emerald-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-300 text-sm"></i>
            </div>
        </a>

    </div>

    <div class="mb-8">
    <div class="flex items-center gap-2 mb-4">
        <div class="w-2 h-6 bg-blue-600 rounded-full"></div>
        <h3 class="font-bold text-gray-800 uppercase text-xs tracking-widest">Log Aktivitas Anggota</h3>
    </div>

    <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 p-6">
        <div class="space-y-4">
            @forelse($recentActivities as $activity)
                <div class="flex items-center justify-between border-b border-gray-50 pb-3 last:border-0 last:pb-0">
                    <div class="flex items-center gap-3">
                        <div class="shrink-0">
                            @if($activity->user->foto_profil)
                                <img src="{{ asset('storage/' . $activity->user->foto_profil) }}" class="w-10 h-10 rounded-full object-cover border border-blue-100">
                            @else
                                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-xs uppercase">
                                    {{ substr($activity->user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <div>
                            <p class="text-sm font-bold text-gray-800">{{ $activity->user->name }}</p>
                            <p class="text-[11px] text-gray-500">{{ $activity->activity }}</p>
                        </div>
                    </div>

                    <div class="text-right">
                        <span class="text-[10px] bg-blue-50 text-blue-600 px-2 py-1 rounded-lg font-bold">
                            {{ $activity->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center py-4 text-gray-400 text-xs italic">
                    Belum ada riwayat aktivitas terbaru.
                </div>
            @endforelse
            </div>
        </div>
    </div>

    <!-- TABEL DAFTAR DOKUMEN TERBARU -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
            <h3 class="font-bold text-gray-800 text-sm"><i class="fa-solid fa-clock-rotate-left mr-2 text-indigo-600"></i> Tanggapan Dokumen Masuk</h3>
        </div>

        <div class="p-6">
            @if(isset($recentDocuments) && count($recentDocuments) > 0)
                <ul class="space-y-4">
                    @foreach($recentDocuments as $doc)
                        <li class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100 hover:bg-gray-100 transition">
                            <div>
                                <p class="font-bold text-sm text-gray-800">{{ $doc->nama_dokumen ?? 'Permintaan #' . $doc->id }}</p>
                                <p class="text-xs font-medium text-gray-500 mt-1"><i class="fa-regular fa-calendar mr-1"></i> {{ $doc->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            @if($doc->status == 'fulfilled' || $doc->status == 'verified')
                                <span class="px-3 py-1.5 bg-emerald-100 text-emerald-700 text-[10px] font-bold uppercase rounded-lg border border-emerald-200">Selesai / Terverifikasi</span>
                            @else
                                <span class="px-3 py-1.5 bg-yellow-100 text-yellow-700 text-[10px] font-bold uppercase rounded-lg border border-yellow-200">Pending</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="text-center py-10">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100 shadow-sm">
                        <i class="fa-solid fa-box-open text-gray-300 text-2xl"></i>
                    </div>
                    <p class="text-sm font-bold text-gray-600">Belum ada aktivitas dokumen</p>
                    <p class="text-xs text-gray-400 mt-1">Belum ada tanggapan dokumen yang masuk untuk di-review.</p>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
