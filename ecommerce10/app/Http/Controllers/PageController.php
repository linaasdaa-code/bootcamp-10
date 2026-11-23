<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function cart()
    {
        // Data contoh, sementara belum memakai database
        $cartItems = [
            ['name' => 'Rose Oud', 'price' => 150000, 'qty' => 2],
            ['name' => 'Caramel Latte', 'price' => 95000, 'qty' => 1],
        ];

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return view('pages.cart', compact('cartItems', 'total'));
    }

    public function checkout()
    {
        return view('pages.checkout');
    }
}