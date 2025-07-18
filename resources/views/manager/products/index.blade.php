@extends('layouts.manager')

@section('content')
    <div class="container mx-auto p-4 lg:p-6">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-8 space-y-4 lg:space-y-0">
            <div class="space-y-2">
                <h1 class="text-3xl font-bold text-gray-900">Daftar Produk</h1>
                <p class="text-gray-600 text-sm">Kelola semua produk dengan mudah dan efisien</p>
            </div>
            <a href="{{ route('manager.products.create') }}" class="bg-[#00712D] text-white py-3 px-6 rounded-xl">
                Tambah Produk
            </a>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-md shadow-md border border-gray-200 overflow-hidden">
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
                            <tr class="hover:bg-gray-50">
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
                                    <div class="flex justify-center items-center space-x-3">
                                        <a href="{{ route('manager.products.show', $product) }}"
                                            class="text-blue-600 text-xs">Lihat</a>
                                        <a href="{{ route('manager.products.edit', $product) }}"
                                            class="text-yellow-600 text-xs">Edit</a>
                                        <form action="{{ route('manager.products.destroy', $product) }}" method="POST"
                                            class="inline-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 text-xs"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
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