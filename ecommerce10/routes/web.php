<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ===== Halaman toko (bisa dibuka siapa saja) =====
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/cart', [PageController::class, 'cart'])->name('cart');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::resource('products', ProductController::class)->only(['index', 'show']);

// ===== Dashboard (hanya untuk yang sudah login) =====
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ===== Profil pengguna (bawaan Breeze, hanya untuk yang sudah login) =====
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== Route login, register, logout, dll (bawaan Breeze) =====
require __DIR__.'/auth.php';