<?php
// app/Http/Controllers/StaffController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Staff Gudang');
    }

    public function dashboard()
    {
        return view('staff.dashboard'); // Pastikan ini merujuk ke view staff gudang
    }

    public function showStock()
    {
        // Logika untuk menampilkan halaman stock untuk staff
        return view('staff.stock.index');
    }

    public function receiveStock(Request $request)
    {
        return redirect()->route('staff.stock.index')->with('success', 'Stock received successfully');
    }


    public function dispatchStock(Request $request)
    {

        return redirect()->route('staff.stock.index')->with('success', 'Stock dispatched successfully');
    }

}
