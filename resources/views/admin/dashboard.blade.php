@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div class="space-y-2">
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                        Dashboard Admin
                    </h1>
                    <p class="text-gray-600 text-lg">Selamat datang kembali! Berikut adalah ringkasan aktivitas hari ini.
                    </p>
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                            <span>System Online</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <span id="currentTime"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Products Card -->
            <div
                class="group relative bg-white/80 backdrop-blur-sm rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 border border-white/50 hover:border-indigo-200/50 hover:-translate-y-1">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-600/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                </div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-6">
                        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-4 rounded-2xl shadow-lg">
                            <i class="fas fa-boxes text-white text-2xl"></i>
                        </div>
                        <div class="text-right">
                            <p class="text-4xl font-bold text-gray-800 mb-1">{{ $productsCount }}</p>
                            <p class="text-sm text-gray-500 uppercase tracking-wider">Produk</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 pt-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">Total Produk</h3>
                    </div>
                </div>
            </div>

            <!-- Transaksi Masuk -->
            <div
                class="group relative bg-white/80 backdrop-blur-sm rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 border border-white/50 hover:border-green-200/50 hover:-translate-y-1">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-emerald-600/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                </div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-6">
                        <div class="bg-gradient-to-br from-green-500 to-emerald-600 p-4 rounded-2xl shadow-lg">
                            <i class="fas fa-arrow-down text-white text-2xl"></i>
                        </div>
                        <div class="text-right">
                            <p class="text-4xl font-bold text-gray-800 mb-1">{{ $incomingTransactions }}</p>
                            <p class="text-sm text-gray-500 uppercase tracking-wider">Transaksi</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 pt-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">Transaksi Masuk</h3>
                    </div>
                </div>
            </div>

            <!-- Transaksi Keluar -->
            <div
                class="group relative bg-white/80 backdrop-blur-sm rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 border border-white/50 hover:border-red-200/50 hover:-translate-y-1">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-pink-600/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                </div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-6">
                        <div class="bg-gradient-to-br from-red-500 to-pink-600 p-4 rounded-2xl shadow-lg">
                            <i class="fas fa-arrow-up text-white text-2xl"></i>
                        </div>
                        <div class="text-right">
                            <p class="text-4xl font-bold text-gray-800 mb-1">{{ $outgoingTransactions }}</p>
                            <p class="text-sm text-gray-500 uppercase tracking-wider">Transaksi</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 pt-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">Transaksi Keluar</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 shadow-xl mb-8 border border-white/50">
            <div class="flex items-center justify-between mb-8">
                <div class="space-y-2">
                    <h3 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                        Grafik Stok Barang
                    </h3>
                    <p class="text-gray-600 text-lg">Visualisasi data stok produk dalam gudang</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="flex space-x-1">
                            <div class="w-3 h-3 bg-indigo-500 rounded-full animate-pulse"></div>
                            <div class="w-3 h-3 bg-purple-500 rounded-full animate-pulse" style="animation-delay: 0.5s">
                            </div>
                            <div class="w-3 h-3 bg-pink-500 rounded-full animate-pulse" style="animation-delay: 1s"></div>
                        </div>
                        <span class="text-sm text-gray-500 ml-2">Live Data</span>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-indigo-50/50 to-purple-50/50 rounded-2xl p-6 border border-indigo-100/50">
                <canvas id="stockChart" class="w-full h-80"></canvas>
            </div>
        </div>

        {{-- Bagian Pengguna Baru --}}
        <div class="space-y-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                    Pengguna Baru Bergabung
                </h3>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-users text-indigo-500 text-xl"></i>
                    <span class="text-sm text-gray-600">{{ $latestUsers->count() }} pengguna minggu ini</span>
                </div>
            </div>

            <div class="space-y-4">
                @foreach ($latestUsers as $index => $user)
                    <div class="group flex items-center justify-between p-6 bg-gradient-to-r from-white/70 to-blue-50/70 rounded-2xl hover:shadow-lg transition-all duration-300 border border-gray-100/50 hover:border-indigo-200/50 hover:-translate-y-1"
                        style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="flex items-center space-x-5">
                            <div class="relative">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                                    <i class="fas fa-user text-white text-lg"></i>
                                </div>
                                <div
                                    class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white">
                                </div>
                            </div>
                            <div class="space-y-1">
                                <h4 class="font-semibold text-gray-800 text-lg">{{ $user->name }}</h4>
                                <p class="text-sm text-gray-500">Pengguna baru</p>
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span class="text-xs text-green-600 font-medium">Active</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="text-right space-y-1">
                                <p class="text-sm font-medium text-gray-600">{{ $user->created_at->diffForHumans() }}</p>
                                <p class="text-xs text-gray-500">Bergabung</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                <i
                                    class="fas fa-chevron-right text-gray-400 text-sm group-hover:text-indigo-500 transition-colors duration-300"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($latestUsers->isEmpty())
                <div class="text-center py-16">
                    <div
                        class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users text-gray-400 text-3xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-600 mb-2">Belum ada aktivitas</h4>
                    <p class="text-gray-500">Pengguna baru akan muncul di sini ketika mereka bergabung</p>
                </div>
            @endif
        </div>

        <hr class="my-10 border-t border-gray-200">

        {{-- Bagian Aktivitas Terbaru --}}
        <div class="space-y-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                    Aktivitas Pengguna Terakhir
                </h3>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-tasks text-indigo-500 text-xl"></i>
                    <span class="text-sm text-gray-600">{{ $recentActivities->count() }} aktivitas terakhir</span>
                </div>
            </div>

            <div class="space-y-4">
                @foreach ($recentActivities as $index => $log)
                    <div class="group flex items-center justify-between p-6 bg-gradient-to-r from-white/70 to-blue-50/70 rounded-2xl hover:shadow-lg transition-all duration-300 border border-gray-100/50 hover:border-indigo-200/50 hover:-translate-y-1"
                        style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="flex items-center space-x-5">
                            <div class="relative">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                                    <i class="fas fa-user text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <h4 class="font-semibold text-gray-800 text-lg">
                                    {{ $log->user->name }}
                                    <span class="text-xs text-gray-500">({{ $log->role }})</span>
                                </h4>
                                <p class="text-sm text-gray-600">{{ $log->activity }}</p>
                                <p class="text-xs text-gray-500 italic">{{ $log->description }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-600">{{ $log->created_at->diffForHumans() }}</p>
                            <p class="text-xs text-gray-500">Waktu</p>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($recentActivities->isEmpty())
                <div class="text-center py-16">
                    <div
                        class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-tasks text-gray-400 text-3xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-600 mb-2">Belum ada aktivitas pengguna</h4>
                    <p class="text-gray-500">Aktivitas pengguna akan muncul di sini</p>
                </div>
            @endif
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('stockChart').getContext('2d');

            const data = {
                labels: {!! json_encode($products->pluck('name')) !!},
                datasets: [{
                    label: 'Jumlah Stok',
                    data: {!! json_encode($products->pluck('stock')) !!},
                    backgroundColor: 'rgba(99, 102, 241, 0.5)', // indigo-500
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 2,
                    borderRadius: 6
                }]
            };

            const options = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            };

            new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
        });
    </script>
@endpush


<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

    * {
        font-family: 'Inter', sans-serif;
    }

    /* Enhanced animations */
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    /* Slide in animation for user cards */
    .group {
        animation: slideInUp 0.6s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    @keyframes slideInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: rgba(241, 245, 249, 0.5);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #cbd5e1, #94a3b8);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #94a3b8, #64748b);
    }

    /* Glassmorphism effect */
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    /* Enhanced hover effects */
    .group:hover {
        transform: translateY(-4px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Floating animation */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .float-animation {
        animation: float 3s ease-in-out infinite;
    }

    /* Gradient text animation */
    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .gradient-animate {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
    }
</style>