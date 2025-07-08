<!-- resources/views/manager/products.blade.php -->

@extends('layouts.manager')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Daftar Produk</h1>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Supplier</th>
                <th>Harga Beli</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->supplier->name }}</td>
                    <td>{{ $product->purchase_price }}</td>
                    <td>{{ $product->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
