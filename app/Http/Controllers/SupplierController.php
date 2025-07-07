<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // Hanya Admin yang bisa mengakses semua method di sini
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);
    }

    // Menampilkan daftar supplier
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    // Menampilkan form untuk membuat supplier baru
    public function create()
    {
        return view('admin.suppliers.create');
    }

    // Menyimpan supplier baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'contact' => 'nullable|string|max:255',
        ]);

        Supplier::create($request->only('name', 'address', 'contact'));

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }

    // Menampilkan detail supplier
    public function show(Supplier $supplier)
    {
        return view('admin.suppliers.show', compact('supplier'));
    }

    // Menampilkan form untuk mengedit supplier
    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    // Memperbarui supplier
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'contact' => 'nullable|string',
        ]);

        $supplier->update($request->only('name', 'address', 'contact'));

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    // Menghapus supplier
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}
