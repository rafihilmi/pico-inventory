<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('kategori');
        
        $query = Barang::with(['kategori', 'satuan']);
        
        if ($search) {
            $query->where('nama_barang', 'like', "%{$search}%");
        }
        
        if ($categoryFilter) {
            $query->where('id_kategori', $categoryFilter);
        }
        
        $barangs = $query->get();
        $kategoris = Kategori::all();
        $satuans = Satuan::all();
        return view('barang.index', compact('barangs', 'kategoris', 'satuans', 'search', 'categoryFilter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'   => 'required|string|max:255',
            'id_kategori'   => 'required|exists:kategoris,id_kategori',
            'id_satuan'     => 'required|exists:satuans,id_satuan',
            'stok'          => 'required|integer|min:0',
            'stok_minimum'  => 'required|integer|min:0',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')
            ->with('success', 'Data Inventory berhasil ditambahkan ke sistem!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang'   => 'required|string|max:255',
            'id_kategori'   => 'required|exists:kategoris,id_kategori',
            'id_satuan'     => 'required|exists:satuans,id_satuan',
            'stok'          => 'required|integer|min:0',
            'stok_minimum'  => 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')
            ->with('success', 'Data Inventory berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Data Inventory telah berhasil dihapus dari sistem.');
    }
}