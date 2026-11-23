<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil id setiap kategori
        $parfum  = ProductCategory::where('name', 'Parfum')->first();
        $lilin   = ProductCategory::where('name', 'Lilin Aromaterapi')->first();
        $hampers = ProductCategory::where('name', 'Hampers')->first();

        $products = [
            [
                'product_category_id' => $parfum->id,
                'name' => 'Rose Oud',
                'description' => 'Perpaduan mawar dan oud yang hangat dan elegan.',
                'price' => 150000,
                'stock' => 10,
                'image' => 'https://picsum.photos/seed/rose-oud/400/300',
            ],
            [
                'product_category_id' => $parfum->id,
                'name' => 'Sea Breeze',
                'description' => 'Aroma segar laut untuk dipakai sehari-hari.',
                'price' => 120000,
                'stock' => 15,
                'image' => 'https://picsum.photos/seed/sea-breeze/400/300',
            ],
            [
                'product_category_id' => $parfum->id,
                'name' => 'Peony Bloom',
                'description' => 'Wangi bunga peony yang lembut dan feminin.',
                'price' => 135000,
                'stock' => 8,
                'image' => 'https://picsum.photos/seed/peony-bloom/400/300',
            ],
            [
                'product_category_id' => $lilin->id,
                'name' => 'Caramel Latte',
                'description' => 'Lilin aroma karamel dan kopi yang menenangkan.',
                'price' => 95000,
                'stock' => 20,
                'image' => 'https://picsum.photos/seed/caramel-latte/400/300',
            ],
            [
                'product_category_id' => $lilin->id,
                'name' => 'Sandalwood Calm',
                'description' => 'Lilin cendana untuk suasana santai di rumah.',
                'price' => 90000,
                'stock' => 12,
                'image' => 'https://picsum.photos/seed/sandalwood/400/300',
            ],
            [
                'product_category_id' => $hampers->id,
                'name' => 'Hampers Love Box',
                'description' => 'Paket parfum mini, lilin, dan kartu ucapan.',
                'price' => 350000,
                'stock' => 5,
                'image' => 'https://picsum.photos/seed/love-box/400/300',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}