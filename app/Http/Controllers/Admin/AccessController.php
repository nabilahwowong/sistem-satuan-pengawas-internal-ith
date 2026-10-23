<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    // Tampilkan daftar user khusus untuk manajemen akses
    public function index()
    {
        // Ambil data user, urutkan berdasarkan role agar admin di atas
        $users = User::with('unit')->orderBy('role')->paginate(10);
        return view('admin.access.index', compact('users'));
    }

    // Tampilkan form edit khusus akses (Role & Status)
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $units = Unit::all();
        return view('admin.access.edit', compact('user', 'units'));
    }

    // Proses simpan perubahan akses
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'role' => 'required|in:admin,anggota,kepala_unit,pimpinan',
            'unit_id' => 'nullable|exists:units,id',
            'status_akun' => 'required|in:1,0', // 1: Aktif, 0: Blokir
        ]);

        $user->update([
            'role' => $request->role,
            'unit_id' => $request->unit_id,
            'is_active' => $request->status_akun
        ]);

        return redirect()->route('admin.access.index')
            ->with('success', 'Hak akses pengguna berhasil diperbarui!');
    }
}
