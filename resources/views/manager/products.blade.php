@extends('layouts.manager')

@section('content')
    <div class="min-h-screen p-6">
        <div class="max-w-7xl mx-auto bg-white rounded-3xl shadow-lg p-8">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Daftar Produk</h1>

            <table class="min-w-full table-auto border-collapse text-left text-gray-800">
                <thead class="bg-gradient-to-r from-[#00712D] to-[#004f2b] text-white">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Supplier</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Harga Beli</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Stok</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($products as $product)
                        <tr class="hover:bg-gradient-to-r hover:from-[#00712D] hover:to-[#004f2b] hover:text-white transition-all duration-300">
                            <td class="px-6 py-4 text-sm">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-sm">{{ $product->category->name }}</td>
                            <td class="px-6 py-4 text-sm">{{ $product->supplier->name }}</td>
                            <td class="px-6 py-4 text-sm">Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm">{{ $product->stock }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
