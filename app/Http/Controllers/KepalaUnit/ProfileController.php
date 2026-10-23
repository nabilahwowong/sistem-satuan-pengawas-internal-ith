<?php

namespace App\Http\Controllers\KepalaUnit;

use App\Http\Controllers\Controller;
use App\Models\User; // Tambahkan Import Model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('kepala_unit.profil.index', compact('user'));
    }

    // Update Biodata & Foto
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        // Baris di atas memberitahu editor bahwa $user adalah Model User, bukan sekadar Authenticatable.
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'nip'   => 'nullable|string|max:20',
            'foto'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'nip'   => $request->nip,
        ];

        // Handle Upload Foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada (dan bukan default)
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $path = $request->file('foto')->store('profil', 'public');
            $data['foto_profil'] = $path;
        }

        // Sekarang editor sudah tahu $user adalah model, garis merah akan hilang
        $user->update($data);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    // Update Password Terpisah (Keamanan)
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed', // field konfirmasi: password_confirmation
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }
}
