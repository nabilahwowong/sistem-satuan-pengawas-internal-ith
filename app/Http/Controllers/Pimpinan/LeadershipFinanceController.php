<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\FinancialReview;
use Illuminate\Http\Request;

class LeadershipFinanceController extends Controller
{
    public function index(Request $request)
    {
        // 1. Query Dasar (Status Final)
        $query = FinancialReview::with('unit')->where('status', 'final');

        // 2. Filter (Tahun & Kategori)
        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun_anggaran', $request->tahun);
        }
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $reviews = $query->latest('created_at')->paginate(10);

        // 3. Statistik Dashboard (Executive Summary)
        // Ambil data tahun ini untuk statistik
        $tahunIni = date('Y');

        $totalPagu = FinancialReview::where('kategori', 'anggaran')
                        ->where('tahun_anggaran', $tahunIni)
                        ->sum('pagu_anggaran');

        $totalRealisasi = FinancialReview::where('kategori', 'anggaran')
                        ->where('tahun_anggaran', $tahunIni)
                        ->sum('realisasi_anggaran');

        // Rata-rata serapan seluruh unit
        $avgSerapan = FinancialReview::where('kategori', 'anggaran')
                        ->where('tahun_anggaran', $tahunIni)
                        ->avg('persentase_serapan') ?? 0;

        // Total Temuan Kepatuhan Keuangan
        $totalTemuan = FinancialReview::where('kategori', 'keuangan')
                        ->where('tahun_anggaran', $tahunIni)
                        ->sum('jumlah_temuan_kepatuhan');

        return view('pimpinan.keuangan.index', compact('reviews', 'totalPagu', 'totalRealisasi', 'avgSerapan', 'totalTemuan'));
    }

    public function download($id)
    {
        $data = FinancialReview::findOrFail($id);
        return response()->download(storage_path('app/public/' . $data->file_path));
    }
}
