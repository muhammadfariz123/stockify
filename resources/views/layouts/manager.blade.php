<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajer Gudang Dashboard - Stockify</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggles = document.querySelectorAll("[data-toggle]");
            toggles.forEach(toggle => {
                toggle.addEventListener("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const target = document.querySelector(this.dataset.toggle);
                    const icon = this.querySelector('.fa-chevron-down');
                    if (target && icon) {
                        target.classList.toggle("hidden");
                        icon.classList.toggle("rotate-180");
                    }
                });
            });

            const sidebarToggle = document.getElementById("sidebarToggle");
            const mobileToggle = document.getElementById("mobileSidebarToggle");
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");

            function toggleSidebar() {
                sidebar.classList.toggle("-translate-x-full");
                overlay.classList.toggle("hidden");
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener("click", toggleSidebar);
            }

            if (mobileToggle) {
                mobileToggle.addEventListener("click", toggleSidebar);
            }

            if (overlay) {
                overlay.addEventListener("click", () => {
                    sidebar.classList.add("-translate-x-full");
                    overlay.classList.add("hidden");
                });
            }

            // Close sidebar when clicking on menu items on mobile
            const menuLinks = document.querySelectorAll('#sidebar a');
            menuLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 768) {
                        sidebar.classList.add("-translate-x-full");
                        overlay.classList.add("hidden");
                    }
                });
            });

            // Add ripple effect to buttons
            const rippleButtons = document.querySelectorAll('.ripple-btn');
            rippleButtons.forEach(btn => {
                btn.addEventListener('click', function (e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Handle window resize
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove("-translate-x-full");
                    overlay.classList.add("hidden");
                } else {
                    sidebar.classList.add("-translate-x-full");
                    overlay.classList.add("hidden");
                }
            });
        });
    </script>
</head>

