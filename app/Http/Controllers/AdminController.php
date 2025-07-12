<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\StockOpname;
use App\Models\ActivityLog;
use App\Models\Transaction; // Asumsi Anda memiliki model untuk transaksi
use App\Models\User; // Asumsi Anda ingin menampilkan aktivitas pengguna terbaru
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        // Ambil data yang diperlukan untuk dashboard
        $products = Product::all();
        $incomingTransactions = Transaction::where('type', 'in')->count();
        $outgoingTransactions = Transaction::where('type', 'out')->count();
        // Ambil semua produk dengan nama dan stok
        $products = Product::select('name', 'stock')->get();  // Ambil produk dan stoknya
        $productsCount = Product::count(); // Hitung total produk

        // Ambil aktivitas pengguna terbaru, misalnya pengguna yang login atau melakukan transaksi terbaru
        $latestUsers = User::latest()->take(5)->get(); // Ambil 5 pengguna terbaru

        // ✅ Ambil log aktivitas terbaru (misalnya 10 terakhir)
        $recentActivities = ActivityLog::latest()->take(10)->get();
        // Kirim data ke view dashboard
        return view('admin.dashboard', compact(
            'incomingTransactions',
            'outgoingTransactions',
            'products',
            'latestUsers',
            'productsCount',
            'recentActivities'
        ));
    }
    // Fungsi untuk menampilkan pengaturan aplikasi
    public function showSettings()
    {
        // Misalnya, Anda bisa mengirimkan data terkait pengaturan aplikasi ke tampilan
        return view('admin.settings.index');
    }

    // Fungsi untuk menampilkan laporan stok
    public function showStockReport()
    {
        // Ambil data produk untuk laporan stok
        $products = Product::all();  // Misalnya, ambil semua produk yang ada di database
        return view('admin.reports.stock', compact('products'));  // Kirim data produk ke tampilan laporan stok
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


    // Menampilkan daftar pengguna
    public function indexUsers()
    {
        $users = User::all();  // Ambil semua pengguna
        return view('admin.users.index', compact('users'));  // Kirim data pengguna ke tampilan
    }

    // Menampilkan form untuk menambah pengguna
    public function createUser()
    {
        return view('admin.users.create');  // Menampilkan form untuk membuat pengguna baru
    }

    // Menyimpan data pengguna baru
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:Admin,Manajer Gudang,Staff Gudang',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),  // Enkripsi password
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit pengguna
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));  // Menampilkan data pengguna untuk diedit
    }

    // Memperbarui data pengguna
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',  // Password boleh kosong
            'role' => 'required|in:Admin,Manajer Gudang,Staff Gudang',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,  // Update password jika diisi
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Menghapus pengguna
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
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
            'stock' => 'required|numeric|min:0',  // Menyimpan stok
        ]);

        // Simpan produk
        Product::create([
            'name' => $request->name,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,  // Menyimpan harga jual
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'description' => $request->description,  // Menyimpan deskripsi
            'stock' => $request->stock,  // Menyimpan stok
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
            'description' => 'nullable|string',
            'stock' => 'required|numeric|min:0',
        ]);

        // Update produk dengan kategori yang baru
        $product->update([
            'name' => $request->name,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'category_id' => $request->category_id,  // Menyimpan category_id yang baru
            'supplier_id' => $request->supplier_id,
            'description' => $request->description,  // Menyimpan deskripsi
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        try {
            // Hapus produk secara langsung (cascade akan menghapus data terkait)
            $product->delete();  // Menggunakan soft delete jika Anda aktifkan soft delete

            // Jika menggunakan penghapusan keras dan sudah diatur di database dengan ON DELETE CASCADE
            // $product->forceDelete(); // Hapus produk secara permanen

            return redirect()->route('admin.products.index')
                ->with('success', 'Produk berhasil dihapus beserta data terkait.');
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Produk tidak bisa dihapus karena memiliki relasi.');
        }
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

    // Fungsi untuk menampilkan transaksi masuk
    public function showIncomingTransactions()
    {
        $transactionsIn = Transaction::where('type', 'in')->get(); // Menampilkan transaksi dengan tipe 'in'
        return view('admin.transactions.in', compact('transactionsIn'));
    }

    // Fungsi untuk menampilkan laporan transaksi
    public function showTransactionsReport()
    {
        // Ambil data transaksi untuk laporan
        $transactions = Transaction::all();  // Ambil semua transaksi yang ada di database
        return view('admin.reports.transactions', compact('transactions'));  // Kirim data transaksi ke tampilan laporan transaksi
    }

    // Fungsi untuk menampilkan laporan aktivitas
    public function showActivityReport()
    {
        $activities = ActivityLog::all(); // ✅ Gunakan ActivityLog, bukan Activity
        return view('admin.reports.activity', compact('activities'));
    }

    // Fungsi untuk menampilkan transaksi keluar
    public function showOutgoingTransactions()
    {
        $transactionsOut = Transaction::where('type', 'out')->get(); // Menampilkan transaksi dengan tipe 'out'
        return view('admin.transactions.out', compact('transactionsOut'));
    }






    // Fungsi untuk menampilkan halaman stock opname
    public function indexStockOpname()
    {
        // Ambil data stock opname (misalnya, semua data dari tabel StockOpname)
        $stockOpnames = StockOpname::all();
        return view('admin.stockopname.index', compact('stockOpnames'));
    }
    // === Laporan ===
    public function showReports()
    {
        return view('admin.reports.index');
    }
}
