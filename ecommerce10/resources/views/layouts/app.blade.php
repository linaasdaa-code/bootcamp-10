<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Suvoire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Suvoire</a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                <a class="nav-link" href="{{ route('products.index') }}">Produk</a>
                <a class="nav-link" href="{{ route('cart') }}">Keranjang</a>
                <a class="nav-link" href="{{ route('checkout') }}">Checkout</a>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer class="text-center text-muted py-4 mt-5 border-top">
        &copy; {{ date('Y') }} Suvoire
    </footer>
</body>
</html>