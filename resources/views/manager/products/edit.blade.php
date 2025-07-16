@extends('layouts.manager')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Edit Produk</h1>
                        <p class="text-gray-600 mt-1">Perbarui informasi produk yang ada</p>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-8 py-6">
                    <h2 class="text-xl font-semibold text-white flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span>Informasi Produk</span>
                    </h2>
                </div>

                <!-- Form Body -->
                <div class="p-8">
                    <form action="{{ route('manager.products.update', $product) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Nama Produk -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-semibold text-gray-700">Nama Produk</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50" value="{{ $product->name }}" required>
                        </div>

                        <!-- Kategori -->
                        <div class="space-y-2">
                            <label for="category_id" class="block text-sm font-semibold text-gray-700">Kategori</label>
                            <select name="category_id" id="category_id" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Supplier -->
                        <div class="space-y-2">
                            <label for="supplier_id" class="block text-sm font-semibold text-gray-700">Supplier</label>
                            <select name="supplier_id" id="supplier_id" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50" required>
                                <option value="">Pilih Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Harga Beli -->
                        <div class="space-y-2">
                            <label for="purchase_price" class="block text-sm font-semibold text-gray-700">Harga Beli</label>
                            <input type="number" name="purchase_price" id="purchase_price" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50" value="{{ $product->purchase_price }}" required>
                        </div>

                        <!-- Harga Jual -->
                        <div class="space-y-2">
                            <label for="sale_price" class="block text-sm font-semibold text-gray-700">Harga Jual</label>
                            <input type="number" name="sale_price" id="sale_price" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50" value="{{ $product->sale_price }}" required>
                        </div>

                        <!-- Stok -->
                        <div class="space-y-2">
                            <label for="stock" class="block text-sm font-semibold text-gray-700">Stok</label>
                            <input type="number" name="stock" id="stock" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50" value="{{ $product->stock }}" required>
                        </div>

                        <!-- Deskripsi Produk -->
                        <div class="space-y-2">
                            <label for="description" class="block text-sm font-semibold text-gray-700">Deskripsi Produk</label>
                            <textarea id="description" name="description" rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50" placeholder="Masukkan deskripsi produk (opsional)">{{ $product->description }}</textarea>
                        </div>

                        <!-- Atribut Produk -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Pilih Atribut Produk</label>
                            <div class="grid grid-cols-2 gap-4">
                                @forelse($attributes as $attribute)
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="attributes[]" value="{{ $attribute->id }}" class="form-checkbox text-indigo-600" {{ $product->attributes->contains($attribute->id) ? 'checked' : '' }}>
                                        <span>{{ $attribute->name }}: {{ $attribute->value }}</span>
                                    </label>
                                @empty
                                    <p class="text-sm text-gray-500">Belum ada atribut dibuat. <a href="{{ route('admin.attributes.create') }}" class="text-blue-600 underline">Buat Atribut</a></p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6">
                            <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl shadow-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-semibold text-lg">
                                Update Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
