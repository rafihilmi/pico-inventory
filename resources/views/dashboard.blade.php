@extends("layouts.app")

@section("content")
<div class="container mx-auto max-w-6xl">
 <div class="flex justify-between items-center mb-6">
 <div class="text-[#3c8dbc] text-sm font-semibold">Dashboard</div>
 <div class="bg-[#3c8dbc] text-white px-3 py-1 rounded-full text-xs font-bold">
 {{ date('d-m-Y : H:i') }}
 </div>
 </div>

 @if(count($listStokKritis) > 0)
            <div x-data="{ show: true }" x-show="show" class="bg-red-50 border border-red-200 p-5 mb-8 rounded-xl flex items-start justify-between">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86l-8.58 14.87A1 1 0 002.58 20h18.84a1 1 0 00.87-1.27l-8.58-14.87a1 1 0 00-1.72 0z" /></svg>
                        <h3 class="text-red-800 font-bold text-lg">Peringatan: Terdapat {{ count($listStokKritis) }} barang dengan stok kritis!</h3>
                    </div>
                    <ul class="list-disc list-inside text-red-700 text-sm ml-8">
                        @foreach($listStokKritis->take(5) as $kritis)
                            <li class="py-0.5"><strong>[{{ $kritis->sku ?? '-' }}] {{ $kritis->nama_barang }}</strong> - Sisa stok: <strong>{{ $kritis->stok }}</strong></li>
                        @endforeach
                        @if(count($listStokKritis) > 5)
                            <li class="mt-1 italic">...dan {{ count($listStokKritis) - 5 }} item lainnya</li>
                        @endif
                    </ul>
                </div>
                <button @click="show = false" class="text-red-500 hover:text-red-700 font-bold text-xl">&times;</button>
            </div>
            @endif

 <!-- Stat Cards -->
 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
 <!-- Total Barang -->
 <div class="bg-white border border-gray-300 btn-sq flex items-center justify-between p-4">
 <div>
 <p class="text-2xl font-bold text-gray-700">{{ $totalBarang }}</p>
 <p class="text-xs text-gray-500 uppercase">Total Barang</p>
 </div>
 <div class="text-[#3c8dbc]">
 <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
 </div>
 </div>

 <!-- Total Supplier -->
 <div class="bg-white border border-gray-300 btn-sq flex items-center justify-between p-4">
 <div>
 <p class="text-2xl font-bold text-gray-700">{{ $totalSupplier }}</p>
 <p class="text-xs text-gray-500 uppercase">Total Supplier</p>
 </div>
 <div class="text-[#00a65a]">
 <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9.12 0a4 4 0 10-6.24 0M12 10a4 4 0 100-8 4 4 0 000 8z" /></svg>
 </div>
 </div>

 <!-- Total Pelanggan -->
 <div class="bg-white border border-gray-300 btn-sq flex items-center justify-between p-4">
 <div>
 <p class="text-2xl font-bold text-gray-700">{{ $totalPelanggan }}</p>
 <p class="text-xs text-gray-500 uppercase">Total Pelanggan</p>
 </div>
 <div class="text-[#f39c12]">
 <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9.12 0a4 4 0 10-6.24 0M12 10a4 4 0 100-8 4 4 0 000 8z" /></svg>
 </div>
 </div>

 <!-- Stok Kritis -->
 <div class="bg-white border border-gray-300 btn-sq flex items-center justify-between p-4">
 <div>
 <p class="text-2xl font-bold text-gray-700">{{ $stokKritis }}</p>
 <p class="text-xs text-gray-500 uppercase">Stok Kritis</p>
 </div>
 <div class="text-[#dd4b39]">
 <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86l-8.58 14.87A1 1 0 002.58 20h18.84a1 1 0 00.87-1.27l-8.58-14.87a1 1 0 00-1.72 0z" /></svg>
 </div>
 </div>
 </div>

 <!-- Recent Activity Tables -->
 <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
 <!-- 5 Barang Masuk Terakhir -->
 <div class="bg-white border border-gray-300 btn-sq">
 <div class="dark-header">
 5 Barang Masuk Terakhir
 </div>
 <div class="p-4">
 <table class="w-full table-sq text-xs">
 <thead>
 <tr>
 <th class="px-3 py-2 text-left">Tanggal</th>
 <th class="px-3 py-2 text-left">SKU</th>
 <th class="px-3 py-2 text-left">Barang</th>
 <th class="px-3 py-2 text-left">Jumlah</th>
 </tr>
 </thead>
 <tbody>
 @forelse($recentMasuk as $bm)
 <tr>
 <td class="px-3 py-2 text-gray-600">{{ date('d M Y', strtotime($bm->tanggal_masuk)) }}</td>
 <td class="px-3 py-2 text-gray-900">{{ $bm->barang->sku ?? '-' }}</td>
 <td class="px-3 py-2 text-gray-900">{{ $bm->barang->nama_barang }}</td>
 <td class="px-3 py-2 text-gray-700">{{ $bm->jumlah_barang }}</td>
 </tr>
 @empty
 <tr>
 <td colspan="4" class="px-3 py-4 text-center text-gray-400">Belum ada data.</td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>

 <!-- 5 Barang Keluar Terakhir -->
 <div class="bg-white border border-gray-300 btn-sq">
 <div class="dark-header">
 5 Barang Keluar Terakhir
 </div>
 <div class="p-4">
 <table class="w-full table-sq text-xs">
 <thead>
 <tr>
 <th class="px-3 py-2 text-left">Tanggal</th>
 <th class="px-3 py-2 text-left">SKU</th>
 <th class="px-3 py-2 text-left">Barang</th>
 <th class="px-3 py-2 text-left">Jumlah</th>
 </tr>
 </thead>
 <tbody>
 @forelse($recentKeluar as $bk)
 <tr>
 <td class="px-3 py-2 text-gray-600">{{ date('d M Y', strtotime($bk->tanggal_keluar)) }}</td>
 <td class="px-3 py-2 text-gray-900">{{ $bk->barang->sku ?? '-' }}</td>
 <td class="px-3 py-2 text-gray-900">{{ $bk->barang->nama_barang }}</td>
 <td class="px-3 py-2 text-gray-700">{{ $bk->jumlah_barang }}</td>
 </tr>
 @empty
 <tr>
 <td colspan="4" class="px-3 py-4 text-center text-gray-400">Belum ada data.</td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
 </div>

 <div class="mt-6 text-center text-gray-400 text-xs">
 &copy; 2026 Pico Inventory System
 </div>
 </div>
@endsection
