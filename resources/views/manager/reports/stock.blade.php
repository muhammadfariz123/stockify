@extends('layouts.manager')

@section('content')
    <div class="container mx-auto p-6 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <!-- Header Section -->
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 mb-8 shadow-lg border border-white/20">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-3 rounded-xl mr-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <span class="bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                    Laporan Stok
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
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-slate-700">Data Stok Produk</h2>
                    </div>
                    <div class="text-sm text-slate-500">
                        Total: {{ count($products) }} produk
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
                                    <span>ID Produk</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-r border-slate-300 last:border-r-0">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span>Nama Produk</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider border-r border-slate-300 last:border-r-0">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                                    <span>Stok</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @foreach ($products as $product)
                            <tr class="hover:bg-slate-50 transition-colors duration-200 group">
                                <td class="px-6 py-4 whitespace-nowrap border-r border-slate-200 last:border-r-0">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-r from-blue-100 to-blue-200 rounded-lg flex items-center justify-center mr-3 group-hover:from-blue-200 group-hover:to-blue-300 transition-colors duration-200">
                                            <span class="text-xs font-bold text-blue-700">#</span>
                                        </div>
                                        <span class="text-sm font-medium text-slate-900">{{ $product->id }}</span>
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
                                        <span class="text-sm font-medium text-slate-900">{{ $product->name }}</span>
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
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                            @if($product->stock < 10) bg-red-100 text-red-800 
                                            @elseif($product->stock < 50) bg-yellow-100 text-yellow-800 
                                            @else bg-green-100 text-green-800 @endif">
                                            {{ $product->stock }}
                                            @if($product->stock < 10)
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                                                    </path>
                                                </svg>
                                            @endif
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection