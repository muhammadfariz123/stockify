<!-- resources/views/manager/reports/stock.blade.php -->
@extends('layouts.manager')

@section('content')
    <h1>Laporan Stok Barang</h1>
    <ul>
        @foreach($reports as $product)
            <li>{{ $product->name }} (Kategori: {{ $product->category->name }}) - Stok: {{ $product->stock }}</li>
        @endforeach
    </ul>
@endsection