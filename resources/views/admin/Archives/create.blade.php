<!DOCTYPE html>
<html lang="id">
<head>
    <title>Arsipkan Laporan | Admin SPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <h2 class="text-xl font-bold mb-6 text-gray-800">Arsipkan Laporan Final</h2>

        <form action="{{ route('admin.archives.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- KATEGORI --}}
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">Jenis Laporan</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="cursor-pointer">
                        <input type="radio" name="kategori" value="lha" class="peer sr-only" required>
                        <div class="p-3 text-center border rounded-lg peer-checked:bg-purple-100 peer-checked:border-purple-500 peer-checked:text-purple-700 hover:bg-gray-50">
                            <span class="text-sm font-bold">LHA (Audit)</span>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="kategori" value="lhr" class="peer sr-only">
                        <div class="p-3 text-center border rounded-lg peer-checked:bg-teal-100 peer-checked:border-teal-500 peer-checked:text-teal-700 hover:bg-gray-50">
                            <span class="text-sm font-bold">LHR (Reviu)</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">Unit Kerja</label>
                <select name="unit_id" class="w-full border rounded-lg p-2.5 text-sm" required>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->nama_unit }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="col-span-2">
                    <label class="block text-sm font-bold mb-2 text-gray-700">Nomor Laporan</label>
                    <input type="text" name="nomor_laporan" placeholder="No. LHA / LHR" class="w-full border rounded-lg p-2.5 text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Tahun</label>
                    <input type="number" name="tahun" value="{{ date('Y') }}" class="w-full border rounded-lg p-2.5 text-sm" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">Judul Laporan</label>
                <input type="text" name="judul" class="w-full border rounded-lg p-2.5 text-sm" placeholder="Contoh: Audit Keuangan Fakultas Teknik..." required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2 text-gray-700">Upload File Final (PDF)</label>
                <input type="file" name="file" accept=".pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                <p class="text-[10px] text-gray-500 mt-1">*Pastikan file sudah ditandatangani.</p>
            </div>

            <div class="flex justify-end gap-4 border-t pt-4">
                <a href="{{ route('admin.archives.index') }}" class="px-4 py-2 text-sm text-gray-500">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg text-sm font-bold shadow hover:bg-blue-700">Simpan Arsip</button>
            </div>
        </form>
    </div>
</body>
</html>
