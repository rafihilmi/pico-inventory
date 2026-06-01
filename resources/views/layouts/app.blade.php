<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pico Inventory - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* General styling for squarish buttons and tables */
        .btn-sq { border-radius: 2px !important; }
        .table-sq { border-radius: 2px !important; border-collapse: collapse; }
        .table-sq th, .table-sq td { border: 1px solid #e5e7eb; }
        .table-sq thead th { background-color: #f9fafb; font-weight: 600; color: #374151; }
        .dark-header { background-color: #374151; color: white; padding: 10px 15px; font-weight: bold; border-radius: 2px 2px 0 0; text-transform: uppercase; font-size: 0.85rem;}
    </style>
</head>
<body class="bg-[#f0f3f6] text-gray-800 antialiased font-sans text-sm flex flex-col h-screen overflow-hidden">
    
    <!-- Top Navbar -->
    <header class="bg-[#222831] h-14 flex items-center justify-between px-6 text-white shrink-0 z-10">
        <div class="flex items-center gap-6">
            <div class="font-extrabold text-xl tracking-wider">Pico</div>
        </div>
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-gray-500 rounded-full overflow-hidden flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-200" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
            </div>
            <span class="text-sm font-medium">{{ auth()->check() ? auth()->user()->name : 'Pico' }}</span>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>
