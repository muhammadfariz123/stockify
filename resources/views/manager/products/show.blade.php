@extends('layouts.manager')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Detail Produk</h1>
            <p class="text-gray-600">Informasi lengkap tentang produk yang dipilih</p>
        </div>

        <!-- Product Detail Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-8">
                <!-- Product Name Section -->
                <div class="mb-8 pb-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $product->name }}</h2>
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            ID: #{{ $product->id }}
                        </span>
                    </div>
                </div>

                <!-- Product Information Grid -->
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Kategori -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                <span class="font-semibold text-gray-900">Kategori</span>
                            </div>
                            <span class="text-gray-700 text-lg">{{ $product->category->name }}</span>
                        </div>

                        <!-- Supplier -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span class="font-semibold text-gray-900">Supplier</span>
                            </div>
                            <span class="text-gray-700 text-lg">{{ $product->supplier->name }}</span>
                        </div>

                        <!-- Stok -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <span class="font-semibold text-gray-900">Stok</span>
                            </div>
                            <span class="text-gray-700 text-2xl font-bold">{{ $product->stock }}</span>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Harga Beli -->
                        <div class="bg-red-50 p-4 rounded-lg border border-red-100">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span class="font-semibold text-gray-900">Harga Beli</span>
                            </div>
                            <span class="text-red-700 text-xl font-bold">Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</span>
                        </div>

                        <!-- Harga Jual -->
                        <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span class="font-semibold text-gray-900">Harga Jual</span>
                            </div>
                            <span class="text-green-700 text-xl font-bold">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</span>
                        </div>

                        
                    </div>
                </div>

                <!-- Description Section -->
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="font-semibold text-gray-900 text-lg">Deskripsi</span>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-700 leading-relaxed">{{ $product->description ?? 'Deskripsi Tidak Tersedia' }}</p>
                    </div>
                </div>

                <!-- Attributes Section -->
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span class="font-semibold text-gray-900 text-lg">Atribut</span>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($product->attributes->count() > 0)
                            <div class="grid md:grid-cols-2 gap-3">
                                @foreach($product->attributes as $attribute)
                                    <div class="flex items-center justify-between bg-white p-3 rounded border border-gray-200">
                                        <span class="font-medium text-gray-900">{{ $attribute->name }}</span>
                                        <span class="text-gray-600 bg-gray-100 px-2 py-1 rounded text-sm">{{ $attribute->value }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Tidak ada atribut yang tersedia</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('manager.products.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar Produk
            </a>
        </div>
    </div>
@endsection