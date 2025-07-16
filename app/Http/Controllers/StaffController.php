<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\ProductAttribute;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    // Menampilkan Dashboard Staff Gudang
    public function dashboard()
    {
        return view('staff.dashboard');
    }

    // Menampilkan Daftar Produk
    public function products()
    {
        // Ambil data produk yang ada (termasuk yang ditambahkan oleh Admin atau Manager)
        $products = Product::all();  // Mengambil semua produk dari database
        return view('staff.products.index', compact('products'));
    }

    // Konfirmasi Barang Masuk
    public function konfirmasiBarangMasuk()
    {
        // Mengambil semua transaksi dengan type 'in' (barang masuk) yang perlu dikonfirmasi
        $incomingItems = Transaction::with('product') // Memuat relasi produk
            ->where('type', 'in')
            ->where('status', 'pending') // Status pending berarti perlu dikonfirmasi
            ->get();

        return view('staff.konfirmasi_masuk', compact('incomingItems'));
    }

    // Konfirmasi Barang Keluar
    public function konfirmasiBarangKeluar()
    {
        // Mengambil transaksi keluar yang berstatus 'pending'
        $outgoingItems = Transaction::with('product') // Relasi dengan produk
            ->where('type', 'out') // Mengambil transaksi keluar
            ->where('status', 'pending') // Hanya yang status 'pending'
            ->get();

        return view('staff.konfirmasi_keluar', compact('outgoingItems'));
    }

    // Aksi Konfirmasi Barang Masuk
    public function konfirmasiBarangMasukAction($id)
    {
        $item = Transaction::find($id);
        $item->status = 'confirmed';
        $item->save();

        // Log Aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'Staff Gudang',
            'activity' => 'Konfirmasi Barang Masuk',
            'description' => 'Barang ' . $item->product->name . ' telah dikonfirmasi sebagai masuk.',
        ]);

        // Update stok produk setelah konfirmasi
        $product = Product::findOrFail($item->product_id);
        $product->stock += $item->quantity;  // Menambahkan jumlah ke stok produk
        $product->save();

        return redirect()->route('staff.stock.in')->with('success', 'Barang masuk berhasil dikonfirmasi.');
    }

    // Aksi Konfirmasi Barang Keluar
    public function konfirmasiBarangKeluarAction($id)
    {
        $item = Transaction::find($id);
        $item->status = 'confirmed'; // Mengubah status menjadi 'confirmed'
        $item->save();

        // Log Aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'Staff Gudang',
            'activity' => 'Konfirmasi Barang Keluar',
            'description' => 'Barang ' . $item->product->name . ' telah dikonfirmasi sebagai keluar.',
        ]);

        // Update stok produk setelah konfirmasi
        $product = Product::findOrFail($item->product_id);
        $product->stock -= $item->quantity;  // Mengurangi jumlah stok produk
        $product->save();

        return redirect()->route('staff.stock.out')->with('success', 'Barang keluar berhasil dikonfirmasi.');
    }

    // Menampilkan Form Tambah Produk
    public function tambahProdukForm()
    {
        // Mengambil semua kategori, supplier, dan atribut produk
        $categories = Category::all();
        $suppliers = Supplier::all();
        $attributes = ProductAttribute::all();

        return view('staff.products.create', compact('categories', 'suppliers', 'attributes'));  // Kirim data ke view
    }

    // Menyimpan Produk Baru
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

        // Simpan produk ke tabel products
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'purchase_price' => $validated['purchase_price'],
            'sale_price' => $validated['sale_price'],
            'stock' => $validated['stock'],
            'category_id' => $validated['category_id'],
            'supplier_id' => $validated['supplier_id'],
        ]);

        // Sinkronkan atribut dengan produk
        if (isset($validated['attributes'])) {
            $product->attributes()->sync($validated['attributes']);
        }

        return redirect()->route('staff.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }
}
