<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Pelanggan;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalSupplier = Supplier::count();
        $totalPelanggan = Pelanggan::count();
        $stokKritis = Barang::whereColumn('stok', '<=', 'stok_minimum')->count();
        $listStokKritis = Barang::whereColumn('stok', '<=', 'stok_minimum')->get();
        $recentMasuk = BarangMasuk::with('barang')->latest()->take(5)->get();
        $recentKeluar = BarangKeluar::with('barang')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalSupplier',
            'totalPelanggan',
            'stokKritis',
            'listStokKritis',
            'recentMasuk',
            'recentKeluar'
        ));
    }
}
