<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProductManagerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CategoryController; // Pastikan ini sudah diimport
use App\Http\Controllers\StockOpnameController; // Pastikan ini sudah diimport
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\SupplierController; // Pastikan ini sudah diimport
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

        // Rute logout
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        // USERS
        Route::get('users', [AdminController::class, 'indexUsers'])->name('users.index');
        Route::get('users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::resource('attributes', ProductAttributeController::class);
        // Resource untuk kategori → uri /admin/categories ; names admin.categories.*
        Route::resource('categories', CategoryController::class);




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


        // RUTE UNTUK EKSPOR PDF
        Route::get('reports/stock/pdf', [AdminController::class, 'exportStockReportPdf'])->name('reports.stock.pdf');
        // Route untuk mengekspor PDF transaksi
        Route::get('reports/transactions/pdf', [AdminController::class, 'exportTransactionsPdf'])->name('reports.transactions.pdf');
        // Route untuk mengekspor PDF laporan aktivitas
        Route::get('reports/activity/pdf', [AdminController::class, 'exportActivityReportPdf'])->name('reports.activity.pdf');


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

        // Kategori
        Route::get('categories', [ManagerController::class, 'categoriesIndex'])->name('categories.index');
        Route::get('categories/create', [ManagerController::class, 'categoriesCreate'])->name('categories.create');
        Route::post('categories', [ManagerController::class, 'categoriesStore'])->name('categories.store');
        Route::get('categories/{category}/edit', [ManagerController::class, 'categoriesEdit'])->name('categories.edit');
        Route::put('categories/{category}', [ManagerController::class, 'categoriesUpdate'])->name('categories.update');
        Route::delete('categories/{category}', [ManagerController::class, 'categoriesDestroy'])->name('categories.destroy');

        // Atribut Produk
        Route::get('attributes', [ManagerController::class, 'attributesIndex'])->name('attributes.index');
        Route::get('attributes/create', [ManagerController::class, 'attributesCreate'])->name('attributes.create');
        Route::post('attributes', [ManagerController::class, 'attributesStore'])->name('attributes.store');
        Route::get('attributes/{attribute}/edit', [ManagerController::class, 'attributesEdit'])->name('attributes.edit');
        Route::put('attributes/{attribute}', [ManagerController::class, 'attributesUpdate'])->name('attributes.update');
        Route::delete('attributes/{attribute}', [ManagerController::class, 'attributesDestroy'])->name('attributes.destroy');


        // TRANSAKSI MASUK
        Route::get('transactions/in', [TransactionController::class, 'in'])->name('transactions.in');
        Route::post('transactions/in/store', [TransactionController::class, 'storeOrUpdateIncoming'])->name('transactions.store.in');
        Route::get('transactions/in/edit/{id}', [TransactionController::class, 'editIncoming'])->name('transactions.edit.in');
        Route::delete('transactions/in/delete/{id}', [TransactionController::class, 'destroyIncoming'])->name('transactions.delete.in');

        // TRANSAKSI KELUAR
        Route::get('transactions/out', [TransactionController::class, 'showOutgoingTransactions'])->name('transactions.out');
        Route::post('transactions/out/store', [TransactionController::class, 'storeOrUpdateOutgoingTransaction'])->name('transactions.store.out');
        Route::get('transactions/out/edit/{id}', [TransactionController::class, 'editOutgoingTransaction'])->name('transactions.edit.out');
        Route::delete('transactions/out/delete/{id}', [TransactionController::class, 'deleteOutgoingTransaction'])->name('transactions.delete.out');



        // STOCKOPNAME
        Route::get('stockopname', [StockOpnameController::class, 'index'])->name('stockopname.index');
        Route::post('stockopname', [StockOpnameController::class, 'store'])->name('stockopname.store');

        // MINIMUM STOK
        Route::get('minimum-stock', [ManagerController::class, 'minimumStock'])->name('minimum_stock.index');
        Route::post('minimum-stock/{product}', [ManagerController::class, 'updateMinimumStock'])->name('minimum_stock.update');


        // Supplier Routes
        Route::get('suppliers', [ManagerController::class, 'suppliers'])->name('suppliers.index');


        // Laporan View 
        Route::get('reports/stock', [ManagerController::class, 'showStockReport'])->name('reports.stock');
        Route::get('reports/transactions', [ManagerController::class, 'showTransactionsReport'])->name('reports.transactions');
        Route::get('reports/activity', [ManagerController::class, 'showActivityReport'])->name('reports.activity');

        // Export PDF
        Route::get('reports/stock/pdf', [ManagerController::class, 'exportStockReportPdf'])->name('reports.stock.pdf');
        Route::get('reports/transactions/pdf', [ManagerController::class, 'exportTransactionsPdf'])->name('reports.transactions.pdf');
        Route::get('reports/activity/pdf', [ManagerController::class, 'exportActivityReportPdf'])->name('reports.activity.pdf');

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
