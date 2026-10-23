<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ReviewSchedule;
use App\Models\Document;
use App\Models\AuditResponse;
use App\Models\AuditReport;
use App\Models\ActivityLog; // Import model ActivityLog yang baru dibuat

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Hitung Statistik (Sama untuk semua anggota)
        $countPekerjaan = ReviewSchedule::count();
        $countDokumen = AuditResponse::count();
        $countLaporan = AuditReport::count() ?? 0;
        $countTemuan = 0;

        // 2. Ambil data tugas terbaru untuk tabel di dashboard
        $recentTasks = ReviewSchedule::with('unit')->latest()->take(5)->get();

        // 3. AMBIL LOG AKTIVITAS TERBARU
        $recentActivities = ActivityLog::with('user')
            ->latest()
            ->take(5)
            ->get();

        // REVISI UTAMA:
        return view('anggota.main_dashboard', compact(
            'countPekerjaan',
            'countDokumen',
            'countLaporan',
            'countTemuan',
            'recentTasks',
            'recentActivities'
        ));
    }
}
