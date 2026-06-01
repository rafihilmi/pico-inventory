<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pico Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#118a88',
                        brandDark: '#0e706f'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-brand relative overflow-hidden h-screen flex justify-center items-center antialiased">
    <!-- Elemen Dekorasi Background (Blobs) -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-teal-400 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[30rem] h-[30rem] bg-brandDark rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
        <div class="absolute bottom-[20%] left-[20%] w-72 h-72 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
    </div>

    <!-- Container Login (Glassmorphism) -->
    <div class="z-10 bg-white/95 backdrop-blur-md p-10 rounded-3xl w-full max-w-md shadow-[0_20px_50px_rgba(0,0,0,0.3)] border border-white/40">
        <div class="text-center mb-8">
            <!-- Tempat logo gambar -->
            <img src="{{ asset('logo.jpeg') }}" alt="Pico Logo" class="w-32 h-32 mx-auto mb-4 rounded-2xl shadow-md object-contain border-2 border-brand/20">
            
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight mt-2">Selamat Datang</h1>
            <p class="text-gray-500 mt-1 text-sm">Masuk untuk mengelola inventory Anda</p>
        </div>

        @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 text-sm flex items-center">
            <svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="username" class="block text-sm font-bold text-gray-700 mb-2">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </span>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-brand focus:border-brand outline-none transition-all" 
                        placeholder="Masukkan username" required autofocus>
                </div>
            </div>

            <div class="mb-8">
                <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </span>
                    <input type="password" name="password" id="password" 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-brand focus:border-brand outline-none transition-all" 
                        placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" 
                class="w-full bg-brand text-white font-bold py-3.5 rounded-xl hover:bg-brandDark focus:outline-none focus:ring-4 focus:ring-brand/30 transition-all transform active:scale-[0.98]">
                Masuk ke Dashboard
            </button>
        </form>

        <p class="mt-8 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} Pico Simplify Digital. All rights reserved.
        </p>
    </div>
</body>
</html>