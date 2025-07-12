<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajer Gudang Dashboard - Stockify</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-inter">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-emerald-800 to-emerald-900 shadow-xl flex flex-col">
            <!-- Logo Section -->
            <div class="p-6 border-b border-emerald-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <i class="fas fa-boxes text-emerald-800 text-lg"></i>
                    </div>
                    <h2 class="text-white text-xl font-bold tracking-wide">Stockify</h2>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="p-4 space-y-2 flex-1">
                <!-- Dashboard Menu -->
                <a href="{{ route('manager.dashboard') }}"
                    class="flex items-center space-x-3 text-emerald-100 hover:text-white hover:bg-emerald-700 px-4 py-3 rounded-lg transition-all duration-200 group">
                    <i class="fas fa-chart-line w-5 text-center group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <!-- Produk Menu -->
                <div>
                    <div class="font-semibold text-emerald-100 mt-4">📦 Produk</div>
                    <a href="{{ route('manager.products.index') }}"
                        class="block py-1 px-3 text-emerald-100 hover:text-white hover:bg-emerald-700">Daftar Produk</a>
                </div>

                <!-- Stok Menu -->
                <div>
                    <div class="font-semibold text-emerald-100 mt-4">📦 Stok</div>
                    <a href="{{ route('manager.transactions.in') }}"
                        class="block py-1 px-3 text-emerald-100 hover:text-white hover:bg-emerald-700">Barang Masuk</a>
                    <a href="{{ route('manager.transactions.out') }}"
                        class="block py-1 px-3 text-emerald-100 hover:text-white hover:bg-emerald-700">Barang Keluar</a>
                    <a href="{{ route('manager.stockopname.index') }}"
                        class="block py-1 px-3 text-emerald-100 hover:text-white hover:bg-emerald-700">Stock Opname</a>
                </div>

                <!-- Supplier Menu -->
                <a href="{{ route('manager.suppliers.index') }}"
                    class="block py-2 px-3 text-emerald-100 hover:text-white hover:bg-emerald-700">Supplier</a>

                <!-- Laporan Menu -->
                <div>
                    <div class="font-semibold text-emerald-100 mt-4">📦 Laporan</div>
                    <a href="{{ route('manager.reports.stock') }}"
                        class="block py-1 px-3 text-emerald-100 hover:text-white hover:bg-emerald-700">Laporan Stok</a>
                    <a href="{{ route('manager.reports.transactions') }}"
                        class="block py-1 px-3 text-emerald-100 hover:text-white hover:bg-emerald-700">Laporan
                        Transaksi</a>
                </div>
            </nav>

            <!-- User Profile & Logout Section -->
            <div class="p-4 border-t border-emerald-700">
                <!-- User Profile -->
                <div class="flex items-center space-x-3 px-4 py-3 mb-3">
                    <div class="w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    <div class="text-sm">
                        <p class="font-medium text-white">Manager</p>
                        <p class="text-emerald-200 text-xs">Gudang Utama</p>
                    </div>
                </div>

                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center space-x-3 text-emerald-100 hover:text-white hover:bg-red-600 px-4 py-3 rounded-lg transition-all duration-200 group">
                        <i class="fas fa-sign-out-alt w-5 text-center group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Top Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">Dashboard Manajer</h1>
                        <p class="text-gray-600 text-sm mt-1">Kelola inventori dan stok gudang dengan mudah</p>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        .font-inter {
            font-family: 'Inter', sans-serif;
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

        /* Smooth transitions */
        * {
            transition: all 0.2s ease-in-out;
        }

        /* Active link styling */
        nav a.active {
            background-color: rgba(16, 185, 129, 0.2);
            color: white;
            border-left: 4px solid #10b981;
        }
    </style>
</body>

</html>