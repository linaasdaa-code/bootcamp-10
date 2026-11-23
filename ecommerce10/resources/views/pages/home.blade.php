<x-layout title="Beranda">
    <div class="p-5 bg-light rounded-3 text-center mb-5">
        <h1>Selamat datang di Suvoire</h1>
        <p class="lead">Parfum dan hampers pilihan untuk orang tersayang.</p>
        <a href="{{ route('products.index') }}" class="btn btn-dark">Lihat Produk</a>
    </div>

    <div class="row text-center">
        <div class="col-md-4 mb-3">
            <h5>🎁 Hampers Custom</h5>
            <p class="text-muted">Pilih sendiri isi hampers sesuai acara.</p>
        </div>
        <div class="col-md-4 mb-3">
            <h5>🌸 Wangi Tahan Lama</h5>
            <p class="text-muted">Parfum dengan bahan pilihan.</p>
        </div>
        <div class="col-md-4 mb-3">
            <h5>🚚 Kirim ke Seluruh Bali</h5>
            <p class="text-muted">Pengiriman cepat dan aman.</p>
        </div>
    </div>
</x-layout>