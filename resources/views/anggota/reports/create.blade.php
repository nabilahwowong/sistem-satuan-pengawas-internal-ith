<!DOCTYPE html>
<html lang="id">
<head>
    <title>Unggah Laporan {{ $jenis }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <div class="flex h-screen overflow-hidden">
        @include('anggota.components.anggota-sidebar')

        <main class="flex-1 overflow-y-auto p-6">
            <h1 class="text-xl font-bold mb-6">Unggah Dokumen {{ $jenis }}</h1>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 w-full">
                <form action="{{ route('anggota.reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <input type="hidden" name="jenis" value="{{ $jenis }}">

                    <div>
                        <label class="block text-sm font-bold mb-1">Terkait Penugasan/Jadwal</label>
                        <select name="review_schedule_id" class="w-full border rounded-lg p-2.5 bg-gray-50">
                            @foreach($schedules as $s)
                                <option value="{{ $s->id }}">{{ $s->nama_kegiatan }} - {{ $s->unit->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold mb-1">Nomor Laporan</label>
                            <input type="text" name="nomor_laporan" class="w-full border rounded-lg p-2.5" placeholder="Nomor Surat..." required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-1">Tanggal Laporan</label>
                            <input type="date" name="tanggal_laporan" class="w-full border rounded-lg p-2.5" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-1">Judul Laporan</label>
                        <input type="text" name="judul_laporan" class="w-full border rounded-lg p-2.5" placeholder="Contoh: LHA Audit Keuangan Semester 1" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-1">File Laporan (PDF)</label>
                        <input type="file" name="file_laporan" accept=".pdf,.doc,.docx" class="w-full border rounded-lg p-2 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                        <p class="text-xs text-gray-500 mt-1">Maksimal ukuran file 5MB.</p>
                    </div>

                    <div class="pt-4 flex justify-end gap-1.5">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-blue-700">Simpan Laporan</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
