<!DOCTYPE html>
<html lang="id">
<head>
    <title>Isi KKA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <div class="flex h-screen overflow-hidden">
        @include('anggota.components.anggota-sidebar')

        <main class="flex-1 overflow-y-auto p-6">
            <h1 class="text-xl font-bold mb-6">Input Kertas Kerja Audit</h1>

            <form action="{{ route('anggota.audit.kka.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow-sm border space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-bold mb-1">Pilih Penugasan/Jadwal</label>
                    <select name="review_schedule_id" class="w-full border rounded-lg p-2.5 bg-gray-50">
                        @foreach($schedules as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_kegiatan }} - {{ $s->unit->nama_unit }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold mb-1">Kondisi (Temuan Fakta)</label>
                        <textarea name="kondisi" rows="3" class="w-full border rounded-lg p-2"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Kriteria (Aturan/SOP)</label>
                        <textarea name="kriteria" rows="3" class="w-full border rounded-lg p-2"></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold mb-1">Sebab</label>
                        <textarea name="sebab" rows="3" class="w-full border rounded-lg p-2"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Akibat</label>
                        <textarea name="akibat" rows="3" class="w-full border rounded-lg p-2"></textarea>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold mb-1 text-blue-800">Rekomendasi Auditor</label>
                    <textarea name="rekomendasi" rows="2" class="w-full border rounded-lg p-2 bg-blue-50/50"></textarea>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700">Simpan KKA</button>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
