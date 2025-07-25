@extends('layouts.manager')

@section('content')
    <div class="p-6 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Transaksi Keluar</h1>


        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total Transaksi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Transaksi</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $transactionsOut->count() }}</p>
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
                            {{ $transactionsOut->where('status', 'pending')->count() }}
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
                            {{ $transactionsOut->where('status', 'confirmed')->count() }}
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

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white p-6 rounded-xl shadow-sm border mb-8">
            <h2 class="text-xl font-semibold mb-4">{{ isset($editTransaction) ? 'Edit Transaksi' : 'Tambah Transaksi' }}
            </h2>
            <form action="{{ route('manager.transactions.store.out') }}" method="POST">
                @csrf
                @if (isset($editTransaction))
                    <input type="hidden" name="id" value="{{ $editTransaction->id }}">
                @endif

                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm">Produk</label>
                        <select name="product_id" class="w-full border p-2 rounded" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ (isset($editTransaction) && $editTransaction->product_id == $product->id) ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm">Jumlah</label>
                        <input type="number" name="quantity" class="w-full border p-2 rounded"
                            value="{{ $editTransaction->quantity ?? '' }}" required>
                    </div>

                    <div>
                        <label class="block text-sm">Status</label>
                        <select name="status" class="w-full border p-2 rounded" required>
                            <option value="pending" {{ (isset($editTransaction) && $editTransaction->status == 'pending') ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ (isset($editTransaction) && $editTransaction->status == 'confirmed') ? 'selected' : '' }}>Confirmed</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm">Supplier</label>
                        <select name="supplier_id" class="w-full border p-2 rounded" required>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ (isset($editTransaction) && $editTransaction->supplier_id == $supplier->id) ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        {{ isset($editTransaction) ? 'Update' : 'Tambah' }}
                    </button>
                    @if (isset($editTransaction))
                        <a href="{{ route('manager.transactions.out') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <h2 class="text-xl font-semibold mb-4">Daftar Transaksi</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="p-2">ID</th>
                            <th class="p-2">Produk</th>
                            <th class="p-2">Jumlah</th>
                            <th class="p-2">Status</th>
                            <th class="p-2">Tanggal</th>
                            <th class="p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactionsOut as $transaction)
                            <tr class="border-b">
                                <td class="p-2">{{ $transaction->id }}</td>
                                <td class="p-2">{{ $transaction->product->name }}</td>
                                <td class="p-2">{{ $transaction->quantity }}</td>
                                <td class="p-2 capitalize">{{ $transaction->status }}</td>
                                <td class="p-2">
                                    {{ $transaction->transaction_date ?? $transaction->created_at->format('d-m-Y') }}</td>
                                <td class="p-2">
                                    <a href="{{ route('manager.transactions.edit.out', $transaction->id) }}"
                                        class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('manager.transactions.delete.out', $transaction->id) }}"
                                        method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 ml-2 hover:underline"
                                            onclick="return confirm('Yakin hapus transaksi ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection