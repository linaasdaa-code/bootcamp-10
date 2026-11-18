<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/products', function () {
    return '<h1>Daftar Produk</h1><p>Di sini nanti tampil semua produk Suvoire.</p>';
});

Route::get('/cart', function () {
    return '<h1>Keranjang Belanja</h1><p>Di sini nanti tampil produk yang dimasukkan ke keranjang.</p>';
});

Route::get('/checkout', function () {
    return '<h1>Checkout</h1><p>Di sini nanti halaman pembayaran.</p>';
});