<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReviewSchedule;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewScheduleController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua jadwal, urutkan dari yang terbaru
        $query = ReviewSchedule::with(['unit', 'creator'])->latest();

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_kegiatan', 'like', '%' . $request->search . '%')
                  ->orWhereHas('unit', function($q) use ($request) {
                      $q->where('nama_unit', 'like', '%' . $request->search . '%');
                  });
        }

        $schedules = $query->paginate(10);
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        // Pastikan hanya Anggota SPI yang bisa akses halaman buat
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.schedules.index')
                ->with('error', 'Hanya Anggota SPI yang dapat membuat jadwal.');
        }

        $units = Unit::all();
        return view('admin.schedules.create', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'unit_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required',
        ]);

        ReviewSchedule::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'unit_id' => $request->unit_id,
            'created_by' => Auth::id(), // Otomatis catat ID Anggota yang login
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal reviu berhasil dibuat');
    }

    public function destroy($id)
    {
        // Opsional: Admin atau Pembuat boleh menghapus
        $schedule = ReviewSchedule::findOrFail($id);
        $schedule->delete();
        return back()->with('success', 'Jadwal dihapus');
    }
}
