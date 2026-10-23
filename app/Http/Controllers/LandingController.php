<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $articles = NewsArticle::with('author')
                        ->where('status', 'published')
                        ->orderBy('published_at', 'desc')
                        ->take(3)
                        ->get();

        return view('welcome', compact('articles'));
    }

    public function showBerita($slug)
    {
        // 1. Ambil Detail Berita Utama
        $article = NewsArticle::with('author')
                    ->where('slug', $slug)
                    ->where('status', 'published')
                    ->firstOrFail();

        // 2. Ambil Berita Lainnya untuk Sidebar (PENTING: Ini yang tadi hilang)
        $otherArticles = NewsArticle::where('status', 'published')
                    ->where('id', '!=', $article->id) // Kecualikan berita yang sedang dibaca
                    ->latest()
                    ->take(5)
                    ->get();

        // 3. Kirim kedua variabel ke View
        return view('landing.show_berita', compact('article', 'otherArticles'));
    }
}
