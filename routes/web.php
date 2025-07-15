<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CategoryController; // Pastikan ini sudah diimport
use App\Http\Controllers\StockOpnameController; // Pastikan ini sudah diimport
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\SupplierController; // Pastikan ini sudah diimport
use App\Http\Controllers\ProductController;  // Import ProductController
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

        // Menambahkan rute untuk stock opname
        Route::get('stockopname', [AdminController::class, 'indexStockOpname'])->name('stockopname.index');

        // Menambahkan rute untuk transaksi
        Route::get('transactions/in', [AdminController::class, 'showIncomingTransactions'])->name('transactions.in');
        Route::get('transactions/out', [AdminController::class, 'showOutgoingTransactions'])->name('transactions.out');

        // Resource untuk supplier → uri /admin/suppliers ; names admin.suppliers.*
        Route::resource('suppliers', SupplierController::class);  // Tambahkan rute ini
    
        // Resource untuk kategori → uri /admin/categories ; names admin.categories.*
        Route::resource('categories', CategoryController::class);

        // Laporan
        Route::get('reports', [AdminController::class, 'showReports'])->name('reports.index');
    });


// ========== MANAGER GUDANG ==========
// Routes untuk manager
Route::prefix('manager')
    ->name('manager.')
    ->middleware(['auth', 'role:Manajer Gudang']) // Menggunakan middleware role
    ->group(function () {
        Route::get('dashboard', [ManagerController::class, 'index'])->name('dashboard');
        Route::get('products', [ProductController::class, 'index'])->name('products.index');
        // Route untuk menampilkan detail produk
        Route::get('products/{product}', [ManagerController::class, 'showProduct'])->name('products.show');
        Route::get('transactions/in', [TransactionController::class, 'showIncomingForm'])->name('transactions.in');
        Route::post('transactions/in', [TransactionController::class, 'storeIncoming'])->name('transactions.store.in');
        Route::get('transactions/out', [TransactionController::class, 'showOutgoingForm'])->name('transactions.out');
        Route::post('transactions/out', [TransactionController::class, 'storeOutgoing'])->name('transactions.store.out');
        Route::get('stockopname', [StockOpnameController::class, 'index'])->name('stockopname.index');
        Route::post('stockopname', [StockOpnameController::class, 'store'])->name('stockopname.store');

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
        Route::get('dashboard', [StaffController::class, 'dashboard'])->name('dashboard');
        Route::post('stock/in', [StaffController::class, 'receiveStock'])->name('receiveStock');
        Route::post('stock/out', [StaffController::class, 'dispatchStock'])->name('dispatchStock');
        // Pastikan rute ini ada untuk staff stock
        Route::get('stock', [StaffController::class, 'showStock'])->name('stock.index');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });

require __DIR__ . '/auth.php';
