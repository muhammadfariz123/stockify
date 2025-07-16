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

        // Catat transaksi masuk dengan status 'pending'
        $transaction = Transaction::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'supplier_id' => $request->supplier_id,
            'type' => 'in',
            'status' => 'pending',  // Status 'pending' sampai dikonfirmasi oleh staff
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
            'description' => 'Barang masuk: ' . $request->quantity . ' unit ke produk "' . $transaction->product->name . '". Menunggu konfirmasi dari staff.',
        ]);

        return redirect()->route('manager.transactions.in')->with('success', 'Barang berhasil ditambahkan dan menunggu konfirmasi.');
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

        // Update stok produk
        $product = Product::findOrFail($request->product_id);
        $product->stock -= $request->quantity;
        $product->save();

        // ✅ Logging aktivitas transaksi keluar
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Barang Keluar',
            'description' => 'Barang keluar: ' . $request->quantity . ' unit dari produk "' . $transaction->product->name . '". Menunggu konfirmasi dari staff.',
        ]);

        return redirect()->route('manager.transactions.out')->with('success', 'Barang berhasil ditambahkan dan menunggu konfirmasi.');
    }


    // Konfirmasi Barang Masuk
    public function confirmIncoming($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'confirmed';  // Ubah status menjadi 'confirmed'
        $transaction->save();

        // Update stok produk setelah konfirmasi
        $product = Product::findOrFail($transaction->product_id);
        $product->stock += $transaction->quantity;  // Menambahkan jumlah ke stok
        $product->save();

        // ✅ Logging aktivitas konfirmasi barang masuk
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Konfirmasi Barang Masuk',
            'description' => 'Transaksi barang masuk ' . $transaction->id . ' telah dikonfirmasi dan stok produk "' . $product->name . '" diperbarui.',
        ]);

        return redirect()->route('staff.stock.in')->with('success', 'Barang masuk berhasil dikonfirmasi.');
    }

    // Konfirmasi Barang Keluar
    public function confirmOutgoing($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'confirmed';  // Ubah status menjadi 'confirmed'
        $transaction->save();

        // Update stok produk setelah konfirmasi
        $product = Product::findOrFail($transaction->product_id);
        $product->stock -= $transaction->quantity;  // Mengurangi jumlah stok produk
        $product->save();

        // ✅ Logging aktivitas konfirmasi barang keluar
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Konfirmasi Barang Keluar',
            'description' => 'Transaksi barang keluar ' . $transaction->id . ' telah dikonfirmasi dan stok produk "' . $product->name . '" diperbarui.',
        ]);

        return redirect()->route('staff.stock.out')->with('success', 'Barang keluar berhasil dikonfirmasi.');
    }
}
