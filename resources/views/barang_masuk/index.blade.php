@extends("layouts.app")

@section("content")
<div class="container mx-auto max-w-6xl" x-data="{ showModal: false, showEditModal: false, editData: {} }">
    <div class="text-[#3c8dbc] text-sm font-semibold mb-6 flex items-center gap-2">
        <span>Dashboard</span> <span class="text-gray-400">/</span> <span>Barang Masuk</span> <span class="text-gray-400">/</span> <span class="text-gray-500">Inbound</span>
    </div>

    @if(session('success'))
    <div class="bg-[#dff0d8] border border-[#d6e9c6] text-[#3c763d] p-3 mb-4 text-sm btn-sq flex justify-between">
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="font-bold">&times;</button>
    </div>
    @endif

    <div class="bg-white border border-gray-300 btn-sq mb-6">
        <div class="border-b border-gray-200 bg-white p-3 flex items-center gap-2 text-gray-700 font-bold text-lg">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
            Riwayat Barang Masuk
        </div>
        
        <div class="p-4">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                <div class="flex gap-2">
                    <button @click="showModal = true" class="bg-[#00a65a] hover:bg-[#008d4c] text-white px-3 py-1.5 btn-sq text-sm flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Catat Barang Masuk
                    </button>
                    <a href="{{ route('barang-masuk.index') }}" class="bg-[#f4f4f4] border border-[#ddd] hover:bg-[#e7e7e7] text-gray-700 px-3 py-1.5 btn-sq text-sm flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Refresh
                    </a>
                </div>
                <form action="{{ route('barang-masuk.index') }}" method="GET" class="flex gap-2 w-full sm:w-auto">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari barang/supplier..." class="flex-1 sm:w-64 border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]">
                    <button type="submit" class="bg-[#3c8dbc] hover:bg-[#367fa9] text-white px-3 py-1.5 btn-sq text-sm">Cari</button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full table-sq text-sm">
                    <thead>
                        <tr>
                            <th class="px-2 py-2 text-left w-24">Action</th>
                            <th class="px-3 py-2 text-left">Tanggal</th>
                            <th class="px-3 py-2 text-left">Nama Barang</th>
                            <th class="px-3 py-2 text-left">Supplier</th>
                            <th class="px-3 py-2 text-left">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangMasuks as $bm)
                        <tr class="hover:bg-gray-50">
                            <td class="px-2 py-2">
                                <div class="flex gap-1">
                                    <button @click="showEditModal = true; editData = { id: '{{ $bm->id_masuk }}', id_barang: '{{ $bm->id_barang }}', id_supplier: '{{ $bm->id_supplier }}', tanggal_masuk: '{{ date('Y-m-d', strtotime($bm->tanggal_masuk)) }}', jumlah_barang: '{{ $bm->jumlah_barang }}' }" class="bg-[#00a65a] text-white p-1 btn-sq hover:bg-[#008d4c]" title="Edit">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <form action="{{ route('barang-masuk.destroy', $bm->id_masuk) }}" method="POST" onsubmit="return confirm('Hapus catatan barang masuk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-[#dd4b39] text-white p-1 btn-sq hover:bg-[#d73925]" title="Hapus">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-3 py-2 text-gray-800">{{ date('d M Y', strtotime($bm->tanggal_masuk)) }}</td>
                            <td class="px-3 py-2 text-gray-800">{{ $bm->barang->nama_barang }}</td>
                            <td class="px-3 py-2 text-gray-800">{{ $bm->supplier->nama_supplier }}</td>
                            <td class="px-3 py-2 text-gray-800">{{ $bm->jumlah_barang }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-3 py-4 text-center text-gray-400">Belum ada data barang masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Barang Masuk -->
    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak style="display: none;">
        <div class="w-full max-w-lg bg-white btn-sq shadow-xl" @click.away="showModal = false">
            <div class="border-b border-gray-200 p-4 flex justify-between items-center bg-white">
                <h2 class="text-lg text-gray-700">Catat Barang Masuk</h2>
                <button @click="showModal = false" class="text-gray-400 hover:text-gray-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>

            <form action="{{ route('barang-masuk.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <div class="flex items-center">
                        <label class="w-32 text-sm text-gray-600 shrink-0">Item Inventory</label>
                        <span class="mr-2 text-gray-600">:</span>
                        <select name="id_barang" class="flex-1 border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]" required>
                            <option value="" disabled selected>-- Pilih Item --</option>
                            @foreach($barangs as $b)
                            <option value="{{ $b->id_barang }}">{{ $b->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="flex items-center">
                        <label class="w-32 text-sm text-gray-600 shrink-0">Supplier</label>
                        <span class="mr-2 text-gray-600">:</span>
                        <select name="id_supplier" class="flex-1 border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]" required>
                            <option value="" disabled selected>-- Pilih Supplier --</option>
                            @foreach($suppliers as $s)
                            <option value="{{ $s->id_supplier }}">{{ $s->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center">
                        <label class="w-32 text-sm text-gray-600 shrink-0">Tanggal Masuk</label>
                        <span class="mr-2 text-gray-600">:</span>
                        <input type="date" name="tanggal_masuk" value="{{ date('Y-m-d') }}" class="flex-1 border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]" required>
                    </div>

                    <div class="flex items-center">
                        <label class="w-32 text-sm text-gray-600 shrink-0">Kuantitas</label>
                        <span class="mr-2 text-gray-600">:</span>
                        <input type="number" name="jumlah_barang" min="1" class="flex-1 border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]" required>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 border-t border-gray-200 flex gap-2">
                    <button type="submit" class="bg-[#337ab7] hover:bg-[#286090] text-white px-4 py-1.5 text-sm btn-sq flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan
                    </button>
                    <button type="reset" class="bg-[#f0ad4e] hover:bg-[#ec971f] text-white px-4 py-1.5 text-sm btn-sq flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Reset
                    </button>
                    <button type="button" @click="showModal = false" class="bg-[#d9534f] hover:bg-[#c9302c] text-white px-4 py-1.5 text-sm btn-sq flex items-center gap-1">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Barang Masuk -->
    <div x-show="showEditModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak style="display: none;">
        <div class="w-full max-w-lg bg-white btn-sq shadow-xl" @click.away="showEditModal = false">
            <div class="border-b border-gray-200 p-4 flex justify-between items-center bg-white">
                <h2 class="text-lg text-gray-700">Edit Barang Masuk</h2>
                <button @click="showEditModal = false" class="text-gray-400 hover:text-gray-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>

            <form :action="'{{ route('barang-masuk.index') }}/' + editData.id" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div class="flex items-center">
                        <label class="w-32 text-sm text-gray-600 shrink-0">Item Inventory</label>
                        <span class="mr-2 text-gray-600">:</span>
                        <select name="id_barang" x-model="editData.id_barang" class="flex-1 border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]" required>
                            @foreach($barangs as $b)
                            <option value="{{ $b->id_barang }}">{{ $b->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="flex items-center">
                        <label class="w-32 text-sm text-gray-600 shrink-0">Supplier</label>
                        <span class="mr-2 text-gray-600">:</span>
                        <select name="id_supplier" x-model="editData.id_supplier" class="flex-1 border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]" required>
                            @foreach($suppliers as $s)
                            <option value="{{ $s->id_supplier }}">{{ $s->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center">
                        <label class="w-32 text-sm text-gray-600 shrink-0">Tanggal Masuk</label>
                        <span class="mr-2 text-gray-600">:</span>
                        <input type="date" name="tanggal_masuk" x-model="editData.tanggal_masuk" class="flex-1 border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]" required>
                    </div>

                    <div class="flex items-center">
                        <label class="w-32 text-sm text-gray-600 shrink-0">Kuantitas</label>
                        <span class="mr-2 text-gray-600">:</span>
                        <input type="number" name="jumlah_barang" x-model="editData.jumlah_barang" min="1" class="flex-1 border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]" required>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 border-t border-gray-200 flex gap-2">
                    <button type="submit" class="bg-[#337ab7] hover:bg-[#286090] text-white px-4 py-1.5 text-sm btn-sq flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan
                    </button>
                    <button type="button" @click="showEditModal = false" class="bg-[#d9534f] hover:bg-[#c9302c] text-white px-4 py-1.5 text-sm btn-sq flex items-center gap-1">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
