<nav class="navbar navbar-expand navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Suvoire</a>
        <div class="navbar-nav">
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
               href="{{ route('home') }}">Beranda</a>
            <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
               href="{{ route('products.index') }}">Produk</a>
            <a class="nav-link {{ request()->routeIs('cart') ? 'active' : '' }}"
               href="{{ route('cart') }}">Keranjang</a>
            <a class="nav-link {{ request()->routeIs('checkout') ? 'active' : '' }}"
               href="{{ route('checkout') }}">Checkout</a>
        </div>
    </div>
</nav>