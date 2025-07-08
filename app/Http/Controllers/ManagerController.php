<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon; // Pastikan Carbon diimpor

class ManagerController extends Controller
{
    // Method untuk menampilkan dashboard
    public function index()
    {
        // Mendapatkan produk dengan stok menipis
        $lowStockProducts = Product::where('stock', '<', 10)->get();

        // Barang masuk hari ini
        $todayIn = Transaction::where('type', 'in')->whereDate('transaction_date', Carbon::today())->get();

        // Barang keluar hari ini
        $todayOut = Transaction::where('type', 'out')->whereDate('transaction_date', Carbon::today())->get();

        return view('manager.dashboard', compact('lowStockProducts', 'todayIn', 'todayOut'));
    }

    // Method untuk menampilkan tampilan dashboard
    public function dashboard()
    {
        // Pastikan mengembalikan tampilan yang sesuai
        return view('manager.dashboard');
    }

    // Method untuk menampilkan stok barang
    public function stock()
    {
        // Menampilkan data transaksi barang masuk/keluar
        $transactions = Transaction::with('product')->latest()->get();
        return view('manager.stock', compact('transactions'));
    }

    // Method untuk menampilkan produk
    public function products()
    {
        // Menampilkan daftar produk
        $products = Product::with('category', 'supplier')->get();
        return view('manager.products', compact('products'));
    }

    // Method untuk menambahkan produk
    public function addProduct(Request $request)
    {
        // Validasi dan menambahkan produk baru
        $product = Product::create($request->all());
        return redirect()->route('manager.products.index');
    }

    // Method untuk menampilkan daftar supplier
    public function suppliers()
    {
        // Menampilkan daftar supplier
        $suppliers = Supplier::all();
        return view('manager.suppliers', compact('suppliers'));
    }

    // Method untuk laporan
    public function reports()
    {
        // Laporan stok barang, barang masuk/keluar
        $reportData = Transaction::with('product')->get();
        return view('manager.reports', compact('reportData'));
    }

    public function showStock()
    {
        // Ambil semua produk dari database
        $products = Product::all();

        // Tampilkan view manager.stock dengan data produk
        return view('manager.stock', compact('products'));
    }
}
