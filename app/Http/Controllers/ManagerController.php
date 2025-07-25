<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Transaction;
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
}
