<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\AuditReport;
use Illuminate\Http\Request;

class LeadershipReportController extends Controller
{
    public function index(Request $request)
    {
        // Query Laporan yang statusnya FINAL
        $query = AuditReport::with('unit')->where('status', 'final');

        // Filter Pencarian
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('judul_laporan', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_laporan', 'like', '%' . $request->search . '%');
            });
        }

        $reports = $query->latest('tanggal_laporan')->paginate(10);

        // Statistik Dashboard (Menggunakan kolom tambahan tadi)
        $stats = [
            'total_laporan' => AuditReport::where('status', 'final')->count(),
            'total_lha' => AuditReport::where('status', 'final')->where('jenis', 'LHA')->count(),
            'total_lhr' => AuditReport::where('status', 'final')->where('jenis', 'LHR')->count(),
            'total_temuan' => AuditReport::where('status', 'final')->sum('jumlah_temuan'),
        ];

        return view('pimpinan.laporan.index', compact('reports', 'stats'));
    }

    public function download($id)
    {
        $report = AuditReport::findOrFail($id);
        return response()->download(storage_path('app/public/' . $report->file_path));
    }
}
