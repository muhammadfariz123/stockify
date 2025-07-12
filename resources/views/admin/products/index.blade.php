@extends('layouts.admin')

@section('content')
    <div class="min-h-screen p-4 lg:p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-8 space-y-4 lg:space-y-0">
                <div class="space-y-2">
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900">
                        Daftar Produk
                    </h1>
                    <p class="text-gray-600 text-sm lg:text-base">Kelola semua produk dengan mudah dan efisien</p>
                </div>
                <a href="{{ route('admin.products.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5 px-6 rounded-xl">
                    <span>Tambah Produk</span>
                </a>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Products Card -->
                <div class="bg-white rounded-2xl p-6 shadow-md">
                    <div class="flex items-center space-x-4">
                        <div class="p-4 bg-blue-600 text-white rounded-xl">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Produk</p>
                            <p class="text-3xl font-bold text-gray-900">{{ count($products) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Active Products Card -->
                <div class="bg-white rounded-2xl p-6 shadow-md">
                    <div class="flex items-center space-x-4">
                        <div class="p-4 bg-emerald-600 text-white rounded-xl">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Produk Aktif</p>
                            <p class="text-3xl font-bold text-gray-900">{{ count($products) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Categories Card -->
                <div class="bg-white rounded-2xl p-6 shadow-md">
                    <div class="flex items-center space-x-4">
                        <div class="p-4 bg-purple-600 text-white rounded-xl">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Kategori</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $categoriesCount }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Container -->
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                <!-- Table Header -->
                <div class="bg-gray-50 px-6 py-5 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-900">Data Produk</h2>
                    </div>
                </div>

                <!-- Desktop Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Nama Produk</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Harga Produk</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Harga Jual</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Supplier</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Stok</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Deskripsi</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center space-x-4">
                                            <div
                                                class="w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center">
                                                <span class="text-lg font-bold">{{ substr($product->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
                                                <div class="text-xs text-gray-500">ID: {{ $product->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-gray-600">Rp
                                        {{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-5 whitespace-nowrap text-gray-600">Rp
                                        {{ number_format($product->sale_price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        {{ $product->category ? $product->category->name : 'Kategori Tidak Ditemukan' }}</td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        {{ $product->supplier ? $product->supplier->name : 'Supplier Tidak Ditemukan' }}</td>
                                    <td class="px-6 py-5 whitespace-nowrap text-gray-600">{{ $product->stock }}</td>
                                    <td class="px-6 py-5 whitespace-nowrap text-gray-600">
                                        {{ $product->description ?? 'Deskripsi Tidak Tersedia' }}</td>
                                    <td class="px-6 py-5 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('admin.products.show', $product) }}"
                                                class="text-blue-600">Lihat</a>
                                            <a href="{{ route('admin.products.edit', $product) }}"
                                                class="text-yellow-600">Edit</a>
                                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection