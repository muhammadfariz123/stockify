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
        <div class="w-64 bg-gradient-to-b from-[#00712D] to-[#005c1e] shadow-xl flex flex-col">
            <!-- Logo Section -->
            <div class="p-6 border-b border-[#005c1e]">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <i class="fas fa-boxes text-[#00712D] text-lg"></i>
                    </div>
                    <h2 class="text-white text-xl font-bold tracking-wide">Stockify</h2>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="p-4 space-y-2 flex-1">
                <!-- Dashboard Menu -->
                <a href="{{ route('manager.dashboard') }}"
                    class="flex items-center space-x-3 text-white hover:text-[#00712D] hover:bg-white px-4 py-3 rounded-lg transition-all duration-300 ease-in-out group transform hover:scale-105 hover:shadow-lg active:bg-[#005c1e] active:text-white">
                    <i class="fas fa-chart-line w-5 text-center group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <!-- Produk Menu -->
                <div>
                    <div class="font-semibold text-white mt-4">📦 Produk</div>
                    <a href="{{ route('manager.products.index') }}"
                        class="block py-1 px-3 text-white hover:text-[#00712D] hover:bg-white rounded-md transition-all duration-300 ease-in-out">Daftar Produk</a>
                </div>

                <!-- Stok Menu -->
                <div>
                    <div class="font-semibold text-white mt-4">📦 Stok</div>
                    <a href="{{ route('manager.transactions.in') }}"
                        class="block py-1 px-3 text-white hover:text-[#00712D] hover:bg-white rounded-md transition-all duration-300 ease-in-out">Barang Masuk</a>
                    <a href="{{ route('manager.transactions.out') }}"
                        class="block py-1 px-3 text-white hover:text-[#00712D] hover:bg-white rounded-md transition-all duration-300 ease-in-out">Barang Keluar</a>
                    <a href="{{ route('manager.stockopname.index') }}"
                        class="block py-1 px-3 text-white hover:text-[#00712D] hover:bg-white rounded-md transition-all duration-300 ease-in-out">Stock Opname</a>
                </div>

                <!-- Supplier Menu -->
                <a href="{{ route('manager.suppliers.index') }}"
                    class="block py-2 px-3 text-white hover:text-[#00712D] hover:bg-white rounded-md transition-all duration-300 ease-in-out">Supplier</a>

                <!-- Laporan Menu -->
                <div>
                    <div class="font-semibold text-white mt-4">📦 Laporan</div>
                    <a href="{{ route('manager.reports.stock') }}"
                        class="block py-1 px-3 text-white hover:text-[#00712D] hover:bg-white rounded-md transition-all duration-300 ease-in-out">Laporan Stok</a>
                    <a href="{{ route('manager.reports.transactions') }}"
                        class="block py-1 px-3 text-white hover:text-[#00712D] hover:bg-white rounded-md transition-all duration-300 ease-in-out">Laporan Transaksi</a>
                </div>
            </nav>

            <!-- User Profile & Logout Section -->
            <div class="p-4 border-t border-[#005c1e]">
                <!-- User Profile -->
                <div class="flex items-center space-x-3 px-4 py-3 mb-3">
                    <div class="w-8 h-8 bg-[#00712D] rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    <div class="text-sm">
                        <p class="font-medium text-white">Manager</p>
                        <p class="text-[#00b88c] text-xs">Gudang Utama</p>
                    </div>
                </div>

                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center space-x-3 text-white hover:text-[#212121] hover:bg-red-600 px-4 py-3 rounded-md transition-all duration-300 ease-in-out group transform hover:scale-105 hover:shadow-lg active:bg-[#e31b23] active:text-white">
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
                        <h1 class="text-2xl font-semibold text-[#00712D]">Dashboard Manajer</h1>
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
            transition: all 0.3s ease-in-out;
        }

        /* Active link styling */
        nav a.active {
            background-color: rgba(0, 113, 45, 0.2);
            color: white;
            border-left: 4px solid #00712D;
        }

        /* Sidebar gradient */
        .sidebar-gradient {
            background: linear-gradient(180deg, #00712D 0%, #005c1e 100%);
        }

        /* Hover Effects */
        a:hover, button:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 113, 45, 0.2);
        }

        /* Active state on buttons and links */
        a:active, button:active {
            transform: scale(0.98);
            box-shadow: none;
            background-color: rgba(0, 113, 45, 0.3);
        }

        /* Rounded corners for all menu items */
        .rounded-md {
            border-radius: 8px;
        }

        /* Specific color for headers */
        h1, h2 {
            color: #00712D;
        }

        .text-emerald-100 {
            color: #00712D;
        }
    </style>
</body>

</html>
