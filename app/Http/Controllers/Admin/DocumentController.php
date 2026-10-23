<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    // 1. LIHAT SEMUA DOKUMEN
    public function index(Request $request)
    {
        $query = Document::latest();

        // Filter jika ada request kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $documents = $query->paginate(10)->appends($request->all());

        $pageTitle = 'Semua Dokumen';
        if ($request->kategori == 'pedoman_audit') $pageTitle = 'Pedoman Audit';
        if ($request->kategori == 'pedoman_reviu') $pageTitle = 'Pedoman Reviu';
        if ($request->kategori == 'template') $pageTitle = 'Template Dokumen';

        return view('admin.documents.index', compact('documents', 'pageTitle'));
    }

    // 2. FORM UPLOAD
    public function create()
    {
        return view('admin.documents.create');
    }

    // 3. PROSES SIMPAN (PENTING)
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required|in:pedoman_audit,pedoman_reviu,template',
            'file' => 'required|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        $file = $request->file('file');

        // Simpan file ke folder: storage/app/public/documents
        $path = $file->store('documents', 'public');

        Document::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori, // Kunci Integrasi ada di sini
            'file_path' => $path,
            'tipe_file' => $file->getClientOriginalExtension(),
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('admin.documents.index', ['kategori' => $request->kategori])
            ->with('success', 'Dokumen berhasil diunggah');
    }

    // 4. HAPUS
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }
        $document->delete();
        return back()->with('success', 'Dokumen dihapus');


    }
}
