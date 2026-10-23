<!DOCTYPE html>
<html lang="id">
<head>
    <title>Input Temuan | Admin SPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-4">Formulir Kertas Kerja Audit</h2>

        <form action="{{ route('admin.audit.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold mb-2">No. Referensi</label>
                    <input type="text" name="no_referensi" value="{{ $autoNumber }}" class="w-full bg-gray-100 border border-gray-300 rounded p-2 text-sm font-mono" readonly>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Unit Terperiksa</label>
                    <select name="unit_id" class="w-full border border-gray-300 rounded p-2 text-sm focus:border-blue-500" required>
                        <option value="">-- Pilih Unit --</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->nama_unit }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">Judul Temuan</label>
                <input type="text" name="judul" class="w-full border border-gray-300 rounded p-2 text-sm focus:border-blue-500" placeholder="Contoh: Selisih Kas Tunai Bendahara" required>
            </div>

            <div class="space-y-4 mb-8">
                <div>
                    <label class="block text-sm font-bold mb-1 text-gray-700">1. KONDISI (Fakta)</label>
                    <textarea name="kondisi" rows="4" class="w-full border border-gray-300 rounded p-2 text-sm focus:border-blue-500" placeholder="Apa yang terjadi di lapangan..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1 text-gray-700">2. KRITERIA (Aturan)</label>
                    <textarea name="kriteria" rows="3" class="w-full border border-gray-300 rounded p-2 text-sm focus:border-blue-500" placeholder="Sebutkan Pasal/Peraturan yang dilanggar..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1 text-gray-700">3. SEBAB</label>
                    <textarea name="sebab" rows="3" class="w-full border border-gray-300 rounded p-2 text-sm focus:border-blue-500" placeholder="Mengapa hal ini terjadi..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1 text-gray-700">4. AKIBAT (Dampak)</label>
                    <textarea name="akibat" rows="3" class="w-full border border-gray-300 rounded p-2 text-sm focus:border-blue-500" placeholder="Kerugian/Risiko yang timbul..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1 text-gray-700">5. REKOMENDASI</label>
                    <textarea name="rekomendasi" rows="4" class="w-full border border-gray-300 rounded p-2 text-sm focus:border-blue-500" placeholder="Saran perbaikan..."></textarea>
                </div>
            </div>

            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 mb-6">
                <label class="block text-sm font-bold mb-2 text-blue-800">
                    <i class="fa-solid fa-paperclip mr-1"></i> Upload Lampiran / Bukti
                </label>
                <input type="file" name="lampiran" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                <p class="text-[10px] text-blue-600 mt-2">*Upload file Excel (KKA), PDF, atau Foto bukti pendukung.</p>
            </div>

            <div class="flex justify-end gap-4 border-t pt-6">
                <a href="{{ route('admin.audit.index') }}" class="px-6 py-2 rounded text-gray-600 hover:bg-gray-100 text-sm font-bold">Batal</a>
                <button type="submit" class="px-6 py-2 rounded bg-blue-600 text-white font-bold hover:bg-blue-700 text-sm shadow-lg">Simpan Temuan</button>
            </div>
        </form>
    </div>
</body>
</html>
