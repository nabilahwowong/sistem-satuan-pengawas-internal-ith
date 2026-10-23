<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\ActivityLog;
use App\Models\User; // Pastikan Model User di-import

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('anggota.profil.index', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var User $user */ // Baris ini untuk menghilangkan error 'Undefined method save' di VS Code
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->name = $request->name;
        $user->nip = $request->nip;

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $user->foto_profil = $request->file('foto_profil')->store('profil', 'public');
        }

        $user->save(); // Sekarang Intelephense tidak akan protes lagi

        // Catat aktivitas ke log
        ActivityLog::create([
            'user_id' => $user->id,
            'activity' => 'Memperbarui informasi profil pribadi',
            'section' => 'Profil',
        ]);

        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        /** @var User $user */ // Baris ini juga ditambahkan di sini
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        ActivityLog::create([
            'user_id' => $user->id,
            'activity' => 'Mengubah password akun',
            'section' => 'Keamanan',
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }
}
