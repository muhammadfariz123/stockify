<!-- resources/views/admin/products/create.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto p-8 bg-white rounded-lg shadow-xl mt-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Produk Baru</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Nama Produk -->
        <div class="mb-6">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nama Produk</label>
            <input type="text" id="name" name="name" 
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
                placeholder="Masukkan nama produk" 
                required>
        </div>

        <!-- Harga Produk -->
        <div class="mb-6">
            <label for="purchase_price" class="block text-gray-700 font-medium mb-2">Harga Produk</label>
            <input type="number" id="purchase_price" name="purchase_price" 
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
                placeholder="Masukkan harga produk" 
                required>
        </div>

        <!-- Harga Jual -->
        <div class="mb-6">
            <label for="selling_price" class="block text-gray-700 font-medium mb-2">Harga Jual</label>
            <input type="number" id="selling_price" name="selling_price" 
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
                placeholder="Masukkan harga jual produk" 
                required>
        </div>

        <!-- Kategori Produk -->
        <div class="mb-6">
            <label for="category_id" class="block text-gray-700 font-medium mb-2">Kategori Produk</label>
            <select id="category_id" name="category_id" 
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
                required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Supplier Produk -->
        <div class="mb-6">
            <label for="supplier_id" class="block text-gray-700 font-medium mb-2">Supplier Produk</label>
            <select id="supplier_id" name="supplier_id" 
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
                required>
                <option value="">Pilih Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" 
            class="w-full py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-md hover:from-green-600 hover:to-green-700 focus:outline-none transition-all duration-300 transform hover:scale-105">
            Simpan Produk
        </button>
    </form>
</div>
@endsection
