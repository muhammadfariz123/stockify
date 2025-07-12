<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::with(['category', 'supplier'])->get();
        return view('manager.products', compact('products'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('manager.create-product', compact('categories', 'suppliers'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $product = Product::create($validated);

        // Logging aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Membuat Produk',
            'description' => 'Produk ' . $product->name . ' ditambahkan.',
        ]);

        return redirect()->route('manager.products.index');
    }

    // Menampilkan form edit
    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('manager.edit-product', compact('product', 'categories', 'suppliers'));
    }

    // Memperbarui produk
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $product->update($validated);

        // Logging aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Mengupdate Produk',
            'description' => 'Produk ' . $product->name . ' diperbarui.',
        ]);

        return redirect()->route('manager.products.index');
    }

    // Menghapus produk
    public function destroy(Product $product)
    {
        $productName = $product->name;
        $product->delete();

        // Logging aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Menghapus Produk',
            'description' => 'Produk ' . $productName . ' dihapus.',
        ]);

        return redirect()->route('manager.products.index');
    }
}
