<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | SPI ITH</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="bg-gray-50">

    <div class="flex min-h-screen w-full">

        {{-- BAGIAN KIRI (GAMBAR - SAMA DENGAN LOGIN) --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <img src="{{ asset('images/WhatsApp Image 2025-10-26 at 21.03.11_d9f2e37e.jpg') }}"
                 onerror="this.src='https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1000&q=80'"
                 alt="Gedung ITH"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-blue-900/30"></div>
        </div>

        {{-- BAGIAN KANAN (FORM REGISTER) --}}
        <div class="flex w-full lg:w-1/2 items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md space-y-6">

                {{-- LOGO & HEADER --}}
                <div class="text-center">
                    <img src="{{ asset('images/download.png') }}" alt="Logo SPI" class="mx-auto h-16 w-auto mb-4">
                    <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Buat Akun Baru</h2>
                    <p class="mt-2 text-sm text-gray-600">Daftarkan diri Anda untuk mengakses sistem.</p>
                </div>

                {{-- ALERT ERROR (Untuk validasi umum) --}}
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-md shadow-sm text-sm">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM REGISTER --}}
                <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Input Nama Lengkap --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-person text-gray-400"></i>
                            </div>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm"
                                   placeholder="Contoh: Budi Santoso" required autofocus>
                        </div>
                    </div>

                    {{-- Input Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm"
                                   placeholder="nama@email.com" required>
                        </div>
                    </div>

                    {{-- Input Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password" id="password"
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm"
                                   placeholder="Minimal 8 karakter" required>
                        </div>
                    </div>

                    {{-- Input Konfirmasi Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-shield-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm"
                                   placeholder="Ulangi password" required>
                        </div>
                    </div>

                    {{-- Button Register --}}
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:scale-[1.02] mt-4">
                        Daftar Sekarang
                    </button>
                </form>

                {{-- Divider --}}
                <div class="relative flex py-2 items-center">
                    <div class="grow border-t border-gray-300"></div>
                    <span class="shrink-0 mx-4 text-gray-400 text-xs">SUDAH PUNYA AKUN?</span>
                    <div class="grow border-t border-gray-300"></div>
                </div>

                {{-- Link Login --}}
                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500 font-medium text-sm hover:underline transition">
                        Masuk di sini
                    </a>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
