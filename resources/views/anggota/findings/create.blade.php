<!DOCTYPE html>
<html lang="id">
<head>
    <title>Catat Temuan Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] }, colors: { 'spi-blue': '#1e4bbc', 'spi-bg': '#f4f6fa' } } } }
    </script>
</head>
<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden flex">

    @include('anggota.components.anggota-sidebar')

    <main class="flex-1 h-full flex flex-col overflow-hidden relative transition-all duration-300">

        <div class="flex-1 overflow-y-auto p-6">
            <h1 class="text-xl font-bold mb-6 text-gray-800">Form Pencatatan Temuan</h1>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 w-full">
                <form action="{{ route('anggota.findings.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold mb-1 text-gray-700">Terkait Penugasan/Jadwal <span class="text-red-500">*</span></label>
                            <select name="review_schedule_id" class="w-full border rounded-lg p-2.5 bg-gray-50 focus:ring-2 focus:ring-spi-blue focus:border-spi-blue outline-none text-sm" required>
                                <option value="">-- Pilih Jadwal --</option>
                                @foreach($schedules as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama_kegiatan }} - {{ $s->unit->nama_unit }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold mb-1 text-gray-700">Judul Temuan <span class="text-red-500">*</span></label>
                            <input type="text" name="judul" class="w-full border rounded-lg p-2.5 bg-gray-50 focus:ring-2 focus:ring-spi-blue focus:border-spi-blue outline-none text-sm" placeholder="Contoh: Selisih Kas, Dokumen Hilang..." required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2 text-gray-700">Tingkat Risiko / Kategori <span class="text-red-500">*</span></label>
                        <div class="flex flex-wrap gap-4">
                            <label class="flex items-center gap-2 cursor-pointer border px-4 py-2 rounded-lg hover:bg-green-50 has-checked:border-green-500 has-checked:bg-green-50 transition-all">
                                <input type="radio" name="kategori" value="ringan" class="accent-green-600 w-4 h-4" required>
                                <span class="text-sm font-medium text-gray-700">Ringan</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer border px-4 py-2 rounded-lg hover:bg-yellow-50 has-checked:border-yellow-500 has-checked:bg-yellow-50 transition-all">
                                <input type="radio" name="kategori" value="sedang" class="accent-yellow-600 w-4 h-4">
                                <span class="text-sm font-medium text-gray-700">Sedang</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer border px-4 py-2 rounded-lg hover:bg-red-50 has-checked:border-red-500 has-checked:bg-red-50 transition-all">
                                <input type="radio" name="kategori" value="berat" class="accent-red-600 w-4 h-4">
                                <span class="text-sm font-bold text-red-600">Berat</span>
                            </label>
                        </div>
                    </div>

                    <hr class="border-gray-100">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">5 Unsur Temuan</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block text-sm font-bold mb-1 text-gray-700">1. Kondisi (Temuan Fakta) <span class="text-red-500">*</span></label>
                            <textarea name="kondisi" rows="3" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-spi-blue focus:border-spi-blue outline-none text-sm" placeholder="Jelaskan fakta yang ditemukan di lapangan..." required></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold mb-1 text-gray-700">2. Kriteria (Standar/Aturan) <span class="text-red-500">*</span></label>
                            <textarea name="kriteria" rows="3" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-spi-blue focus:border-spi-blue outline-none text-sm" placeholder="Sebutkan aturan, SOP, atau standar yang seharusnya..." required></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold mb-1 text-gray-700">3. Sebab (Akar Masalah) <span class="text-red-500">*</span></label>
                            <textarea name="sebab" rows="3" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-spi-blue focus:border-spi-blue outline-none text-sm" placeholder="Mengapa hal ini bisa terjadi?" required></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold mb-1 text-gray-700">4. Akibat (Dampak Negatif) <span class="text-red-500">*</span></label>
                            <textarea name="akibat" rows="3" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-spi-blue focus:border-spi-blue outline-none text-sm" placeholder="Apa kerugian atau risikonya?" required></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold mb-1 text-gray-700">5. Rekomendasi (Saran) <span class="text-red-500">*</span></label>
                            <textarea name="rekomendasi" rows="3" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-spi-blue focus:border-spi-blue outline-none text-sm" placeholder="Langkah perbaikan yang disarankan..." required></textarea>
                        </div>
                    </div>

                    <div class="pt-6 flex justify-end gap-3 border-t mt-4">
                        <a href="{{ route('anggota.findings.index') }}" class="px-5 py-2.5 rounded-lg text-sm bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold transition-colors">Batal</a>
                        <button type="submit" class="px-5 py-2.5 rounded-lg text-sm bg-spi-blue hover:bg-blue-800 text-white font-bold shadow-lg shadow-blue-200 transition-all hover:-translate-y-0.5">
                            <i class="fa-solid fa-save mr-2"></i> Simpan Temuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
