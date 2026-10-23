<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\DocumentRequest;
use App\Models\ReviewSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    // --- 1. HALAMAN KIRIM PERMINTAAN ---
    public function create()
    {
        // Ambil jadwal yang masih aktif untuk dropdown
        $schedules = ReviewSchedule::where('status', '!=', 'Selesai')->get();

        // Ambil riwayat permintaan yang SAYA buat
        $myRequests = DocumentRequest::with('schedule.unit')
                        ->where('created_by', Auth::id())
                        ->latest()
                        ->paginate(5);

        return view('anggota.documents.create', compact('schedules', 'myRequests'));
    }

    // PROSES SIMPAN PERMINTAAN
    public function store(Request $request)
    {
        $request->validate([
            'review_schedule_id' => 'required|exists:review_schedules,id', // Pastikan ID valid
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'nullable|date', // Tambahkan validasi deadline
        ]);

        // 1. Ambil data Jadwal untuk mendapatkan unit_id
        $schedule = ReviewSchedule::findOrFail($request->review_schedule_id);

        // 2. Simpan dengan menyertakan unit_id
        DocumentRequest::create([
            'review_schedule_id' => $request->review_schedule_id,
            'unit_id'            => $schedule->unit_id, // <--- INI YANG KURANG SEBELUMNYA
            'judul'              => $request->judul,
            'deskripsi'          => $request->deskripsi,
            'deadline'           => $request->deadline,
            'created_by'         => Auth::id(),
            'status'             => 'pending'
        ]);

        return redirect()->back()->with('success', 'Permintaan dokumen berhasil dikirim ke Unit.');
    }

    // --- 2. HALAMAN DATA TANGGAPAN ---
    public function responses()
    {
        $responses = DocumentRequest::with(['schedule.unit', 'unit'])
                        ->where('created_by', Auth::id()) // Hanya permintaan buatan saya
                        ->where('status', '!=', 'pending') // <--- PERUBAHAN UTAMA
                        ->latest('updated_at')
                        ->paginate(10);

        return view('anggota.documents.responses', compact('responses'));
    }

    // --- 3. FITUR VERIFIKASI (WAJIB DITAMBAHKAN) ---
    // Method ini diperlukan agar tombol "Terima" dan "Tolak" di tabel berfungsi
    public function verify(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:fulfilled,rejected',
        ]);

        // Pastikan hanya bisa memverifikasi dokumen buatan sendiri
        $doc = DocumentRequest::where('created_by', Auth::id())->findOrFail($id);

        $doc->update([
            'status' => $request->status,
        ]);

        $msg = $request->status == 'fulfilled' ? 'Dokumen diterima (Selesai).' : 'Dokumen ditolak (Dikembalikan ke Unit).';

        return redirect()->back()->with('success', $msg);
    }
}
