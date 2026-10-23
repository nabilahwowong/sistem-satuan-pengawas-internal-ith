<?php

namespace App\Http\Controllers\Anggota; 

use App\Http\Controllers\Controller;
use App\Models\ReviewSchedule;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewScheduleController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'kepala_unit') {
            $schedules = ReviewSchedule::with('unit')
                            ->where('unit_id', $user->unit_id)
                            ->latest()
                            ->paginate(10);
        } else {
            $schedules = ReviewSchedule::with('unit')
                            ->latest()
                            ->paginate(10);
        }

        return view('anggota.schedules.index', compact('schedules'));
    }

    public function create()
    {
        // Cek Role
        if (Auth::user()->role === 'kepala_unit') {
            abort(403, 'Anda tidak memiliki izin membuat jadwal.');
        }

        // Ambil data unit
        $units = Unit::all();

        // PANGGIL VIEW ANGGOTA (Sudah Benar)
        return view('anggota.schedules.create', compact('units'));
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'nama_kegiatan'   => 'required|string|max:255',
            'unit_id'         => 'required|exists:units,id', // Pastikan tabel 'units' ada
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jenis_penugasan' => 'required|string',
        ]);

        // Simpan
        ReviewSchedule::create([
            'nama_kegiatan'   => $request->nama_kegiatan,
            'unit_id'         => $request->unit_id,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jenis_penugasan' => $request->jenis_penugasan,
            'status'          => 'Terjadwal',
            'created_by'      => Auth::id(),
        ]);

        return redirect()->route('anggota.schedules.index')->with('success', 'Jadwal berhasil dibuat!');
    }
}
