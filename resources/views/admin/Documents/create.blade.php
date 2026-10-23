<!DOCTYPE html>
<html lang="id">
<head>
    <title>Upload Dokumen | Admin SPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <h2 class="text-xl font-bold mb-6 text-gray-800">Upload Dokumen</h2>

        <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">Judul Dokumen</label>
                <input type="text" name="judul" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">Kategori</label>
                <select name="kategori" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-blue-500" required>
                <option value="">-- Pilih --</option>
                    <option value="pedoman_audit">Pedoman Audit (Untuk Menu Audit)</option>
                    <option value="pedoman_reviu">Pedoman Reviu (Untuk Menu Reviu)</option>
                    <option value="template">Template Dokumen</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-gray-700">File</label>
                <input type="file" name="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2 text-gray-700">Keterangan</label>
                <textarea name="keterangan" rows="3" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm"></textarea>
            </div>

            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                <a href="{{ route('admin.documents.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-5 py-2.5 shadow-lg">Upload</button>
            </div>
        </form>
    </div>
</body>
</html>
