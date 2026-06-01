<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with(['kategori', 'satuan'])->get();
        $kategoris = Kategori::all();
        $satuans = Satuan::all();
        return view('barang.index', compact('barangs', 'kategoris', 'satuans'));
    }

    public function create()
    {
        return view('barang.create');
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

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
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