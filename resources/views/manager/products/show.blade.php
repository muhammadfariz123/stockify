@extends('layouts.manager')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Detail Produk</h1>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <!-- Nama Produk -->
        <div class="mb-4">
            <strong class="text-lg">Nama Produk: </strong>
            <span>{{ $product->name }}</span>
        </div>

        <!-- Kategori -->
        <div class="mb-4">
            <strong class="text-lg">Kategori: </strong>
            <span>{{ $product->category->name }}</span>
        </div>

        <!-- Supplier -->
        <div class="mb-4">
            <strong class="text-lg">Supplier: </strong>
            <span>{{ $product->supplier->name }}</span>
        </div>

        <!-- Harga Beli -->
        <div class="mb-4">
            <strong class="text-lg">Harga Beli: </strong>
            <span>Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</span>
        </div>

        <!-- Harga Jual -->
        <div class="mb-4">
            <strong class="text-lg">Harga Jual: </strong>
            <span>Rp {{ number_format($product->sale_price, 0, ',', '.') }}</span>
        </div>

        <!-- Stok -->
        <div class="mb-4">
            <strong class="text-lg">Stok: </strong>
            <span>{{ $product->stock }}</span>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <strong class="text-lg">Deskripsi: </strong>
            <p>{{ $product->description ?? 'Deskripsi Tidak Tersedia' }}</p>
        </div>

        <!-- Atribut -->
        <div class="mb-4">
            <strong class="text-lg">Atribut: </strong>
            <ul class="list-disc pl-5">
                @foreach($product->attributes as $attribute)
                    <li>{{ $attribute->name }} - {{ $attribute->value }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <a href="{{ route('manager.products.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">Kembali ke Daftar Produk</a>
@endsection
