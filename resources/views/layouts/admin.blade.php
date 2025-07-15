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
            background-color: #3B82F6;
            /* Blue hover effect */
            color: white;
        }

        /* Submenu items hover */
        .submenu-item:hover {
            background-color: #E0F2FE;
            /* Light blue hover */
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
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-slate-100 text-gray-800 min-h-screen">
    <!-- Mobile Overlay -->
    <div id="mobileOverlay" class="fixed inset-0 z-20 mobile-overlay hidden lg:hidden"></div>

    <div class="flex h-screen">
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
                <a href="{{ route('admin.dashboard') }} "
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
                    <div class="submenu space-y-1 pl-6" id="products-submenu">
                        <a href="{{ route('admin.products.index') }} "
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="list" class="w-4 h-4"></i>
                            <span>Daftar Produk</span>
                        </a>
                        <a href="{{ route('admin.categories.index') }} "
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="tag" class="w-4 h-4"></i>
                            <span>Kategori Produk</span>
                        </a>
                        <a href="{{ route('admin.attributes.index') }} "
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
                    <div class="submenu space-y-1 pl-6" id="stock-submenu">
                        <a href="{{ route('admin.transactions.in') }} "
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="arrow-down-circle" class="w-4 h-4 text-green-500"></i>
                            <span>Barang Masuk</span>
                        </a>
                        <a href="{{ route('admin.transactions.out') }} "
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="arrow-up-circle" class="w-4 h-4 text-red-500"></i>
                            <span>Barang Keluar</span>
                        </a>
                        <a href="{{ route('admin.stockopname.index') }} "
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                            <i data-feather="clipboard" class="w-4 h-4 text-blue-500"></i>
                            <span>Stock Opname</span>
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
                    <div class="submenu space-y-1 pl-6" id="reports-submenu">
                        <a href="{{ route('admin.reports.stock') }} "
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i data-feather="package" class="w-4 h-4"></i>
                            <span>Laporan Stok</span>
                        </a>
                        <a href="{{ route('admin.reports.transactions') }} "
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i data-feather="activity" class="w-4 h-4"></i>
                            <span>Laporan Transaksi</span>
                        </a>
                        <a href="{{ route('admin.reports.activity') }} "
                            class="submenu-item flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            <i data-feather="clock" class="w-4 h-4"></i>
                            <span>Laporan Aktivitas</span>
                        </a>
                    </div>
                </div>


                <!-- Supplier -->
                <a href="{{ route('admin.suppliers.index') }} "
                    class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-blue-100 hover:text-blue-600">
                    <i data-feather="truck" class="w-5 h-5"></i>
                    <span>Supplier</span>
                </a>

                <!-- Pengguna -->
                <a href="{{ route('admin.users.index') }} "
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
        <main class="flex-1 overflow-hidden">
            <div class="h-full overflow-y-auto">
                <div class="p-6 max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <script>
        feather.replace(); // Initialize Feather Icons

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

        // Initialize submenus as hidden
        document.querySelectorAll('.submenu').forEach(submenu => {
            submenu.classList.add('hidden');
        });
    </script>
    @stack('scripts')
</body>

</html>