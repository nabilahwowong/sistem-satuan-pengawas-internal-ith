<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    // Menampilkan Arsip (Bisa LHA atau LHR tergantung request)
    public function index(Request $request)
    {
        $query = Archive::with('unit')->latest();

        // Filter berdasarkan kategori (lha atau lhr) dari sidebar
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_laporan', 'like', '%' . $request->search . '%');
        }

        $archives = $query->paginate(10)->appends($request->all());

        // Judul Halaman Dinamis
        $pageTitle = 'Semua Arsip';
        if($request->kategori == 'lha') $pageTitle = 'Arsip Laporan Hasil Audit (LHA)';
        if($request->kategori == 'lhr') $pageTitle = 'Arsip Laporan Hasil Reviu (LHR)';

        return view('admin.archives.index', compact('archives', 'pageTitle'));
    }

    public function create()
    {
        $units = Unit::all();
        return view('admin.archives.create', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'nomor_laporan' => 'required',
            'kategori' => 'required|in:lha,lhr',
            'unit_id' => 'required',
            'tahun' => 'required|numeric',
            'file' => 'required|file|mimes:pdf|max:20480', // Max 20MB (PDF Only)
        ]);

        // Upload File
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/archives', $filename);

        Archive::create([
            'judul' => $request->judul,
            'nomor_laporan' => $request->nomor_laporan,
            'kategori' => $request->kategori,
            'unit_id' => $request->unit_id,
            'tahun' => $request->tahun,
            'file_path' => $filename,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('admin.archives.index', ['kategori' => $request->kategori])
            ->with('success', 'Laporan berhasil diarsipkan');
    }

    public function destroy($id)
    {
        $archive = Archive::findOrFail($id);
        if (Storage::exists('public/archives/' . $archive->file_path)) {
            Storage::delete('public/archives/' . $archive->file_path);
        }
        $archive->delete();
        return back()->with('success', 'Arsip dihapus');
    }
}
