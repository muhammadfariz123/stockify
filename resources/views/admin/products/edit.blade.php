@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Edit Produk</h1>
                            <p class="text-sm text-gray-500 mt-1">Perbarui informasi produk dengan mengisi form di bawah ini</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <form action="{{ route('admin.products.update', $product) }}" method="POST" class="divide-y divide-gray-200" onsubmit="return formatForSubmit()">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information Section -->
                    <div class="px-6 py-6">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Informasi Dasar</h3>
                            <p class="text-sm text-gray-600">Informasi umum tentang produk</p>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Product Name -->
                            <div class="lg:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Produk
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ $product->name }}" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400" required>
                            </div>

                            <!-- Product Description -->
                            <div class="lg:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Deskripsi Produk
                                </label>
                                <textarea id="description" name="description" rows="4" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400">{{ $product->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Section -->
                    <div class="px-6 py-6">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Informasi Harga</h3>
                            <p class="text-sm text-gray-600">Atur harga beli dan jual produk</p>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Purchase Price -->
                            <div>
                                <label for="purchase_price" class="block text-sm font-medium text-gray-700 mb-2">
                                    Harga Produk
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="purchase_price" name="purchase_price" value="{{ number_format($product->purchase_price, 0, ',', '.') }}" class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400" required oninput="formatCurrency(this)">
                            </div>

                            <!-- Sale Price -->
                            <div>
                                <label for="sale_price" class="block text-sm font-medium text-gray-700 mb-2">
                                    Harga Jual
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="sale_price" name="sale_price" value="{{ number_format($product->sale_price, 0, ',', '.') }}" class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400" required oninput="formatCurrency(this)">
                            </div>
                        </div>
                    </div>

                    <script>
                        function formatCurrency(input) {
                            // Remove non-numeric characters and format the value
                            let value = input.value.replace(/[^0-9]/g, '');
                            let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            input.value = formattedValue;
                        }

                        function formatForSubmit() {
                            // Strip commas before submitting
                            let purchase_price = document.getElementById('purchase_price').value.replace(/\./g, '');
                            let sale_price = document.getElementById('sale_price').value.replace(/\./g, '');
                            document.getElementById('purchase_price').value = purchase_price;
                            document.getElementById('sale_price').value = sale_price;
                            return true;
                        }
                    </script>

                    <!-- Category and Supplier Section -->
                    <div class="px-6 py-6">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Kategori & Supplier</h3>
                            <p class="text-sm text-gray-600">Pilih kategori dan supplier produk</p>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kategori Produk
                                    <span class="text-red-500">*</span>
                                </label>
                                <select id="category_id" name="category_id" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Supplier Produk
                                    <span class="text-red-500">*</span>
                                </label>
                                <select id="supplier_id" name="supplier_id" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm" required>
                                    <option value="">Pilih Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" @if($product->supplier_id == $supplier->id) selected @endif>{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Stock Section -->
                    <div class="px-6 py-6">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Stok Produk</h3>
                            <p class="text-sm text-gray-600">Masukkan jumlah stok produk yang tersedia</p>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                                    Stok Produk
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="stock" name="stock" value="{{ $product->stock }}" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm" required>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="px-6 py-4 bg-gray-50 rounded-b-lg">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-3 sm:space-y-0">
                            <div class="text-sm text-gray-600">
                                <span class="text-red-500">*</span> Field wajib diisi
                            </div>
                            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                                <button type="button" onclick="window.history.back()" class="w-full sm:w-auto px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 font-medium">
                                    Batal
                                </button>
                                <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                        </svg>
                                        Perbarui Produk
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
