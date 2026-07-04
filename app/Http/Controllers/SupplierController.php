<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');
        $query = Supplier::query();
        if ($search) {
            $query->where('nama_supplier', 'ilike', "%{$search}%");
        }
        $suppliers = $query->get();
        return view('supplier.index', compact('suppliers', 'search'));
    }

    public function create() {
        return view('supplier.create');
    }

    public function store(Request $request) {
        $request->validate(['nama_supplier' => 'required', 'alamat' => 'required', 'no_telp' => 'required']);
        Supplier::create($request->all());
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambah!');
    }

    public function edit($id) {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id) {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diupdate!');
    }

    public function destroy($id) {
        Supplier::destroy($id);
        return redirect()->route('supplier.index')->with('success', 'Supplier dihapus!');
    }
}