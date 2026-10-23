<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditFinding;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuditFindingController extends Controller
{
    // 1. TAMPILKAN DAFTAR TEMUAN
    public function index()
    {
        $findings = AuditFinding::with(['unit', 'auditor'])->latest()->paginate(10);
        return view('admin.audit.index', compact('findings'));
    }

    // 2. TAMPILKAN FORM BUAT BARU
    public function create()
    {
        $units = Unit::all();
        // Generate Nomor Otomatis (AUD/Tahun/Urutan)
        $nextId = AuditFinding::max('id') + 1;
        $autoNumber = 'AUD/' . date('Y') . '/' . sprintf("%03d", $nextId);

        return view('admin.audit.create', compact('units', 'autoNumber'));
    }

    // 3. PROSES SIMPAN KE DATABASE
    public function store(Request $request)
    {
        $request->validate([
            'no_referensi' => 'required|unique:audit_findings',
            'judul' => 'required',
            'unit_id' => 'required',
            'kondisi' => 'required',
            'kriteria' => 'required',
            'sebab' => 'required',
            'akibat' => 'required',
            'rekomendasi' => 'required',
            'lampiran' => 'nullable|file|mimes:pdf,xls,xlsx,doc,docx,jpg,png|max:10240' // Max 10MB
        ]);

        // Logic Upload File
        $filePath = null;
        $fileType = null;

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Simpan ke folder: storage/app/public/audit_files
            $file->storeAs('public/audit_files', $filename);

            $filePath = $filename;
            $fileType = $file->getClientOriginalExtension();
        }

        // Simpan Data
        AuditFinding::create([
            'no_referensi' => $request->no_referensi,
            'judul' => $request->judul,
            'unit_id' => $request->unit_id,
            'auditor_id' => Auth::id(), // Ambil ID user yang sedang login
            'kondisi' => $request->kondisi,
            'kriteria' => $request->kriteria,
            'sebab' => $request->sebab,
            'akibat' => $request->akibat,
            'rekomendasi' => $request->rekomendasi,
            'file_path' => $filePath,
            'tipe_file' => $fileType,
            'status' => 'draft'
        ]);

        return redirect()->route('admin.audit.index')->with('success', 'Kertas kerja audit berhasil dibuat');
    }

    // 4. TAMPILKAN DETAIL (CETAK)
    public function show($id)
    {
        $finding = AuditFinding::with(['unit', 'auditor'])->findOrFail($id);
        return view('admin.audit.show', compact('finding'));
    }
}
