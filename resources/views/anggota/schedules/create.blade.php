<!DOCTYPE html>
<html lang="id">
<head>
    <title>Buat Jadwal Baru</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: { 'spi-blue': '#1e4bbc' }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <div class="flex h-screen w-screen overflow-hidden">

        <aside class="w-64 shrink-0 h-full overflow-hidden relative z-20">
            @include('anggota.components.anggota-sidebar')
        </aside>

        <main class="flex-1 h-full bg-gray-50 p-3 overflow-y-auto relative z-10">

            <div class="bg-white rounded-[20px] shadow-sm border border-gray-200 p-6 w-full min-h-full">

                <div class="mb-6 border-b border-gray-100 pb-4">
                    <h1 class="text-xl font-bold text-gray-800 mb-1">Buat Jadwal Reviu Baru</h1>
                    <p class="text-gray-500 text-xs">Isi formulir di bawah untuk menjadwalkan kegiatan audit/reviu.</p>
                </div>

                <form action="{{ route('anggota.schedules.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Kegiatan <span class="text-red-500">*</span></label>
                        <input type="text"
                               name="nama_kegiatan"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                               placeholder="Contoh: Audit Keuangan Semester Ganjil 2025"
                               required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Unit Kerja (Auditee) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="unit_id"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-800 text-sm appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all cursor-pointer"
                                        required>
                                    <option value="" disabled selected>-- Pilih Unit Kerja --</option>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->nama_unit }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                    <i class="fa-solid fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Penugasan <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="jenis_penugasan"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-800 text-sm appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all cursor-pointer"
                                        required>
                                    <option value="" disabled selected>-- Pilih Jenis --</option>
                                    <option value="Audit Ketaatan">Audit Ketaatan</option>
                                    <option value="Reviu Laporan Keuangan">Reviu Laporan Keuangan</option>
                                    <option value="Reviu SAKIP">Reviu SAKIP</option>
                                    <option value="Pemantauan">Pemantauan</option>
                                    <option value="Consulting">Consulting / Pendampingan</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                    <i class="fa-solid fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Mulai <span class="text-red-500">*</span></label>
                            <input type="date"
                                   name="tanggal_mulai"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all cursor-pointer"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Selesai <span class="text-red-500">*</span></label>
                            <input type="date"
                                   name="tanggal_selesai"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all cursor-pointer"
                                   required>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-md shadow-blue-200 transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                            <i class="fa-regular fa-paper-plane"></i> Simpan Jadwal
                        </button>
                        <a href="{{ route('anggota.schedules.index') }}" class="text-gray-500 hover:text-gray-700 font-medium px-4 py-2.5 text-sm transition-colors rounded-xl hover:bg-gray-100">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </main>
    </div>
</body>
</html>
