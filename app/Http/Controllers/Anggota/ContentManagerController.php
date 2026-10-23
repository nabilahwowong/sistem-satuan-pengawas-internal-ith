<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\LandingContent;
use App\Models\ActivityLog; // IMPORT ACTIVITY LOG
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; // IMPORT AUTH

class ContentManagerController extends Controller {
    public function index() {
        $profils = LandingContent::where('category', 'profil')->get();
        $layanans = LandingContent::where('category', 'layanan')->get();
        $programs = LandingContent::where('category', 'program_kerja')->get();

        return view('anggota.cms.index', compact('profils', 'layanans', 'programs'));
    }

    public function edit($id) {
        $content = LandingContent::findOrFail($id);
        return view('anggota.cms.edit', compact('content'));
    }

    public function update(Request $request, $id) {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $content = LandingContent::findOrFail($id);
        $data = $request->only('title', 'content');

        // Jika ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            if ($content->image && Storage::disk('public')->exists($content->image)) {
                Storage::disk('public')->delete($content->image);
            }
            $data['image'] = $request->file('image')->store('landing', 'public');
        }

        $content->update($data);

        // CATAT LOG AKTIVITAS (UPDATE)
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity' => 'Memperbarui konten: ' . $content->title,
                'section' => 'CMS Landing Page',
            ]);
        }

        return redirect()->route('anggota.cms.index')->with('success', 'Berhasil memperbarui halaman ' . $content->title);
    }

    public function create() {
        return view('anggota.cms.create');
    }

    public function store(Request $request) {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|in:profil,layanan,program_kerja',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only('title', 'content', 'category');
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('landing', 'public');
        }

        $newContent = LandingContent::create($data);

        // CATAT LOG AKTIVITAS (CREATE)
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity' => 'Menambahkan konten baru: ' . $newContent->title,
                'section' => 'CMS Landing Page',
            ]);
        }

        return redirect()->route('anggota.cms.index')->with('success', 'Berhasil menambahkan menu baru');
    }

    public function destroy($id) {
        $content = LandingContent::findOrFail($id);
        $title = $content->title; // Simpan judul sebelum dihapus

        if ($content->image && Storage::disk('public')->exists($content->image)) {
            Storage::disk('public')->delete($content->image);
        }

        $content->delete();

        // CATAT LOG AKTIVITAS (DELETE)
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity' => 'Menghapus konten: ' . $title,
                'section' => 'CMS Landing Page',
            ]);
        }

        return redirect()->route('anggota.cms.index')->with('success', 'Berhasil menghapus menu ' . $title);
    }
}
