<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    // 1. TAMPILKAN DAFTAR UNIT
    public function index(Request $request)
    {
        $query = Unit::latest();

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_unit', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_unit', 'like', '%' . $request->search . '%');
        }

        $units = $query->paginate(10);
        return view('admin.units.index', compact('units'));
    }

    // 2. FORM TAMBAH UNIT
    public function create()
    {
        return view('admin.units.create');
    }

    // 3. SIMPAN UNIT BARU
    public function store(Request $request)
    {
        $request->validate([
            'kode_unit' => 'required|unique:units|max:10',
            'nama_unit' => 'required|max:255',
        ]);

        Unit::create($request->all());

        return redirect()->route('admin.units.index')
            ->with('success', 'Unit kerja berhasil ditambahkan');
    }

    // 4. FORM EDIT UNIT
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('admin.units.edit', compact('unit'));
    }

    // 5. UPDATE UNIT
    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);

        $request->validate([
            'kode_unit' => 'required|max:10|unique:units,kode_unit,' . $id, // Abaikan validasi unique untuk diri sendiri
            'nama_unit' => 'required|max:255',
        ]);

        $unit->update($request->all());

        return redirect()->route('admin.units.index')
            ->with('success', 'Unit kerja berhasil diperbarui');
    }

    // 6. HAPUS UNIT
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return back()->with('success', 'Unit kerja dihapus');
    }
}
