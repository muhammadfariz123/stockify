@extends('layouts.staff')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 lg:p-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">Tambah Produk Baru</h1>
            <form action="{{ route('staff.product.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold">Nama Produk</label>
                    <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-lg font-semibold">Deskripsi Produk</label>
                    <textarea name="description" id="description" class="w-full p-2 border border-gray-300 rounded"></textarea>
                </div>

                <div class="mb-4">
                    <label for="purchase_price" class="block text-lg font-semibold">Harga Beli</label>
                    <input type="number" name="purchase_price" id="purchase_price" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="sale_price" class="block text-lg font-semibold">Harga Jual</label>
                    <input type="number" name="sale_price" id="sale_price" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="stock" class="block text-lg font-semibold">Stok</label>
                    <input type="number" name="stock" id="stock" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-lg font-semibold">Kategori</label>
                    <select name="category_id" id="category_id" class="w-full p-2 border border-gray-300 rounded" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="supplier_id" class="block text-lg font-semibold">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="w-full p-2 border border-gray-300 rounded" required>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="attributes" class="block text-lg font-semibold">Atribut Produk</label>
                    <select name="attributes[]" id="attributes" class="w-full p-2 border border-gray-300 rounded" multiple>
                        @foreach ($attributes as $attribute)
                            <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded">Tambah Produk</button>
            </form>
        </div>
    </div>
@endsection
