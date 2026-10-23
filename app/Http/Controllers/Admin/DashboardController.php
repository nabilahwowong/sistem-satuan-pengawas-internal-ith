<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReviewSchedule; // Asumsi: Jadwal Reviu = Audit
use App\Models\AuditFinding;   // Temuan Audit
use App\Models\Unit;           // Unit Kerja
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. DATA CARD STATISTIK
        $totalAudit = ReviewSchedule::count();
        $auditBerjalan = ReviewSchedule::where('status', 'berjalan')->count();
        $totalTemuan = AuditFinding::count(); // Mengambil total temuan dari Kertas Kerja
        $totalUnit = Unit::count();

        // 2. DATA TABEL TERBARU (Ambil 5 jadwal terakhir)
        $latestAudits = ReviewSchedule::with('unit')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalAudit',
            'auditBerjalan',
            'totalTemuan',
            'totalUnit',
            'latestAudits'
        ));
    }
}
