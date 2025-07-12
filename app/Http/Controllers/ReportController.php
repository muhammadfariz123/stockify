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
        // Ambil data yang diperlukan untuk laporan stok
        $products = Product::all();  // Contoh ambil semua produk sebagai laporan stok

        return view('manager.reports.stock', compact('products'));  // Kirim data ke tampilan laporan stok
    }

    public function transactionReport()
    {
        // Ambil data yang diperlukan untuk laporan transaksi
        $transactions = Transaction::all();  // Contoh ambil semua transaksi

        return view('manager.reports.transactions', compact('transactions'));  // Kirim data ke tampilan laporan transaksi
    }
}
