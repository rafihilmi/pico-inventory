<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Login - Pico Inventory</title>
 <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen flex justify-center items-center antialiased">
 <div class="bg-white p-10 rounded-2xl w-full max-w-md border border-gray-100">
 <div class="text-center mb-10">
 <div class="inline-block p-3 bg-indigo-100 rounded-2xl mb-4">
 <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
 </svg>
 </div>
 <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Pico Inventory</h1>
 <p class="text-gray-500 mt-2">Selamat datang kembali, silakan login.</p>
 </div>

 @if($errors->any())
 <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 text-sm flex items-center">
 <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
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
 class="w-full pl-10 pr-4 py-3 border border-gray-300 btn-sq focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all" 
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
 class="w-full pl-10 pr-4 py-3 border border-gray-300 btn-sq focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all" 
 placeholder="••••••••" required>
 </div>
 </div>

 <button type="submit" 
 class="w-full bg-indigo-600 text-white font-bold py-3.5 btn-sq hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-200 transition-all transform active:scale-95 -200">
 Masuk ke Dashboard
 </button>
 </form>

 <p class="mt-8 text-center text-xs text-gray-400">
 &copy; 2026 Pico Inventory System. All rights reserved.
 </p>
 </div>
</body>
</html>