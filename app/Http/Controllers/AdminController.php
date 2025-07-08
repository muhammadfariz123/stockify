<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Transaction; // Asumsi Anda memiliki model untuk transaksi
use App\Models\User; // Asumsi Anda ingin menampilkan aktivitas pengguna terbaru
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        // Ambil data yang diperlukan untuk dashboard
        $productsCount = Product::count(); // Jumlah produk
        $incomingTransactions = 20; // Data dummy untuk transaksi masuk
        $outgoingTransactions = 15; // Data dummy untuk transaksi keluar
        // Ambil semua produk dengan nama dan stok
        $products = Product::select('name', 'stock')->get();  // Ambil produk dan stoknya


        // Ambil aktivitas pengguna terbaru, misalnya pengguna yang login atau melakukan transaksi terbaru
        $latestUsers = User::latest()->take(5)->get(); // Ambil 5 pengguna terbaru

        // Grafik stok barang (misalnya, jumlah produk yang tersedia)
        // Gunakan data dummy untuk stok barang
        $stockGraphData = Product::select('name', 'purchase_price')->get(); // Ambil nama produk dan harga beli sebagai pengganti stok

        // Kirim data ke view dashboard
        return view('admin.dashboard', compact(
            'productsCount',
            'incomingTransactions',
            'outgoingTransactions',
            'products',
            'latestUsers',
            'stockGraphData'
        ));
    }

    // === Produk CRUD ===
    public function index()
    {
        $products = Product::all();
        $products = Product::with('category', 'supplier')->get();
        $categoriesCount = Category::count(); // Menambahkan jumlah kategori

        return view('admin.products.index', compact('products', 'categoriesCount'));
    }

    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori
        $suppliers = Supplier::all(); // Ambil semua supplier
        return view('admin.products.create', compact('categories', 'suppliers')); // Kirim kategori dan supplier ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',  // Validasi harga jual
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'description' => 'nullable|string',
        ]);

        // Simpan produk
        Product::create([
            'name' => $request->name,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,  // Menyimpan harga jual
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'description' => $request->description,  // Menyimpan deskripsi
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }


    // Menampilkan halaman edit produk
    public function edit(Product $product)
    {
        $categories = Category::all();  // Ambil semua kategori
        $suppliers = Supplier::all();  // Ambil semua supplier
        return view('admin.products.edit', compact('product', 'categories', 'suppliers')); // Kirim data ke view
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        // Update produk dengan kategori yang baru
        $product->update([
            'name' => $request->name,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'category_id' => $request->category_id,  // Menyimpan category_id yang baru
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    // === Kategori CRUD ===
    public function indexCategories()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.categories.create');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        Category::create($request->only(['name', 'description']));
        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function showCategory(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function editCategory(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $category->update($request->only(['name', 'description']));
        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    // === Laporan ===
    public function showReports()
    {
        return view('admin.reports.index');
    }
}
