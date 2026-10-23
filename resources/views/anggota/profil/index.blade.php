@extends('anggota.main_dashboard') {{-- Pastikan ini extend ke layout anggota --}}

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Pengaturan Akun</h2>
        <p class="text-sm text-gray-500">Kelola informasi data diri dan keamanan login Anggota SPI.</p>
    </div>

    @if(session('success'))
        <div class="bg-indigo-50 text-indigo-700 p-4 rounded-2xl mb-6 font-bold text-sm border border-indigo-200">
            <i class="fa-solid fa-check-double mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 bg-white p-8 rounded-[30px] shadow-sm border border-gray-100">
            <form action="{{ route('anggota.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-8 flex items-center gap-6 p-4 bg-indigo-50/30 rounded-2xl border border-indigo-100">
                    <div class="w-20 h-20 rounded-full bg-white overflow-hidden border-2 border-indigo-200 shrink-0 shadow-sm">
                        @if($user->foto_profil)
                            <img src="{{ asset('storage/' . $user->foto_profil) }}" class="w-full h-full object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1e4bbc&color=fff" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-indigo-700 uppercase tracking-wider mb-2">Foto Profil Anggota</label>
                        <input type="file" name="foto_profil" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 cursor-pointer transition">
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="w-full border border-gray-200 rounded-xl bg-gray-50 p-3 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">NIP / Kode Anggota</label>
                        <input type="text" name="nip" value="{{ $user->nip }}" class="w-full border border-gray-200 rounded-xl bg-gray-50 p-3 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email (Login)</label>
                        <input type="email" value="{{ $user->email }}" class="w-full border border-gray-200 rounded-xl bg-gray-200 p-3 text-sm text-gray-500 cursor-not-allowed" disabled>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white font-bold py-3 px-10 rounded-xl hover:bg-indigo-700 transition shadow-lg">Perbarui Profil</button>
                </div>
            </form>
        </div>

        <div class="bg-white p-8 rounded-[30px] shadow-sm border border-gray-100 h-fit">
            <h3 class="font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-key text-indigo-600"></i> Ubah Password
            </h3>

            <form action="{{ route('anggota.profil.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Password Sekarang</label>
                        <input type="password" name="current_password" class="w-full border border-gray-200 rounded-xl bg-gray-50 p-3 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                        @error('current_password') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-2">
                        <label class="block text-xs font-bold text-gray-600 mb-1">Password Baru</label>
                        <input type="password" name="new_password" class="w-full border border-gray-200 rounded-xl bg-gray-50 p-3 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                        @error('new_password') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Ulangi Password Baru</label>
                        <input type="password" name="new_password_confirmation" class="w-full border border-gray-200 rounded-xl bg-gray-50 p-3 text-sm focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 bg-gray-800 text-white font-bold py-3 rounded-xl hover:bg-black transition">Update Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
