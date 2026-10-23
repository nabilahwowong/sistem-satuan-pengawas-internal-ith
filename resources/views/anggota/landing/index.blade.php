@extends('anggota.dashboard')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Landing Page</h1>
            <p class="text-sm text-gray-500">Perbarui informasi profil, visi misi, dan layanan SPI</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3 shadow-sm">
            <i class="fa-solid fa-circle-check"></i>
            <span class="text-sm font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="mb-8">
        <div class="flex justify-between items-end mb-4">
            <div>
                <h3 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <i class="fa-solid fa-bolt text-yellow-500"></i>
                    Aktivitas Terbaru Anggota
                </h3>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 max-h-64 overflow-y-auto no-scrollbar">
            <ul class="divide-y divide-gray-50">
                @forelse($recentLogs as $log)
                    <li class="p-4 hover:bg-gray-50/50 transition-colors flex items-start gap-3">
                        <div class="shrink-0 mt-0.5">
                            @if($log->user->foto_profil)
                                <img src="{{ asset('storage/' . $log->user->foto_profil) }}"
                                     class="w-8 h-8 rounded-full object-cover border border-gray-100">
                            @else
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-[10px] uppercase">
                                    {{ substr($log->user->name, 0, 2) }}
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="text-[12px] text-gray-700 leading-tight">
                                <span class="font-bold text-gray-900">{{ $log->user->name }}</span>
                                {{ strtolower($log->activity) }}
                            </p>
                            <div class="flex items-center gap-2 mt-1.5">
                                <span class="text-[10px] text-gray-400 flex items-center gap-1">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $log->created_at->diffForHumans() }}
                                </span>

                                @if($log->section)
                                    <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                    <span class="text-[9px] uppercase font-bold text-blue-500 tracking-wider">
                                        {{ $log->section }}
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

    <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 bg-white">
            <h3 class="font-bold text-gray-800">Daftar Halaman</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-500 text-[11px] uppercase font-bold tracking-wider">
                    <tr>
                        <th class="px-8 py-4">Bagian (Section)</th>
                        <th class="px-6 py-4">Judul Halaman</th>
                        <th class="px-6 py-4">Terakhir Diupdate</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 bg-white text-sm">
                    @forelse($contents as $item)
                    <tr class="hover:bg-blue-50/50 transition-colors group">
                        <td class="px-8 py-4 font-mono text-blue-600 font-bold uppercase text-[11px]">{{ $item->section_key }}</td>
                        <td class="px-6 py-4 text-gray-800 font-semibold">{{ $item->title }}</td>
                        <td class="px-6 py-4 text-gray-500 text-xs">{{ $item->updated_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('anggota.landing.edit', $item->id) }}"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white text-xs font-bold rounded-xl transition-all">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-400 italic text-sm">Belum ada data konten halaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
