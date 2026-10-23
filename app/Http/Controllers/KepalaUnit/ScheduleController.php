<?php

namespace App\Http\Controllers\KepalaUnit;

use App\Http\Controllers\Controller;
use App\Models\ReviewSchedule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        // Ambil jadwal HANYA untuk unit user yang login
        // Kita gunakan 'with' ke 'creator' (sesuai nama fungsi di model Anda)
        $schedules = ReviewSchedule::with('creator')
                        ->where('unit_id', Auth::user()->unit_id)
                        ->orderBy('tanggal_mulai', 'desc') // Urutkan dari yang terbaru
                        ->paginate(10);

        return view('kepala_unit.jadwal.index', compact('schedules'));
    }
}
