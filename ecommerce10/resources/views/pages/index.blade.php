@extends('layouts.app')

@section('title', 'Produk')

@section('content')
    <h1 class="mb-4">Daftar Produk</h1>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <span class="badge bg-secondary mb-2">{{ $product['category'] }}</span>
                        <h5 class="card-title">{{ $product['name'] }}</h5>
                        <p class="card-text">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                        <a href="{{ route('products.show', $product['id']) }}" class="btn btn-dark btn-sm">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection