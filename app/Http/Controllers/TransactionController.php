<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Supplier;
use App\Models\ActivityLog; // ✅ Tambahkan
use Illuminate\Support\Facades\Auth; // ✅ Tambahkan
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Menampilkan form untuk barang masuk
    public function showIncomingForm()
    {
        $products = Product::all();  // Ambil semua produk
        $suppliers = Supplier::all();  // Ambil semua supplier
        return view('manager.transactions.in', compact('products', 'suppliers'));  // Kirim data ke tampilan
    }

    public function showOutgoingForm()
    {
        $products = Product::all();  // Ambil semua produk
        return view('manager.transactions.out', compact('products'));
    }

    // Menampilkan transaksi masuk
    public function in()
    {
        $transactions = Transaction::where('type', 'in')->get();  // Filter transaksi masuk
        return view('manager.transactions.in', compact('transactions'));
    }

    // Menampilkan transaksi keluar
    public function out()
    {
        $transactions = Transaction::where('type', 'out')->get();  // Filter transaksi keluar
        return view('manager.transactions.out', compact('transactions'));
    }

    // Menyimpan transaksi barang masuk
    public function storeIncoming(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        // Catat transaksi masuk
        Transaction::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'supplier_id' => $request->supplier_id,
            'type' => 'in',
        ]);

        // Update stok produk
        $product = Product::findOrFail($request->product_id);
        $product->stock += $request->quantity;
        $product->save();

        // ✅ Logging aktivitas transaksi masuk
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Barang Masuk',
            'description' => 'Barang masuk: ' . $request->quantity . ' unit ke produk "' . $product->name . '".',
        ]);

        return redirect()->route('manager.transactions.in')->with('success', 'Barang berhasil ditambahkan');
    }

    // Menyimpan transaksi barang keluar
    public function storeOutgoing(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        // Catat transaksi keluar
        Transaction::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'type' => 'out',
        ]);

        // Update stok produk
        $product = Product::findOrFail($request->product_id);
        $product->stock -= $request->quantity;
        $product->save();

        // ✅ Logging aktivitas transaksi keluar
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Barang Keluar',
            'description' => 'Barang keluar: ' . $request->quantity . ' unit dari produk "' . $product->name . '".',
        ]);

        return redirect()->route('manager.transactions.out')->with('success', 'Barang berhasil dikeluarkan');
    }
}
