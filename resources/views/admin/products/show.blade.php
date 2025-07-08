@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 lg:p-6">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-600 bg-clip-text text-transparent mb-2">
                    Detail Produk
                </h1>
                <p class="text-slate-600">Informasi lengkap produk yang dipilih</p>
            </div>

            <!-- Product Detail Card -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden mb-6">
                <!-- Product Header -->
                <div class="bg-gradient-to-r from-slate-50 to-slate-100 px-6 py-5 border-b border-slate-200/50">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-md">
                            <span class="text-white font-bold text-2xl">{{ substr($product->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">{{ $product->name }}</h2>
                            <p class="text-sm text-slate-500 font-medium">ID: {{ $product->id }}</p>
                        </div>
                    </div>
                </div>

                <!-- Product Information -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Product Name -->
                        <div class="space-y-3">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <strong class="text-slate-700 font-semibold">Nama Produk:</strong>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-slate-900 font-medium">{{ $product->name }}</p>
                            </div>
                        </div>

                        <!-- Product Category -->
                        <div class="space-y-3">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <strong class="text-slate-700 font-semibold">Kategori Produk:</strong>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 shadow-sm">
                                    {{ $product->category ? $product->category->name : 'Kategori Tidak Ditemukan' }}
                                </span>
                            </div>
                        </div>

                        <!-- Purchase Price -->
                        <div class="space-y-3">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                </svg>
                                <strong class="text-slate-700 font-semibold">Harga Produk:</strong>
                            </div>
                            <div class="bg-emerald-50 rounded-xl p-4">
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-md">
                                        Rp {{ number_format($product->purchase_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Sale Price -->
                        <div class="space-y-3">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <strong class="text-slate-700 font-semibold">Harga Jual:</strong>
                            </div>
                            <div class="bg-amber-50 rounded-xl p-4">
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-md">
                                        Rp {{ number_format($product->sale_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier -->
                        <div class="space-y-3 md:col-span-2">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <strong class="text-slate-700 font-semibold">Supplier Produk:</strong>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800 shadow-sm">
                                    {{ $product->supplier ? $product->supplier->name : 'Supplier Tidak Ditemukan' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <a href="{{ route('admin.products.edit', $product) }}" 
                        class="group inline-flex items-center justify-center space-x-2 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>Edit Produk</span>
                    </a>
                    
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="group inline-flex items-center justify-center space-x-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 w-full sm:w-auto"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span>Hapus Produk</span>
                        </button>
                    </form>
                </div>

                <a href="{{ route('admin.products.index') }}" 
                    class="group inline-flex items-center justify-center space-x-2 bg-gradient-to-r from-slate-500 to-slate-600 hover:from-slate-600 hover:to-slate-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 w-full sm:w-auto">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Daftar Produk</span>
                </a>
            </div>
        </div>
    </div>
@endsection