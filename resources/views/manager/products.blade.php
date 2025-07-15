@extends('layouts.manager')

@section('content')
    <div class="min-h-screen p-6">
        <div class="max-w-7xl mx-auto bg-white rounded-3xl shadow-lg p-8">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Daftar Produk</h1>

            <table class="min-w-full table-auto border-collapse text-left text-gray-800">
                <thead class="bg-gradient-to-r from-[#00712D] to-[#004f2b] text-white">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Harga Produk</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Harga Jual</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Supplier</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Atribut</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($products as $product)
                        <tr class="hover:bg-gradient-to-r hover:from-[#00712D] hover:to-[#004f2b] hover:text-white transition-all duration-300">
                            <td class="px-6 py-4 text-sm">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-sm">Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm">{{ $product->category->name }}</td>
                            <td class="px-6 py-4 text-sm">{{ $product->supplier->name }}</td>
                            <td class="px-6 py-4 text-sm">{{ $product->stock }}</td>
                            <td class="px-6 py-4 text-sm">{{ $product->description ?? 'Deskripsi Tidak Tersedia' }}</td>
                            <td class="px-6 py-4">
                                @foreach($product->attributes as $attribute)
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">{{ $attribute->name }} - {{ $attribute->value }}</span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('manager.products.show', $product) }}" class="text-blue-600">Lihat Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
