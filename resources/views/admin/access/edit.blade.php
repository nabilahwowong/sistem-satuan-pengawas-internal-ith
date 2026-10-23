<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Hak Akses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">

        <h2 class="text-xl font-bold mb-1 text-gray-800">Edit Hak Akses</h2>
        <p class="text-sm text-gray-500 mb-6">Mengubah peran untuk pengguna: <span class="font-semibold text-blue-600">{{ $user->name }}</span></p>

        <form action="{{ route('admin.access.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block text-sm font-bold mb-2 text-gray-700">Role / Peran</label>
                <div class="relative">
                    <select name="role" class="block w-full border border-gray-300 rounded-lg p-2.5 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin (Akses Penuh)</option>
                        <option value="anggota" {{ $user->role == 'anggota' ? 'selected' : '' }}>Anggota SPI (Auditor)</option>
                        <option value="kepala_unit" {{ $user->role == 'kepala_unit' ? 'selected' : '' }}>Kepala Unit (Auditee)</option>
                        <option value="pimpinan" {{ $user->role == 'pimpinan' ? 'selected' : '' }}>Pimpinan (Viewer)</option>
                    </select>
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-bold mb-2 text-gray-700">Unit Kerja</label>
                <select name="unit_id" class="block w-full border border-gray-300 rounded-lg p-2.5 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    <option value="">-- Tidak Ada Unit --</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ $user->unit_id == $unit->id ? 'selected' : '' }}>
                            {{ $unit->nama_unit }}
                        </option>
                    @endforeach
                </select>
                <p class="text-[10px] text-gray-500 mt-1">*Unit kerja wajib diisi untuk Kepala Unit & Anggota.</p>
            </div>

            <div class="mb-6 bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                <label class="block text-sm font-bold mb-2 text-gray-700">Status Akun</label>
                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="radio" name="status_akun" value="1" {{ $user->is_active ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <span class="ml-2 text-sm font-medium text-gray-900">Aktif</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="status_akun" value="0" {{ !$user->is_active ? 'checked' : '' }} class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500">
                        <span class="ml-2 text-sm font-medium text-gray-900">Blokir / Non-Aktif</span>
                    </label>
                </div>
                <p class="text-[10px] text-yellow-700 mt-2">Jika diblokir, pengguna tidak akan bisa login ke sistem.</p>
            </div>

            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                <a href="{{ route('admin.access.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-lg shadow-blue-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</body>
</html>
