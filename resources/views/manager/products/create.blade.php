@extends('layouts.manager')

@section('content')
    <div class="min-h-screen py-8 bg-gray-100">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Header Section -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Tambah Produk Baru</h1>
                <p class="text-gray-600 mt-1">Lengkapi informasi produk dengan detail yang akurat</p>
            </div>

            <!-- Form Container -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <form action="{{ route('manager.products.store') }}" method="POST">
                    @csrf

                    <!-- Nama Produk -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold text-gray-700">Nama Produk</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Masukkan nama produk" value="{{ old('name') }}" required>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-semibold text-gray-700">Kategori</label>
                        <select name="category_id" id="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Supplier -->
                    <div class="mb-4">
                        <label for="supplier_id" class="block text-sm font-semibold text-gray-700">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                            <option value="">Pilih Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Harga Beli -->
                    <div class="mb-4">
                        <label for="purchase_price" class="block text-sm font-semibold text-gray-700">Harga Beli</label>
                        <input type="number" name="purchase_price" id="purchase_price" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Masukkan harga beli produk" value="{{ old('purchase_price') }}" required>
                    </div>

                    <!-- Harga Jual -->
                    <div class="mb-4">
                        <label for="sale_price" class="block text-sm font-semibold text-gray-700">Harga Jual</label>
                        <input type="number" name="sale_price" id="sale_price" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Masukkan harga jual produk" value="{{ old('sale_price') }}" required>
                    </div>

                    <!-- Stok -->
                    <div class="mb-4">
                        <label for="stock" class="block text-sm font-semibold text-gray-700">Stok</label>
                        <input type="number" name="stock" id="stock" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Masukkan jumlah stok produk" value="{{ old('stock') }}" required>
                    </div>

                    <!-- Deskripsi Produk -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-semibold text-gray-700">Deskripsi Produk</label>
                        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Masukkan deskripsi produk (opsional)">{{ old('description') }}</textarea>
                    </div>

                    <!-- Atribut Produk -->
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700">Pilih Atribut Produk</label>
                        <div class="grid grid-cols-2 gap-4">
                            @forelse($attributes as $attribute)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="attributes[]" value="{{ $attribute->id }}" class="form-checkbox text-indigo-600">
                                    <span>{{ $attribute->name }}: {{ $attribute->value }}</span>
                                </label>
                            @empty
                                <p class="text-sm text-gray-500">Belum ada atribut dibuat. <a href="{{ route('admin.attributes.create') }}" class="text-blue-600 underline">Buat Atribut</a></p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all duration-300">
                            Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
