<x-layout :title="$product->name">
    <a href="{{ route('products.index') }}" class="btn btn-link px-0 mb-3">&larr; Kembali ke daftar produk</a>

    <div class="row">
        <div class="col-md-5 mb-3">
            @if ($product->image)
                <img src="{{ $product->image }}" class="img-fluid rounded" alt="{{ $product->name }}">
            @endif
        </div>
        <div class="col-md-7">
            <span class="badge bg-secondary">{{ $product->category->name }}</span>
            <h1>{{ $product->name }}</h1>
            <p class="fs-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p>{{ $product->description }}</p>
            <p class="text-muted">Stok tersedia: {{ $product->stock }}</p>
        </div>
    </div>
</x-layout>