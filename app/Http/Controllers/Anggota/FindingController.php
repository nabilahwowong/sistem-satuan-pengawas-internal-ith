<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\AuditFinding;
use App\Models\ReviewSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FindingController extends Controller
{
    public function index()
    {
        $findings = AuditFinding::with('schedule.unit')
                    ->where('auditor_id', Auth::id())
                    ->latest()
                    ->paginate(10);

        return view('anggota.findings.index', compact('findings'));
    }

    public function create()
    {
        $schedules = ReviewSchedule::where('status', '!=', 'Selesai')->get();
        return view('anggota.findings.create', compact('schedules'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (Tambahkan 'judul' di sini)
        $request->validate([
            'review_schedule_id' => 'required|exists:review_schedules,id',
            'judul'              => 'required|string|max:255', // <--- WAJIB ADA
            'kondisi'            => 'required|string',
            'kriteria'           => 'required|string',
            'sebab'              => 'required|string',
            'akibat'             => 'required|string',
            'rekomendasi'        => 'required|string',
            'kategori'           => 'required|in:ringan,sedang,berat',
        ]);

        $kode = 'TM-' . strtoupper(Str::random(6));
        $schedule = ReviewSchedule::findOrFail($request->review_schedule_id);

        AuditFinding::create([
            'review_schedule_id' => $request->review_schedule_id,
            'unit_id'            => $schedule->unit_id,
            'auditor_id'         => Auth::id(),

            'judul'              => $request->judul,

            'no_referensi'       => $kode,
            'kondisi'            => $request->kondisi,
            'kriteria'           => $request->kriteria,
            'sebab'              => $request->sebab,
            'akibat'             => $request->akibat,
            'rekomendasi'        => $request->rekomendasi,
            'kategori'           => $request->kategori,
            'status'             => 'open',
        ]);

        return redirect()->route('anggota.findings.index')->with('success', 'Temuan berhasil dicatat.');
    }

    public function closeFinding($id)
    {
        $finding = AuditFinding::where('auditor_id', Auth::id())->findOrFail($id);

        $finding->update([
            'status' => 'closed',
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Temuan berhasil diverifikasi dan ditutup.');
    }
}
