<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Penerapan Algoritma Bcrypt (Manual Check)
        $user = User::where('email', $request->email)->first();

        // 3. Logika Inti Bcrypt:
        if ($user && Hash::check($request->password, $user->password)) {

            // Jika hash cocok, lakukan login sesi
            Auth::login($user);
            $request->session()->regenerate();

            // Cek Role
            $role = $user->role;

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
                    Auth::logout();
                    return back()->with('error', 'Role tidak valid.');
            }
        }

        // Jika user tidak ada atau password salah
        return back()->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil keluar.');
    }
}
