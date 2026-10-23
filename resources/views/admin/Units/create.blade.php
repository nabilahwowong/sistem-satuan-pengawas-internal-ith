<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Unit | Admin SPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <h2 class="text-xl font-bold mb-6 text-gray-800">Tambah Unit Kerja</h2>

        <form action="{{ route('admin.units.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">Kode Unit</label>
                <input type="text" name="kode_unit" placeholder="Contoh: SPI, FT, KEU" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500 uppercase" required>
                <p class="text-[10px] text-gray-500 mt-1">Singkatan unit, maksimal 10 karakter.</p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2 text-gray-700">Nama Unit Lengkap</label>
                <input type="text" name="nama_unit" placeholder="Contoh: Fakultas Teknik" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                <a href="{{ route('admin.units.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-5 py-2.5 shadow-lg shadow-blue-200">
                    Simpan Unit
                </button>
            </div>
        </form>
    </div>
</body>
</html>
