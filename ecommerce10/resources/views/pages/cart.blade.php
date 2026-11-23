<x-layout title="Keranjang">
    <h1 class="mb-4">Keranjang Belanja</h1>

    @if (count($cartItems) === 0)
        <p class="text-muted">Keranjangmu masih kosong.</p>
        <a href="{{ route('products.index') }}" class="btn btn-outline-dark">Mulai Belanja</a>
    @else
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>{{ $item['qty'] }}</td>
                        <td class="text-end">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <th class="text-end">Rp {{ number_format($total, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>

        <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>
    @endif
</x-layout>