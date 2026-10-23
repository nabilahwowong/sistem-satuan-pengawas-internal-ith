<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="p-8 bg-gray-100 font-sans text-gray-800">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-gray-200">

        <div class="mb-6 border-b border-gray-100 pb-4 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Data Pengguna</h2>
                <p class="text-sm text-gray-500">Perbarui informasi akun <span class="font-bold text-blue-600">{{ $user->name }}</span>.</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:underline font-medium">Kembali</a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm border border-red-200">
                <ul class="list-disc pl-5 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">NIP (Opsional)</label>
                    <input type="text" name="nip" value="{{ old('nip', $user->nip) }}" class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">Password Baru</label>
                    <input type="password" name="password" class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Kosongkan jika tidak diubah">
                    <p class="text-[10px] text-gray-400 mt-1">* Isi hanya jika ingin mengganti password lama.</p>
                </div>
            </div>

            <div class="mb-6">
                <label class="block mb-1 text-sm font-bold text-gray-700">Peran (Role)</label>
                <select name="role" id="roleSelect" class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="anggota" {{ old('role', $user->role) == 'anggota' ? 'selected' : '' }}>Anggota SPI</option>
                    <option value="pimpinan" {{ old('role', $user->role) == 'pimpinan' ? 'selected' : '' }}>Pimpinan Universitas</option>
                    <option value="kepala_unit" {{ old('role', $user->role) == 'kepala_unit' ? 'selected' : '' }}>Kepala UPT / Unit</option>
                </select>
            </div>

            <div id="unitSection" class="hidden bg-blue-50 border border-blue-100 p-5 rounded-xl mb-6">
                <h3 class="font-bold text-blue-800 text-sm mb-3"><i class="fa-solid fa-building mr-1"></i> Penugasan Unit Kerja</h3>

                <label class="block mb-1 text-xs font-bold text-gray-600">Pilih Unit</label>
                <select name="unit_id" id="unit_id" class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                    <option value="">-- Tidak Memilih / Lepas Unit --</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ old('unit_id', $user->unit_id) == $unit->id ? 'selected' : '' }}>
                            {{ $unit->kode_unit }} - {{ $unit->nama_unit }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 text-gray-600 bg-gray-100 hover:bg-gray-200 font-bold rounded-xl transition">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-xl transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const roleSelect = document.getElementById('roleSelect');
            const unitSection = document.getElementById('unitSection');
            const selectUnitId = document.getElementById('unit_id');

            // Fungsi untuk menampilkan/menyembunyikan section Unit
            function handleRoleChange() {
                if (roleSelect.value === 'kepala_unit') {
                    unitSection.classList.remove('hidden');
                } else {
                    unitSection.classList.add('hidden');
                    // Reset pilihan unit jika role diganti menjadi selain kepala unit
                    selectUnitId.value = "";
                }
            }

            // Pasang event listener saat dropdown berubah
            roleSelect.addEventListener('change', handleRoleChange);

            // Jalankan sekali saat halaman dimuat (Penting agar saat mengedit Kepala Unit, form unit langsung terbuka)
            handleRoleChange();
        });
    </script>
</body>
</html>