<body class="bg-gradient-to-br from-slate-50 to-gray-100 font-inter h-screen overflow-hidden">
    <!-- Mobile Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden hidden"></div>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar"
            class="fixed lg:relative z-30 w-full sm:w-80 md:w-72 lg:w-72 xl:w-80 bg-gradient-to-br from-emerald-800 via-emerald-700 to-emerald-900 shadow-2xl flex flex-col transform transition-all duration-300 ease-in-out lg:translate-x-0 -translate-x-full backdrop-blur-lg h-screen">

            <!-- Decorative Elements -->
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-white/10 to-transparent rounded-full -translate-y-16 translate-x-16">
            </div>
            <div
                class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-white/5 to-transparent rounded-full translate-y-12 -translate-x-12">
            </div>

            <!-- Logo Section -->
            <div
                class="p-4 sm:p-6 border-b border-emerald-600/30 flex justify-between items-center relative flex-shrink-0">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-white to-emerald-50 rounded-xl flex items-center justify-center shadow-lg transform hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-boxes text-emerald-700 text-lg sm:text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-white text-xl sm:text-2xl font-bold tracking-wide">Stockify</h2>
                        <p class="text-emerald-200 text-xs font-medium">Warehouse Management</p>
                    </div>
                </div>
                <!-- Mobile Close Button -->
                <button id="sidebarToggle"
                    class="lg:hidden text-white text-xl focus:outline-none hover:bg-white/10 rounded-lg p-2 transition-all touch-manipulation">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Navigation Menu -->
            <nav
                class="p-3 sm:p-4 space-y-2 sm:space-y-3 flex-1 overflow-y-auto scrollbar-thin scrollbar-thumb-emerald-600 scrollbar-track-emerald-800">
                <!-- Dashboard Menu -->
                <a href="{{ route('manager.dashboard') }}"
                    class="flex items-center space-x-3 sm:space-x-4 text-white hover:text-emerald-100 hover:bg-gradient-to-r hover:from-white/10 hover:to-white/5 px-3 sm:px-4 py-3 sm:py-4 rounded-xl transition-all duration-300 ease-in-out group transform hover:scale-[1.02] hover:shadow-lg active:bg-emerald-600/30 active:scale-95 ripple-btn relative overflow-hidden touch-manipulation">
                    <div
                        class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg flex-shrink-0">
                        <i class="fas fa-chart-line text-white text-sm sm:text-base"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="font-semibold text-sm sm:text-base block truncate">Dashboard</span>
                        <p class="text-emerald-200 text-xs hidden sm:block">Overview & Analytics</p>
                    </div>
                </a>

                <!-- Produk Menu -->
                <div class="space-y-2">
                    <div class="font-semibold text-white cursor-pointer flex justify-between items-center px-3 sm:px-4 py-3 hover:bg-white/10 rounded-xl transition-all duration-300 group touch-manipulation"
                        data-toggle="#produkSubmenu">
                        <div class="flex items-center space-x-3 sm:space-x-4 min-w-0 flex-1">
                            <div
                                class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg flex-shrink-0">
                                <i class="fas fa-cube text-white text-sm sm:text-base"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-sm sm:text-base block truncate">Produk</span>
                                <p class="text-emerald-200 text-xs hidden sm:block">Product Management</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-down text-sm transition-transform duration-300 flex-shrink-0 ml-2"></i>
                    </div>
                    <div id="produkSubmenu" class="ml-4 sm:ml-6 space-y-2 hidden">
                        <a href="{{ route('manager.products.index') }}"
                            class="flex items-center space-x-3 py-2 sm:py-3 px-3 sm:px-4 text-emerald-200 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 ease-in-out group touch-manipulation">
                            <div
                                class="w-2 h-2 bg-emerald-400 rounded-full group-hover:scale-150 transition-transform flex-shrink-0">
                            </div>
                            <span class="text-sm font-medium truncate">Daftar Produk</span>
                        </a>
                        <a href="{{ route('manager.categories.index') }}"
                            class="flex items-center space-x-3 py-2 sm:py-3 px-3 sm:px-4 text-emerald-200 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 ease-in-out group touch-manipulation">
                            <div
                                class="w-2 h-2 bg-emerald-400 rounded-full group-hover:scale-150 transition-transform flex-shrink-0">
                            </div>
                            <span class="text-sm font-medium truncate">Kategori Produk</span>
                        </a>
                        <a href="{{ route('manager.attributes.index') }}"
                            class="flex items-center space-x-3 py-2 sm:py-3 px-3 sm:px-4 text-emerald-200 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 ease-in-out group touch-manipulation">
                            <div
                                class="w-2 h-2 bg-emerald-400 rounded-full group-hover:scale-150 transition-transform flex-shrink-0">
                            </div>
                            <span class="text-sm font-medium truncate">Atribut Produk</span>
                        </a>
                    </div>
                </div>

                <!-- Stok Menu -->
                <div class="space-y-2">
                    <div class="font-semibold text-white cursor-pointer flex justify-between items-center px-3 sm:px-4 py-3 hover:bg-white/10 rounded-xl transition-all duration-300 group touch-manipulation"
                        data-toggle="#stokSubmenu">
                        <div class="flex items-center space-x-3 sm:space-x-4 min-w-0 flex-1">
                            <div
                                class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg flex-shrink-0">
                                <i class="fas fa-warehouse text-white text-sm sm:text-base"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-sm sm:text-base block truncate">Stok</span>
                                <p class="text-emerald-200 text-xs hidden sm:block">Stock Management</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-down text-sm transition-transform duration-300 flex-shrink-0 ml-2"></i>
                    </div>
                    <div id="stokSubmenu" class="ml-4 sm:ml-6 space-y-2 hidden">
                        <a href="{{ route('manager.transactions.in') }}"
                            class="flex items-center space-x-3 py-2 sm:py-3 px-3 sm:px-4 text-emerald-200 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 ease-in-out group touch-manipulation">
                            <div
                                class="w-2 h-2 bg-green-400 rounded-full group-hover:scale-150 transition-transform flex-shrink-0">
                            </div>
                            <span class="text-sm font-medium truncate">Barang Masuk</span>
                        </a>
                        <a href="{{ route('manager.transactions.out') }}"
                            class="flex items-center space-x-3 py-2 sm:py-3 px-3 sm:px-4 text-emerald-200 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 ease-in-out group touch-manipulation">
                            <div
                                class="w-2 h-2 bg-red-400 rounded-full group-hover:scale-150 transition-transform flex-shrink-0">
                            </div>
                            <span class="text-sm font-medium truncate">Barang Keluar</span>
                        </a>
                        <a href="{{ route('manager.stockopname.index') }}"
                            class="flex items-center space-x-3 py-2 sm:py-3 px-3 sm:px-4 text-emerald-200 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 ease-in-out group touch-manipulation">
                            <div
                                class="w-2 h-2 bg-yellow-400 rounded-full group-hover:scale-150 transition-transform flex-shrink-0">
                            </div>
                            <span class="text-sm font-medium truncate">Stock Opname</span>
                        </a>
                        <a href="{{ route('manager.minimum_stock.index') }}"
                            class="flex items-center space-x-3 py-2 sm:py-3 px-3 sm:px-4 text-emerald-200 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 ease-in-out group touch-manipulation">
                            <div
                                class="w-2 h-2 bg-amber-400 rounded-full group-hover:scale-150 transition-transform flex-shrink-0">
                            </div>
                            <span class="text-sm font-medium truncate">Stok Minimum</span>
                        </a>

                    </div>
                </div>

                <!-- Supplier Menu -->
                <a href="{{ route('manager.suppliers.index') }}"
                    class="flex items-center space-x-3 sm:space-x-4 text-white hover:text-emerald-100 hover:bg-gradient-to-r hover:from-white/10 hover:to-white/5 px-3 sm:px-4 py-3 sm:py-4 rounded-xl transition-all duration-300 ease-in-out group transform hover:scale-[1.02] hover:shadow-lg active:bg-emerald-600/30 active:scale-95 ripple-btn relative overflow-hidden touch-manipulation">
                    <div
                        class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg flex-shrink-0">
                        <i class="fas fa-truck text-white text-sm sm:text-base"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="font-semibold text-sm sm:text-base block truncate">Supplier</span>
                        <p class="text-emerald-200 text-xs hidden sm:block">Vendor Management</p>
                    </div>
                </a>

                <!-- Laporan Menu -->
                <div class="space-y-2">
                    <div class="font-semibold text-white cursor-pointer flex justify-between items-center px-3 sm:px-4 py-3 hover:bg-white/10 rounded-xl transition-all duration-300 group touch-manipulation"
                        data-toggle="#laporanSubmenu">
                        <div class="flex items-center space-x-3 sm:space-x-4 min-w-0 flex-1">
                            <div
                                class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg flex-shrink-0">
                                <i class="fas fa-chart-bar text-white text-sm sm:text-base"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-sm sm:text-base block truncate">Laporan</span>
                                <p class="text-emerald-200 text-xs hidden sm:block">Reports & Analytics</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-down text-sm transition-transform duration-300 flex-shrink-0 ml-2"></i>
                    </div>
                    <div id="laporanSubmenu" class="ml-4 sm:ml-6 space-y-2 hidden">
                        <a href="{{ route('manager.reports.stock') }}"
                            class="flex items-center space-x-3 py-2 sm:py-3 px-3 sm:px-4 text-emerald-200 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 ease-in-out group touch-manipulation">
                            <div
                                class="w-2 h-2 bg-blue-400 rounded-full group-hover:scale-150 transition-transform flex-shrink-0">
                            </div>
                            <span class="text-sm font-medium truncate">Laporan Stok</span>
                        </a>
                        <a href="{{ route('manager.reports.transactions') }}"
                            class="flex items-center space-x-3 py-2 sm:py-3 px-3 sm:px-4 text-emerald-200 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 ease-in-out group touch-manipulation">
                            <div
                                class="w-2 h-2 bg-purple-400 rounded-full group-hover:scale-150 transition-transform flex-shrink-0">
                            </div>
                            <span class="text-sm font-medium truncate">Laporan Transaksi</span>
                        </a>
                        <a href="{{ route('manager.reports.activity') }}"
                            class="flex items-center space-x-3 py-2 sm:py-3 px-3 sm:px-4 text-emerald-200 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 ease-in-out group touch-manipulation">
                            <div
                                class="w-2 h-2 bg-yellow-400 rounded-full group-hover:scale-150 transition-transform flex-shrink-0">
                            </div>
                            <span class="text-sm font-medium truncate">Laporan Aktivitas</span>
                        </a>

                    </div>
                </div>
            </nav>

            <!-- User Profile & Logout Section -->
            <div
                class="p-3 sm:p-4 border-t border-emerald-600/30 bg-gradient-to-r from-emerald-800/50 to-emerald-900/50 backdrop-blur-sm flex-shrink-0">
                <div
                    class="flex items-center space-x-3 sm:space-x-4 px-3 sm:px-4 py-3 sm:py-4 mb-3 sm:mb-4 bg-white/5 rounded-xl backdrop-blur-sm">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-emerald-400 to-emerald-500 rounded-full flex items-center justify-center shadow-lg flex-shrink-0">
                        <i class="fas fa-user text-white text-sm sm:text-lg"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="font-semibold text-white text-sm sm:text-base truncate">Manager</p>
                        <p class="text-emerald-200 text-xs sm:text-sm truncate">Gudang Utama</p>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center space-x-3 sm:space-x-4 text-white hover:text-white hover:bg-gradient-to-r hover:from-red-500 hover:to-red-600 px-3 sm:px-4 py-3 sm:py-4 rounded-xl transition-all duration-300 ease-in-out group transform hover:scale-[1.02] hover:shadow-lg active:bg-red-700 active:scale-95 ripple-btn relative overflow-hidden touch-manipulation">
                        <div
                            class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg flex-shrink-0">
                            <i class="fas fa-sign-out-alt text-white text-sm sm:text-base"></i>
                        </div>
                        <div class="min-w-0 flex-1 text-left">
                            <span class="font-semibold text-sm sm:text-base block truncate">Logout</span>
                            <p class="text-red-200 text-xs hidden sm:block">Sign out securely</p>
                        </div>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col h-screen min-w-0">
            <!-- Mobile Header -->
            <header
                class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-200/50 px-4 sm:px-6 py-3 sm:py-4 lg:hidden flex justify-between items-center sticky top-0 z-10 flex-shrink-0">
                <button id="mobileSidebarToggle"
                    class="text-emerald-700 text-xl focus:outline-none hover:bg-emerald-50 rounded-lg p-2 transition-all touch-manipulation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="flex items-center space-x-2 sm:space-x-3 min-w-0 flex-1 justify-center">
                    <div
                        class="w-6 h-6 sm:w-8 sm:h-8 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-chart-line text-white text-xs sm:text-sm"></i>
                    </div>
                    <h1 class="text-lg sm:text-xl font-bold text-emerald-800 truncate">Dashboard</h1>
                </div>
                <div class="w-10"></div> <!-- Spacer for centering -->
            </header>

            <!-- Desktop Header -->
            <header
                class="hidden lg:block bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-200/50 px-6 lg:px-8 py-4 lg:py-6 sticky top-0 z-10 flex-shrink-0">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-xl lg:text-2xl font-semibold text-[#00712D] truncate">Dashboard Manajer</h1>
                        <p class="text-gray-600 text-sm mt-1 truncate">Kelola inventori dan stok gudang dengan mudah</p>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto bg-gradient-to-br from-slate-50 to-gray-100 min-w-0">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        .font-inter {
            font-family: 'Inter', sans-serif;
        }

        /* Touch targets for better mobile interaction */
        .touch-manipulation {
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
            min-height: 44px;
            min-width: 44px;
        }

        /* Custom Scrollbar */
        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
        }

        .scrollbar-track-emerald-800::-webkit-scrollbar-track {
            background: rgba(6, 78, 59, 0.3);
            border-radius: 2px;
        }

        .scrollbar-thumb-emerald-600::-webkit-scrollbar-thumb {
            background: rgba(5, 150, 105, 0.7);
            border-radius: 2px;
        }

        .scrollbar-thumb-emerald-600::-webkit-scrollbar-thumb:hover {
            background: rgba(5, 150, 105, 0.9);
        }

        /* Ripple Effect */
        .ripple-btn {
            position: relative;
            overflow: hidden;
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-animation 0.6s ease-out;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }

        /* Smooth transitions */
        * {
            transition: all 0.3s ease-in-out;
        }

        /* Glass morphism effect */
        .glass {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Active state for navigation */
        nav a.active {
            background-color: rgba(0, 113, 45, 0.2);
            color: white;
            border-left: 4px solid #00712D;
        }

        /* Sidebar gradient */
        .sidebar-gradient {
            background: linear-gradient(180deg, #00712D 0%, #005c1e 100%);
        }

        /* Hover Effects - Reduced for mobile */
        @media (hover: hover) {

            a:hover,
            button:hover {
                transform: scale(1.05);
                box-shadow: 0 4px 12px rgba(0, 113, 45, 0.2);
            }
        }

        /* Active state on buttons and links */
        a:active,
        button:active {
            transform: scale(0.98);
            box-shadow: none;
            background-color: rgba(0, 113, 45, 0.3);
        }

        /* Rounded corners for all menu items */
        .rounded-md {
            border-radius: 8px;
        }

        /* Specific color for headers */
        h1,
        h2 {
            color: #00712D;
        }

        .text-emerald-100 {
            color: #00712D;
        }

        /* Prevent text selection on toggle elements */
        [data-toggle] {
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        /* Improved focus styles for accessibility */
        button:focus,
        a:focus {
            outline: 2px solid #00712D;
            outline-offset: 2px;
            box-shadow: 0 0 0 2px rgba(0, 113, 45, 0.2);
        }

        /* Responsive text scaling */
        @media (max-width: 375px) {
            .text-xl {
                font-size: 1.125rem;
            }

            .text-2xl {
                font-size: 1.25rem;
            }
        }

        /* Better mobile sidebar width */
        @media (max-width: 640px) {
            #sidebar {
                width: 100vw;
                max-width: 100vw;
            }
        }

        @media (min-width: 641px) and (max-width: 767px) {
            #sidebar {
                width: 320px;
                max-width: 80vw;
            }
        }

        /* Prevent horizontal scroll */
        body {
            overflow-x: hidden;
        }

        /* Ensure proper flex behavior */
        .min-w-0 {
            min-width: 0;
        }

        /* Better truncation */
        .truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</body>

</html>