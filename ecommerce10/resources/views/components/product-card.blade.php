@props(['product'])

<div class="card h-100">
    @if ($product->image)
        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
    @endif
    <div class="card-body d-flex flex-column">
        <span class="badge bg-secondary align-self-start mb-2">{{ $product->category->name }}</span>
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        <p class="text-muted small">Stok: {{ $product->stock }}</p>
        <a href="{{ route('products.show', $product) }}" class="btn btn-dark btn-sm mt-auto">Lihat Detail</a>
    </div>
</div>