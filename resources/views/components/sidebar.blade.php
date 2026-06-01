<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@php
 $initialMenu = 'none';
 if (request()->routeIs('barang.*')) $initialMenu = 'barang';
 elseif (request()->routeIs('kategori.*') || request()->routeIs('satuan.*')) $initialMenu = 'atribut';
 elseif (request()->routeIs('barang-masuk.*') || request()->routeIs('barang-keluar.*')) $initialMenu = 'aktivitas';
 elseif (request()->routeIs('supplier.*') || request()->routeIs('pelanggan.*')) $initialMenu = 'supp_pel';
@endphp

<aside class="w-64 h-full bg-[#222d32] text-[#b8c7ce] flex flex-col font-sans shrink-0">
 <nav x-data="{ activeMenu: '{{ $initialMenu }}' }" class="flex-1 overflow-y-auto pt-4">
 
 <a href="{{ route('dashboard') }}" class="px-5 py-3 flex items-center gap-3 border-l-4 transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#1e282c] text-white border-[#3c8dbc]' : 'border-transparent hover:bg-[#1e282c] hover:text-white' }}">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
 <span class="text-sm">Dashboard</span>
 </a>

 <div>
 <button @click="activeMenu = (activeMenu === 'barang' ? null : 'barang')" 
 class="w-full px-5 py-3 flex justify-between items-center transition-colors border-l-4"
 :class="activeMenu === 'barang' ? 'bg-[#1e282c] text-white border-[#3c8dbc]' : 'border-transparent hover:bg-[#1e282c] hover:text-white'">
 <div class="flex items-center gap-3">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
 <span class="text-sm">Barang</span>
 </div>
 <svg class="w-3 h-3 transform transition-transform" :class="activeMenu === 'barang' ? '-rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
 </button>
 <div x-show="activeMenu === 'barang'" x-collapse class="bg-[#2c3b41] py-1">
 <a href="{{ route('barang.index') }}" class="block px-10 py-2 text-sm hover:text-white {{ request()->routeIs('barang.index') ? 'text-white' : 'text-[#8aa4af]' }}">&circlearrowright; Data Barang</a>
 </div>
 </div>

 <div>
 <button @click="activeMenu = (activeMenu === 'atribut' ? null : 'atribut')" 
 class="w-full px-5 py-3 flex justify-between items-center transition-colors border-l-4"
 :class="activeMenu === 'atribut' ? 'bg-[#3c8dbc] text-white border-[#3c8dbc]' : 'border-transparent hover:bg-[#1e282c] hover:text-white'">
 <div class="flex items-center gap-3">
 <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
 <span class="text-sm">Atribut Barang</span>
 </div>
 <svg class="w-3 h-3 transform transition-transform" :class="activeMenu === 'atribut' ? '-rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
 </button>
 <div x-show="activeMenu === 'atribut'" x-collapse class="bg-[#2c3b41] py-1">
 <a href="{{ route('kategori.index') }}" class="block px-10 py-2 text-sm hover:text-white {{ request()->routeIs('kategori.index') ? 'text-white' : 'text-[#8aa4af]' }}">&circlearrowright; Kategori</a>
 <a href="{{ route('satuan.index') }}" class="block px-10 py-2 text-sm hover:text-white {{ request()->routeIs('satuan.index') ? 'text-white' : 'text-[#8aa4af]' }}">&circlearrowright; Satuan</a>
 </div>
 </div>

 <div>
 <button @click="activeMenu = (activeMenu === 'aktivitas' ? null : 'aktivitas')" 
 class="w-full px-5 py-3 flex justify-between items-center transition-colors border-l-4"
 :class="activeMenu === 'aktivitas' ? 'bg-[#1e282c] text-white border-[#3c8dbc]' : 'border-transparent hover:bg-[#1e282c] hover:text-white'">
 <div class="flex items-center gap-3">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
 <span class="text-sm">Aktivitas</span>
 </div>
 <svg class="w-3 h-3 transform transition-transform" :class="activeMenu === 'aktivitas' ? '-rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
 </button>
 <div x-show="activeMenu === 'aktivitas'" x-collapse class="bg-[#2c3b41] py-1">
 <a href="{{ route('barang-masuk.index') }}" class="block px-10 py-2 text-sm hover:text-white {{ request()->routeIs('barang-masuk.*') ? 'text-white' : 'text-[#8aa4af]' }}">&circlearrowright; Barang Masuk</a>
 <a href="{{ route('barang-keluar.index') }}" class="block px-10 py-2 text-sm hover:text-white {{ request()->routeIs('barang-keluar.*') ? 'text-white' : 'text-[#8aa4af]' }}">&circlearrowright; Barang Keluar</a>
 </div>
 </div>

 <div>
 <button @click="activeMenu = (activeMenu === 'supp_pel' ? null : 'supp_pel')" 
 class="w-full px-5 py-3 flex justify-between items-center transition-colors border-l-4"
 :class="activeMenu === 'supp_pel' ? 'bg-[#1e282c] text-white border-[#3c8dbc]' : 'border-transparent hover:bg-[#1e282c] hover:text-white'">
 <div class="flex items-center gap-3">
 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
 <span class="text-sm">Supplier & Pelanggan</span>
 </div>
 <svg class="w-3 h-3 transform transition-transform" :class="activeMenu === 'supp_pel' ? '-rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
 </button>
 <div x-show="activeMenu === 'supp_pel'" x-collapse class="bg-[#2c3b41] py-1">
 <a href="{{ route('supplier.index') }}" class="block px-10 py-2 text-sm hover:text-white {{ request()->routeIs('supplier.index') ? 'text-white' : 'text-[#8aa4af]' }}">&circlearrowright; Data Supplier</a>
 <a href="{{ route('pelanggan.index') }}" class="block px-10 py-2 text-sm hover:text-white {{ request()->routeIs('pelanggan.index') ? 'text-white' : 'text-[#8aa4af]' }}">&circlearrowright; Data Pelanggan</a>
 </div>
 </div>

 </nav>

 <div class="p-4 bg-[#1a2226]">
 <form action="{{ route('logout') }}" method="POST">
 @csrf
 <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#d9534f] hover:bg-[#c9302c] text-white py-2 rounded-sm text-sm transition-all">
 Logout
 </button>
 </form>
 </div>
</aside>
