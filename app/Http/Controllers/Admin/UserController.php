<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk Transaction

class UserController extends Controller
{
    // 1. REVISI INDEX: Tambahkan Logika Filter & Search
    public function index(Request $request)
    {
        // Mulai query dengan relasi unit
        $query = User::with('unit')->latest();

        // Logika Filter Role (Dropdown)
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // Logika Pencarian (Search Bar)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Pagination 10 per halaman
        $users = $query->paginate(10);

        // Agar filter tidak hilang saat klik next page
        $users->appends($request->all());

        // Perbaiki path view ke 'admin.users.index' (plural)
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $units = Unit::all();
        // Perbaiki path view ke 'admin.users.create'
        return view('admin.users.create', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nip' => 'nullable|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
            // Validasi opsional jika membuat unit baru sekaligus
            'kode_unit_baru' => 'nullable|unique:units,kode_unit',
            'nama_unit_baru' => 'nullable|string'
        ]);

        // MULAI TRANSACTION
        DB::beginTransaction();

        try {
            // 1. CEK APAKAH INI KEPALA UNIT BARU YANG JUGA MEMBUAT UNIT BARU
            // Misal: Admin memilih opsi "Buat Unit Baru" di form dropdown unit
            $unitId = $request->unit_id;

            if ($request->role === 'kepala_unit' && $request->filled('kode_unit_baru') && $request->filled('nama_unit_baru')) {
                // Buat unit baru tanpa kepala_unit_id dulu
                $newUnit = Unit::create([
                    'kode_unit' => $request->kode_unit_baru,
                    'nama_unit' => $request->nama_unit_baru,
                ]);
                $unitId = $newUnit->id;
            }

            // 2. BUAT USER
            $user = User::create([
                'name' => $request->name,
                'gelar_depan' => $request->gelar_depan,
                'gelar_belakang' => $request->gelar_belakang,
                'nip' => $request->nip,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'unit_id' => $unitId,
                'is_active' => 1
            ]);

            // 3. JIKA TADI MEMBUAT UNIT BARU, UPDATE KEPALA UNITNYA SEKARANG
            if (isset($newUnit)) {
                $newUnit->update(['kepala_unit_id' => $user->id]);
            }

            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Gagal membuat pengguna: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $units = Unit::all();
        return view('admin.users.edit', compact('user', 'units'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'nip' => 'nullable|unique:users,nip,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang,
            'nip' => $request->nip,
            'email' => $request->email,
            'role' => $request->role,
            'unit_id' => $request->unit_id,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Pengguna dihapus');
    }
}
