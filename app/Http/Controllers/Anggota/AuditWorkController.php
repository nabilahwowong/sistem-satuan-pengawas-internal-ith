<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\AuditFinding;
use App\Models\WorkGuideline;
use App\Models\AuditWorkingPaper;
use App\Models\AuditDataPaper;
use App\Models\ReviewSchedule;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuditWorkController extends Controller
{
   public function pedoman(Request $request)
    {
        // 1. Ambil parameter 'type' dari URL (audit atau review)
        $type = $request->get('type', 'audit');

        // 2. Konversi 'type' URL menjadi 'kategori' Database
        // URL: audit  -> DB: pedoman_audit
        // URL: review -> DB: pedoman_reviu
        $kategoriDb = ($type == 'audit') ? 'pedoman_audit' : 'pedoman_reviu';

        // 3. Query ke tabel documents
        $guidelines = Document::where('kategori', $kategoriDb)
                        ->latest()
                        ->paginate(10);
        return view('anggota.audit.pedoman', compact('guidelines', 'type'));
    }

    public function templates()
    {
        // Ambil dokumen yang kategorinya 'template'
        $documents = Document::where('kategori', 'template')
                        ->latest()
                        ->paginate(10);

        return view('anggota.audit.templates', compact('documents'));
    }

    public function kkaIndex()
    {
        // Tampilkan KKA milik user yang login
        $papers = AuditWorkingPaper::with('schedule.unit')
                    ->where('created_by', Auth::id())
                    ->latest()
                    ->paginate(10);

        return view('anggota.audit.kka-index', compact('papers'));
    }

    public function kkaCreate()
    {
        // Ambil jadwal yang statusnya 'Berjalan' atau 'Terjadwal'
        $schedules = ReviewSchedule::where('status', '!=', 'Selesai')->get();
        $guidelines = WorkGuideline::all();

        return view('anggota.audit.kka-create', compact('schedules', 'guidelines'));
    }

    public function kkaStore(Request $request)
    {
        $request->validate([
            'review_schedule_id' => 'required',
            'kondisi' => 'required',
            'kriteria' => 'required',
            'sebab' => 'required',
            'akibat' => 'required',
            'rekomendasi' => 'required',
        ]);

        AuditWorkingPaper::create([
            'review_schedule_id' => $request->review_schedule_id,
            'work_guideline_id' => $request->work_guideline_id,
            'kondisi' => $request->kondisi,
            'kriteria' => $request->kriteria,
            'sebab' => $request->sebab,
            'akibat' => $request->akibat,
            'rekomendasi' => $request->rekomendasi,
            'created_by' => Auth::id(),
            'status' => 'draft'
        ]);

        return redirect()->route('anggota.audit.kka-index')->with('success', 'Kertas Kerja berhasil disimpan.');
    }

   public function kdaIndex()
    {
        $kdas = AuditFinding::with('schedule.unit')
                    ->where('created_by', Auth::id())
                    ->latest()
                    ->paginate(10);

        return view('anggota.audit.kda-index', compact('kdas'));
    }

    // 2. Form Tambah KDA Baru
    public function kdaCreate()
    {
        // Hanya ambil jadwal yang sedang berjalan
        $schedules = ReviewSchedule::where('status', 'Sedang Berjalan')->get();
        return view('anggota.audit.kda-create', compact('schedules'));
    }

    // 3. Simpan KDA (Integrasi ke Pimpinan dimulai disini)
    public function kdaStore(Request $request)
    {
        $request->validate([
            'review_schedule_id' => 'required',
            'kondisi'     => 'required',
            'kriteria'    => 'required',
            'sebab'       => 'required',
            'akibat'      => 'required',
            'rekomendasi' => 'required',
        ]);

        // Buat Kode Temuan Otomatis (Contoh: KDA-001)
        $count = AuditFinding::count() + 1;
        $kode  = 'KDA-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        AuditFinding::create([
            'review_schedule_id' => $request->review_schedule_id,
            'kode_temuan' => $kode,
            'kondisi'     => $request->kondisi,
            'kriteria'    => $request->kriteria,
            'sebab'       => $request->sebab,
            'akibat'      => $request->akibat,
            'rekomendasi' => $request->rekomendasi,
            'status'      => 'open', // Status OPEN akan mentrigger notif merah di Pimpinan
            'created_by'  => Auth::id(),
        ]);

        return redirect()->route('anggota.audit.kda-index')
                         ->with('success', 'Kertas Data Audit (Temuan) berhasil dikirim ke Pimpinan.');
    }
}
