@extends('layouts.manager')

@section('content')
    <div class="container mx-auto p-6 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <!-- Header dengan glassmorphism effect -->
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 mb-8 shadow-lg border border-white/20">
            <h1 class="text-4xl font-bold text-gray-800 flex items-center">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-3 rounded-xl mr-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                </div>
                <span class="bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                    Dashboard Manager Gudang
                </span>
            </h1>
        </div>

        <!-- Stok Menipis -->
        <a href="{{ route('manager.minimum_stock.index') }}"
            class="block group bg-white/80 backdrop-blur-sm rounded-2xl p-6 mb-8 shadow-lg border border-white/20 hover:shadow-2xl hover:scale-[1.02] transition-all duration-500 overflow-hidden relative">
            <!-- Gradient overlay untuk hover effect -->
            <div
                class="absolute inset-0 bg-gradient-to-r from-red-500/10 to-red-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
            </div>

            <div class="relative z-10">
                <div class="flex items-center mb-6">
                    <div
                        class="bg-gradient-to-r from-red-500 to-red-600 p-3 rounded-xl mr-4 shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 group-hover:text-red-700 transition-colors duration-300">
                        Stok Menipis
                    </h2>
                </div>

                <div class="space-y-4">
                    @foreach($lowStockProducts as $product)
                        <div
                            class="bg-white/90 backdrop-blur-sm rounded-xl p-4 border border-red-100 hover:border-red-200 hover:shadow-md transition-all duration-300 group/item">
                            <div class="flex items-center justify-between">
                                <span
                                    class="font-semibold text-gray-800 group-hover/item:text-red-800 transition-colors duration-300">
                                    {{ $product->name }}
                                </span>
                                <div
                                    class="bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-md">
                                    Stok: {{ $product->stock }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </a>

        <!-- Barang Masuk Hari Ini -->
        <a href="{{ route('manager.transactions.in') }}"
            class="block group bg-white/80 backdrop-blur-sm rounded-2xl p-6 mb-8 shadow-lg border border-white/20 hover:shadow-2xl hover:scale-[1.02] transition-all duration-500 overflow-hidden relative">
            <div
                class="absolute inset-0 bg-gradient-to-r from-green-500/10 to-green-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
            </div>

            <div class="relative z-10">
                <div class="flex items-center mb-6">
                    <div
                        class="bg-gradient-to-r from-green-500 to-green-600 p-3 rounded-xl mr-4 shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 group-hover:text-green-700 transition-colors duration-300">
                        Barang Masuk Hari Ini
                    </h2>
                </div>

                <div class="space-y-4">
                    @foreach($todayIn as $transaction)
                        <div
                            class="bg-white/90 backdrop-blur-sm rounded-xl p-4 border border-green-100 hover:border-green-200 hover:shadow-md transition-all duration-300 group/item">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span
                                        class="font-semibold text-gray-800 group-hover/item:text-green-800 transition-colors duration-300">
                                        {{ $transaction->product->name }}
                                    </span>
                                    <div class="text-sm text-gray-600 mt-2 flex items-center">
                                        <div class="bg-gray-100 p-1 rounded-lg mr-2">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        {{ $transaction->transaction_date }}
                                    </div>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-green-500 to-green-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-md">
                                    Jumlah: {{ $transaction->quantity }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </a>

        <!-- Barang Keluar Hari Ini -->
        <a href="{{ route('manager.transactions.out') }}"
            class="block group bg-white/80 backdrop-blur-sm rounded-2xl p-6 mb-8 shadow-lg border border-white/20 hover:shadow-2xl hover:scale-[1.02] transition-all duration-500 overflow-hidden relative">
            <div
                class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
            </div>

            <div class="relative z-10">
                <div class="flex items-center mb-6">
                    <div
                        class="bg-gradient-to-r from-blue-500 to-blue-600 p-3 rounded-xl mr-4 shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 12H4m16 0l-4-4m4 4l-4 4" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 group-hover:text-blue-700 transition-colors duration-300">
                        Barang Keluar Hari Ini
                    </h2>
                </div>

                <div class="space-y-4">
                    @foreach($todayOut as $transaction)
                        <div
                            class="bg-white/90 backdrop-blur-sm rounded-xl p-4 border border-blue-100 hover:border-blue-200 hover:shadow-md transition-all duration-300 group/item">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span
                                        class="font-semibold text-gray-800 group-hover/item:text-blue-800 transition-colors duration-300">
                                        {{ $transaction->product->name }}
                                    </span>
                                    <div class="text-sm text-gray-600 mt-2 flex items-center">
                                        <div class="bg-gray-100 p-1 rounded-lg mr-2">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        {{ $transaction->transaction_date }}
                                    </div>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-md">
                                    Jumlah: {{ $transaction->quantity }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </a>


    </div>
@endsection