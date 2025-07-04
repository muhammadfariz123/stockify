<?php
// app/Http/Controllers/ManagerController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Manajer Gudang');
    }

    public function dashboard()
    {
        return view('manager.dashboard'); // Pastikan ini merujuk ke view manajer gudang
    }
}
