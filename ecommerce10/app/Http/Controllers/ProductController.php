<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Tampilkan produk dengan pagination dan filter kategori
    public function index(Request $request)
    {
        // Semua kategori + jumlah produk di tiap kategori (memakai relasi hasMany)
        $categories = ProductCategory::withCount('products')->get();

        // Ambil produk beserta kategorinya (memakai relasi belongsTo)
        $query = Product::with('category')->orderBy('id');

        // Kalau ada ?category=... di URL, tampilkan produk kategori itu saja
        if ($request->filled('category')) {
            $query->where('product_category_id', $request->category);
        }

        // 3 produk per halaman
        $products = $query->paginate(3)->withQueryString();

        return view('products.index', compact('products', 'categories'));
    }

    // Tampilkan detail satu produk
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Method di bawah ini diisi di sesi berikutnya
    public function create() {}
    public function store(Request $request) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}