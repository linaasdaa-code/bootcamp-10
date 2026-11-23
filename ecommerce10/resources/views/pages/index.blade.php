<x-layout title="Produk">
    <h1 class="mb-4">Daftar Produk</h1>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-4">
                <x-product-card :product="$product" />
            </div>
        @endforeach
    </div>
</x-layout>