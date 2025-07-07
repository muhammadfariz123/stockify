<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // Tentukan kolom yang dapat diisi
    protected $fillable = ['name', 'address', 'contact'];

    // Relasi dengan Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    // Tentukan nama tabel jika berbeda dengan nama model dalam plural
    // protected $table = 'suppliers';  // Misalnya, jika tabelnya bukan 'suppliers'
}
