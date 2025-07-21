@extends('layouts.manager')

@section('content')
    <div class="container mx-auto p-4 lg:p-6">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-8 space-y-4 lg:space-y-0">
            <div class="space-y-2">
                <h1 class="text-3xl font-bold text-gray-900">Daftar Produk</h1>
                <p class="text-gray-600 text-sm">Kelola semua produk dengan mudah dan efisien</p>
            </div>
            <a href="{{ route('manager.products.create') }}"
                class="bg-[#00712D] text-white py-3 px-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 ease-in-out">
                Tambah Produk
            </a>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-md shadow-lg border border-gray-200 overflow-hidden">
            <!-- Table Header -->
            <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">Data Produk</h2>
            </div>

            <!-- Table -->
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
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Atribut</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr class="hover:bg-gray-50 transition duration-300 ease-in-out">
                                <td class="px-6 py-5">{{ $product->name }}</td>
                                <td class="px-6 py-5">Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-5">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-5">{{ $product->category->name ?? 'Kategori Tidak Ditemukan' }}</td>
                                <td class="px-6 py-5">{{ $product->supplier->name ?? 'Supplier Tidak Ditemukan' }}</td>
                                <td class="px-6 py-5">{{ $product->stock }}</td>
                                <td class="px-6 py-5">{{ $product->description ?? 'Deskripsi Tidak Tersedia' }}</td>
                                <td class="px-6 py-5">
                                    @if($product->attributes->count())
                                        @foreach($product->attributes as $attribute)
                                            <span
                                                class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full mr-1 mb-1">
                                                {{ $attribute->name }}: {{ $attribute->value }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400 text-xs">Tidak ada atribut</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <div class="flex justify-center items-center space-x-2">
                                        <!-- Lihat Button -->
                                        <a href="{{ route('manager.products.show', $product) }}"
                                            class="group relative inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded-md hover:bg-blue-100 hover:border-blue-300 transition-all duration-200 hover:shadow-sm">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            Lihat
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('manager.products.edit', $product) }}"
                                            class="group relative inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-amber-700 bg-amber-50 border border-amber-200 rounded-md hover:bg-amber-100 hover:border-amber-300 transition-all duration-200 hover:shadow-sm">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                            Edit
                                        </a>

                                        <!-- Hapus Button -->
                                        <form action="{{ route('manager.products.destroy', $product) }}" method="POST"
                                            class="inline-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="group relative inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded-md hover:bg-red-100 hover:border-red-300 transition-all duration-200 hover:shadow-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                                Hapus
                                            </button>
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
@endsection