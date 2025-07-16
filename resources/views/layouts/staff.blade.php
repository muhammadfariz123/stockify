<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Staff Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        .sidebar-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .menu-item {
            transition: all 0.3s ease;
            border-radius: 12px;
            margin-bottom: 8px;
        }
        
        .menu-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(8px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .menu-item.active {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
            padding-left: 2rem;
        }
        
        .submenu.active {
            max-height: 200px;
            padding-top: 0.5rem;
        }
        
        .submenu-item {
            transition: all 0.3s ease;
            border-radius: 8px;
            margin-bottom: 4px;
            padding: 8px 12px;
        }
        
        .submenu-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(4px);
        }
        
        .submenu-item.active {
            background: rgba(255, 255, 255, 0.15);
        }
        
        .dropdown-arrow {
            transition: transform 0.3s ease;
        }
        
        .dropdown-arrow.rotated {
            transform: rotate(180deg);
        }
        
        .ripple-btn {
            position: relative;
            overflow: hidden;
        }
        
        .ripple-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .ripple-btn:active::after {
            width: 300px;
            height: 300px;
        }
        
        .floating-shadow {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .hamburger-line {
            transition: all 0.3s ease;
        }
        
        .hamburger-open .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }
        
        .hamburger-open .hamburger-line:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger-open .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }
        
        .slide-in {
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        .content-area {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        .mobile-overlay {
            backdrop-filter: blur(5px);
            background: rgba(0, 0, 0, 0.6);
        }
        
        .logo-pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        .menu-icon {
            transition: all 0.3s ease;
        }
        
        .menu-item:hover .menu-icon {
            transform: scale(1.1);
        }
        
        .notification-dot {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-6px);
            }
            60% {
                transform: translateY(-3px);
            }
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex h-screen bg-gray-100">
        <div class="sidebar-gradient text-white w-64 p-6 flex flex-col justify-between md:block hidden floating-shadow">
            <div>
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-3 logo-pulse">
                        <i class="fas fa-warehouse text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">Staff Gudang</h2>
                        <p class="text-xs text-white text-opacity-70">Warehouse Management</p>
                    </div>
                </div>
                
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('staff.dashboard') }}" class="menu-item active flex items-center space-x-3 px-4 py-3 text-white hover:text-white">
                                <div class="menu-icon w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center relative">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                                <span class="font-medium">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <div class="menu-item flex items-center justify-between px-4 py-3 text-white hover:text-white cursor-pointer" onclick="toggleSubmenu('stok-submenu')">
                                <div class="flex items-center space-x-3">
                                    <div class="menu-icon w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center relative">
                                        <i class="fas fa-boxes"></i>
                                        <span class="notification-dot"></span>
                                    </div>
                                    <span class="font-medium">Stok</span>
                                </div>
                                <i class="fas fa-chevron-down dropdown-arrow" id="stok-arrow"></i>
                            </div>
                            <div class="submenu" id="stok-submenu">
                                <a href="{{ route('staff.stock.in') }}" class="submenu-item flex items-center space-x-2 text-white hover:text-white block">
                                    <i class="fas fa-truck-loading text-sm"></i>
                                    <span class="text-sm">Konfirmasi Barang Masuk</span>
                                </a>
                                <a href="{{ route('staff.stock.out') }}" class="submenu-item flex items-center space-x-2 text-white hover:text-white block">
                                    <i class="fas fa-shipping-fast text-sm"></i>
                                    <span class="text-sm">Konfirmasi Barang Keluar</span>
                                </a>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('staff.products.index') }}" class="menu-item flex items-center space-x-3 px-4 py-3 text-white hover:text-white">
                                <div class="menu-icon w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center relative">
                                    <i class="fas fa-cube"></i>
                                </div>
                                <span class="font-medium">Produk</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Logout Section -->
            <div class="mt-8">
                <div class="glass-effect rounded-xl p-4 mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium text-sm">Staff Gudang</p>
                            <p class="text-xs text-white text-opacity-70">Online</p>
                        </div>
                    </div>
                </div>
                
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-4 text-white hover:text-white hover:bg-gradient-to-r hover:from-red-500 hover:to-red-600 px-4 py-4 rounded-xl transition-all duration-300 ease-in-out group transform hover:scale-[1.02] hover:shadow-lg active:bg-red-700 active:scale-95 ripple-btn relative overflow-hidden">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                            <i class="fas fa-sign-out-alt text-white"></i>
                        </div>
                        <div class="text-left">
                            <span class="font-semibold text-base">Logout</span>
                            <p class="text-red-200 text-xs">Sign out securely</p>
                        </div>
                    </button>
                </form>
            </div>
        </div>

        <!-- Content Area -->
        <div class="flex-1 content-area overflow-y-auto">
            <div class="p-6">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar (Hamburger Menu) -->
    <div class="md:hidden fixed inset-0 mobile-overlay z-50 hidden fade-in" id="mobile-sidebar">
        <div class="w-64 sidebar-gradient text-white p-6 h-full slide-in floating-shadow">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-warehouse text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold">Staff Gudang</h2>
                        <p class="text-xs text-white text-opacity-70">Warehouse</p>
                    </div>
                </div>
                <button id="close-sidebar" class="text-white hover:text-red-300 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('staff.dashboard') }}" class="menu-item active flex items-center space-x-3 px-4 py-3 text-white hover:text-white">
                            <div class="menu-icon w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <div class="menu-item flex items-center justify-between px-4 py-3 text-white hover:text-white cursor-pointer" onclick="toggleSubmenu('mobile-stok-submenu')">
                            <div class="flex items-center space-x-3">
                                <div class="menu-icon w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center relative">
                                    <i class="fas fa-boxes"></i>
                                    <span class="notification-dot"></span>
                                </div>
                                <span class="font-medium">Stok</span>
                            </div>
                            <i class="fas fa-chevron-down dropdown-arrow" id="mobile-stok-arrow"></i>
                        </div>
                        <div class="submenu" id="mobile-stok-submenu">
                            <a href="{{ route('staff.stock.in') }}" class="submenu-item flex items-center space-x-2 text-white hover:text-white block">
                                <i class="fas fa-truck-loading text-sm"></i>
                                <span class="text-sm">Konfirmasi Barang Masuk</span>
                            </a>
                            <a href="{{ route('staff.stock.out') }}" class="submenu-item flex items-center space-x-2 text-white hover:text-white block">
                                <i class="fas fa-shipping-fast text-sm"></i>
                                <span class="text-sm">Konfirmasi Barang Keluar</span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('staff.products.index') }}" class="menu-item flex items-center space-x-3 px-4 py-3 text-white hover:text-white">
                            <div class="menu-icon w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center relative">
                                <i class="fas fa-cube"></i>
                            </div>
                            <span class="font-medium">Produk</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Logout Section -->
            <div class="mt-8">
                <div class="glass-effect rounded-xl p-4 mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium text-sm">Staff Gudang</p>
                            <p class="text-xs text-white text-opacity-70">Online</p>
                        </div>
                    </div>
                </div>
                
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-4 text-white hover:text-white hover:bg-gradient-to-r hover:from-red-500 hover:to-red-600 px-4 py-4 rounded-xl transition-all duration-300 ease-in-out group transform hover:scale-[1.02] hover:shadow-lg active:bg-red-700 active:scale-95 ripple-btn relative overflow-hidden">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                            <i class="fas fa-sign-out-alt text-white"></i>
                        </div>
                        <div class="text-left">
                            <span class="font-semibold text-base">Logout</span>
                            <p class="text-red-200 text-xs">Sign out securely</p>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Button to open mobile sidebar -->
    <button id="sidebar-toggle" class="md:hidden p-3 fixed top-4 left-4 z-50 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
        <div class="hamburger-container">
            <div class="hamburger-line w-6 h-0.5 bg-white mb-1"></div>
            <div class="hamburger-line w-6 h-0.5 bg-white mb-1"></div>
            <div class="hamburger-line w-6 h-0.5 bg-white"></div>
        </div>
    </button>

    <!-- JavaScript for mobile sidebar toggle and submenu -->
    <script>
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        const hamburgerContainer = document.querySelector('.hamburger-container');

        sidebarToggle.addEventListener('click', () => {
            mobileSidebar.classList.toggle('hidden');
            hamburgerContainer.classList.toggle('hamburger-open');
        });

        closeSidebar.addEventListener('click', () => {
            mobileSidebar.classList.add('hidden');
            hamburgerContainer.classList.remove('hamburger-open');
        });

        // Close sidebar when clicked outside
        mobileSidebar.addEventListener('click', (e) => {
            if (e.target === mobileSidebar) {
                mobileSidebar.classList.add('hidden');
                hamburgerContainer.classList.remove('hamburger-open');
            }
        });

        // Function to toggle submenu
        function toggleSubmenu(submenuId) {
            const submenu = document.getElementById(submenuId);
            const arrow = document.getElementById(submenuId.replace('-submenu', '-arrow'));
            
            submenu.classList.toggle('active');
            arrow.classList.toggle('rotated');
        }

        // Add smooth scrolling for better UX
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>