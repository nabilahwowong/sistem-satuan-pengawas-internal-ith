<?php

namespace App\Http\Controllers\anggota;
use App\Http\Controllers\Controller;
use App\Models\AuditReport;
use App\Models\ReviewSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    // --- 1. MENU LHA (Laporan Hasil Audit) ---
    public function indexLHA()
    {
        $reports = AuditReport::with('schedule.unit')
                    ->where('jenis', 'LHA')
                    ->where('created_by', Auth::id())
                    ->latest()
                    ->paginate(10);

        return view('anggota.reports.lha-index', compact('reports'));
    }

    // --- 2. MENU LHR (Laporan Hasil Reviu) ---
    public function indexLHR()
    {
        $reports = AuditReport::with('schedule.unit')
                    ->where('jenis', 'LHR')
                    ->where('created_by', Auth::id())
                    ->latest()
                    ->paginate(10);

        return view('anggota.reports.lhr-index', compact('reports'));
    }

    // --- FORM UPLOAD (Bisa dipakai LHA atau LHR) ---
    public function create(Request $request)
    {
        // Tangkap jenis dari URL (LHA atau LHR)
        $jenis = $request->get('jenis', 'LHA');

        // Ambil jadwal aktif
        $schedules = ReviewSchedule::where('status', '!=', 'Selesai')->get();

        return view('anggota.reports.create', compact('schedules', 'jenis'));
    }

    // --- PROSES SIMPAN ---
   public function store(Request $request)
    {
        $request->validate([
            'review_schedule_id' => 'required',
            'jenis' => 'required|in:LHA,LHR',
            'nomor_laporan' => 'required|string',
            'judul_laporan' => 'required|string',
            'tanggal_laporan' => 'required|date',
            'file_laporan' => 'required|mimes:pdf,doc,docx|max:10240', // Saya naikkan jadi 10MB
        ]);

        // 1. Ambil data Jadwal untuk mendapatkan ID Unit
        $schedule = ReviewSchedule::findOrFail($request->review_schedule_id);

        $path = $request->file('file_laporan')->store('reports', 'public');

        AuditReport::create([
            'review_schedule_id' => $request->review_schedule_id,
            'unit_id'            => $schedule->unit_id, // <--- INI TAMBAHAN PENTINGNYA
            'jenis'              => $request->jenis,
            'nomor_laporan'      => $request->nomor_laporan,
            'judul_laporan'      => $request->judul_laporan,
            'tanggal_laporan'    => $request->tanggal_laporan,
            'file_path'          => $path,
            'created_by'         => Auth::id(),
            'status'             => 'final'
        ]);

        $route = $request->jenis == 'LHA' ? 'anggota.reports.lha' : 'anggota.reports.lhr';
        return redirect()->route($route)->with('success', 'Laporan berhasil diunggah.');
    }
}
