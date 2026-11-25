<nav class="navbar navbar-expand navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Suvoire</a>

        {{-- Menu toko --}}
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

        {{-- Menu akun (kanan) --}}
        <div class="navbar-nav ms-auto">
            @auth
                <a class="nav-link" href="{{ route('dashboard') }}">Halo, {{ Auth::user()->name }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link">Logout</button>
                </form>
            @else
                <a class="nav-link" href="{{ route('login') }}">Login</a>
                <a class="nav-link" href="{{ route('register') }}">Daftar</a>
            @endauth
        </div>
    </div>
</nav>