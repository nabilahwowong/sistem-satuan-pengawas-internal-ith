<?php

namespace App\Http\Controllers\KepalaUnit;

use App\Http\Controllers\Controller;
use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DocumentRequestController extends Controller
{
    // Menampilkan daftar permintaan dokumen milik unit user yang login
    public function index()
    {
        $user = Auth::user();

        $requests = DocumentRequest::with('schedule')
                        ->where('unit_id', $user->unit_id)
                        ->orderBy('deadline', 'asc') // Urutkan deadline terdekat
                        ->paginate(10);

        return view('kepala_unit.dokumen.index', compact('requests'));
    }

    public function upload(Request $request, $id)
    {
    // 1. Validasi Input
    $request->validate([
        'file_dokumen' => 'required|mimes:pdf,doc,docx,xls,xlsx,zip|max:10240',
    ]);

    // 2. Cari Data
    $documentRequest = DocumentRequest::where('unit_id', Auth::user()->unit_id)->findOrFail($id);

    // 3. Hapus file lama jika ada (Sesuai kolom migrasi: file_path_auditi)
    if ($documentRequest->file_path_auditi && Storage::disk('public')->exists($documentRequest->file_path_auditi)) {
        Storage::disk('public')->delete($documentRequest->file_path_auditi);
    }

    // 4. Simpan file baru
    $path = $request->file('file_dokumen')->store('dokumen_audit', 'public');

    // 5. Update Database (Sesuai struktur migrasi Anda)
    $documentRequest->update([
        'file_path_auditi' => $path, // NAMA KOLOM YANG BENAR
        'status'           => 'terkirim',
        'responded_at'     => now(), // Mengisi kolom timestamp respon
    ]);

    // 6. Redirect
    return redirect()->back()->with('success', 'Dokumen berhasil diunggah!');
    }
}
