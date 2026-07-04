<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satuan;

class SatuanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Satuan::query();
        if ($search) {
            $query->where('nama', 'ilike', "%{$search}%")->orWhere('kode', 'ilike', "%{$search}%");
        }
        $satuans = $query->get();
        return view('satuan.index', compact('satuans', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:satuans,kode',
            'nama' => 'required'
        ]);

        Satuan::create($request->all());

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|unique:satuans,kode,'.$id.',id_satuan',
            'nama' => 'required'
        ]);

        $satuan = Satuan::findOrFail($id);
        $satuan->update($request->all());

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $satuan = Satuan::findOrFail($id);
        $satuan->delete();

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil dihapus!');
    }
}
