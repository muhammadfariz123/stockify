<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Stockify</title>
    @vite('resources/css/app.css') <!-- Pastikan Anda menggunakan Vite jika diperlukan -->
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-800 p-5">
            <h2 class="text-white text-2xl mb-6">Stockify</h2>
            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="block text-white">Dashboard</a>
                <a href="{{ route('admin.products.index') }}" class="block text-white">Produk</a>
                <a href="{{ route('admin.categories.index') }}" class="block text-white">Kategori</a>
                <a href="{{ route('admin.suppliers.index') }}" class="block text-white">Supplier</a>
                <a href="{{ route('admin.reports.index') }}" class="block text-white">Laporan</a>
            </nav>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-semibold mb-6">Laporan</h1>
            <!-- Tampilkan laporan di sini -->
            <div class="bg-white p-5 shadow-lg rounded-lg">
                <h2 class="text-xl font-medium mb-4">Ringkasan Laporan</h2>
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">Nama Produk</th>
                            <th class="px-4 py-2 border">Jumlah Masuk</th>
                            <th class="px-4 py-2 border">Jumlah Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contoh data, Anda bisa menggantinya dengan data dari database -->
                        <tr>
                            <td class="px-4 py-2 border">1</td>
                            <td class="px-4 py-2 border">Produk A</td>
                            <td class="px-4 py-2 border">100</td>
                            <td class="px-4 py-2 border">50</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border">2</td>
                            <td class="px-4 py-2 border">Produk B</td>
                            <td class="px-4 py-2 border">200</td>
                            <td class="px-4 py-2 border">150</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>