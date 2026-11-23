<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    // Setiap produk milik 1 kategori
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}