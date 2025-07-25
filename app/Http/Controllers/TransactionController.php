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
    // TRANSAKSI MASUK
    // Tampilkan semua transaksi masuk
    public function in()
    {
        $transactionsIn = Transaction::where('type', 'in')->with('product')->latest()->get();
        $products = Product::all();
        $suppliers = Supplier::all();

        return view('manager.transactions.in', compact('transactionsIn', 'products', 'suppliers'));
    }

    // Simpan transaksi masuk baru atau update jika edit
    public function storeOrUpdateIncoming(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'supplier_id' => 'required|exists:suppliers,id',
            'status' => 'required|in:pending,confirmed',
        ]);

        if ($request->filled('id')) {
            $transaction = Transaction::findOrFail($request->id);
            $previousStatus = $transaction->status;

            $transaction->update([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'supplier_id' => $request->supplier_id,
                'status' => $request->status,
            ]);

            if ($previousStatus !== 'confirmed' && $request->status === 'confirmed') {
                $transaction->product->increment('stock', $request->quantity);
            }

            $activity = 'Edit Transaksi Masuk';
        } else {
            $transaction = Transaction::create([
                'type' => 'in',
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'supplier_id' => $request->supplier_id,
                'status' => $request->status,
                'transaction_date' => now(),
            ]);

            if ($request->status === 'confirmed') {
                $transaction->product->increment('stock', $request->quantity);
            }

            $activity = 'Tambah Transaksi Masuk';
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'Manager',
            'activity' => $activity,
            'description' => $activity . ' #' . $transaction->id,
        ]);

        return redirect()->route('manager.transactions.in')->with('success', 'Transaksi berhasil disimpan.');
    }

    // Isi data form edit
    public function editIncoming($id)
    {
        $transactionsIn = Transaction::where('type', 'in')->with('product')->latest()->get();
        $products = Product::all();
        $suppliers = Supplier::all();
        $editTransaction = Transaction::findOrFail($id);

        return view('manager.transactions.in', compact('transactionsIn', 'products', 'suppliers', 'editTransaction'));
    }

    // Hapus transaksi masuk
    public function destroyIncoming($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'Manager',
            'activity' => 'Hapus Transaksi Masuk',
            'description' => 'Menghapus transaksi masuk #' . $transaction->id,
        ]);

        return redirect()->route('manager.transactions.in')->with('success', 'Transaksi berhasil dihapus.');
    }

    // ==========TRANSAKSI KELUAR=========
    // Tampilkan semua transaksi keluar + form input/edit
    public function showOutgoingTransactions()
    {
        $transactionsOut = Transaction::where('type', 'out')->with('product')->latest()->get();
        $products = Product::all();
        $suppliers = Supplier::all();

        return view('manager.transactions.out', compact('transactionsOut', 'products', 'suppliers'));
    }

    // Simpan transaksi baru atau update jika edit
    public function storeOrUpdateOutgoingTransaction(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'status' => 'required|in:pending,confirmed',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        if ($request->filled('id')) {
            $transaction = Transaction::findOrFail($request->id);
            $previousStatus = $transaction->status;

            $transaction->update([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'status' => $request->status,
                'supplier_id' => $request->supplier_id,
            ]);

            if ($previousStatus !== 'confirmed' && $request->status === 'confirmed') {
                $transaction->product->decrement('stock', $request->quantity);
            }

            $activity = 'Edit Transaksi Keluar';
        } else {
            $transaction = Transaction::create([
                'type' => 'out',
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'status' => $request->status,
                'supplier_id' => $request->supplier_id,
                'transaction_date' => now(),
            ]);

            if ($request->status === 'confirmed') {
                $transaction->product->decrement('stock', $request->quantity);
            }

            $activity = 'Tambah Transaksi Keluar';
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'Manager',
            'activity' => $activity,
            'description' => $activity . ' #' . $transaction->id,
        ]);

        return redirect()->route('manager.transactions.out')->with('success', 'Transaksi berhasil disimpan.');
    }

    // Isi data untuk form edit
    public function editOutgoingTransaction($id)
    {
        $transactionsOut = Transaction::where('type', 'out')->with('product')->latest()->get();
        $products = Product::all();
        $suppliers = Supplier::all();
        $editTransaction = Transaction::findOrFail($id);

        return view('manager.transactions.out', compact('transactionsOut', 'products', 'suppliers', 'editTransaction'));
    }

    // Hapus transaksi
    public function deleteOutgoingTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'Manager',
            'activity' => 'Hapus Transaksi Keluar',
            'description' => 'Menghapus transaksi keluar #' . $transaction->id,
        ]);

        return redirect()->route('manager.transactions.out')->with('success', 'Transaksi berhasil dihapus.');
    }
}
