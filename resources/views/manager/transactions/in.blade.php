@extends('layouts.manager')

@section('content')
    <h1 class="text-xl font-semibold mb-4 text-black">Barang Masuk</h1>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Transaksi -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Transaksi</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $transactionsIn->count() }}</p>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending</p>
                    <p class="text-2xl font-bold text-yellow-600">
                        {{ $transactionsIn->where('status', 'pending')->count() }}
                    </p>
                </div>
                <div class="p-3 bg-yellow-50 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Confirmed -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Confirmed</p>
                    <p class="text-2xl font-bold text-green-600">
                        {{ $transactionsIn->where('status', 'confirmed')->count() }}
                    </p>
                </div>
                <div class="p-3 bg-green-50 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>


    </div>
    <!-- Form untuk tambah transaksi -->
    <form action="{{ route('manager.transactions.store.in') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="product_id" class="block text-sm font-medium text-black">Produk</label>
            <select id="product_id" name="product_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-black">Jumlah</label>
            <input type="number" id="quantity" name="quantity"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
        </div>

        <div class="mb-4">
            <label for="supplier_id" class="block text-sm font-medium text-black">Supplier</label>
            <select id="supplier_id" name="supplier_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                required>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit"
            class="bg-[#00712D] text-white px-4 py-2 rounded-md hover:bg-[#005b1b] focus:outline-none focus:ring-2 focus:ring-[#00712D] transform active:scale-95 transition-all duration-300">
            Tambah Barang Masuk
        </button>
    </form>

    <!-- Tabel Transaksi Masuk -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-x-auto mt-8">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($transactionsIn as $transaction)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">#{{ $transaction->id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->product->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->quantity }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ ucfirst($transaction->status) }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('manager.transactions.edit.in', $transaction->id) }}"
                                class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('manager.transactions.delete.in', $transaction->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection