@extends("layouts.app")

@section("content")
<div class="w-full max-w-lg bg-white p-8 btn-sq border border-gray-100">
 <h1 class="text-2xl font-extrabold text-indigo-600 mb-6 tracking-tight">Tambah Data Inventory Baru</h1>

 <form action="{{ route('barang.store') }}" method="POST">
 @csrf
 <div class="mb-5">
 <label class="block text-sm font-bold text-gray-700 mb-2">Nama Item</label>
 <input type="text" name="nama_barang" class="w-full border border-gray-300 btn-sq px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none transition" placeholder="Contoh: Laptop Asus ROG" required>
 </div>

 <div class="grid grid-cols-2 gap-5 mb-5">
 <div>
 <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
 <input type="text" name="kategori" class="w-full border border-gray-300 btn-sq px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none transition" placeholder="Contoh: Elektronik" required>
 </div>
 <div>
 <label class="block text-sm font-bold text-gray-700 mb-2">Satuan</label>
 <input type="text" name="satuan" class="w-full border border-gray-300 btn-sq px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none transition" placeholder="Contoh: Pcs, Unit, Dus" required>
 </div>
 </div>

 <div class="grid grid-cols-2 gap-5 mb-8">
 <div>
 <label class="block text-sm font-bold text-gray-700 mb-2">Stok Awal</label>
 <input type="number" name="stok" class="w-full border border-gray-300 btn-sq px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none transition" placeholder="0" required>
 </div>
 <div>
 <label class="block text-sm font-bold text-gray-700 mb-2">Batas Minimum</label>
 <input type="number" name="stok_minimum" class="w-full border border-gray-300 btn-sq px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none transition" placeholder="0" required>
 </div>
 </div>

 <div class="flex justify-between items-center pt-4 border-t border-gray-100">
 <a href="{{ route('barang.index') }}" class="text-gray-500 hover:text-gray-800 font-medium transition">Batalkan</a>
 <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 btn-sq transition-transform active:scale-95">
 Simpan ke Gudang
 </button>
 </div>
 </form>
 </div>
@endsection
