@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">Dashboard Admin</h1>
                    <p class="text-gray-600">Selamat datang kembali! Berikut adalah ringkasan aktivitas hari ini.</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-white p-3 rounded-full shadow-lg">
                        <i class="fas fa-bell text-indigo-600 text-xl"></i>
                    </div>
                    <div class="bg-white p-3 rounded-full shadow-lg">
                        <i class="fas fa-user-circle text-indigo-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Products Card -->
            <div
                class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-indigo-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-3 rounded-xl">
                        <i class="fas fa-boxes text-white text-xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-gray-800">{{ $productsCount }}</p>
                        <p class="text-sm text-gray-500">Produk</p>
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Produk</h3>
                    <div class="flex items-center text-green-600">
                        <i class="fas fa-arrow-up text-xs mr-1"></i>
                        <span class="text-sm font-medium">Stabil</span>
                    </div>
                </div>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                </div>
            </div>

            <!-- Incoming Transactions Card -->
            <div
                class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-green-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-3 rounded-xl">
                        <i class="fas fa-arrow-down text-white text-xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-gray-800">{{ $incomingTransactions }}</p>
                        <p class="text-sm text-gray-500">Transaksi</p>
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Transaksi Masuk</h3>
                    <div class="flex items-center text-green-600">
                        <i class="fas fa-arrow-up text-xs mr-1"></i>
                        <span class="text-sm font-medium">+12% dari minggu lalu</span>
                    </div>
                </div>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                </div>
            </div>

            <!-- Outgoing Transactions Card -->
            <div
                class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-red-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-r from-red-500 to-pink-600 p-3 rounded-xl">
                        <i class="fas fa-arrow-up text-white text-xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-gray-800">{{ $outgoingTransactions }}</p>
                        <p class="text-sm text-gray-500">Transaksi</p>
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Transaksi Keluar</h3>
                    <div class="flex items-center text-red-600">
                        <i class="fas fa-arrow-down text-xs mr-1"></i>
                        <span class="text-sm font-medium">-5% dari minggu lalu</span>
                    </div>
                </div>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-red-500 to-pink-600 rounded-2xl opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="bg-white rounded-2xl p-6 shadow-lg mb-8 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Grafik Stok Barang</h3>
                    <p class="text-gray-600">Visualisasi data stok produk dalam gudang</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-2 rounded-lg">
                        <i class="fas fa-chart-bar text-white"></i>
                    </div>
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-indigo-500 rounded-full"></div>
                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                        <div class="w-2 h-2 bg-pink-500 rounded-full"></div>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-4">
                <canvas id="stockChart" class="w-full h-80"></canvas>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Aktivitas Pengguna Terbaru</h3>
                    <p class="text-gray-600">Daftar pengguna yang baru saja bergabung</p>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-2 rounded-lg">
                    <i class="fas fa-users text-white"></i>
                </div>
            </div>

            <div class="space-y-4">
                @foreach ($latestUsers as $user)
                    <div
                        class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl hover:shadow-md transition-all duration-300 border border-gray-100">
                        <div class="flex items-center space-x-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $user->name }}</h4>
                                <p class="text-sm text-gray-500">Pengguna baru</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-600">{{ $user->created_at->diffForHumans() }}</p>
                                <p class="text-xs text-gray-500">Bergabung</p>
                            </div>
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($latestUsers->isEmpty())
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-gray-400 text-xl"></i>
                    </div>
                    <p class="text-gray-500">Belum ada aktivitas pengguna terbaru</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Ambil data produk yang sudah dikirim dari Controller
        const products = @json($products);  // Mengambil data produk dari controller

        const labels = products.map(product => product.name);  // Nama produk
        const data = products.map(product => product.stock);  // Stok produk

        // Membuat chart
        const ctx = document.getElementById('stockChart').getContext('2d');
        const stockChart = new Chart(ctx, {
            type: 'bar',  // Jenis grafik (bar chart)
            data: {
                labels: labels,  // Label berdasarkan nama produk
                datasets: [{
                    label: 'Stok Produk',
                    data: data,  // Data stok produk
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',  // Warna latar belakang bar
                    borderColor: 'rgba(75, 192, 192, 1)',  // Warna border bar
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true  // Mulai sumbu Y dari 0
                    }
                }
            }
        });
    </script>
@endpush

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    * {
        font-family: 'Inter', sans-serif;
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: .5;
        }
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>