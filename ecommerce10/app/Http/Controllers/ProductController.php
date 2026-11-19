<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Data contoh, sementara belum memakai database
    private function getProducts()
    {
        return [
            ['id' => 1, 'name' => 'Rose Oud', 'category' => 'Parfum', 'price' => 150000,
             'description' => 'Perpaduan mawar dan oud yang hangat dan elegan.'],
            ['id' => 2, 'name' => 'Sea Breeze', 'category' => 'Parfum', 'price' => 120000,
             'description' => 'Aroma segar laut untuk dipakai sehari-hari.'],
            ['id' => 3, 'name' => 'Peony Bloom', 'category' => 'Parfum', 'price' => 135000,
             'description' => 'Wangi bunga peony yang lembut dan feminin.'],
            ['id' => 4, 'name' => 'Caramel Latte', 'category' => 'Lilin', 'price' => 95000,
             'description' => 'Lilin aroma karamel dan kopi yang menenangkan.'],
        ];
    }

    // Tampilkan semua produk
    public function index()
    {
        $products = $this->getProducts();
        return view('products.index', compact('products'));
    }

    // Tampilkan detail satu produk berdasarkan id
    public function show(string $id)
    {
        foreach ($this->getProducts() as $product) {
            if ($product['id'] == $id) {
                return view('products.show', compact('product'));
            }
        }

        abort(404);
    }

    // Method di bawah ini diisi nanti, setelah memakai database
    public function create() {}
    public function store(Request $request) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}