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
}
