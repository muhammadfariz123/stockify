@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Pengaturan Stok Minimum</h1>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left">Nama Produk</th>
                    <th class="px-4 py-3 text-left">Stok Saat Ini</th>
                    <th class="px-4 py-3 text-left">Stok Minimum</th>
                    <th class="px-4 py-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr>
                        <td class="px-4 py-3">{{ $product->name }}</td>
                        <td class="px-4 py-3">{{ $product->stock }}</td>
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.minimum_stock.update', $product) }}" method="POST"
                                class="flex space-x-2 items-center">
                                @csrf
                                <input type="number" name="minimum_stock" min="0" value="{{ $product->minimum_stock }}"
                                    class="w-24 border-gray-300 rounded px-2 py-1 text-sm">
                                <button type="submit"
                                    class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                    Simpan
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-3">
                            @if($product->stock < $product->minimum_stock)
                                <span class="text-red-500 font-semibold">⚠ Stok di bawah minimum</span>
                            @else
                                <span class="text-green-600">✅ Aman</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection