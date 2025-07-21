<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function attributes()
    {
        return $this->belongsToMany(ProductAttribute::class, 'product_attribute_product');
    }




    // Pastikan field yang sesuai ter-cast ke tipe yang benar
    protected $casts = [
        'purchase_price' => 'decimal:2',  // Menyimpan harga dengan dua angka di belakang koma
        'sale_price' => 'decimal:2',  // Menyimpan harga jual dengan dua angka di belakang koma
    ];
    protected $fillable = [
        'name',
        'description',
        'purchase_price',
        'sale_price',
        'stock',
        'image',
        'category_id',
        'supplier_id',
        'minimum_stock',
    ];

    // Aksesornya untuk harga beli (dalam rupiah)
    public function getPurchasePriceAttribute($value)
    {
        return $value / 100;  // Mengonversi harga beli dari sen ke rupiah
    }

    // Aksesornya untuk harga jual (dalam rupiah)
    public function getSellingPriceAttribute($value)
    {
        return $value / 100;  // Mengonversi harga jual dari sen ke rupiah
    }

    // Mutator untuk harga beli (dalam sen)
    public function setPurchasePriceAttribute($value)
    {
        $this->attributes['purchase_price'] = $value * 100;
    }

    // Mutator untuk harga jual (dalam sen)
    public function setSellingPriceAttribute($value)
    {
        $this->attributes['selling_price'] = $value * 100;
    }

    // Definisikan relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function updateStock()
    {
        $this->stock = $this->transactions->sum('quantity');
        $this->save();
    }
}
