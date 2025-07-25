<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\ProductAttribute;
use App\Models\ActivityLog; // ✅ Tambahkan ini
use Illuminate\Support\Facades\Auth; // ✅ Tambahkan ini
use Illuminate\Http\Request;
use Carbon\Carbon;

class ManagerController extends Controller
{
    // Method untuk menampilkan dashboard
    public function index()
    {
        $lowStockProducts = Product::where('stock', '<', 10)->get();
        $todayIn = Transaction::where('type', 'in')->whereDate('transaction_date', Carbon::today())->get();
        $todayOut = Transaction::where('type', 'out')->whereDate('transaction_date', Carbon::today())->get();

        return view('manager.dashboard', compact('lowStockProducts', 'todayIn', 'todayOut'));
    }

    // Method untuk menampilkan tampilan dashboard
    public function dashboard()
    {
        return view('manager.dashboard');
    }

    // Method untuk menampilkan stok barang
    public function stock()
    {
        $transactions = Transaction::with('product')->latest()->get();
        return view('manager.stock', compact('transactions'));
    }

    // Menampilkan daftar produk
    public function products()
    {
        $products = Product::with('category', 'supplier')->get();
        return view('manager.products.index', compact('products'));
    }

    // Menampilkan detail produk
    public function showProduct(Product $product)
    {
        return view('manager.products.show', compact('product'));
    }

    // Method untuk menambahkan produk
    public function addProduct(Request $request)
    {
        // Validasi dan menambahkan produk baru
        $product = Product::create($request->all());

        // ✅ Tambahkan logging aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Membuat Produk',
            'description' => 'Produk ' . $product->name . ' ditambahkan oleh manajer.',
        ]);

        return redirect()->route('manager.products.index');
    }

    // Method untuk menampilkan daftar supplier
    public function suppliers()
    {
        $suppliers = Supplier::all();
        return view('manager.suppliers.index', compact('suppliers'));
    }

    // FUNGSI STOCK MINIMUM
    public function minimumStock()
    {
        $products = Product::all();
        return view('manager.minimum_stock.index', compact('products'));
    }

    public function updateMinimumStock(Request $request, Product $product)
    {
        $validated = $request->validate([
            'minimum_stock' => 'required|integer|min:0',
        ]);

        $product->minimum_stock = $validated['minimum_stock'];
        $product->save();

        return redirect()->route('manager.minimum_stock.index')->with('success', 'Stok minimum berhasil diperbarui.');
    }


    // FUNGSI UNTUK MENGATUR LAPORAN 
    public function showStockReport()
    {
        $products = Product::all();
        return view('manager.reports.stock', compact('products'));
    }

    public function exportStockReportPdf()
    {
        $products = Product::all();
        $pdf = Pdf::loadView('manager.reports.stock_pdf', compact('products'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan_stok_produk.pdf');
    }

    public function showTransactionsReport()
    {
        $transactions = Transaction::with('product')->get();
        return view('manager.reports.transactions', compact('transactions'));
    }

    public function exportTransactionsPdf()
    {
        $transactions = Transaction::with('product')->get();
        $pdf = Pdf::loadView('manager.reports.transactions_pdf', compact('transactions'));
        return $pdf->download('laporan_transaksi.pdf');
    }

    public function showActivityReport()
    {
        $activities = ActivityLog::with('user')->paginate(10);
        return view('manager.reports.activity', compact('activities'));
    }

    public function exportActivityReportPdf()
    {
        $activities = ActivityLog::with('user')->get();
        $pdf = Pdf::loadView('manager.reports.activity_pdf', compact('activities'));
        return $pdf->download('laporan_aktivitas.pdf');
    }


    // === Kategori ===
    public function categoriesIndex()
    {
        $categories = Category::all();
        return view('manager.categories.index', compact('categories'));
    }

    public function categoriesCreate()
    {
        return view('manager.categories.create');
    }

    public function categoriesStore(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Category::create($request->only('name'));
        return redirect()->route('manager.categories.index')->with('success', 'Kategori ditambahkan.');
    }

    public function categoriesEdit(Category $category)
    {
        return view('manager.categories.edit', compact('category'));
    }

    public function categoriesUpdate(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category->update($request->only('name'));
        return redirect()->route('manager.categories.index')->with('success', 'Kategori diperbarui.');
    }

    public function categoriesDestroy(Category $category)
    {
        $category->delete();
        return redirect()->route('manager.categories.index')->with('success', 'Kategori dihapus.');
    }

    // === Atribut Produk ===
    public function attributesIndex()
    {
        $attributes = ProductAttribute::latest()->paginate(10);
        return view('manager.attributes.index', compact('attributes'));
    }

    public function attributesCreate()
    {
        return view('manager.attributes.create');
    }

    public function attributesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);
        ProductAttribute::create($request->only('name', 'value'));
        return redirect()->route('manager.attributes.index')->with('success', 'Atribut ditambahkan.');
    }

    public function attributesEdit(ProductAttribute $attribute)
    {
        return view('manager.attributes.edit', compact('attribute'));
    }

    public function attributesUpdate(Request $request, ProductAttribute $attribute)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);
        $attribute->update($request->only('name', 'value'));
        return redirect()->route('manager.attributes.index')->with('success', 'Atribut diperbarui.');
    }

    public function attributesDestroy(ProductAttribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('manager.attributes.index')->with('success', 'Atribut dihapus.');
    }


}
