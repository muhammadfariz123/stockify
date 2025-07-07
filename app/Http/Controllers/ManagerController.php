<?php
// app/Http/Controllers/ManagerController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    // Method untuk menampilkan dashboard
    public function index()
    {
        // Pastikan mengembalikan tampilan yang sesuai
        return view('manager.dashboard');
    }
    public function dashboard()
    {
        // Pastikan mengembalikan tampilan yang sesuai
        return view('manager.dashboard');
    }

    // Method lainnya
    public function stock()
    {
        return view('manager.stock');
    }

    public function products()
    {
        return view('manager.products');
    }

    public function reports()
    {
        return view('manager.reports');
    }
}
