<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\StockOpname;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed kategori
        $kategoriElektronik = Category::create(['name' => 'Elektronik']);
        $kategoriPakaian = Category::create(['name' => 'Pakaian']);
        $kategoriMakanan = Category::create(['name' => 'Makanan']);

        // Seed supplier dengan field 'address' ditambahkan
        $supplierA = Supplier::create([
            'name' => 'Supplier A',
            'contact' => '08123456789',
            'address' => 'Jl. Merdeka No. 1, Jakarta'
        ]);

        $supplierB = Supplier::create([
            'name' => 'Supplier B',
            'contact' => '08234567890',
            'address' => 'Jl. Sudirman No. 99, Bandung'
        ]);

        // Seed produk
        $product1 = Product::create([
            'name' => 'Smartphone A12',
            'purchase_price' => 15000,
            'sale_price' => 20000,
            'stock' => 100,
            'category_id' => $kategoriElektronik->id,
            'supplier_id' => $supplierA->id,
            'description' => 'Smartphone murah dengan fitur lengkap',
        ]);

        $product2 = Product::create([
            'name' => 'Kaos Polos Hitam',
            'purchase_price' => 25000,
            'sale_price' => 40000,
            'stock' => 50,
            'category_id' => $kategoriPakaian->id,
            'supplier_id' => $supplierB->id,
            'description' => 'Kaos polos berkualitas bahan katun',
        ]);

        // Seed stock opname untuk produk yang sudah ada
        StockOpname::create([
            'product_id' => $product1->id,
            'quantity_opname' => 95,
        ]);

        StockOpname::create([
            'product_id' => $product2->id,
            'quantity_opname' => 48,
        ]);
    }
}
