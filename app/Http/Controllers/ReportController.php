<?php
// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function stockReport()
    {
        // Laporan stok per kategori
        $reports = Product::with('category')->get();
        return view('manager.reports.stock', compact('reports'));
    }

    public function transactionReport()
    {
        // Laporan transaksi barang masuk dan keluar
        $transactions = Transaction::all();
        return view('manager.reports.transactions', compact('transactions'));
    }
}
