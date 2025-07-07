@extends('layouts.manager')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Dashboard Manajer Gudang</h1>
    <div class="grid grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded shadow-lg">
            <h3 class="text-xl font-semibold">Stok Menipis</h3>
            <p>5 Produk</p>
        </div>
        <div class="bg-white p-6 rounded shadow-lg">
            <h3 class="text-xl font-semibold">Barang Masuk Hari Ini</h3>
            <p>10 Barang</p>
        </div>
        <div class="bg-white p-6 rounded shadow-lg">
            <h3 class="text-xl font-semibold">Barang Keluar Hari Ini</h3>
            <p>8 Barang</p>
        </div>
    </div>
@endsection