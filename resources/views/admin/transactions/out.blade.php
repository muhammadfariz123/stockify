@extends('layouts.admin')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Transaksi Keluar</h1>
        <p class="text-gray-600">Kelola dan pantau semua transaksi keluar produk</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Transaksi</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $transactionsOut->count() }}</p>
                </div>
                <div class="p-3 bg-red-50 rounded-lg">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19V6a2 2 0 012-2h2a2 2 0 012 2v13"></path>
                    </svg>
                </div>
            </div>
        </div>
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
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
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
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Tambah/Edit -->
    <div class="bg-white rounded-xl shadow border border-gray-200 p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">
            {{ isset($editTransaction) ? 'Edit Transaksi Keluar' : 'Tambah Transaksi Keluar' }}
        </h2>
        <form action="{{ isset($editTransaction) ? route('admin.transactions.out.update', $editTransaction->id) : route('admin.transactions.out.store') }}"
            method="POST">
            @csrf
            @if(isset($editTransaction))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Produk</label>
                    <select name="product_id" required class="mt-1 block w-full border rounded-md p-2">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                {{ (isset($editTransaction) && $editTransaction->product_id == $product->id) ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input type="number" name="quantity" required class="mt-1 block w-full border rounded-md p-2"
                        value="{{ $editTransaction->quantity ?? old('quantity') }}">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" required class="mt-1 block w-full border rounded-md p-2">
                        @foreach(['pending', 'confirmed'] as $status)
                            <option value="{{ $status }}"
                                {{ (isset($editTransaction) && $editTransaction->status == $status) ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">
                    {{ isset($editTransaction) ? 'Perbarui' : 'Tambah' }}
                </button>
                @if(isset($editTransaction))
                    <a href="{{ route('admin.transactions.out') }}" class="ml-2 text-sm text-gray-500 underline">Batal Edit</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Transaksi Keluar -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-x-auto">
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
                @foreach($transactionsOut as $transaction)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">#{{ $transaction->id }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->product->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->quantity }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $transaction->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <span class="inline-block px-2 py-1 text-xs rounded-full bg-gray-100">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.transactions.out.edit', $transaction->id) }}"
                            class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.transactions.out.delete', $transaction->id) }}"
                            method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus?')"
                                class="text-red-600 hover:underline ml-2">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($transactionsOut->isEmpty())
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-8">Tidak ada data transaksi keluar.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
