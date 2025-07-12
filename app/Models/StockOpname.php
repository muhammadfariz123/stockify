<?php
// app/Models/StockOpname.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi
    protected $fillable = ['product_id', 'quantity_opname'];

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
