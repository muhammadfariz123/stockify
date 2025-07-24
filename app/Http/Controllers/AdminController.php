<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\Supplier;
use App\Models\StockOpname;
use App\Models\ActivityLog;
use App\Models\Transaction; // Asumsi Anda memiliki model untuk transaksi
use App\Models\User; // Asumsi Anda ingin menampilkan aktivitas pengguna terbaru
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        // Ambil data produk
        $products = Product::all();  // Ambil semua produk dari database
        $totalIncomingTransactions = 0;
        $totalOutgoingTransactions = 0;
        $lowStockCount = Product::whereColumn('stock', '<', 'minimum_stock')->count();

        // Hitung transaksi masuk dan keluar yang sudah dikonfirmasi
        foreach ($products as $product) {
            // Hanya ambil transaksi yang sudah dikonfirmasi (status 'confirmed')
            $incomingTransactions = Transaction::where('product_id', $product->id)
                ->where('type', 'in')
                ->where('status', 'confirmed')  // Hanya transaksi yang sudah dikonfirmasi
                ->count();  // Hitung jumlah transaksi masuk yang sudah dikonfirmasi


            $outgoingTransactions = Transaction::where('product_id', $product->id)
                ->where('type', 'out')
                ->where('status', 'confirmed')  // Hanya transaksi yang sudah dikonfirmasi
                ->count();  // Hitung jumlah transaksi keluar yang sudah dikonfirmasi

            // Tambahkan transaksi masuk dan keluar yang sudah dikonfirmasi
            $totalIncomingTransactions += $incomingTransactions;
            $totalOutgoingTransactions += $outgoingTransactions;
        }

        // Ambil jumlah total produk
        $productsCount = Product::count();

        // Ambil 5 pengguna terbaru
        $latestUsers = User::latest()->take(5)->get();

        // Ambil 10 aktivitas terbaru
        $recentActivities = ActivityLog::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'products',
            'totalIncomingTransactions',  // Kirim variabel transaksi masuk
            'totalOutgoingTransactions',  // Kirim variabel transaksi keluar
            'productsCount',
            'latestUsers',
            'recentActivities',
            'lowStockCount',
        ));
    }

    public function minimumStock()
    {
        $products = Product::all();
        return view('admin.minimum_stock.index', compact('products'));
    }

    public function updateMinimumStock(Request $request, Product $product)
    {
        $validated = $request->validate([
            'minimum_stock' => 'required|integer|min:0',
        ]);

        $product->minimum_stock = $validated['minimum_stock'];
        $product->save();

        return redirect()->route('admin.minimum_stock.index')->with('success', 'Stok minimum berhasil diperbarui.');
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

    public function exportStockReportPdf()
    {
        $products = Product::all();
        $pdf = PDF::loadView('admin.reports.stock_pdf', compact('products'))->setPaper('a4', 'landscape');

        return $pdf->download('laporan_stok_produk.pdf');
    }


    // === Produk CRUD ===
    public function index()
    {
        // Mengambil semua produk dengan relasi kategori, supplier, dan atribut (eager loading)
        $products = Product::with(['category', 'supplier', 'attributes'])->get();

        // Menghitung jumlah kategori
        $categoriesCount = Category::count();

        // Menampilkan ke view
        return view('admin.products.index', compact('products', 'categoriesCount'));
    }

    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori
        $suppliers = Supplier::all(); // Ambil semua supplier
        $attributes = ProductAttribute::all();

        return view('admin.products.create', compact('categories', 'suppliers', 'attributes'));
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

        $product->attributes()->sync($validated['attributes']);


        // Logging aktivitas
        \App\Models\ActivityLog::create([
            'user_id' => \Auth::id(),
            'role' => \Auth::user()->role ?? 'User',
            'activity' => 'Membuat Produk',
            'description' => 'Produk ' . $product->name . ' ditambahkan.',
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
        $attributes = ProductAttribute::all();
        return view('admin.products.edit', compact('product', 'categories', 'suppliers', 'attributes')); // Kirim data ke view
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
            'attributes' => 'array', // Validasi untuk attributes
            'attributes.*' => 'exists:product_attributes,id', // Pastikan setiap ID atribut valid
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

        // Sinkronkan atribut yang dipilih dengan produk
        if ($request->has('attributes')) {
            $product->attributes()->sync($request->input('attributes', [])); // Sync atribut yang dipilih
        } else {
            // Jika tidak ada atribut yang dipilih, pastikan tidak ada atribut yang terkait dengan produk ini
            $product->attributes()->sync([]);
        }

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

    // Menampilkan halaman transaksi masuk + form tambah/edit
    public function showIncomingTransactions(Request $request)
    {
        $transactionsIn = Transaction::where('type', 'in')->with('product')->latest()->get();
        $products = Product::all();
        $suppliers = Supplier::all();

        return view('admin.transactions.in', compact('transactionsIn', 'products', 'suppliers'));
    }

    // Store transaksi masuk baru
    public function storeIncomingTransaction(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'supplier_id' => 'required|exists:suppliers,id',
            'status' => 'required|in:pending,confirmed,canceled',
        ]);

        $transaction = Transaction::create([
            'type' => 'in',
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'supplier_id' => $request->supplier_id,
            'status' => $request->status,
            'transaction_date' => now(),
        ]);

        if ($transaction->status === 'confirmed') {
            $transaction->product->increment('stock', $transaction->quantity);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Tambah Transaksi Masuk',
            'description' => 'Menambahkan transaksi masuk #' . $transaction->id,
        ]);

        return redirect()->route('admin.transactions.in')->with('success', 'Transaksi masuk berhasil ditambahkan.');
    }



    // Tampilkan form edit pada halaman yang sama
    public function editIncomingTransaction($id)
    {
        $transactionsIn = Transaction::where('type', 'in')->with('product')->latest()->get();
        $products = Product::all();
        $suppliers = Supplier::all();
        $editTransaction = Transaction::findOrFail($id);

        return view('admin.transactions.in', compact('transactionsIn', 'products', 'suppliers', 'editTransaction'));
    }

    // Update data transaksi masuk
    public function updateIncomingTransaction(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'supplier_id' => 'required|exists:suppliers,id',
            'status' => 'required|in:pending,confirmed,canceled',
        ]);

        $transaction = Transaction::findOrFail($id);
        $product = Product::findOrFail($request->product_id);
        $previousStatus = $transaction->status;

        $transaction->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'supplier_id' => $request->supplier_id,
            'status' => $request->status,
        ]);

        if ($previousStatus !== 'confirmed' && $request->status === 'confirmed') {
            $product->increment('stock', $request->quantity);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Edit Transaksi Masuk',
            'description' => 'Memperbarui transaksi masuk #' . $transaction->id,
        ]);

        return redirect()->route('admin.transactions.in')->with('success', 'Transaksi berhasil diperbarui.');
    }




    // Hapus transaksi masuk
    public function deleteIncomingTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Hapus Transaksi Masuk',
            'description' => 'Menghapus transaksi masuk #' . $transaction->id,
        ]);

        return redirect()->route('admin.transactions.in')->with('success', 'Transaksi berhasil dihapus.');
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
    // Tampilkan halaman transaksi keluar (form & tabel)
    public function showOutgoingTransactions()
    {
        $transactionsOut = Transaction::where('type', 'out')->with('product')->latest()->get();
        $products = Product::all();
        return view('admin.transactions.out', compact('transactionsOut', 'products'));
    }

    // Simpan transaksi keluar baru
    public function storeOutgoingTransaction(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'status' => 'required|in:pending,confirmed',
        ]);

        $transaction = Transaction::create([
            'type' => 'out',
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'transaction_date' => now(),
        ]);

        if ($transaction->status === 'confirmed') {
            $transaction->product->decrement('stock', $transaction->quantity);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Tambah Transaksi Keluar',
            'description' => 'Menambahkan transaksi keluar #' . $transaction->id,
        ]);

        return redirect()->route('admin.transactions.out')->with('success', 'Transaksi keluar berhasil ditambahkan.');
    }


    // Tampilkan form edit dalam halaman yang sama
    public function editOutgoingTransaction($id)
    {
        $transactionsOut = Transaction::where('type', 'out')->with('product')->latest()->get();
        $products = Product::all();
        $editTransaction = Transaction::findOrFail($id);

        return view('admin.transactions.out', compact('transactionsOut', 'products', 'editTransaction'));
    }

    // Update transaksi keluar
    public function updateOutgoingTransaction(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'status' => 'required|in:pending,confirmed',
        ]);

        $transaction = Transaction::findOrFail($id);
        $product = Product::findOrFail($request->product_id);
        $previousStatus = $transaction->status;

        $transaction->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'status' => $request->status,
        ]);

        if ($previousStatus !== 'confirmed' && $request->status === 'confirmed') {
            $product->decrement('stock', $request->quantity);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Edit Transaksi Keluar',
            'description' => 'Memperbarui transaksi keluar #' . $transaction->id,
        ]);

        return redirect()->route('admin.transactions.out')->with('success', 'Transaksi berhasil diperbarui.');
    }


    // Hapus transaksi keluar
    public function deleteOutgoingTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'User',
            'activity' => 'Hapus Transaksi Keluar',
            'description' => 'Menghapus transaksi keluar #' . $transaction->id,
        ]);

        return redirect()->route('admin.transactions.out')->with('success', 'Transaksi berhasil dihapus.');
    }







    // Fungsi untuk menampilkan halaman stock opname
    public function indexStockOpname()
    {
        // Ambil data stock opname (misalnya, semua data dari tabel StockOpname)
        $stockOpnames = StockOpname::all();
        return view('admin.stockopname.index', compact('stockOpnames'));
    }
}
