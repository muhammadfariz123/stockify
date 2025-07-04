@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>
    <div class="grid grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded shadow-lg">
            <h3 class="text-xl font-semibold">Jumlah Produk</h3>
            <p>100 Produk</p>
        </div>
        <div class="bg-white p-6 rounded shadow-lg">
            <h3 class="text-xl font-semibold">Jumlah Transaksi Masuk</h3>
            <p>20 Transaksi</p>
        </div>
        <div class="bg-white p-6 rounded shadow-lg">
            <h3 class="text-xl font-semibold">Jumlah Transaksi Keluar</h3>
            <p>15 Transaksi</p>
        </div>
    </div>
@endsection
