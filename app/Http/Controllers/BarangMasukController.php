<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('kategori');

        $query = BarangMasuk::with(['barang.kategori', 'supplier'])->latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('barang', function($q2) use ($search) {
                    $q2->where('nama_barang', 'ilike', "%{$search}%")
                       ->orWhere('sku', 'ilike', "%{$search}%");
                })->orWhereHas('supplier', function($q2) use ($search) {
                    $q2->where('nama_supplier', 'ilike', "%{$search}%");
                });
            });
        }

        if ($categoryFilter) {
            $query->whereHas('barang', function($q) use ($categoryFilter) {
                $q->where('id_kategori', $categoryFilter);
            });
        }

        $barangMasuks = $query->get();
        $barangs = Barang::all();
        $suppliers = Supplier::all();
        $kategoris = \App\Models\Kategori::all();
        return view('barang_masuk.index', compact('barangMasuks', 'barangs', 'suppliers', 'kategoris', 'search', 'categoryFilter'));
    }

    public function create()
    {
        $barangs = Barang::all();
        $suppliers = Supplier::all();
        return view('barang_masuk.create', compact('barangs', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang'      => 'required|exists:barangs,id_barang',
            'id_supplier'    => 'required|exists:suppliers,id_supplier',
            'tanggal_masuk'  => 'required|date',
            'jumlah_barang'  => 'required|integer|min:1',
        ]);

        BarangMasuk::create($request->all());

        // Auto-update stok barang (tambah)
        $barang = Barang::findOrFail($request->id_barang);
        $barang->increment('stok', $request->jumlah_barang);

        return redirect()->route('barang-masuk.index')
            ->with('success', 'Barang masuk berhasil dicatat! Stok telah ditambahkan.');
    }

    public function edit($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangs = Barang::all();
        $suppliers = Supplier::all();
        return view('barang_masuk.edit', compact('barangMasuk', 'barangs', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_barang'      => 'required|exists:barangs,id_barang',
            'id_supplier'    => 'required|exists:suppliers,id_supplier',
            'tanggal_masuk'  => 'required|date',
            'jumlah_barang'  => 'required|integer|min:1',
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);

        // Kembalikan stok lama, lalu tambah stok baru
        $barangLama = Barang::findOrFail($barangMasuk->id_barang);
        $barangLama->decrement('stok', $barangMasuk->jumlah_barang);

        $barangMasuk->update($request->all());

        $barangBaru = Barang::findOrFail($request->id_barang);
        $barangBaru->increment('stok', $request->jumlah_barang);

        return redirect()->route('barang-masuk.index')
            ->with('success', 'Data barang masuk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        // Kembalikan stok
        $barang = Barang::findOrFail($barangMasuk->id_barang);
        $barang->decrement('stok', $barangMasuk->jumlah_barang);

        $barangMasuk->delete();

        return redirect()->route('barang-masuk.index')
            ->with('success', 'Catatan barang masuk dihapus dan stok dikembalikan.');
    }
}
