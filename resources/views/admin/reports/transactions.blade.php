@extends('layouts.admin')

@section('content')
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Laporan Transaksi</h1>
                <p class="text-sm text-gray-600 mt-1">Kelola dan pantau semua transaksi stok</p>
            </div>
            <div class="flex items-center gap-2">
                <div class="bg-blue-50 border border-blue-200 rounded-lg px-3 py-2">
                    <span class="text-sm font-medium text-blue-700">Total: {{ $transactions->count() }} transaksi</span>
                </div>
            </div>
        </div>
    </div>

   <!-- Export PDF Button -->
    <div class="mb-6 text-right">
        <a href="{{ route('admin.reports.transactions.pdf') }}" 
           class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Export PDF
        </a>
    </div>

    <!-- Filter Section (Optional - you can add this for better functionality) -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="p-4 border-b border-gray-200">
            <div class="flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2">
                    <i data-feather="filter" class="w-4 h-4 text-gray-500"></i>
                    <span class="text-sm font-medium text-gray-700">Filter</span>
                </div>
                <select class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Semua Tipe</option>
                    <option>Masuk</option>
                    <option>Keluar</option>
                </select>
                <select class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Semua Status</option>
                    <option>Pending</option>
                    <option>Confirmed</option>
                </select>
                <input type="date" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-1">
                                <i data-feather="hash" class="w-4 h-4"></i>
                                ID Transaksi
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-1">
                                <i data-feather="package" class="w-4 h-4"></i>
                                Produk
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-1">
                                <i data-feather="layers" class="w-4 h-4"></i>
                                Jumlah
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-1">
                                <i data-feather="arrow-up-down" class="w-4 h-4"></i>
                                Tipe
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-1">
                                <i data-feather="check-circle" class="w-4 h-4"></i>
                                Status
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-1">
                                <i data-feather="calendar" class="w-4 h-4"></i>
                                Tanggal
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($transactions as $transaction)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-xs font-medium text-gray-600">#</span>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">{{ $transaction->id }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i data-feather="box" class="w-4 h-4 text-blue-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $transaction->product->name }}</div>
                                        <div class="text-xs text-gray-500">SKU: {{ $transaction->product->sku ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-sm font-semibold text-blue-700">{{ $transaction->quantity }}</span>
                                    </div>
                                    <span class="text-xs text-gray-500">unit</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($transaction->type == 'in' || $transaction->type == 'Masuk')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i data-feather="arrow-down-circle" class="w-3 h-3 mr-1"></i>
                                        {{ $transaction->type == 'in' ? 'Masuk' : $transaction->type }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i data-feather="arrow-up-circle" class="w-3 h-3 mr-1"></i>
                                        {{ $transaction->type == 'out' ? 'Keluar' : $transaction->type }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($transaction->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i data-feather="clock" class="w-3 h-3 mr-1"></i>
                                        Pending
                                    </span>
                                @elseif($transaction->status == 'confirmed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i data-feather="check-circle" class="w-3 h-3 mr-1"></i>
                                        Confirmed
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <i data-feather="circle" class="w-3 h-3 mr-1"></i>
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center text-sm text-gray-900">
                                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                        <i data-feather="calendar" class="w-4 h-4 text-gray-600"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium">{{ $transaction->created_at->format('d-m-Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $transaction->created_at->format('H:i') }}</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Empty State -->
        @if($transactions->isEmpty())
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-feather="inbox" class="w-8 h-8 text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada transaksi</h3>
                <p class="text-sm text-gray-500">Belum ada transaksi yang tercatat dalam sistem.</p>
            </div>
        @endif
    </div>

    <!-- Summary Cards (Optional enhancement) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i data-feather="arrow-down-circle" class="w-6 h-6 text-green-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Barang Masuk</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $transactions->where('type', 'in')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i data-feather="arrow-up-circle" class="w-6 h-6 text-red-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Barang Keluar</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $transactions->where('type', 'out')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i data-feather="clock" class="w-6 h-6 text-yellow-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pending</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $transactions->where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Re-initialize feather icons after dynamic content
    feather.replace();
</script>
@endpush