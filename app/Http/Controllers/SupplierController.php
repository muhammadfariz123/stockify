<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\ActivityLog; // ✅ Tambahkan ini
use Illuminate\Support\Facades\Auth; // ✅ Tambahkan ini
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
        $suppliers = Supplier::all(); // Mengambil semua data supplier
        return view('admin.suppliers.index', compact('suppliers'));
        return view('manager.suppliers.index', compact('suppliers'));  // Mengirim data ke tampilan
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

        $supplier = Supplier::create($request->only('name', 'address', 'contact'));

        // ✅ Logging aktivitas membuat supplier
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Membuat Supplier',
            'description' => 'Supplier "' . $supplier->name . '" berhasil ditambahkan.',
        ]);

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

        // ✅ Logging aktivitas memperbarui supplier
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Memperbarui Supplier',
            'description' => 'Supplier "' . $supplier->name . '" berhasil diperbarui.',
        ]);

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    // Menghapus supplier
    public function destroy(Supplier $supplier)
    {
        $supplierName = $supplier->name;
        $supplier->delete();

        // ✅ Logging aktivitas menghapus supplier
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Menghapus Supplier',
            'description' => 'Supplier "' . $supplierName . '" berhasil dihapus.',
        ]);

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}
