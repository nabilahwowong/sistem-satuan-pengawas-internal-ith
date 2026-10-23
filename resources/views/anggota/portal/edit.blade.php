<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Berita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <div class="flex h-screen overflow-hidden">
        @include('anggota.components.anggota-sidebar')

        <main class="flex-1 overflow-y-auto p-6">
            <h1 class="text-xl font-bold mb-6">Edit Artikel / Berita</h1>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 max-w-4xl">
                <form action="{{ route('anggota.portal.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT') {{-- Wajib untuk Update --}}

                    <div>
                        <label class="block text-sm font-bold mb-1">Judul Berita</label>
                        <input type="text" name="judul" value="{{ old('judul', $article->judul) }}" class="w-full border rounded-lg p-2.5 text-lg font-medium" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-1">Ganti Thumbnail (Opsional)</label>
                        @if($article->thumbnail)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" class="h-24 w-auto rounded border p-1">
                                <span class="text-xs text-gray-500">Gambar saat ini</span>
                            </div>
                        @endif
                        <input type="file" name="thumbnail" accept="image/*" class="w-full border rounded-lg p-2 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-1">Isi Berita</label>
                        <textarea name="konten" rows="10" class="w-full border rounded-lg p-3" required>{{ old('konten', $article->konten) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-1">Status Publikasi</label>
                        <select name="status" class="w-1/3 border rounded-lg p-2.5 bg-gray-50">
                            <option value="draft" {{ $article->status == 'draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                            <option value="published" {{ $article->status == 'published' ? 'selected' : '' }}>Terbit (Published)</option>
                        </select>
                    </div>

                    <div class="pt-4 flex justify-end gap-3 border-t mt-4">
                        <a href="{{ route('anggota.portal.index') }}" class="px-5 py-2.5 rounded-lg text-sm bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-blue-700">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
