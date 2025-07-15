<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'value'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute_product');
    }


}
