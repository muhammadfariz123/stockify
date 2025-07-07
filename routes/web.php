<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CategoryController; // Pastikan ini sudah diimport
use App\Http\Controllers\SupplierController; // Pastikan ini sudah diimport
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

        // Resource untuk produk → uri /admin/products ; names admin.products.*
        Route::resource('products', AdminController::class);

        // Resource untuk supplier → uri /admin/suppliers ; names admin.suppliers.*
        Route::resource('suppliers', SupplierController::class);  // Tambahkan rute ini
    
        // Resource untuk kategori → uri /admin/categories ; names admin.categories.*
        Route::resource('categories', CategoryController::class);

        // Laporan
        Route::get('reports', [AdminController::class, 'showReports'])->name('reports.index');
    });

// ========== MANAGER GUDANG ==========

Route::prefix('manager')
    ->name('manager.')
    ->middleware(['auth', 'role:Manajer Gudang'])
    ->group(function () {
        Route::get('dashboard', [ManagerController::class, 'dashboard'])->name('dashboard');
        Route::resource('products', ManagerController::class);
        Route::resource('stock', ManagerController::class);

        // Laporan (Route yang hilang)
        Route::get('reports', [ManagerController::class, 'reports'])->name('reports.index'); // Menambahkan route laporan
    });

// ========== STAFF GUDANG ==========

Route::prefix('staff')
    ->name('staff.')
    ->middleware(['auth', 'role:Staff Gudang'])
    ->group(function () {
        Route::get('dashboard', [StaffController::class, 'dashboard'])->name('dashboard');
        Route::post('stock/in', [StaffController::class, 'receiveStock'])->name('stock.in');
        Route::post('stock/out', [StaffController::class, 'dispatchStock'])->name('stock.out');
    });

require __DIR__ . '/auth.php';
