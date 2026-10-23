<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Dokumen | Admin SPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <h2 class="text-xl font-bold mb-6 text-gray-800">Edit Dokumen</h2>

        {{-- TAMBAHAN: Menampilkan Error Validasi jika ada --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">Gagal Menyimpan!</strong>
                <ul class="list-disc ml-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">Judul Dokumen</label>
                {{-- PERBAIKAN: Tambahkan old() agar input tidak hilang saat error --}}
                <input type="text" name="judul" value="{{ old('judul', $document->judul) }}" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">Kategori</label>
                {{-- PERBAIKAN: Value opsi disesuaikan dengan Controller baru (pedoman_audit, dll) --}}
                <select name="kategori" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-blue-500">
                    <option value="pedoman_audit" {{ old('kategori', $document->kategori) == 'pedoman_audit' ? 'selected' : '' }}>Pedoman Audit</option>
                    <option value="pedoman_reviu" {{ old('kategori', $document->kategori) == 'pedoman_reviu' ? 'selected' : '' }}>Pedoman Reviu</option>
                    <option value="template" {{ old('kategori', $document->kategori) == 'template' ? 'selected' : '' }}>Template Dokumen</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">Ganti File (Opsional)</label>
                <input type="file" name="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-[10px] text-gray-500 mt-1">File saat ini: <a href="{{ asset('storage/documents/' . $document->file_path) }}" target="_blank" class="text-blue-600 underline">{{ $document->file_path }}</a></p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2 text-gray-700">Keterangan</label>
                <textarea name="keterangan" rows="3" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-blue-500">{{ old('keterangan', $document->keterangan) }}</textarea>
            </div>

            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                <a href="{{ route('admin.documents.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-5 py-2.5 shadow-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>
