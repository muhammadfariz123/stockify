@extends('layouts.manager')

@section('content')
    <div class="container mx-auto p-6 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <!-- Header Section -->
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 mb-8 shadow-lg border border-white/20">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-3 rounded-xl mr-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                </div>
                <span class="bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                    Laporan Transaksi
                </span>
            </h1>
        </div>

        <!-- Table Container -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
            <!-- Table Header Background -->
            <div class="bg-gradient-to-r from-slate-50 to-slate-100 p-6 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-r from-slate-600 to-slate-700 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-slate-700">Riwayat Transaksi</h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-slate-600">Masuk</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <span class="text-sm text-slate-600">Keluar</span>
                        </div>
                        <div class="text-sm text-slate-500">
                            Total: {{ count($transactions) }} transaksi
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-gradient-to-r from-slate-100 to-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-r border-slate-300 last:border-r-0">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    <span>ID Transaksi</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-r border-slate-300 last:border-r-0">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span>Produk</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-r border-slate-300 last:border-r-0">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                                    <span>Jumlah</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-r border-slate-300 last:border-r-0">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-indigo-500 rounded-full"></div>
                                    <span>Tanggal Transaksi</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-r border-slate-300 last:border-r-0">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                    <span>Jenis Transaksi</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-r border-slate-300 last:border-r-0">
    <div class="flex items-center space-x-2">
        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
        <span>Status</span>
    </div>
</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @foreach ($transactions as $transaction)
                            <tr class="hover:bg-slate-50 transition-colors duration-200 group">
                                <td class="px-6 py-4 whitespace-nowrap border-r border-slate-200 last:border-r-0">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-r from-blue-100 to-blue-200 rounded-lg flex items-center justify-center mr-3 group-hover:from-blue-200 group-hover:to-blue-300 transition-colors duration-200">
                                            <span class="text-xs font-bold text-blue-700">#</span>
                                        </div>
                                        <span class="text-sm font-medium text-slate-900">{{ $transaction->id }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-slate-200 last:border-r-0">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-r from-green-100 to-green-200 rounded-lg flex items-center justify-center mr-3 group-hover:from-green-200 group-hover:to-green-300 transition-colors duration-200">
                                            <svg class="w-4 h-4 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-slate-900">{{ $transaction->product->name }}</span>
                                            <div class="text-xs text-slate-500">Produk ID: {{ $transaction->product->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-slate-200 last:border-r-0">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-r from-orange-100 to-orange-200 rounded-lg flex items-center justify-center mr-3 group-hover:from-orange-200 group-hover:to-orange-300 transition-colors duration-200">
                                            <svg class="w-4 h-4 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                            {{ $transaction->quantity }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-slate-200 last:border-r-0">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-r from-indigo-100 to-indigo-200 rounded-lg flex items-center justify-center mr-3 group-hover:from-indigo-200 group-hover:to-indigo-300 transition-colors duration-200">
                                            <svg class="w-4 h-4 text-indigo-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-slate-900">{{ $transaction->created_at->format('d-m-Y') }}</span>
                                            <div class="text-xs text-slate-500">{{ $transaction->created_at->format('H:i:s') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-slate-200 last:border-r-0">
                                    <div class="flex items-center">
                                        @if($transaction->type === 'in')
                                            <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                                                    </path>
                                                </svg>
                                            </div>
                                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-green-100 text-green-800 shadow-sm">
                                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                                Masuk
                                            </span>
                                        @elseif($transaction->type === 'out')
                                            <div class="w-8 h-8 bg-gradient-to-r from-red-500 to-red-600 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M20 12H4m16 0l-4-4m4 4l-4 4">
                                                    </path>
                                                </svg>
                                            </div>
                                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-red-100 text-red-800 shadow-sm">
                                                <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                                Keluar
                                            </span>
                                        @else
                                            <div class="w-8 h-8 bg-gradient-to-r from-gray-400 to-gray-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-500 italic shadow-sm">
                                                <div class="w-2 h-2 bg-gray-400 rounded-full mr-2"></div>
                                                Tidak Diketahui
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-r border-slate-200 last:border-r-0">
    @if($transaction->status === 'confirmed')
        <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-bold bg-green-100 text-green-700">
            <svg class="w-3 h-3 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15H6v-2.414l8.293-8.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Terkonfirmasi
        </span>
    @else
        <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-bold bg-yellow-100 text-yellow-700">
            <svg class="w-3 h-3 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm.707 11.707a1 1 0 01-1.414 0L7 11.414l1.414-1.414L10 10.586l4.293-4.293 1.414 1.414L10.707 13.707z"/>
            </svg>
            Pending
        </span>
    @endif
</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="bg-gradient-to-r from-slate-50 to-slate-100 px-6 py-4 border-t border-slate-200">
                <div class="flex items-center justify-between text-sm text-slate-600">
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span>Transaksi Masuk</span>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                {{ $transactions->where('type', 'in')->count() }}
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <span>Transaksi Keluar</span>
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                                {{ $transactions->where('type', 'out')->count() }}
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                            <span>Tidak Diketahui</span>
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs font-medium">
                                {{ $transactions->whereNotIn('type', ['in', 'out'])->count() }}
                            </span>
                        </div>
                    </div>
                    <div class="text-slate-500">
                        Terakhir diperbarui: {{ now()->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection