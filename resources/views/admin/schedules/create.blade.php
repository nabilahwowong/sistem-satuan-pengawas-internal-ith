<!DOCTYPE html>
<html lang="id">
<head>
    <title>Buat Jadwal | Admin SPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <h2 class="text-xl font-bold mb-6 text-gray-800 border-b pb-4">Buat Jadwal Reviu Baru</h2>

        <form action="{{ route('admin.schedules.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-blue-500" placeholder="Contoh: Audit Operasional Fakultas Teknik" required>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Unit Kerja</label>
                    <select name="unit_id" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm" required>
                        <option value="">-- Pilih Unit --</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->nama_unit }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Status Awal</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm" required>
                        <option value="dijadwalkan">Dijadwalkan</option>
                        <option value="berjalan">Sedang Berjalan</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2 text-gray-700">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm" required>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2 text-gray-700">Keterangan (Opsional)</label>
                <textarea name="keterangan" rows="3" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm" placeholder="Catatan tambahan..."></textarea>
            </div>

            <div class="flex justify-end gap-4 border-t pt-4">
                <a href="{{ route('admin.schedules.index') }}" class="px-4 py-2 text-sm text-gray-500 hover:text-gray-700">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-6 py-2 shadow">Simpan Jadwal</button>
            </div>
        </form>
    </div>
</body>
</html>
