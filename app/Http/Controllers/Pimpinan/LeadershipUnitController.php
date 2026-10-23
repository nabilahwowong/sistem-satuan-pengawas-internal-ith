<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class LeadershipUnitController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua unit beserta relasinya untuk efisiensi (Eager Loading)
        $query = Unit::with(['kepala', 'auditReports', 'sakipReviews']);

        // Filter Pencarian
        if ($request->has('search')) {
            $query->where('nama_unit', 'like', '%' . $request->search . '%');
        }

        $unitsRaw = $query->get();

        // Olah data untuk menambahkan statistik per unit
        $units = $unitsRaw->map(function ($unit) {
            // 1. Hitung Total Temuan (Audit + Keuangan)
            $temuanAudit = $unit->auditReports->where('status', 'final')->sum('jumlah_temuan');
            // Jika ada relasi ke financialReviews, tambahkan juga
            // $temuanKeu = $unit->financialReviews->where('status', 'final')->sum('jumlah_temuan_kepatuhan');

            $unit->total_temuan = $temuanAudit; // + $temuanKeu;

            // 2. Ambil Nilai SAKIP Terakhir
            $lastSakip = $unit->sakipReviews->where('status', 'final')->sortByDesc('tahun')->first();
            $unit->nilai_sakip = $lastSakip ? $lastSakip->nilai_akhir : 0;
            $unit->predikat_sakip = $lastSakip ? $lastSakip->predikat : '-';

            // 3. Tentukan Status Kesehatan Unit
            if ($unit->total_temuan > 10) {
                $unit->status_label = 'Perlu Perhatian';
                $unit->status_color = 'bg-red-100 text-red-700 border-red-200';
            } elseif ($unit->total_temuan > 0) {
                $unit->status_label = 'Cukup';
                $unit->status_color = 'bg-yellow-100 text-yellow-700 border-yellow-200';
            } else {
                $unit->status_label = 'Sangat Baik';
                $unit->status_color = 'bg-green-100 text-green-700 border-green-200';
            }

            return $unit;
        });

        // Statistik Header
        $stats = [
            'total_unit' => $units->count(),
            'unit_patuh' => $units->where('total_temuan', 0)->count(),
            'perlu_pembinaan' => $units->where('total_temuan', '>', 5)->count(),
        ];

        // Manual Pagination (karena kita pakai map collection)
        // Atau kirim collection langsung jika data unit sedikit (<50)

        return view('pimpinan.unit.index', compact('units', 'stats'));
    }

    public function show($id)
    {
        // Jika nanti ingin detail per unit
        $unit = Unit::with(['auditReports', 'sakipReviews'])->findOrFail($id);
        return view('pimpinan.unit.show', compact('unit'));
    }
}
