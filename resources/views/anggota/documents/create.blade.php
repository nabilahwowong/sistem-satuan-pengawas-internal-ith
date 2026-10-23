<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kirim Permintaan Dokumen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <div class="flex h-screen overflow-hidden">
        @include('anggota.components.anggota-sidebar')

        <main class="flex-1 overflow-y-auto p-6">
            <h1 class="text-2xl font-bold mb-6">Kirim Permintaan Dokumen</h1>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-8">
                <h2 class="text-lg font-bold mb-4 text-blue-800 border-b pb-2">Formulir Permintaan Baru</h2>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('anggota.documents.request.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-bold mb-1">Tujukan Untuk (Unit/Jadwal)</label>
                            <select name="review_schedule_id" class="w-full border rounded-lg p-2 bg-gray-50">
                                @foreach($schedules as $s)
                                    <option value="{{ $s->id }}">{{ $s->unit->nama_unit }} - {{ $s->nama_kegiatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-1">Judul Dokumen yg Diminta</label>
                            <input type="text" name="judul" class="w-full border rounded-lg p-2" placeholder="Contoh: Bukti Transaksi Bulan Januari" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-1">Deskripsi / Keterangan Tambahan</label>
                            <textarea name="deskripsi" rows="3" class="w-full border rounded-lg p-2" placeholder="Jelaskan detail dokumen yang dibutuhkan..."></textarea>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700">
                            <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Permintaan
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b bg-gray-50">
                    <h3 class="font-bold text-gray-700">Riwayat Permintaan Anda</h3>
                </div>
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Unit Tujuan</th>
                            <th class="px-6 py-3">Dokumen Diminta</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($myRequests as $req)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 text-gray-500">{{ $req->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-3 font-medium">{{ $req->schedule->unit->nama_unit }}</td>
                            <td class="px-6 py-3">{{ $req->judul }}</td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-bold {{ $req->status == 'fulfilled' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $req->status == 'pending' ? 'Menunggu Balasan' : 'Dibalas' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="px-6 py-6 text-center text-gray-400">Belum ada permintaan dikirim.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4">{{ $myRequests->links() }}</div>
            </div>
        </main>
    </div>
</body>
</html>
