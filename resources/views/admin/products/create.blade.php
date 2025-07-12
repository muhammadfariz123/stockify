@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Tambah Produk Baru</h1>
                        <p class="text-gray-600 mt-1">Lengkapi informasi produk dengan detail yang akurat</p>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-8 py-6">
                    <h2 class="text-xl font-semibold text-white flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Informasi Produk</span>
                    </h2>
                </div>

                <!-- Form Body -->
                <div class="p-8">
                    <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-8">
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Nama Produk -->
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <span class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <span>Nama Produk</span>
                                        <span class="text-red-500">*</span>
                                    </span>
                                </label>
                                <input type="text" id="name" name="name"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                    placeholder="Masukkan nama produk" required>
                            </div>

                            <!-- Harga Produk -->
                            <div class="space-y-2">
                                <label for="purchase_price" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <span class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        <span>Harga Produk</span>
                                        <span class="text-red-500">*</span>
                                    </span>
                                </label>
                                <input type="number" id="purchase_price" name="purchase_price"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                    placeholder="Masukkan harga produk" required>
                            </div>
                        </div>

                        <!-- Price Section -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Harga Jual -->
                            <div class="space-y-2">
                                <label for="sale_price" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <span class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Harga Jual</span>
                                        <span class="text-red-500">*</span>
                                    </span>
                                </label>
                                <input type="number" id="sale_price" name="sale_price"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                    placeholder="Masukkan harga jual produk" required>
                            </div>

                            <!-- Kategori Produk -->
                            <div class="space-y-2">
                                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <span class="flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                        <span>Kategori Produk</span>
                                        <span class="text-red-500">*</span>
                                    </span>
                                </label>
                                <select id="category_id" name="category_id"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                    required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Supplier Section -->
                        <div class="space-y-2">
                            <label for="supplier_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                <span class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Supplier Produk</span>
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <select id="supplier_id" name="supplier_id"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                required>
                                <option value="">Pilih Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Stok Section -->
                        <div class="space-y-2">
                            <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">
                                <span class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>Stok</span>
                                    <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <input type="number" id="stock" name="stock"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                placeholder="Masukkan jumlah stok produk" required>
                        </div>

                        <!-- Deskripsi Produk -->
                        <div class="space-y-2">
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                <span class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>Deskripsi Produk</span>
                                </span>
                            </label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white resize-none"
                                placeholder="Masukkan atribut produk (misalnya: ukuran, warna, berat)"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6 border-t border-gray-100">
                            <button type="submit"
                                class="w-full py-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl shadow-lg hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl font-semibold text-lg">
                                <span class="flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Simpan Produk</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
