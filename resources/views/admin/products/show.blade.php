<!-- resources/views/admin/products/show.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Detail Produk</h1>

    <div class="mb-4">
        <strong>Nama Produk:</strong>
        <p>{{ $product->name }}</p>
    </div>

    <div class="mb-4">
        <strong>Harga:</strong>
        <p>{{ $product->price }}</p>
    </div>

    <a href="{{ route('admin.products.edit', $product) }}" class="bg-yellow-500 text-white py-2 px-4 rounded">Edit Produk</a>
    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Hapus Produk</button>
    </form>

    <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded mt-4 inline-block">Kembali ke Daftar Produk</a>
@endsection
