<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Satu pengguna contoh (tabel users bawaan Laravel)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Kategori dulu, baru produk
        $this->call([
            ProductCategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}