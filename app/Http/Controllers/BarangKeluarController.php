<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('kategori');

        $query = BarangKeluar::with(['barang.kategori', 'pelanggan'])->latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('barang', function($q2) use ($search) {
                    $q2->where('nama_barang', 'like', "%{$search}%");
                })->orWhereHas('pelanggan', function($q2) use ($search) {
                    $q2->where('nama_pelanggan', 'like', "%{$search}%");
                });
            });
        }

        if ($categoryFilter) {
            $query->whereHas('barang', function($q) use ($categoryFilter) {
                $q->where('id_kategori', $categoryFilter);
            });
        }

        $barangKeluars = $query->get();
        $barangs = Barang::all();
        $pelanggans = Pelanggan::all();
        $kategoris = \App\Models\Kategori::all();
        return view('barang_keluar.index', compact('barangKeluars', 'barangs', 'pelanggans', 'kategoris', 'search', 'categoryFilter'));
    }

    public function create()
    {
        $barangs = Barang::all();
        $pelanggans = Pelanggan::all();
        return view('barang_keluar.create', compact('barangs', 'pelanggans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang'       => 'required|exists:barangs,id_barang',
            'id_pelanggan'    => 'required|exists:pelanggans,id_pelanggan',
            'tanggal_keluar'  => 'required|date',
            'jumlah_barang'   => 'required|integer|min:1',
        ]);

        // Cek stok cukup
        $barang = Barang::findOrFail($request->id_barang);
        if ($barang->stok < $request->jumlah_barang) {
            return back()->withErrors(['jumlah_barang' => 'Stok tidak mencukupi! Stok tersedia: ' . $barang->stok])
                ->withInput();
        }

        BarangKeluar::create($request->all());

        // Auto-update stok barang (kurangi)
        $barang->decrement('stok', $request->jumlah_barang);

        return redirect()->route('barang-keluar.index')
            ->with('success', 'Barang keluar berhasil dicatat! Stok telah dikurangi.');
    }

    public function edit($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        $barangs = Barang::all();
        $pelanggans = Pelanggan::all();
        return view('barang_keluar.edit', compact('barangKeluar', 'barangs', 'pelanggans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_barang'       => 'required|exists:barangs,id_barang',
            'id_pelanggan'    => 'required|exists:pelanggans,id_pelanggan',
            'tanggal_keluar'  => 'required|date',
            'jumlah_barang'   => 'required|integer|min:1',
        ]);

        $barangKeluar = BarangKeluar::findOrFail($id);

        // Kembalikan stok lama
        $barangLama = Barang::findOrFail($barangKeluar->id_barang);
        $barangLama->increment('stok', $barangKeluar->jumlah_barang);

        // Cek stok cukup untuk jumlah baru
        $barangBaru = Barang::findOrFail($request->id_barang);
        if ($barangBaru->stok < $request->jumlah_barang) {
            // Rollback stok lama
            $barangLama->decrement('stok', $barangKeluar->jumlah_barang);
            return back()->withErrors(['jumlah_barang' => 'Stok tidak mencukupi! Stok tersedia: ' . $barangBaru->stok])
                ->withInput();
        }

        $barangKeluar->update($request->all());

        // Kurangi stok baru
        $barangBaru->decrement('stok', $request->jumlah_barang);

        return redirect()->route('barang-keluar.index')
            ->with('success', 'Data barang keluar berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        // Kembalikan stok
        $barang = Barang::findOrFail($barangKeluar->id_barang);
        $barang->increment('stok', $barangKeluar->jumlah_barang);

        $barangKeluar->delete();

        return redirect()->route('barang-keluar.index')
            ->with('success', 'Catatan barang keluar dihapus dan stok dikembalikan.');
    }
}
