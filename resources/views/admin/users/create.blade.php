<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="p-8 bg-gray-100 font-sans text-gray-800">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-gray-200">

        <div class="mb-6 border-b border-gray-100 pb-4 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Tambah Pengguna Baru</h2>
                <p class="text-sm text-gray-500">Isi formulir di bawah ini untuk menambahkan akun.</p>
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

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">NIP (Opsional)</label>
                    <input type="text" name="nip" value="{{ old('nip') }}" class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">Password</label>
                    <input type="password" name="password" class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
            </div>

            <div class="mb-6">
                <label class="block mb-1 text-sm font-bold text-gray-700">Peran (Role)</label>
                <select name="role" id="roleSelect" class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="" disabled selected>-- Pilih Peran --</option>
                    <option value="anggota" {{ old('role') == 'anggota' ? 'selected' : '' }}>Anggota SPI</option>
                    <option value="pimpinan" {{ old('role') == 'pimpinan' ? 'selected' : '' }}>Pimpinan Universitas</option>
                    <option value="kepala_unit" {{ old('role') == 'kepala_unit' ? 'selected' : '' }}>Kepala UPT / Unit</option>
                </select>
            </div>

            <div id="unitSection" class="hidden bg-blue-50 border border-blue-100 p-5 rounded-xl mb-6">
                <h3 class="font-bold text-blue-800 text-sm mb-3"><i class="fa-solid fa-building mr-1"></i> Pengaturan Unit Kerja</h3>

                <div class="mb-4">
                    <label class="flex items-center space-x-2 text-sm font-bold text-gray-700 cursor-pointer">
                        <input type="checkbox" id="createNewUnitToggle" class="w-4 h-4 text-blue-600 rounded">
                        <span>Buat Unit Baru Sekaligus</span>
                    </label>
                </div>

                <div id="existingUnitWrapper">
                    <label class="block mb-1 text-xs font-bold text-gray-600">Pilih Unit yang Sudah Terdaftar</label>
                    <select name="unit_id" id="unit_id" class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                        <option value="">-- Tidak Memilih / Pilih Unit --</option>
                        @foreach($units ?? [] as $unit)
                            <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->kode_unit }} - {{ $unit->nama_unit }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="newUnitWrapper" class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                    <div>
                        <label class="block mb-1 text-xs font-bold text-gray-600">Kode Unit Baru</label>
                        <input type="text" name="kode_unit_baru" id="kode_unit_baru" placeholder="Contoh: UPT-TI" value="{{ old('kode_unit_baru') }}" class="w-full border border-gray-300 p-2.5 rounded-lg text-sm outline-none">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-bold text-gray-600">Nama Unit Baru</label>
                        <input type="text" name="nama_unit_baru" id="nama_unit_baru" placeholder="Contoh: Unit Teknologi Informasi" value="{{ old('nama_unit_baru') }}" class="w-full border border-gray-300 p-2.5 rounded-lg text-sm outline-none">
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-3 rounded-xl w-full transition">
                Simpan Pengguna
            </button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const roleSelect = document.getElementById('roleSelect');
            const unitSection = document.getElementById('unitSection');

            const createNewUnitToggle = document.getElementById('createNewUnitToggle');
            const existingUnitWrapper = document.getElementById('existingUnitWrapper');
            const newUnitWrapper = document.getElementById('newUnitWrapper');
            const selectUnitId = document.getElementById('unit_id');
            const inputKodeBaru = document.getElementById('kode_unit_baru');
            const inputNamaBaru = document.getElementById('nama_unit_baru');

            // Fungsi untuk menampilkan/menyembunyikan section Unit
            function handleRoleChange() {
                if (roleSelect.value === 'kepala_unit') {
                    unitSection.classList.remove('hidden');
                } else {
                    unitSection.classList.add('hidden');
                    // Reset input unit jika role diganti
                    createNewUnitToggle.checked = false;
                    handleToggleChange();
                    selectUnitId.value = "";
                }
            }

            // Fungsi untuk mengganti antara "Pilih Unit" atau "Buat Unit Baru"
            function handleToggleChange() {
                if (createNewUnitToggle.checked) {
                    existingUnitWrapper.classList.add('hidden');
                    selectUnitId.value = ""; // Kosongkan pilihan lama

                    newUnitWrapper.classList.remove('hidden');
                } else {
                    newUnitWrapper.classList.add('hidden');
                    inputKodeBaru.value = ""; // Kosongkan input baru
                    inputNamaBaru.value = "";

                    existingUnitWrapper.classList.remove('hidden');
                }
            }

            // Pasang event listener
            roleSelect.addEventListener('change', handleRoleChange);
            createNewUnitToggle.addEventListener('change', handleToggleChange);

            // Jalankan sekali saat halaman dimuat (untuk handle old() data jika error validasi)
            handleRoleChange();
            if(inputKodeBaru.value !== "" || inputNamaBaru.value !== "") {
                createNewUnitToggle.checked = true;
                handleToggleChange();
            }
        });
    </script>
</body>
</html>
