@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="p-5 bg-light rounded-3 text-center">
        <h1>Selamat datang di Suvoire</h1>
        <p class="lead">Parfum dan hampers pilihan untuk orang tersayang.</p>
        <a href="{{ route('products.index') }}" class="btn btn-dark">Lihat Produk</a>
    </div>
@endsection