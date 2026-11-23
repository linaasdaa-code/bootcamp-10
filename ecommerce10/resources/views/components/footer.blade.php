<footer class="bg-dark text-light mt-5 py-4">
    <div class="container d-flex justify-content-between flex-wrap">
        <span>&copy; {{ date('Y') }} Suvoire. Parfum &amp; hampers pilihan.</span>
        <span>
            <a href="{{ route('products.index') }}" class="text-light me-3">Produk</a>
            <a href="{{ route('cart') }}" class="text-light">Keranjang</a>
        </span>
    </div>
</footer>