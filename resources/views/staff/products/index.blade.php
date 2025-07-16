@extends('layouts.staff')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 lg:p-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">Daftar Produk</h1>
            <div class="space-y-4">
                @foreach ($products as $product)
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                        <p class="text-gray-600">Stok: {{ $product->stock }}</p>
                        <p class="text-gray-600">Harga: Rp{{ number_format($product->sale_price, 2) }}</p>
                        <a href="{{ route('staff.stock.in') }}" class="text-blue-500 hover:underline">Detail Produk</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
