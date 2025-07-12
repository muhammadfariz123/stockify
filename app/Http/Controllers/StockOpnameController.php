<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOpname;
use App\Models\ActivityLog; // ✅ Tambahkan ini
use Illuminate\Support\Facades\Auth; // ✅ Tambahkan ini
use Illuminate\Http\Request;

class StockOpnameController extends Controller
{
    // Menampilkan daftar stock opname
    public function index()
    {
        $products = Product::all();  // Ambil semua produk
        return view('manager.stockopname.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity_opname' => 'required|numeric|min:0',
        ]);

        // Catat hasil opname
        StockOpname::create([
            'product_id' => $request->product_id,
            'quantity_opname' => $request->quantity_opname,
        ]);

        // Sesuaikan stok produk
        $product = Product::findOrFail($request->product_id);
        $oldStock = $product->stock;
        $product->stock = $request->quantity_opname;
        $product->save();

        // ✅ Logging aktivitas stock opname
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Stock Opname',
            'description' => 'Stok produk "' . $product->name . '" diperbarui dari ' . $oldStock . ' menjadi ' . $request->quantity_opname . '.',
        ]);

        return redirect()->route('manager.stockopname.index')->with('success', 'Stock Opname berhasil dilakukan');
    }
}
