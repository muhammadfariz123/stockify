@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Detail Produk</h1>

    <div class="mb-4">
        <strong>Nama Produk:</strong>
        <p>{{ $product->name }}</p>
    </div>

    <div class="mb-4">
        <strong>Harga Produk:</strong>
        <p>Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</p>
    </div>

    <div class="mb-4">
        <strong>Harga Jual:</strong>
        <p>Rp {{ number_format($product->selling_price, 0, ',', '.') }}</p>
    </div>

    <!-- Menampilkan Kategori Produk -->
    <div class="mb-4">
        <strong>Kategori Produk:</strong>
        <p>{{ $product->category ? $product->category->name : 'Kategori Tidak Ditemukan' }}</p>
    </div>

    <!-- Menampilkan Supplier Produk -->
    <div class="mb-4">
        <strong>Supplier Produk:</strong>
        <p>{{ $product->supplier ? $product->supplier->name : 'Supplier Tidak Ditemukan' }}</p>
    </div>

    <a href="{{ route('admin.products.edit', $product) }}" class="bg-yellow-500 text-white py-2 px-4 rounded">Edit Produk</a>
    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Hapus Produk</button>
    </form>

    <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded mt-4 inline-block">Kembali ke Daftar Produk</a>
@endsection
