@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Tambah Produk Baru</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
        @csrf
        <div class="mb-6">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nama Produk</label>
            <input type="text" id="name" name="name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" required>
        </div>

        <div class="mb-6">
            <label for="price" class="block text-gray-700 font-medium mb-2">Harga</label>
            <input type="number" id="price" name="price" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" required>
        </div>

        <button type="submit" class="w-full py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-md hover:from-green-600 hover:to-green-700 focus:outline-none transition-all duration-300 transform hover:scale-105">
            Simpan Produk
        </button>
    </form>
@endsection
