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
            <label for="description" class="block">Deskripsi Produk</label>
            <textarea id="description" name="description" class="w-full p-2 border">{{ $product->description }}</textarea>
        </div>

        <div class="mb-4">
            <label for="purchase_price" class="block">Harga Produk</label>
            <input type="number" id="purchase_price" name="purchase_price" class="w-full p-2 border"
                value="{{ $product->purchase_price }}" required>
        </div>

        <div class="mb-4">
            <label for="sale_price" class="block">Harga Jual</label>
            <input type="number" id="sale_price" name="sale_price" class="w-full p-2 border"
                value="{{ $product->sale_price }}" required>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block">Kategori Produk</label>
            <select id="category_id" name="category_id" class="w-full p-2 border" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="supplier_id" class="block">Supplier Produk</label>
            <select id="supplier_id" name="supplier_id" class="w-full p-2 border" required>
                <option value="">Pilih Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @if($product->supplier_id == $supplier->id) selected @endif>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Perbarui Produk</button>
    </form>


@endsection