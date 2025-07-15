@extends('layouts.manager')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Daftar Produk</h1>
    <table class="min-w-full table-auto">
        <thead>
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Nama Produk</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Harga Produk</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Harga Jual</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Kategori</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Supplier</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Stok</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Deskripsi</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Atribut</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $product->name }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">{{ $product->category->name }}</td>
                    <td class="px-6 py-4">{{ $product->supplier->name }}</td>
                    <td class="px-6 py-4">{{ $product->stock }}</td>
                    <td class="px-6 py-4">{{ $product->description ?? 'Deskripsi Tidak Tersedia' }}</td>
                    <td class="px-6 py-4">
                        @foreach($product->attributes as $attribute)
                            <span class="inline-block px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">{{ $attribute->name }} - {{ $attribute->value }}</span>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('manager.products.show', $product) }}" class="text-blue-600">Lihat Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
