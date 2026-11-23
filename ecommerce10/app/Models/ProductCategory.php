<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name'];

    // 1 kategori punya banyak produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}