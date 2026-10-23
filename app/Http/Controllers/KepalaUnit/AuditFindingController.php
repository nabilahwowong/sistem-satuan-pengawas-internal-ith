<?php

namespace App\Http\Controllers\KepalaUnit;

use App\Http\Controllers\Controller;
use App\Models\AuditFinding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditFindingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengambil temuan berdasarkan unit_id user yang login
        $findings = AuditFinding::with(['schedule', 'auditor'])
                        ->where('unit_id', $user->unit_id)
                        ->latest()
                        ->paginate(10);

        return view('kepala_unit.temuan.index', compact('findings'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggapan_auditi' => 'required|string|min:5',
        ]);

        // Keamanan: Pastikan temuan tersebut milik unit user yang sedang login
        $finding = AuditFinding::where('unit_id', Auth::user()->unit_id)->findOrFail($id);

        $finding->update([
            'tanggapan_auditi' => $request->tanggapan_auditi,
            'tanggal_tanggapan' => now(),
            'status' => 'responded' // Update status agar Auditor tahu sudah dijawab
        ]);

        return redirect()->back()->with('success', 'Tanggapan berhasil dikirim.');
    }
}
