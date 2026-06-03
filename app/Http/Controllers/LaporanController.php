<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $type = $request->input('type', 'semua');

        $queryMasuk = BarangMasuk::with(['barang', 'supplier']);
        $queryKeluar = BarangKeluar::with(['barang', 'pelanggan']);

        if ($startDate) {
            $queryMasuk->whereDate('tanggal_masuk', '>=', $startDate);
            $queryKeluar->whereDate('tanggal_keluar', '>=', $startDate);
        }
        if ($endDate) {
            $queryMasuk->whereDate('tanggal_masuk', '<=', $endDate);
            $queryKeluar->whereDate('tanggal_keluar', '<=', $endDate);
        }

        $barangMasuks = collect();
        $barangKeluars = collect();

        if ($type === 'semua' || $type === 'masuk') {
            $barangMasuks = $queryMasuk->orderBy('tanggal_masuk', 'desc')->get();
        }
        
        if ($type === 'semua' || $type === 'keluar') {
            $barangKeluars = $queryKeluar->orderBy('tanggal_keluar', 'desc')->get();
        }

        return view('laporan.index', compact('barangMasuks', 'barangKeluars', 'startDate', 'endDate', 'type'));
    }
}
