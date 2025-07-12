<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\StockOpname;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::create(['name' => 'Elektronik']);
        Category::create(['name' => 'Pakaian']);
        Category::create(['name' => 'Makanan']);

        StockOpname::create([
            'product_id' => 1, // ID produk yang sudah ada
            'quantity_opname' => 100,
        ]);

        StockOpname::create([
            'product_id' => 2, // ID produk yang lain
            'quantity_opname' => 50,
        ]);
    }
}
