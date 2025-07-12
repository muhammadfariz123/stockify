<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ActivityLog; // ✅ Tambahkan
use Illuminate\Support\Facades\Auth; // ✅ Tambahkan
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Hanya Admin yang bisa mengakses semua method di sini
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);
    }

    // Menampilkan daftar kategori
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('admin.categories.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($request->only('name', 'description'));

        // ✅ Logging aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Membuat Kategori',
            'description' => 'Kategori "' . $category->name . '" ditambahkan.',
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan detail kategori
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    // Menampilkan form untuk mengedit kategori
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Memperbarui kategori
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->only('name', 'description'));

        // ✅ Logging aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Memperbarui Kategori',
            'description' => 'Kategori "' . $category->name . '" diperbarui.',
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy(Category $category)
    {
        $categoryName = $category->name; // Simpan nama sebelum dihapus
        $category->delete();

        // ✅ Logging aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Menghapus Kategori',
            'description' => 'Kategori "' . $categoryName . '" dihapus.',
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }
}
