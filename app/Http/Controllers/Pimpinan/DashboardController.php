<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\AuditReport;  // Pastikan Model ini ada
use App\Models\AuditFinding; // Pastikan Model ini ada
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tahunIni = date('Y');

        // --- 1. MENGHITUNG STATISTIK DARI DATABASE ---

        $totalAudit = AuditReport::whereYear('tanggal_laporan', $tahunIni)->count();

        $auditSelesai = AuditReport::whereYear('tanggal_laporan', $tahunIni)
                                   ->where('status', 'final')
                                   ->count();

        // Hitung persentase (cegah error pembagian nol)
        $persenSelesai = $totalAudit > 0 ? round(($auditSelesai / $totalAudit) * 100) : 0;

        // Hitung temuan yang statusnya 'open' (Belum ditindaklanjuti)
        $temuanAktif = AuditFinding::where('status', 'open')->count();

        // Hitung Rasio Kepatuhan (Temuan Closed vs Total Temuan)
        $totalTemuan = AuditFinding::count();
        $temuanClosed = AuditFinding::where('status', 'closed')->count();
        $persenKepatuhan = $totalTemuan > 0 ? round(($temuanClosed / $totalTemuan) * 100) : 0;
        // Jika belum ada temuan sama sekali, bisa di-set 100 atau 0 sesuai kebijakan


        // --- 2. MENGAMBIL DATA TABEL (AUDIT AKTIF) ---

        // Ambil 5 audit terakhir yang statusnya BUKAN final (sedang berjalan)
        $activeAudits = AuditReport::with(['unit', 'auditor'])
                            ->where('status', '!=', 'final')
                            ->latest()
                            ->take(5)
                            ->get()
                            ->map(function($audit) {
                                // Logika Warna & Progress Dummy (Bisa disesuaikan logic-nya)
                                if ($audit->status == 'draft') {
                                    $audit->progress_percent = 50;
                                    $audit->status_label = 'Penyusunan LHA';
                                    $audit->status_color = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                } else {
                                    $audit->progress_percent = 80;
                                    $audit->status_label = 'Reviu Pimpinan';
                                    $audit->status_color = 'bg-blue-100 text-blue-800 border-blue-200';
                                }
                                return $audit;
                            });

        // --- 3. KIRIM DATA KE VIEW ---
        // Variabel ini yang akan ditangkap oleh {{ $... }} di Blade
        return view('pimpinan.dashboard', compact(
            'totalAudit',
            'auditSelesai',
            'persenSelesai',
            'temuanAktif',
            'persenKepatuhan',
            'activeAudits'
        ));
    }
}
