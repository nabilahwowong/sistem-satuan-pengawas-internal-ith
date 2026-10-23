<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SPI ITH</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="bg-gray-50">

    <div class="flex min-h-screen w-full">

        {{-- BAGIAN KIRI (GAMBAR) --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <img src="{{ asset('images/WhatsApp Image 2025-10-26 at 21.03.11_d9f2e37e.jpg') }}"
                 onerror="this.src='https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1000&q=80'"
                 alt="Gedung ITH"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-blue-900/30"></div>
        </div>

        {{-- BAGIAN KANAN (FORM) --}}
        <div class="flex w-full lg:w-1/2 items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md space-y-8">

                {{-- LOGO & HEADER --}}
                <div class="text-center">
                    <img src="{{ asset('images/download.png') }}" alt="Logo SPI" class="mx-auto h-20 w-auto mb-4">
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Login SPI</h2>
                    <p class="mt-2 text-sm text-gray-600">Masuk untuk mengakses dashboard pengawasan.</p>
                </div>

                {{-- ALERT ERROR --}}
                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-md shadow-sm text-sm flex items-center">
                        <i class="bi bi-exclamation-circle-fill mr-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                {{-- FORM LOGIN --}}
                <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Input Email --}}
                    <div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" id="email"
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm"
                                   placeholder="email" required autofocus>
                        </div>
                    </div>

                    {{-- Input Password --}}
                    <div>
                        <div class="relative">
                            {{-- Ikon Gembok (Kiri) --}}
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-lock text-gray-400"></i>
                            </div>

                            {{-- Input Field --}}
                            {{-- Perhatikan: pr-10 (padding right diperbesar agar teks tidak tertutup ikon mata) --}}
                            <input type="password" name="password" id="password"
                                   class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm"
                                   required
                                   placeholder="password" required autofocus>

                            {{-- Tombol Toggle Mata (Kanan) --}}
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center focus:outline-none">
                                <i id="eye-icon" class="bi bi-eye text-gray-400 hover:text-blue-600 cursor-pointer"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Button Submit --}}
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:scale-[1.02]">
                        Masuk Sekarang
                    </button>
                </form>

                {{-- Link Kembali --}}
                <div class="text-center">
                    <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 transition">
                        <i class="bi bi-arrow-left mr-2"></i> Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>

<script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                // Ubah menjadi text (show)
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                // Kembalikan ke password (hide)
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        }
</script>

</body>
</html>
