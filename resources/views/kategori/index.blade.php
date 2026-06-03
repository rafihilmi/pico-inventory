@extends("layouts.app")

@section("content")
<div class="container mx-auto max-w-6xl" x-data="{ showModal: false, showEditModal: false, editData: {} }">
    <div class="text-[#3c8dbc] text-sm font-semibold mb-6 flex items-center gap-2">
        <span>Dashboard</span> <span class="text-gray-400">/</span> <span>Kategori</span> <span class="text-gray-400">/</span> <span class="text-gray-500">Data Kategori</span>
    </div>

    @if(session('success'))
    <div class="bg-[#dff0d8] border border-[#d6e9c6] text-[#3c763d] p-3 mb-4 text-sm btn-sq flex justify-between">
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="font-bold">&times;</button>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-[#f2dede] border border-[#ebccd1] text-[#a94442] p-3 mb-4 text-sm btn-sq flex justify-between">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button onclick="this.parentElement.remove()" class="font-bold">&times;</button>
    </div>
    @endif

    <div class="bg-white border border-gray-300 btn-sq mb-6">
        <div class="border-b border-gray-200 bg-white p-3 flex items-center gap-2 text-gray-700 font-bold text-lg">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            Data kategori <span class="bg-gray-400 text-white text-xs px-2 py-0.5 rounded-sm ml-1">{{ $kategoris->count() }}</span>
        </div>
        
        <div class="p-4">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                <div class="flex gap-2">
                    <button @click="showModal = true" class="bg-[#5bc0de] hover:bg-[#31b0d5] text-white px-3 py-1.5 btn-sq text-sm flex items-center gap-1">
                        Tambah
                    </button>
                    <a href="{{ route('kategori.index') }}" class="bg-[#f4f4f4] border border-[#ddd] hover:bg-[#e7e7e7] text-gray-700 px-3 py-1.5 btn-sq text-sm flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Refresh
                    </a>
                </div>
                <form action="{{ route('kategori.index') }}" method="GET" class="flex gap-2 w-full sm:w-auto">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari kategori..." class="flex-1 sm:w-64 border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]">
                    <button type="submit" class="bg-[#3c8dbc] hover:bg-[#367fa9] text-white px-3 py-1.5 btn-sq text-sm">Cari</button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full table-sq text-sm">
                    <thead>
                        <tr>
                            <th class="px-2 py-2 text-left w-24">Action</th>
                            <th class="px-3 py-2 text-left w-16">No</th>
                            <th class="px-3 py-2 text-left">Kode Group</th>
                            <th class="px-3 py-2 text-left">Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $index => $k)
                        <tr class="hover:bg-gray-50 border-b border-gray-100">
                            <td class="px-2 py-2">
                                <div class="flex gap-1">
                                    <button @click="showEditModal = true; editData = { id: '{{ $k->id_kategori }}', kode: '{{ addslashes($k->kode) }}', nama: '{{ addslashes($k->nama) }}' }" class="bg-[#00a65a] text-white p-1 btn-sq hover:bg-[#008d4c]" title="Edit">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <form action="{{ route('kategori.destroy', $k->id_kategori) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-[#dd4b39] text-white p-1 btn-sq hover:bg-[#d73925]" title="Hapus">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-3 py-2 text-gray-800">{{ $index + 1 }}</td>
                            <td class="px-3 py-2 text-gray-800">{{ $k->kode }}</td>
                            <td class="px-3 py-2 text-gray-800">{{ $k->nama }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-3 py-4 text-center text-gray-400">Belum ada data kategori.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak style="display: none;">
        <div class="w-full max-w-2xl bg-white btn-sq shadow-xl" @click.away="showModal = false">
            <div class="border-b border-gray-200 p-4 flex justify-between items-center bg-white">
                <h2 class="text-lg text-gray-700">Tambah Kategori</h2>
                <button @click="showModal = false" class="text-gray-400 hover:text-gray-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>

            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="p-6 grid grid-cols-1 gap-4">
                    <div class="flex items-center">
                        <label class="w-32 text-sm text-gray-600 shrink-0">Kode Group</label>
                        <span class="mr-2 text-gray-600">:</span>
                        <input type="text" name="kode" class="flex-1 border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]" required>
                    </div>
                    
                    <div class="flex items-center">
                        <label class="w-32 text-sm text-gray-600 shrink-0">Nama Kategori</label>
                        <span class="mr-2 text-gray-600">:</span>
                        <input type="text" name="nama" class="flex-1 border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]" required>
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

    <!-- Modal Edit Kategori -->
    <div x-show="showEditModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak style="display: none;">
        <div class="w-full max-w-2xl bg-white btn-sq shadow-xl" @click.away="showEditModal = false">
            <div class="border-b border-gray-200 p-4 flex justify-between items-center bg-white">
                <h2 class="text-lg text-gray-700">Edit Kategori</h2>
                <button @click="showEditModal = false" class="text-gray-400 hover:text-gray-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>

            <form :action="'{{ route('kategori.index') }}/' + editData.id" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6 grid grid-cols-1 gap-4">
                    <div class="flex items-center">
                        <label class="w-32 text-sm text-gray-600 shrink-0">Kode Group</label>
                        <span class="mr-2 text-gray-600">:</span>
                        <input type="text" name="kode" x-model="editData.kode" class="flex-1 border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]" required>
                    </div>
                    
                    <div class="flex items-center">
                        <label class="w-32 text-sm text-gray-600 shrink-0">Nama Kategori</label>
                        <span class="mr-2 text-gray-600">:</span>
                        <input type="text" name="nama" x-model="editData.nama" class="flex-1 border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]" required>
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
