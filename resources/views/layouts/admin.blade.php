<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stockify Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        /* Sidebar Theme */
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }

        /* Hover & Active Button Effects */
        .menu-item {
            transition: all 0.2s ease-in-out;
        }

        .menu-item:hover {
            transform: translateX(4px);
            background-color: #3B82F6;
            /* Blue hover effect */
            color: white;
        }

        .submenu-item {
            transition: all 0.2s ease-in-out;
        }

        .submenu-item:hover {
            transform: translateX(2px);
            background-color: #E0F2FE;
            /* Light blue hover */
            color: white;
        }

        /* Sidebar and menu icons */
        .icon-rotate {
            transition: transform 0.3s ease;
        }

        .icon-rotate.rotated {
            transform: rotate(90deg);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.8);
        }

        .section-header {
            cursor: pointer;
            user-select: none;
        }

        .section-header:hover {
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Mobile Overlay */
        .mobile-overlay {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .shadow-custom {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .border-custom {
            border: 1px solid rgba(229, 231, 235, 0.5);
        }

        /* Logout Button */
        .logout-btn {
            transition: all 0.2s ease;
            border-radius: 9999px;
            /* Rounded corners */
        }

        .logout-btn:hover {
            background-color: #FF4D4D;
            color: white;
        }

        /* Sidebar Buttons Rounded */
        .menu-item,
        .submenu-item,
        .logout-btn {
            border-radius: 9999px;
            /* Rounded corners */
        }

        /* Add border effect to sidebar items */
        .menu-item:hover,
        .submenu-item:hover {
            border-radius: 12px;
            border: 1px solid #3B82F6;
            /* Blue border on hover */
        }

        /* Mobile Hamburger Animation */
        .hamburger-line {
            transition: all 0.3s ease-in-out;
            transform-origin: center;
        }

        .hamburger-open .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .hamburger-open .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .hamburger-open .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        /* Mobile Sidebar */
        .mobile-sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }

        .mobile-sidebar.open {
            transform: translateX(0);
        }

        /* Responsive improvements */
        @media (max-width: 1023px) {
            .sidebar-transition {
                z-index: 40;
            }
        }

        /* Modern glassmorphism effect for mobile */
        .glass-sidebar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Enhanced mobile header */
        .mobile-header {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 250, 252, 0.9));
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-slate-100 text-gray-800 min-h-screen">
    <!-- Mobile Overlay -->
    <div id="mobileOverlay" class="fixed inset-0 z-30 mobile-overlay hidden lg:hidden transition-opacity duration-300"></div>

    <!-- Mobile Header -->
    <header class="lg:hidden fixed top-0 left-0 right-0 z-20 mobile-header shadow-sm">
        <div class="flex items-center justify-between px-4 py-3">
            <!-- Hamburger Menu Button -->
            <button id="mobileMenuBtn" class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                <div class="w-6 h-6 flex flex-col justify-center items-center">
                    <div class="hamburger-line w-6 h-0.5 bg-gray-600 mb-1"></div>
                    <div class="hamburger-line w-6 h-0.5 bg-gray-600 mb-1"></div>
                    <div class="hamburger-line w-6 h-0.5 bg-gray-600"></div>
                </div>
            </button>

            <!-- Mobile Logo -->
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <i data-feather="package" class="w-4 h-4 text-white"></i>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-gray-900">Stockify</h1>
                </div>
            </div>

            <!-- Mobile User Menu -->
            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                <i data-feather="user" class="w-4 h-4 text-gray-600"></i>
            </div>
        </div>
    </header>

    <div class="flex h-screen">
        <!-- Mobile Sidebar -->
        <aside id="mobileSidebar" class="lg:hidden fixed inset-y-0 left-0 z-40 w-72 mobile-sidebar glass-sidebar flex flex-col">
            <!-- Mobile Header Inside Sidebar -->
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i data-feather="package" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">Stockify</h1>
                        <p class="text-sm text-gray-500">Admin Dashboard</p>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <nav class="flex-1 p-6 space-y-3 overflow-y-auto">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                    class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl bg-gradient-to-r from-blue-50 to-indigo-500 text-blue-700 font-medium border border-blue-100">
                    <i data-feather="home" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Produk Section -->
                <div class="space-y-2">
                    <div class="section-header flex items-center justify-between px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 rounded-lg"
                        data-section="products-mobile">
                        <div class="flex items-center gap-2">
                            <i data-feather="box" class="w-4 h-4"></i>
                            <span>Produk</span>
                        </div>
                        <i data-feather="chevron-right" class="w-4 h-4 icon-rotate"></i>
                    </div>
                    <div class="submenu space-y-1 pl-6 hidden" id="products-mobile-submenu">
                        <a href="{{ route('admin.products.index') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="list" class="w-4 h-4"></i>
                            <span>Daftar Produk</span>
                        </a>
                        <a href="{{ route('admin.categories.index') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="tag" class="w-4 h-4"></i>
                            <span>Kategori Produk</span>
                        </a>
                        <a href="{{ route('admin.attributes.index') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="sliders" class="w-4 h-4"></i>
                            <span>Atribut Produk</span>
                        </a>
                    </div>
                </div>

                <!-- Stok Section -->
                <div class="space-y-2">
                    <div class="section-header flex items-center justify-between px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 rounded-lg"
                        data-section="stock-mobile">
                        <div class="flex items-center gap-2">
                            <i data-feather="layers" class="w-4 h-4"></i>
                            <span>Stok</span>
                        </div>
                        <i data-feather="chevron-right" class="w-4 h-4 icon-rotate"></i>
                    </div>
                    <div class="submenu space-y-1 pl-6 hidden" id="stock-mobile-submenu">
                        <a href="{{ route('admin.transactions.in') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="arrow-down-circle" class="w-4 h-4 text-green-500"></i>
                            <span>Barang Masuk</span>
                        </a>
                        <a href="{{ route('admin.transactions.out') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="arrow-up-circle" class="w-4 h-4 text-red-500"></i>
                            <span>Barang Keluar</span>
                        </a>
                        <a href="{{ route('admin.stockopname.index') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="clipboard" class="w-4 h-4 text-blue-500"></i>
                            <span>Stock Opname</span>
                        </a>
                        <a href="{{ route('admin.minimum_stock.index') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="alert-triangle" class="w-4 h-4 text-amber-500"></i>
                            <span>Pengaturan Stok Minimum</span>
                        </a>
                    </div>
                </div>

                <!-- Laporan Section -->
                <div class="space-y-2">
                    <div class="section-header flex items-center justify-between px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 rounded-lg"
                        data-section="reports-mobile">
                        <div class="flex items-center gap-2">
                            <i data-feather="bar-chart-2" class="w-4 h-4"></i>
                            <span>Laporan</span>
                        </div>
                        <i data-feather="chevron-right" class="w-4 h-4 icon-rotate"></i>
                    </div>
                    <div class="submenu space-y-1 pl-6 hidden" id="reports-mobile-submenu">
                        <a href="{{ route('admin.reports.stock') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i data-feather="package" class="w-4 h-4"></i>
                            <span>Laporan Stok</span>
                        </a>
                        <a href="{{ route('admin.reports.transactions') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i data-feather="activity" class="w-4 h-4"></i>
                            <span>Laporan Transaksi</span>
                        </a>
                        <a href="{{ route('admin.reports.activity') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i data-feather="clock" class="w-4 h-4"></i>
                            <span>Laporan Aktivitas</span>
                        </a>
                    </div>
                </div>

                <!-- Supplier -->
                <a href="{{ route('admin.suppliers.index') }}"
                    class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                    <i data-feather="truck" class="w-5 h-5"></i>
                    <span>Supplier</span>
                </a>

                <!-- Pengguna -->
                <a href="{{ route('admin.users.index') }}"
                    class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                    <i data-feather="users" class="w-5 h-5"></i>
                    <span>Pengguna</span>
                </a>

                <!-- Logout -->
                <form action="{{ route('admin.logout') }}" method="POST"
                    class="logout-btn flex items-center gap-3 px-4 py-3 rounded-lg text-red-500 hover:text-white font-medium border border-red-500">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full">
                        <i data-feather="log-out" class="w-5 h-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Desktop Sidebar -->
        <aside class="hidden lg:flex lg:w-72 bg-white shadow-custom border-r border-custom flex-col">
            <!-- Header -->
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i data-feather="package" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">Stockify</h1>
                        <p class="text-sm text-gray-500">Admin Dashboard</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-6 space-y-3 overflow-y-auto">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                    class="menu-item flex items-center gap-3 px-4 py-3 rounded-xl bg-gradient-to-r from-blue-50 to-indigo-500 text-blue-700 font-medium border border-blue-100">
                    <i data-feather="home" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Produk Section -->
                <div class="space-y-2">
                    <div class="section-header flex items-center justify-between px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 rounded-lg"
                        data-section="products">
                        <div class="flex items-center gap-2">
                            <i data-feather="box" class="w-4 h-4"></i>
                            <span>Produk</span>
                        </div>
                        <i data-feather="chevron-right" class="w-4 h-4 icon-rotate"></i>
                    </div>
                    <div class="submenu space-y-1 pl-6 hidden" id="products-submenu">
                        <a href="{{ route('admin.products.index') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="list" class="w-4 h-4"></i>
                            <span>Daftar Produk</span>
                        </a>
                        <a href="{{ route('admin.categories.index') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="tag" class="w-4 h-4"></i>
                            <span>Kategori Produk</span>
                        </a>
                        <a href="{{ route('admin.attributes.index') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="sliders" class="w-4 h-4"></i>
                            <span>Atribut Produk</span>
                        </a>
                    </div>
                </div>

                <!-- Stok Section -->
                <div class="space-y-2">
                    <div class="section-header flex items-center justify-between px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 rounded-lg"
                        data-section="stock">
                        <div class="flex items-center gap-2">
                            <i data-feather="layers" class="w-4 h-4"></i>
                            <span>Stok</span>
                        </div>
                        <i data-feather="chevron-right" class="w-4 h-4 icon-rotate"></i>
                    </div>
                    <div class="submenu space-y-1 pl-6 hidden" id="stock-submenu">
                        <a href="{{ route('admin.transactions.in') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="arrow-down-circle" class="w-4 h-4 text-green-500"></i>
                            <span>Barang Masuk</span>
                        </a>
                        <a href="{{ route('admin.transactions.out') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="arrow-up-circle" class="w-4 h-4 text-red-500"></i>
                            <span>Barang Keluar</span>
                        </a>
                        <a href="{{ route('admin.stockopname.index') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="clipboard" class="w-4 h-4 text-blue-500"></i>
                            <span>Stock Opname</span>
                        </a>
                        <a href="{{ route('admin.minimum_stock.index') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="alert-triangle" class="w-4 h-4 text-amber-500"></i>
                            <span>Pengaturan Stok Minimum</span>
                        </a>
                    </div>
                </div>

                <!-- Laporan Section -->
                <div class="space-y-2">
                    <div class="section-header flex items-center justify-between px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 rounded-lg"
                        data-section="reports">
                        <div class="flex items-center gap-2">
                            <i data-feather="bar-chart-2" class="w-4 h-4"></i>
                            <span>Laporan</span>
                        </div>
                        <i data-feather="chevron-right" class="w-4 h-4 icon-rotate"></i>
                    </div>
                    <div class="submenu space-y-1 pl-6 hidden" id="reports-submenu">
                        <a href="{{ route('admin.reports.stock') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i data-feather="package" class="w-4 h-4"></i>
                            <span>Laporan Stok</span>
                        </a>
                        <a href="{{ route('admin.reports.transactions') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i data-feather="activity" class="w-4 h-4"></i>
                            <span>Laporan Transaksi</span>
                        </a>
                        <a href="{{ route('admin.reports.activity') }}"
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i data-feather="clock" class="w-4 h-4"></i>
                            <span>Laporan Aktivitas</span>
                        </a>
                    </div>
                </div>

                <!-- Supplier -->
                <a href="{{ route('admin.suppliers.index') }}"
                    class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                    <i data-feather="truck" class="w-5 h-5"></i>
                    <span>Supplier</span>
                </a>

                <!-- Pengguna -->
                <a href="{{ route('admin.users.index') }}"
                    class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                    <i data-feather="users" class="w-5 h-5"></i>
                    <span>Pengguna</span>
                </a>

                <!-- Logout -->
                <form action="{{ route('admin.logout') }}" method="POST"
                    class="logout-btn flex items-center gap-3 px-4 py-3 rounded-lg text-red-500 hover:text-white font-medium border border-red-500">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full">
                        <i data-feather="log-out" class="w-5 h-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-hidden lg:ml-0 pt-16 lg:pt-0">
            <div class="h-full overflow-y-auto">
                <div class="p-4 sm:p-6 max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <script>
        feather.replace(); // Initialize Feather Icons

        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');

        function toggleMobileSidebar() {
            const isOpen = mobileSidebar.classList.contains('open');
            
            if (isOpen) {
                // Close sidebar
                mobileSidebar.classList.remove('open');
                mobileOverlay.classList.add('hidden');
                mobileMenuBtn.classList.remove('hamburger-open');
                document.body.style.overflow = '';
            } else {
                // Open sidebar
                mobileSidebar.classList.add('open');
                mobileOverlay.classList.remove('hidden');
                mobileMenuBtn.classList.add('hamburger-open');
                document.body.style.overflow = 'hidden';
            }
        }

        // Mobile menu button click
        mobileMenuBtn.addEventListener('click', toggleMobileSidebar);

        // Close sidebar when clicking overlay
        mobileOverlay.addEventListener('click', toggleMobileSidebar);

        // Close sidebar on window resize to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                mobileSidebar.classList.remove('open');
                mobileOverlay.classList.add('hidden');
                mobileMenuBtn.classList.remove('hamburger-open');
                document.body.style.overflow = '';
            }
        });

        // Submenu Toggle Function
        function toggleSubmenu(sectionName) {
            const submenu = document.getElementById(sectionName + '-submenu');
            const chevron = document.querySelector(`[data-section="${sectionName}"] .icon-rotate`);

            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                chevron.classList.add('rotated');
            } else {
                submenu.classList.add('hidden');
                chevron.classList.remove('rotated');
            }
        }

        // Add click event listeners to section headers
        document.querySelectorAll('.section-header').forEach(header => {
            header.addEventListener('click', function () {
                const sectionName = this.dataset.section;
                toggleSubmenu(sectionName);
            });
        });

        // Close mobile sidebar when clicking on menu items (optional UX improvement)
        document.querySelectorAll('#mobileSidebar a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 1024) {
                    setTimeout(toggleMobileSidebar, 100);
                }
            });
        });

        // Initialize feather icons after DOM modifications
        setTimeout(() => {
            feather.replace();
        }, 100);
    </script>
    @stack('scripts')

</body>

</html>