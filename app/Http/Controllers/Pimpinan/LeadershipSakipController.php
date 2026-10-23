<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\SakipReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LeadershipSakipController extends Controller
{
    public function index(Request $request)
    {
        // 1. Tentukan Tahun (Default tahun ini)
        $tahunIni = $request->tahun ?? date('Y');

        // 2. Query Dasar (Re-usable)
        // Penting: Filter 'final' diterapkan di sini agar konsisten untuk semua perhitungan
        $baseQuery = SakipReview::where('status', 'final');

        // Clone query untuk list data agar tidak mengganggu query statistik
        $listQuery = clone $baseQuery;

        // Filter tahun untuk list data (jika ada request khusus)
        // Jika user filter tahun 2023, list ikut 2023. Jika tidak, list tampilkan semua history (sesuai logic awal Anda)
        if ($request->has('tahun') && $request->tahun != '') {
            $listQuery->where('tahun', $request->tahun);
        }

        $reviews = $listQuery->with('unit')->latest('tahun')->paginate(10);

        // --- STATISTIK DASHBOARD (Hanya Tahun Terpilih) ---

        // Buat query khusus statistik tahun ini yang sudah difilter 'final'
        $statsQuery = SakipReview::where('status', 'final')->where('tahun', $tahunIni);

        // A. Rata-rata Nilai & Komponen (DIOPTIMALKAN: 1 Query untuk semua)
        $aggregates = $statsQuery->selectRaw('
            avg(nilai_akhir) as rata_nilai,
            avg(nilai_perencanaan) as avg_perencanaan,
            avg(nilai_pengukuran) as avg_pengukuran,
            avg(nilai_pelaporan) as avg_pelaporan,
            avg(nilai_evaluasi) as avg_evaluasi,
            avg(nilai_capaian) as avg_capaian
        ')->first();

        // Assign ke variabel agar mudah dipanggil di view
        $avgNilai = $aggregates->rata_nilai ?? 0;
        $avgKomponen = [
            'perencanaan' => $aggregates->avg_perencanaan ?? 0,
            'pengukuran'  => $aggregates->avg_pengukuran ?? 0,
            'pelaporan'   => $aggregates->avg_pelaporan ?? 0,
            'evaluasi'    => $aggregates->avg_evaluasi ?? 0,
            'capaian'     => $aggregates->avg_capaian ?? 0,
        ];

        // B. Predikat Terbanyak (Mode)
        $predikatDominan = $statsQuery->clone() // Gunakan clone agar query sebelumnya aman
            ->select('predikat', DB::raw('count(*) as total'))
            ->groupBy('predikat')
            ->orderByDesc('total')
            ->first(); // Bisa null jika data kosong

        return view('pimpinan.sakip.index', compact('reviews', 'avgNilai', 'predikatDominan', 'avgKomponen', 'tahunIni'));
    }

    public function download($id)
    {
        $data = SakipReview::findOrFail($id);

        // Ini akan menampilkan path lengkap di layar browser
        dd([
            'Path di Database' => $data->file_path,
            'Path Lengkap Sistem' => storage_path('app/public/' . $data->file_path),
            'Apakah File Ada?' => file_exists(storage_path('app/public/' . $data->file_path))
        ]);
    }

}
