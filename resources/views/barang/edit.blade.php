@extends("layouts.app")

@section("content")
<div class="w-full max-w-lg bg-white p-8 btn-sq border border-gray-100">
 <h1 class="text-2xl font-extrabold text-indigo-600 mb-6 tracking-tight">Edit Data Inventory</h1>

 <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
 @csrf
 @method('PUT')

 <div class="mb-5">
 <label class="block text-sm font-bold text-gray-700 mb-2">Nama Item</label>
 <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" 
 class="w-full border border-gray-300 btn-sq px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none transition" required>
 </div>

 <div class="grid grid-cols-2 gap-5 mb-5">
 <div>
 <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
 <input type="text" name="kategori" value="{{ $barang->kategori }}" 
 class="w-full border border-gray-300 btn-sq px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none transition" required>
 </div>
 <div>
 <label class="block text-sm font-bold text-gray-700 mb-2">Satuan</label>
 <input type="text" name="satuan" value="{{ $barang->satuan }}" 
 class="w-full border border-gray-300 btn-sq px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none transition" required>
 </div>
 </div>

 <div class="grid grid-cols-2 gap-5 mb-8">
 <div>
 <label class="block text-sm font-bold text-gray-700 mb-2">Stok Saat Ini</label>
 <input type="number" name="stok" value="{{ $barang->stok }}" 
 class="w-full border border-gray-300 btn-sq px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none transition" required>
 </div>
 <div>
 <label class="block text-sm font-bold text-gray-700 mb-2">Batas Minimum</label>
 <input type="number" name="stok_minimum" value="{{ $barang->stok_minimum }}" 
 class="w-full border border-gray-300 btn-sq px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none transition" required>
 </div>
 </div>

 <div class="flex justify-between items-center pt-4 border-t border-gray-100">
 <a href="{{ route('barang.index') }}" class="text-gray-500 hover:text-gray-800 font-medium transition">Batalkan</a>
 <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 btn-sq transition-transform active:scale-95">
 Simpan Perubahan
 </button>
 </div>
 </form>
 </div>
@endsection
