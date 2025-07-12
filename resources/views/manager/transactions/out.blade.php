@extends('layouts.manager')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Barang Keluar</h1>

    <form action="{{ route('manager.transactions.store.out') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="product_id" class="block text-sm font-medium">Produk</label>
            <select id="product_id" name="product_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium">Jumlah</label>
            <input type="number" id="quantity" name="quantity" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Keluarkan Barang</button>
    </form>
@endsection
