@extends('layouts.manager')

@section('content')
    <h1 class="text-xl font-semibold mb-4 text-black">Barang Masuk</h1>
    
    <form action="{{ route('manager.transactions.store.in') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="product_id" class="block text-sm font-medium text-black">Produk</label>
            <select id="product_id" name="product_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-black">Jumlah</label>
            <input type="number" id="quantity" name="quantity" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
        </div>

        <div class="mb-4">
            <label for="supplier_id" class="block text-sm font-medium text-black">Supplier</label>
            <select id="supplier_id" name="supplier_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-[#00712D] text-white px-4 py-2 rounded-md hover:bg-[#005b1b] focus:outline-none focus:ring-2 focus:ring-[#00712D] transform active:scale-95 transition-all duration-300">
            Tambah Barang Masuk
        </button>
    </form>
@endsection
