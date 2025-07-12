@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Laporan Stok Produk</h1>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="border px-4 py-2">Nama Produk</th>
                <th class="border px-4 py-2">Harga Beli</th>
                <th class="border px-4 py-2">Harga Jual</th>
                <th class="border px-4 py-2">Stok Tersedia</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="border px-4 py-2">{{ $product->name }}</td>
                    <td class="border px-4 py-2">{{ number_format($product->purchase_price, 2) }}</td>
                    <td class="border px-4 py-2">{{ number_format($product->sale_price, 2) }}</td>
                    <td class="border px-4 py-2">{{ $product->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
