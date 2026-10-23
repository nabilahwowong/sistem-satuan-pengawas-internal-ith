<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\DocumentRequest;
use App\Models\LandingContent;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {

        }

    public function boot()
    {

        View::composer('*', function ($view) {
            $view->with('menu_profil', LandingContent::where('category', 'profil')->get());
            $view->with('menu_layanan', LandingContent::where('category', 'layanan')->get());
            $view->with('menu_program', LandingContent::where('category', 'program_kerja')->get());
        });

        View::composer('kepala_unit.components.sidebar', function ($view) {

            $count = 0;

            // Cek apakah user login & role-nya kepala unit
            if (Auth::check() && Auth::user()->role === 'kepala_unit') {
                $count = DocumentRequest::where('unit_id', Auth::user()->unit_id)
                            ->where('status', 'pending') // Hitung yang statusnya masih 'pending'
                            ->count();
            }

            // Kirim variabel $reqCount ke view
            $view->with('reqCount', $count);
        });
    }
}
