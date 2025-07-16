<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Stockify - Aplikasi Manajemen Stok Barang</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/flowbite@1.4.7/dist/flowbite.js"></script>
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            /* Smooth transitions */
            * {
                transition: all 0.2s ease;
            }

            /* Clean hover effects */
            .hover-lift {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .hover-lift:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            }

            /* Subtle animations */
            .fade-in {
                opacity: 0;
                transform: translateY(20px);
                animation: fadeIn 0.8s ease forwards;
            }

            .fade-in-delay-1 { animation-delay: 0.1s; }
            .fade-in-delay-2 { animation-delay: 0.2s; }
            .fade-in-delay-3 { animation-delay: 0.3s; }

            @keyframes fadeIn {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Clean button styles */
            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
                color: white;
                font-weight: 600;
                padding: 0.75rem 2rem;
                border-radius: 0.5rem;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
            }

            .btn-primary:hover {
                box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
                transform: translateY(-1px);
            }

            .btn-secondary {
                background: white;
                color: #374151;
                border: 2px solid #e5e7eb;
                font-weight: 500;
                padding: 0.75rem 2rem;
                border-radius: 0.5rem;
                transition: all 0.3s ease;
            }

            .btn-secondary:hover {
                border-color: #667eea;
                color: #667eea;
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.1);
            }

            /* Clean card styles */
            .card {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                border: 1px solid #f3f4f6;
                transition: all 0.3s ease;
            }

            .card:hover {
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                border-color: #e5e7eb;
            }

            /* Navbar */
            .navbar {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid #f3f4f6;
            }

            /* Hero gradient */
            .hero-gradient {
                background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            }

            /* Icon styles */
            .icon-box {
                width: 4rem;
                height: 4rem;
                border-radius: 0.75rem;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }

            /* Clean typography */
            .text-balance {
                text-wrap: balance;
            }

            /* Smooth scrolling */
            html {
                scroll-behavior: smooth;
            }

            /* Professional spacing */
            .section-padding {
                padding: 5rem 0;
            }

            /* Clean shadows */
            .shadow-soft {
                box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .section-padding {
                    padding: 3rem 0;
                }
            }
        </style>
    </head>
    <body class="antialiased bg-gray-50">
        <!-- Navbar -->
        <nav class="navbar fixed w-full top-0 z-50 py-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center px-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-xl mr-3">
                        S
                    </div>
                    <span class="text-2xl font-bold text-gray-900">Stockify</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-gray-600 hover:text-gray-900 font-medium">Fitur</a>
                    <a href="#roles" class="text-gray-600 hover:text-gray-900 font-medium">Role</a>
                    <a href="#contact" class="text-gray-600 hover:text-gray-900 font-medium">Kontak</a>
                </div>

                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-gray-900 font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 font-medium">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-primary">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
        

        <!-- Hero Section -->
        <section class="hero-gradient pt-24 pb-16 section-padding">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center max-w-4xl mx-auto">
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 fade-in text-balance">
                        Kelola Stok Barang dengan
                        <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            Lebih Efisien
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-12 fade-in fade-in-delay-1 max-w-2xl mx-auto text-balance">
                        Stockify adalah solusi manajemen inventori modern yang membantu bisnis Anda mengoptimalkan operasional gudang dengan teknologi terdepan.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center fade-in fade-in-delay-2">
                        <a href="#features" class="btn-primary">Jelajahi Fitur</a>
                        <a href="#demo" class="btn-secondary">Lihat Demo</a>
                    </div>
                </div>
                
                <!-- Hero Image/Illustration -->
                <div class="mt-16 fade-in fade-in-delay-3">
                    <div class="bg-white rounded-2xl shadow-soft p-8 max-w-4xl mx-auto">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                            <div>
                                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-2">Manajemen Produk</h3>
                                <p class="text-gray-600 text-sm">Kelola produk dengan mudah</p>
                            </div>
                            <div>
                                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-2">Monitoring Real-time</h3>
                                <p class="text-gray-600 text-sm">Pantau stok secara langsung</p>
                            </div>
                            <div>
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-2">Laporan Lengkap</h3>
                                <p class="text-gray-600 text-sm">Analisis data mendalam</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="section-padding bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto text-balance">
                        Solusi lengkap untuk semua kebutuhan manajemen inventori bisnis Anda
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card hover-lift">
                        <div class="icon-box">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Manajemen Produk</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Kelola data produk, kategori, dan supplier dengan interface yang intuitif dan mudah digunakan untuk semua level pengguna.
                        </p>
                    </div>

                    <div class="card hover-lift">
                        <div class="icon-box">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Kontrol Stok</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Monitoring real-time untuk transaksi masuk dan keluar barang dengan sistem notifikasi otomatis untuk stok minimum.
                        </p>
                    </div>

                    <div class="card hover-lift">
                        <div class="icon-box">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Laporan Analytics</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Dashboard analytics yang komprehensif dengan visualisasi data untuk mendukung pengambilan keputusan strategis.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Role-Based Section -->
        <section id="roles" class="section-padding bg-gray-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Akses Berdasarkan Role</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto text-balance">
                        Sistem manajemen pengguna yang fleksibel dengan hak akses yang disesuaikan dengan kebutuhan tim Anda
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card hover-lift">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-lg flex items-center justify-center text-white font-bold mr-4">
                                A
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Administrator</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Kontrol penuh atas sistem dengan kemampuan mengelola semua aspek aplikasi.
                        </p>
                        <ul class="text-sm text-gray-600 space-y-2">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Manajemen pengguna dan hak akses
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Konfigurasi sistem
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Laporan komprehensif
                            </li>
                        </ul>
                    </div>

                    <div class="card hover-lift">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center text-white font-bold mr-4">
                                M
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Manajer Gudang</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Tanggung jawab utama dalam operasional dan monitoring gudang.
                        </p>
                        <ul class="text-sm text-gray-600 space-y-2">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Manajemen stok dan inventory
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Koordinasi tim gudang
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Laporan operasional
                            </li>
                        </ul>
                    </div>

                    <div class="card hover-lift">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-lg flex items-center justify-center text-white font-bold mr-4">
                                S
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Staff Gudang</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Eksekusi operasional harian dengan akses sesuai kebutuhan tugas.
                        </p>
                        <ul class="text-sm text-gray-600 space-y-2">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Input barang masuk/keluar
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Pemeriksaan fisik barang
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update status barang
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section-padding bg-gradient-to-r from-indigo-600 to-purple-700 text-white">
            <div class="max-w-4xl mx-auto text-center px-4">
                <h2 class="text-4xl font-bold mb-6">Siap Mengoptimalkan Operasional Gudang Anda?</h2>
                <p class="text-xl mb-8 opacity-90">
                    Bergabunglah dengan ratusan perusahaan yang telah merasakan efisiensi Stockify
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="bg-white text-indigo-600 font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition-colors">
                        Mulai Gratis
                    </a>
                    <a href="#contact" class="border-2 border-white text-white font-semibold py-3 px-8 rounded-lg hover:bg-white hover:text-indigo-600 transition-colors">
                        Konsultasi
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-12">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-xl mr-3">
                                S
                            </div>
                            <span class="text-2xl font-bold text-gray-900">Stockify</span>
                        </div>
                        <p class="text-gray-600 mb-4 max-w-md">
                            Solusi manajemen inventori yang membantu bisnis mengoptimalkan operasional gudang dengan teknologi modern.
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-4">Fitur</h4>
                        <ul class="space-y-2 text-gray-600">
                            <li><a href="#" class="hover:text-gray-900">Manajemen Produk</a></li>
                            <li><a href="#" class="hover:text-gray-900">Kontrol Stok</a></li>
                            <li><a href="#" class="hover:text-gray-900">Laporan Analytics</a></li>
                            <li><a href="#" class="hover:text-gray-900">Multi-Role Access</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-4">Perusahaan</h4>
                        <ul class="space-y-2 text-gray-600">
                            <li><a href="#" class="hover:text-gray-900">Tentang Kami</a></li>
                            <li><a href="#" class="hover:text-gray-900">Karir</a></li>
                            <li><a href="#" class="hover:text-gray-900">Kontak</a></li>
                            <li><a href="#" class="hover:text-gray-900">Blog</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-gray-200 mt-8 pt-8 text-center text-gray-600">
                    <p>&copy; 2025 Stockify. Semua hak dilindungi.</p>
                </div>
            </div>
        </footer>

        <script>
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('nav');
                if (window.scrollY > 10) {
                    navbar.style.boxShadow = '0 1px 3px rgba(0, 0, 0, 0.1)';
                } else {
                    navbar.style.boxShadow = 'none';
                }
            });
        </script>
    </body>
</html>