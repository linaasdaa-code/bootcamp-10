<x-layout :title="$product['name']">
    <a href="{{ route('products.index') }}" class="btn btn-link px-0 mb-3">&larr; Kembali ke daftar produk</a>

    <span class="badge bg-secondary">{{ $product['category'] }}</span>
    <h1>{{ $product['name'] }}</h1>
    <p class="fs-4">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
    <p>{{ $product['description'] }}</p>
</x-layout>
