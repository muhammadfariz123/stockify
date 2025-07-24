<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Supplier;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    // ==========TRANSAKSI MASUK=========

    // Menampilkan form untuk barang masuk
    public function showIncomingForm()
    {
        $products = Product::all();  // Ambil semua produk
        $suppliers = Supplier::all();  // Ambil semua supplier
        return view('manager.transactions.in', compact('products', 'suppliers'));
    }

    // Menampilkan transaksi masuk
    public function in()
    {
        // Ambil data transaksi masuk
        $transactionsIn = Transaction::where('type', 'in')->get();  // Ambil transaksi yang tipe 'in'

        // Ambil data produk dan supplier untuk form input
        $products = Product::all();
        $suppliers = Supplier::all();

        // Kirim data transaksi, produk, dan supplier ke view
        return view('manager.transactions.in', compact('transactionsIn', 'products', 'suppliers'));
    }

    // Menyimpan transaksi barang masuk
    public function storeIncoming(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        // Simpan transaksi masuk dengan status 'pending'
        $transaction = Transaction::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'supplier_id' => $request->supplier_id,
            'type' => 'in',
            'status' => 'pending',  // Status 'pending' hingga dikonfirmasi
        ]);

        // ✅ Logging aktivitas transaksi masuk
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'Manager',
            'activity' => 'Barang Masuk',
            'description' => 'Barang masuk: ' . $request->quantity . ' unit ke produk "' . $transaction->product->name . '". Menunggu konfirmasi dari staff.',
        ]);

        return redirect()->route('manager.transactions.in')->with('success', 'Barang berhasil ditambahkan dan menunggu konfirmasi.');
    }

    // Mengedit transaksi masuk
    public function editIncoming(Transaction $transaction)
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('manager.transactions.in', compact('transaction', 'products', 'suppliers'));
    }

    // Mengupdate transaksi masuk
    public function updateIncoming(Request $request, Transaction $transaction)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $transaction->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'supplier_id' => $request->supplier_id,
        ]);

        // ✅ Logging aktivitas update transaksi masuk
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'Manager',
            'activity' => 'Update Barang Masuk',
            'description' => 'Transaksi barang masuk diperbarui: ' . $request->quantity . ' unit produk "' . $transaction->product->name . '".',
        ]);

        return redirect()->route('manager.transactions.in')->with('success', 'Transaksi berhasil diperbarui.');
    }

    // Menghapus transaksi masuk
    public function destroyIncoming(Transaction $transaction)
    {
        $transaction->delete();

        // ✅ Logging aktivitas penghapusan transaksi masuk
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'Manager',
            'activity' => 'Hapus Barang Masuk',
            'description' => 'Transaksi barang masuk dihapus: ' . $transaction->quantity . ' unit produk "' . $transaction->product->name . '".',
        ]);

        return redirect()->route('manager.transactions.in')->with('success', 'Transaksi berhasil dihapus.');
    }



    
    // ==========TRANSAKSI KELUAR=========
    public function showOutgoingForm()
    {
        $products = Product::all();  // Ambil semua produk
        return view('manager.transactions.out', compact('products'));
    }

    // Menampilkan transaksi keluar
    public function out()
    {
        $transactions = Transaction::where('type', 'out')->get();  // Filter transaksi keluar
        return view('manager.transactions.out', compact('transactions'));
    }

    // Menyimpan transaksi barang keluar
    public function storeOutgoing(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        // Catat transaksi keluar dengan status 'pending'
        $transaction = Transaction::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'type' => 'out',
            'status' => 'pending',  // Status 'pending' sampai dikonfirmasi oleh staff
        ]);

        // ✅ Logging aktivitas transaksi keluar
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'Manager',
            'activity' => 'Barang Keluar',
            'description' => 'Barang keluar: ' . $request->quantity . ' unit dari produk "' . $transaction->product->name . '". Menunggu konfirmasi dari staff.',
        ]);

        return redirect()->route('manager.transactions.out')->with('success', 'Barang berhasil ditambahkan dan menunggu konfirmasi.');
    }
}
