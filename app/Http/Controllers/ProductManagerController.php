<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\ProductAttribute;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductManagerController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::with(['category', 'supplier', 'attributes'])->get();
        return view('manager.products.index', compact('products'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        // Mengambil semua data atribut dari database
        $attributes = ProductAttribute::all();
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('manager.products.create', compact('categories', 'suppliers', 'attributes'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'attributes' => 'array',
            'attributes.*' => 'exists:product_attributes,id',
        ]);

        // Menyimpan produk ke tabel products
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'purchase_price' => $validated['purchase_price'],
            'sale_price' => $validated['sale_price'],
            'stock' => $validated['stock'],
            'category_id' => $validated['category_id'],
            'supplier_id' => $validated['supplier_id'],
        ]);

        // Menyinkronkan atribut dengan produk
        if ($validated['attributes']) {
            $product->attributes()->sync($validated['attributes']);
        }

        // Logging aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'Manager',
            'activity' => 'Membuat Produk',
            'description' => 'Produk ' . $product->name . ' ditambahkan.',
        ]);

        return redirect()->route('manager.products.index');
    }

    // Menampilkan form edit produk
    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $attributes = ProductAttribute::all();
        return view('manager.products.edit', compact('product', 'categories', 'suppliers', 'attributes'));
    }

    // Memperbarui produk
    // Memperbarui produk
    public function update(Request $request, Product $product)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'attributes' => 'array',
            'attributes.*' => 'exists:product_attributes,id',
        ]);

        // Memperbarui data produk
        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'purchase_price' => $validated['purchase_price'],
            'sale_price' => $validated['sale_price'],
            'stock' => $validated['stock'],
            'category_id' => $validated['category_id'],
            'supplier_id' => $validated['supplier_id'],
        ]);

        // Sinkronkan atribut produk yang dipilih
        if ($validated['attributes']) {
            $product->attributes()->sync($validated['attributes']);
        } else {
            // Jika tidak ada atribut yang dipilih, pastikan atribut terhapus
            $product->attributes()->sync([]);
        }

        // Logging aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'Manager',
            'activity' => 'Mengupdate Produk',
            'description' => 'Produk ' . $product->name . ' diperbarui.',
        ]);

        // Redirect ke halaman produk
        return redirect()->route('manager.products.index')->with('success', 'Produk berhasil diperbarui.');
    }


    // Menghapus produk
    // Menghapus produk
    public function destroy(Product $product)
    {
        $productName = $product->name;

        // Menghapus produk
        $product->delete();

        // Logging aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'Manager',
            'activity' => 'Menghapus Produk',
            'description' => 'Produk ' . $productName . ' dihapus.',
        ]);

        // Redirect ke halaman produk
        return redirect()->route('manager.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    // Menampilkan detail produk
    public function show(Product $product)
    {
        return view('manager.products.show', compact('product'));
    }
}
