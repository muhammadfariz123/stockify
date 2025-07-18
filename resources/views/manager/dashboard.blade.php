@extends('layouts.manager')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8 text-gray-800 flex items-center">
            <svg class="w-8 h-8 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                </path>
            </svg>
            Dashboard Manager Gudang
        </h1>


        <!-- Stok Menipis -->
        <div
            class="bg-gray-50 rounded-lg p-4 mb-6 border-l-4 border-red-500 text-black hover:text-white hover:translate-x-3 hover:scale-105 hover:shadow-xl transition-all duration-500">
            <h2 class="text-lg font-bold mb-3 text-red-800 flex items-center">
                <svg class="w-6 h-6 mr-2 text-red-600 group-hover:text-white" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                    </path>
                </svg>
                Stok Menipis
            </h2>
            <div class="space-y-3">
                @foreach($lowStockProducts as $product)
                    <div class="bg-white rounded-lg p-3 border border-red-200">
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-gray-800">{{ $product->name }}</span>
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">
                                Stok: {{ $product->stock }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Barang Masuk Hari Ini -->
        <div
            class="bg-gray-50 rounded-lg p-4 mb-6 border-l-4 border-green-500 text-black hover:text-white hover:translate-x-3 hover:scale-105 hover:shadow-xl transition-all duration-500">
            <h2 class="text-lg font-bold mb-3 text-green-800 flex items-center">
                <svg class="w-6 h-6 mr-2 text-green-600 group-hover:text-white" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Barang Masuk Hari Ini
            </h2>
            <div class="space-y-3">
                @foreach($todayIn as $transaction)
                    <div class="bg-white rounded-lg p-3 border border-green-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="font-medium text-gray-800">{{ $transaction->product->name }}</span>
                                <div class="text-sm text-gray-600 mt-1">
                                    <span class="inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $transaction->transaction_date }}
                                    </span>
                                </div>
                            </div>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                Jumlah: {{ $transaction->quantity }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Barang Keluar Hari Ini -->
        <div
            class="bg-gray-50 rounded-lg p-4 mb-6 border-l-4 border-blue-500 text-black hover:text-white hover:translate-x-3 hover:scale-105 hover:shadow-xl transition-all duration-500">
            <h2 class="text-lg font-bold mb-3 text-blue-800 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4m16 0l-4-4m4 4l-4 4">
                    </path>
                </svg>
                Barang Keluar Hari Ini
            </h2>
            <div class="space-y-3">
                @foreach($todayOut as $transaction)
                    <div class="bg-white rounded-lg p-3 border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="font-medium text-gray-800">{{ $transaction->product->name }}</span>
                                <div class="text-sm text-gray-600 mt-1">
                                    <span class="inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $transaction->transaction_date }}
                                    </span>
                                </div>
                            </div>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                Jumlah: {{ $transaction->quantity }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>



    </div>
@endsection