<!DOCTYPE html>
<html lang="id">
<head>
    <title>Profil Saya - Kepala Unit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: { 'spi-blue': '#1e4bbc', 'spi-bg': '#f4f6fa' }
                }
            }
        }
    </script>
    <style>
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }
    </style>
</head>
<body class="bg-spi-bg font-sans text-gray-800 h-screen w-screen overflow-hidden">

    @include('kepala_unit.components.sidebar')

    <main class="ml-[275px] h-full flex flex-col overflow-hidden relative transition-all duration-300">

        <div class="flex-1 overflow-y-auto">

            {{-- HEADER --}}
            <header class="bg-white mx-8 mt-8 px-8 py-5 rounded-[20px] shadow-sm shrink-0 flex items-center gap-5 sticky top-0 z-20">
                <a href="{{ route('kepala_unit.dashboard') }}"
                   class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-spi-blue hover:text-white hover:border-spi-blue transition-all duration-200 shadow-sm group"
                   title="Kembali ke Dashboard">
                    <i class="fa-solid fa-arrow-left text-sm group-hover:-translate-x-0.5 transition-transform"></i>
                </a>
                <div>
                    <h1 class="text-xl font-bold text-gray-800 tracking-tight">Profil Saya</h1>
                    <p class="text-xs text-gray-500 mt-0.5">Kelola informasi akun dan data unit Anda.</p>
                </div>
            </header>

            <div class="p-8">

                {{-- Alert Messages --}}
                @if(session('success'))
                <div class="bg-green-50 border border-green-100 text-green-700 px-4 py-3 rounded-xl mb-8 text-sm flex items-center shadow-sm">
                    <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mr-3 shrink-0">
                        <i class="fa-solid fa-check text-xs"></i>
                    </div>
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-xl mb-8 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- LAYOUT GRID UTAMA --}}
                <div class="grid lg:grid-cols-3 gap-8 mb-8">

                    {{-- 1. KARTU PROFIL (KIRI) --}}
                    <div class="lg:col-span-1 flex flex-col">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-0 text-center relative overflow-hidden h-full flex flex-col">
                            <div class="h-28 bg-linear-to-r from-spi-blue to-blue-600 relative">
                                <div class="absolute inset-0 bg-white/10"></div>
                            </div>

                            <div class="px-6 pb-8 flex-1 flex flex-col relative">
                                <div class="relative -mt-12 mb-4 mx-auto">
                                    <div class="w-24 h-24 rounded-full border-4 border-white shadow-md overflow-hidden bg-gray-200 flex items-center justify-center">
                                        @if(isset($user->foto_profil) && $user->foto_profil)
                                            <img src="{{ asset('storage/'.$user->foto_profil) }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-3xl font-bold text-gray-500">{{ substr($user->name ?? 'User', 0, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="absolute bottom-1 right-1 bg-white rounded-full p-1.5 shadow-sm border border-gray-100 text-spi-blue text-[10px]">
                                        <i class="fa-solid fa-camera"></i>
                                    </div>
                                </div>

                                <h2 class="text-lg font-bold text-gray-800">{{ $user->name ?? 'Nama Pengguna' }}</h2>
                                <p class="text-xs text-gray-500 font-medium">{{ $user->email ?? 'email@example.com' }}</p>

                                <div class="mt-8 pt-6 border-t border-gray-50 text-left space-y-4 flex-1 flex flex-col justify-center">
                                    <div class="flex justify-between items-center text-sm group hover:bg-gray-50 p-2 rounded-lg transition">
                                        <span class="text-gray-400 text-xs font-medium uppercase tracking-wider">NIP</span>
                                        <span class="font-semibold text-gray-700 font-mono">{{ $user->nip ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm group hover:bg-gray-50 p-2 rounded-lg transition">
                                        <span class="text-gray-400 text-xs font-medium uppercase tracking-wider">Unit Kerja</span>
                                        <span class="font-semibold text-gray-700 text-right">{{ $user->unit->nama_unit ?? 'Tidak Ada Unit' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm group hover:bg-gray-50 p-2 rounded-lg transition">
                                        <span class="text-gray-400 text-xs font-medium uppercase tracking-wider">Role</span>
                                        <span class="bg-blue-50 text-spi-blue px-2.5 py-1 rounded-md text-[10px] font-bold uppercase border border-blue-100">
                                            Kepala Unit
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. FORM EDIT BIODATA (KANAN) --}}
                    <div class="lg:col-span-2 flex flex-col">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 h-full">
                            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-50">
                                <h3 class="text-base font-bold text-gray-800">Edit Informasi Pribadi</h3>
                                <div class="text-[10px] text-gray-400 bg-gray-50 px-2 py-1 rounded">Update terakhir: {{ now()->format('d M Y') }}</div>
                            </div>

                            <form action="{{ route('kepala_unit.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                                @csrf @method('PATCH')

                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-1.5">
                                        <label class="text-xs font-bold text-gray-600 ml-1">Nama Lengkap</label>
                                        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-spi-blue/20 focus:border-spi-blue transition-all outline-none" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="space-y-1.5">
                                        <label class="text-xs font-bold text-gray-600 ml-1">Email</label>
                                        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-spi-blue/20 focus:border-spi-blue transition-all outline-none" placeholder="email@contoh.com">
                                    </div>
                                    <div class="space-y-1.5">
                                        <label class="text-xs font-bold text-gray-600 ml-1">NIP</label>
                                        <input type="text" name="nip" value="{{ old('nip', $user->nip ?? '') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-spi-blue/20 focus:border-spi-blue transition-all outline-none" placeholder="Nomor Induk Pegawai">
                                    </div>
                                </div>

                                <div class="pt-2">
                                    <label class="text-xs font-bold text-gray-600 ml-1 mb-2 block">Ganti Foto Profil</label>
                                    <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-xl border border-gray-200 border-dashed">
                                        <div class="shrink-0 w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-spi-blue">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                        </div>
                                        <div class="flex-1">
                                            <input type="file" name="foto" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-white file:text-spi-blue hover:file:bg-blue-50 cursor-pointer">
                                        </div>
                                    </div>
                                    <p class="text-[10px] text-gray-400 mt-2 ml-1">* Format: JPG, PNG. Maksimal ukuran file 2MB.</p>
                                </div>

                                <div class="text-right pt-4 border-t border-gray-50 mt-auto">
                                    <button type="submit" class="bg-spi-blue text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-blue-800 transition shadow-lg shadow-blue-500/20 flex items-center gap-2 ml-auto">
                                        <i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- 3. FORM GANTI PASSWORD (FULL WIDTH) --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-50">
                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600">
                            <i class="fa-solid fa-shield-halved text-sm"></i>
                        </div>
                        <h3 class="text-base font-bold text-gray-800">Keamanan (Ganti Password)</h3>
                    </div>

                    <form action="{{ route('kepala_unit.profil.password') }}" method="POST">
                        @csrf @method('PATCH')

                        <div class="grid md:grid-cols-3 gap-6">

                            {{-- Password Saat Ini --}}
                            <div class="space-y-1.5" x-data="{ show: false }">
                                <label class="text-xs font-bold text-gray-600 ml-1">Password Saat Ini</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3.5 text-gray-400 text-xs"><i class="fa-solid fa-lock"></i></span>
                                    <input :type="show ? 'text' : 'password'" name="current_password" required
                                           class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-10 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-spi-blue/20 focus:border-spi-blue transition-all outline-none">
                                    <button type="button" @click="show = !show" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- Password Baru --}}
                            <div class="space-y-1.5" x-data="{ show: false }">
                                <label class="text-xs font-bold text-gray-600 ml-1">Password Baru</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3.5 text-gray-400 text-xs"><i class="fa-solid fa-key"></i></span>
                                    <input :type="show ? 'text' : 'password'" name="password" required
                                           class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-10 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-spi-blue/20 focus:border-spi-blue transition-all outline-none">
                                    <button type="button" @click="show = !show" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="space-y-1.5" x-data="{ show: false }">
                                <label class="text-xs font-bold text-gray-600 ml-1">Konfirmasi Password</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3.5 text-gray-400 text-xs"><i class="fa-solid fa-check-double"></i></span>
                                    <input :type="show ? 'text' : 'password'" name="password_confirmation" required
                                           class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-10 py-3 text-sm focus:bg-white focus:ring-2 focus:ring-spi-blue/20 focus:border-spi-blue transition-all outline-none">
                                    <button type="button" @click="show = !show" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="text-right mt-6">
                            <button type="submit" class="bg-gray-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-black transition shadow-lg shadow-gray-500/20 flex items-center gap-2 ml-auto">
                                <i class="fa-solid fa-lock-open"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>
</body>
</html>
