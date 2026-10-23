<?php

namespace App\Http\Controllers\anggota;
use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    // 1. DATA BERITA (Index)
    public function index()
    {
        // Tampilkan berita milik user yang login
        $news = NewsArticle::where('author_id', Auth::id())
                    ->latest()
                    ->paginate(10);

        return view('anggota.portal.index', compact('news'));
    }

    // 2. TULIS BERITA (Create)
    public function create()
    {
        return view('anggota.portal.create');
    }

    // 3. SIMPAN BERITA (Store)
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'thumbnail' => 'nullable|image|max:2048', // Max 2MB
            'status' => 'required|in:draft,published',
        ]);

        $path = null;
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('news_thumbnails', 'public');
        }

        NewsArticle::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . time(),
            'konten' => $request->konten,
            'thumbnail' => $path,
            'status' => $request->status,
            'author_id' => Auth::id(),
            'published_at' => $request->status == 'published' ? now() : null,
        ]);

        return redirect()->route('anggota.portal.index')->with('success', 'Berita berhasil disimpan.');
    }
    public function edit($id)
    {
        $article = NewsArticle::findOrFail($id);

        // Keamanan: Pastikan yang edit adalah penulis aslinya
        if ($article->author_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin mengedit berita ini.');
        }

        return view('anggota.portal.edit', compact('article'));
    }

    // 5. PROSES UPDATE BERITA
    public function update(Request $request, $id)
    {
        $article = NewsArticle::findOrFail($id);

        // Keamanan: Cek kepemilikan
        if ($article->author_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'thumbnail' => 'nullable|image|max:2048', // Max 2MB
            'status' => 'required|in:draft,published',
        ]);

        // Logika Update Thumbnail
        $path = $article->thumbnail; // Default pakai yang lama
        if ($request->hasFile('thumbnail')) {
            // 1. Hapus file lama jika ada
            if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            // 2. Upload file baru
            $path = $request->file('thumbnail')->store('news_thumbnails', 'public');
        }

        // Update Database
        $article->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . time(), // Update slug jika judul berubah
            'konten' => $request->konten,
            'thumbnail' => $path,
            'status' => $request->status,
            // Update tanggal publish hanya jika status berubah jadi published dan tanggalnya masih kosong
            'published_at' => ($request->status == 'published' && !$article->published_at) ? now() : $article->published_at,
        ]);

        return redirect()->route('anggota.portal.index')->with('success', 'Berita berhasil diperbarui.');
    }

    // Opsional: HAPUS BERITA
    public function destroy($id)
    {
        $article = NewsArticle::findOrFail($id);
        if ($article->author_id !== Auth::id()) abort(403);

        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();
        return redirect()->route('anggota.portal.index')->with('success', 'Berita berhasil dihapus.');
    }
}
