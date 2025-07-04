<!-- resources/views/admin/products/edit.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Edit Produk</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block">Nama Produk</label>
            <input type="text" id="name" name="name" class="w-full p-2 border" value="{{ $product->name }}" required>
        </div>

        <div class="mb-4">
            <label for="price" class="block">Harga</label>
            <input type="number" id="price" name="price" class="w-full p-2 border" value="{{ $product->price }}" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Perbarui Produk</button>
    </form>
@endsection
