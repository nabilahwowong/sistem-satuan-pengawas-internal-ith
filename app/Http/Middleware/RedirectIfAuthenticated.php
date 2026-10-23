<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // Cek apakah user SUDAH Login?
            if (Auth::guard($guard)->check()) {

                // Jika SUDAH Login, kita cek rolenya
                $role = Auth::user()->role;

                switch ($role) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'anggota':
                        return redirect()->route('anggota.dashboard');
                    case 'kepala_unit':
                        return redirect()->route('kepala_unit.dashboard');
                    case 'pimpinan':
                        return redirect()->route('pimpinan.dashboard');
                    default:
                        return redirect('/'); // Jika role aneh, baru lempar ke home
                }
            }
        }

        // Jika BELUM Login, silakan lanjut buka halaman Login
        return $next($request);
    }
}
