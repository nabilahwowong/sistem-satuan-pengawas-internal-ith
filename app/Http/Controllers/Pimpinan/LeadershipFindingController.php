<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\AuditFinding;
use Illuminate\Http\Request;

class LeadershipFindingController extends Controller
{
    public function index()
    {
        // 1. Ambil data dasar
        $total = AuditFinding::count();
        $closed = AuditFinding::where('status', 'closed')->count();
        $open = AuditFinding::where('status', 'open')->count();

        // 2. Hitung Rasio (Cegah error pembagian nol)
        $ratio = $total > 0 ? round(($closed / $total) * 100) : 0;

        $stats = [
            'total' => $total,
            'open' => $open,
            'closed' => $closed,
            'ratio' => $ratio, // <--- Key ini wajib ada agar View tidak error
        ];

        // 4. Ambil data untuk tabel
        $findings = AuditFinding::with(['schedule.unit']) // Pastikan relasi schedule & unit ada
                        ->latest()
                        ->paginate(10);

        return view('pimpinan.temuan.index', compact('stats', 'findings'));
    }
}
