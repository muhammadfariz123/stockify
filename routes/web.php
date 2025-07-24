<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProductManagerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CategoryController; // Pastikan ini sudah diimport
use App\Http\Controllers\StockOpnameController; // Pastikan ini sudah diimport
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\SupplierController; // Pastikan ini sudah diimport
use App\Http\Controllers\ReportController;  // Import ReportController
use App\Http\Controllers\TransactionController;  // Import ReportController
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

/*
|---------------------------------------------------------------------- 
| Web Routes
|---------------------------------------------------------------------- 
*/

Route::get('/', fn() => view('welcome'))->name('welcome');

// Semua rute di bawah ini butuh login
Route::middleware('auth')->group(function () {
    // Redirect /dashboard ke route dashboard per role
    Route::get('/dashboard', function () {
        switch (auth()->user()->role) {
            case 'Admin':
                return redirect()->route('admin.dashboard');
            case 'Manajer Gudang':
                return redirect()->route('manager.dashboard');
            case 'Staff Gudang':
                return redirect()->route('staff.dashboard');
        }
        return redirect()->route('welcome');
    })->name('dashboard');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route logout
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

// ========== ADMIN ==========

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:Admin'])
    ->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('attributes', ProductAttributeController::class);
        // Rute logout
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        // USERS
        Route::get('users', [AdminController::class, 'indexUsers'])->name('users.index');
        Route::get('users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

        // Resource untuk produk → uri /admin/products ; names admin.products.*
        Route::resource('products', AdminController::class);

        // Menambahkan rute untuk pengaturan aplikasi
        Route::get('settings', [AdminController::class, 'showSettings'])->name('settings.index');

        // Menambahkan rute untuk laporan aktivitas
        Route::get('reports/activity', [AdminController::class, 'showActivityReport'])->name('reports.activity');

        // Menambahkan rute untuk laporan stok
        Route::get('reports/stock', [AdminController::class, 'showStockReport'])->name('reports.stock');

        // Menambahkan rute untuk laporan transaksi
        Route::get('reports/transactions', [AdminController::class, 'showTransactionsReport'])->name('reports.transactions');

        Route::get('reports/stock/pdf', [AdminController::class, 'exportStockReportPdf'])->name('reports.stock.pdf');



        // Menambahkan rute untuk stock opname
        Route::get('stockopname', [AdminController::class, 'indexStockOpname'])->name('stockopname.index');

        // Menambahkan rute untuk transaksi
        // Transaksi Masuk - Admin
        Route::get('transactions/in', [AdminController::class, 'showIncomingTransactions'])->name('transactions.in');
        Route::post('transactions/in/store', [AdminController::class, 'storeIncomingTransaction'])->name('transactions.in.store');
        Route::get('transactions/in/edit/{id}', [AdminController::class, 'editIncomingTransaction'])->name('transactions.in.edit');
        Route::put('transactions/in/update/{id}', [AdminController::class, 'updateIncomingTransaction'])->name('transactions.in.update');
        Route::delete('transactions/in/delete/{id}', [AdminController::class, 'deleteIncomingTransaction'])->name('transactions.in.delete');


        // Transaksi Keluar
        Route::get('transactions/out', [AdminController::class, 'showOutgoingTransactions'])->name('transactions.out');
        Route::post('transactions/out/store', [AdminController::class, 'storeOutgoingTransaction'])->name('transactions.out.store');
        Route::get('transactions/out/edit/{id}', [AdminController::class, 'editOutgoingTransaction'])->name('transactions.out.edit');
        Route::put('transactions/out/update/{id}', [AdminController::class, 'updateOutgoingTransaction'])->name('transactions.out.update');
        Route::delete('transactions/out/delete/{id}', [AdminController::class, 'deleteOutgoingTransaction'])->name('transactions.out.delete');


        // Resource untuk supplier → uri /admin/suppliers ; names admin.suppliers.*
        Route::resource('suppliers', SupplierController::class);  // Tambahkan rute ini
    
        // Resource untuk kategori → uri /admin/categories ; names admin.categories.*
        Route::resource('categories', CategoryController::class);

        //    stock minimum
        Route::get('/minimum-stock', [AdminController::class, 'minimumStock'])->name('minimum_stock.index');
        Route::post('/minimum-stock/{product}', [AdminController::class, 'updateMinimumStock'])->name('minimum_stock.update');

    });


// ========== MANAGER GUDANG ==========
// Routes untuk manager
Route::prefix('manager')
    ->name('manager.')
    ->middleware(['auth', 'role:Manajer Gudang']) // Menggunakan middleware role
    ->group(function () {
        Route::get('dashboard', [ManagerController::class, 'index'])->name('dashboard');



        // PRODUCTS
        Route::resource('products', ProductManagerController::class);


        // TRANSACTIONS
        Route::get('transactions/in', [TransactionController::class, 'showIncomingForm'])->name('transactions.in');
        Route::post('transactions/in', [TransactionController::class, 'storeIncoming'])->name('transactions.store.in');
        Route::get('transactions/out', [TransactionController::class, 'showOutgoingForm'])->name('transactions.out');
        Route::post('transactions/out', [TransactionController::class, 'storeOutgoing'])->name('transactions.store.out');

        // STOCKOPNAME
        Route::get('stockopname', [StockOpnameController::class, 'index'])->name('stockopname.index');
        Route::post('stockopname', [StockOpnameController::class, 'store'])->name('stockopname.store');

        // REPORTS
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');



        // Supplier Routes
        Route::get('suppliers', [ManagerController::class, 'suppliers'])->name('suppliers.index');


        // Menambahkan rute untuk laporan stok
        Route::get('reports/stock', [ReportController::class, 'stockReport'])->name('reports.stock');
        // Menambahkan rute untuk laporan transaksi
        Route::get('reports/transactions', [ReportController::class, 'transactionReport'])->name('reports.transactions');



    });



// ========== STAFF GUDANG ==========
Route::prefix('staff')
    ->name('staff.')
    ->middleware(['auth', 'role:Staff Gudang'])
    ->group(function () {
        // Rute Dashboard Staff Gudang
        Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');

        // Rute untuk menampilkan daftar produk
        Route::get('/products', [StaffController::class, 'products'])->name('products.index');

        // Rute untuk menampilkan halaman tambah produk
        Route::get('/product/create', [StaffController::class, 'tambahProdukForm'])->name('product.create');

        // Rute untuk menyimpan produk
        Route::post('/product/store', [StaffController::class, 'store'])->name('product.store');

        // Konfirmasi Barang Masuk
        Route::get('/stock/in', [StaffController::class, 'konfirmasiBarangMasuk'])->name('stock.in');
        Route::post('/stock/in/{id}/confirm', [StaffController::class, 'konfirmasiBarangMasukAction'])->name('stock.confirm');

        // Konfirmasi Barang Keluar
        Route::get('/stock/out', [StaffController::class, 'konfirmasiBarangKeluar'])->name('stock.out');
        Route::post('/stock/out/{id}/send', [StaffController::class, 'konfirmasiBarangKeluarAction'])->name('stock.send');

        // Logout
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
require __DIR__ . '/auth.php';
