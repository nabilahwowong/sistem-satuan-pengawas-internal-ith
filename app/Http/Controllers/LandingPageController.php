<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\LandingContent; // Import model LandingContent ditambahkan di sini
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingPageController extends Controller
{

    public function show($slug) {
        // REVISI: Ganti 'Content' menjadi 'LandingContent' dan 'section_key' menjadi 'slug'
        $content = LandingContent::where('slug', $slug)->firstOrFail();

        return view('landing.detail', compact('content'));
    }

    /**
     * Menampilkan daftar konten yang bisa diedit oleh Anggota SPI
     */
    public function indexAdmin() {
        $contents = Content::all();

        // Ambil 3 riwayat aktivitas terbaru beserta data usernya
        $recentLogs = ActivityLog::with('user')->latest()->take(3)->get();

        return view('anggota.landing.index', compact('contents', 'recentLogs'));
    }

    /**
     * Menampilkan form edit konten
     */
    public function edit($id) {
        $content = Content::findOrFail($id);
        return view('anggota.landing.edit', compact('content'));
    }

    /**
     * Menyimpan perubahan konten dan mencatat aktivitas anggota
     */
    public function update(Request $request, $id) {
        $content = Content::findOrFail($id);

        // Validasi data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        // Update konten
        $content->update($request->only(['title', 'content']));

        // PROSES PENCATATAN LOG AKTIVITAS
        ActivityLog::create([
            'user_id' => Auth::id(), // ID Anggota yang sedang login
            'activity' => 'Memperbarui data ' . $content->title,
            'section' => 'Landing Page',
        ]);

        return redirect()->route('anggota.landing.index')->with('success', 'Konten berhasil diperbarui!');
    }
}
