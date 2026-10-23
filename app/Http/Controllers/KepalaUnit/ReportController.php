<?php

namespace App\Http\Controllers\KepalaUnit;

use App\Http\Controllers\Controller;
use App\Models\AuditReport; // Pakai model yang sama dengan Anggota
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        // Ambil semua laporan (LHA & LHR) milik unit ini
        $reports = AuditReport::with(['auditor', 'schedule'])
                        ->where('unit_id', Auth::user()->unit_id)
                        ->latest('tanggal_laporan')
                        ->paginate(10);

        return view('kepala_unit.laporan.index', compact('reports'));
    }
}
