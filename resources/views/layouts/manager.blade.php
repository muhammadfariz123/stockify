<!-- resources/views/layouts/manager.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajer Gudang Dashboard - Stockify</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-green-800 p-5">
            <h2 class="text-white text-2xl mb-5">Stockify</h2>
            <ul class="space-y-4">
                <li><a href="{{ route('manager.dashboard') }}" class="text-white">Dashboard</a></li>
                <li><a href="{{ route('manager.stock.index') }}" class="text-white">Manajemen Stok</a></li>
                <li><a href="{{ route('manager.products.index') }}" class="text-white">Produk</a></li>
                <li><a href="{{ route('manager.reports.index') }}" class="text-white">Laporan</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="flex-1 p-6">
            <!-- Logout Button -->
            <form action="{{ route('logout') }}" method="POST" class="mb-4">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Logout
                </button>
            </form>

            @yield('content')
        </div>
    </div>
</body>

</html>
