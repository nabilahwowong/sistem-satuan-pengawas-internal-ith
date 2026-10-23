<?php

namespace App\Http\Controllers\KepalaUnit;

use App\Http\Controllers\Controller;
use App\Models\ReviewSchedule;
use App\Models\DocumentRequest;
use App\Models\AuditFinding;
use App\Models\Unit; // TAMBAHKAN IMPORT INI
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $unitId = $user->unit_id;

        // AMBIL DATA UNIT UNTUK NAMA HEADER DINAMIS
        $unit = Unit::find($unitId);

        // NAMA UNIT DINAMIS (Jika tidak ada unit, beri nilai default)
        $namaUnit = $unit ? $unit->nama_unit : 'Belum Ada Unit';

        // PENGAMAN: JIKA KEPALA UPT BELUM DIHUBUNGKAN KE UNIT MANAPUN
        if (!$unitId) {
            $counts = ['jadwal' => 0, 'dokumen' => 0, 'temuan' => 0, 'selesai' => 0];
            $recentDocuments = [];
            return view('kepala_unit.main_dashboard', compact('counts', 'recentDocuments', 'namaUnit'));
        }

        // 1. DATA KARTU STATISTIK (Menggunakan kodemu yang sudah bagus)
        $counts = [
            'jadwal'   => ReviewSchedule::where('unit_id', $unitId)->count(),
            'dokumen'  => DocumentRequest::where('unit_id', $unitId)->count(),
            'temuan'   => AuditFinding::where('unit_id', $unitId)->where('status', 'open')->count(),
            'selesai'  => DocumentRequest::where('unit_id', $unitId)->where('status', 'fulfilled')->count(),
        ];

        // 2. DATA TABEL (5 Permintaan Dokumen Terbaru)
        $recentDocuments = DocumentRequest::with('schedule')
                            ->where('unit_id', $unitId)
                            ->latest()
                            ->take(5)
                            ->get();

        // PASTIKAN memanggil view 'main_dashboard' agar sesuai dengan template layout
        return view('kepala_unit.main_dashboard', compact('counts', 'recentDocuments', 'namaUnit'));
    }
}
