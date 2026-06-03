@extends("layouts.app")

@section("content")
<div class="container mx-auto max-w-6xl">
    <div class="text-[#3c8dbc] text-sm font-semibold mb-6 flex items-center gap-2">
        <span>Dashboard</span> <span class="text-gray-400">/</span> <span class="text-gray-500">Laporan Transaksi</span>
    </div>

    <!-- Filter Section -->
    <div class="bg-white border border-gray-300 btn-sq mb-6 p-4">
        <form action="{{ route('laporan.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
            <div class="flex flex-col gap-1">
                <label class="text-sm text-gray-600">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]">
            </div>
            <div class="flex flex-col gap-1">
                <label class="text-sm text-gray-600">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc]">
            </div>
            <div class="flex flex-col gap-1">
                <label class="text-sm text-gray-600">Jenis Transaksi</label>
                <select name="type" class="border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:border-[#3c8dbc] w-48">
                    <option value="semua" {{ $type === 'semua' ? 'selected' : '' }}>Semua</option>
                    <option value="masuk" {{ $type === 'masuk' ? 'selected' : '' }}>Barang Masuk</option>
                    <option value="keluar" {{ $type === 'keluar' ? 'selected' : '' }}>Barang Keluar</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-[#3c8dbc] hover:bg-[#367fa9] text-white px-4 py-1.5 text-sm btn-sq flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter
                </button>
                <a href="{{ route('laporan.index') }}" class="bg-[#f4f4f4] border border-[#ddd] hover:bg-[#e7e7e7] text-gray-700 px-4 py-1.5 btn-sq text-sm flex items-center gap-1">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Data Barang Masuk -->
    @if($type === 'semua' || $type === 'masuk')
    <div class="bg-white border border-gray-300 btn-sq mb-6">
        <div class="border-b border-gray-200 bg-white p-3 flex items-center gap-2 text-gray-700 font-bold text-lg">
            <svg class="w-5 h-5 text-[#00a65a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z"></path></svg>
            Laporan Barang Masuk
        </div>
        <div class="p-4 overflow-x-auto">
            <table class="w-full table-sq text-sm">
                <thead>
                    <tr>
                        <th class="px-3 py-2 text-left">Tanggal Masuk</th>
                        <th class="px-3 py-2 text-left">Barang</th>
                        <th class="px-3 py-2 text-left">Supplier</th>
                        <th class="px-3 py-2 text-left">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangMasuks as $bm)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 text-gray-800">{{ \Carbon\Carbon::parse($bm->tanggal_masuk)->format('d-m-Y') }}</td>
                        <td class="px-3 py-2 text-gray-800">{{ $bm->barang ? $bm->barang->nama_barang : '-' }}</td>
                        <td class="px-3 py-2 text-gray-800">{{ $bm->supplier ? $bm->supplier->nama_supplier : '-' }}</td>
                        <td class="px-3 py-2 text-gray-800 font-semibold text-[#00a65a]">+{{ $bm->jumlah_barang }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-3 py-4 text-center text-gray-400">Tidak ada data barang masuk untuk filter ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Data Barang Keluar -->
    @if($type === 'semua' || $type === 'keluar')
    <div class="bg-white border border-gray-300 btn-sq mb-6">
        <div class="border-b border-gray-200 bg-white p-3 flex items-center gap-2 text-gray-700 font-bold text-lg">
            <svg class="w-5 h-5 text-[#dd4b39]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path></svg>
            Laporan Barang Keluar
        </div>
        <div class="p-4 overflow-x-auto">
            <table class="w-full table-sq text-sm">
                <thead>
                    <tr>
                        <th class="px-3 py-2 text-left">Tanggal Keluar</th>
                        <th class="px-3 py-2 text-left">Barang</th>
                        <th class="px-3 py-2 text-left">Pelanggan</th>
                        <th class="px-3 py-2 text-left">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangKeluars as $bk)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 text-gray-800">{{ \Carbon\Carbon::parse($bk->tanggal_keluar)->format('d-m-Y') }}</td>
                        <td class="px-3 py-2 text-gray-800">{{ $bk->barang ? $bk->barang->nama_barang : '-' }}</td>
                        <td class="px-3 py-2 text-gray-800">{{ $bk->pelanggan ? $bk->pelanggan->nama_pelanggan : '-' }}</td>
                        <td class="px-3 py-2 text-gray-800 font-semibold text-[#dd4b39]">-{{ $bk->jumlah_barang }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-3 py-4 text-center text-gray-400">Tidak ada data barang keluar untuk filter ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

</div>
@endsection
