<x-layout title="Produk">
    <h1 class="mb-3">Daftar Produk</h1>

    {{-- Filter kategori --}}
    <div class="mb-4 d-flex flex-wrap gap-2">
        <a href="{{ route('products.index') }}"
           class="btn btn-sm {{ request('category') ? 'btn-outline-dark' : 'btn-dark' }}">
            Semua
        </a>

        @foreach ($categories as $category)
            <a href="{{ route('products.index', ['category' => $category->id]) }}"
               class="btn btn-sm {{ request('category') == $category->id ? 'btn-dark' : 'btn-outline-dark' }}">
                {{ $category->name }} ({{ $category->products_count }})
            </a>
        @endforeach
    </div>

    {{-- Daftar produk --}}
    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-4 mb-4">
                <x-product-card :product="$product" />
            </div>
        @empty
            <p class="text-muted">Belum ada produk di kategori ini.</p>
        @endforelse
    </div>

    {{-- Tombol pagination --}}
    {{ $products->links() }}
</x-layout>