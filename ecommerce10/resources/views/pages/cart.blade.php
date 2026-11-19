@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
    <h1>Keranjang Belanja</h1>
    <p class="text-muted">Keranjangmu masih kosong.</p>
    <a href="{{ route('products.index') }}" class="btn btn-outline-dark">Mulai Belanja</a>
@endsection