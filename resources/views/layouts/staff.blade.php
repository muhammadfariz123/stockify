<!-- resources/views/layouts/staff.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Gudang Dashboard - Stockify</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-purple-800 p-5">
            <h2 class="text-white text-2xl mb-5">Stockify</h2>
            <ul class="space-y-4">
                <li><a href="{{ route('staff.dashboard') }}" class="text-white">Dashboard</a></li>
                <li><a href="{{ route('staff.stock.index') }}" class="text-white">Stok</a></li>
                <li><a href="{{ route('staff.receiveStock') }}" class="text-white">Terima Barang</a></li>
                <li><a href="{{ route('staff.dispatchStock') }}" class="text-white">Kirim Barang</a></li>
                <form action="{{ route('staff.logout') }}" method="POST"
                    class="logout-btn flex items-center gap-3 px-4 py-3 rounded-lg text-red-500 hover:text-white font-medium border border-red-500">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full">
                        <i data-feather="log-out" class="w-5 h-5"></i>
                        <span>Logout</span>
                    </button>
                </form>

            </ul>
        </div>

        <!-- Content -->
        <div class="flex-1 p-6">
            @yield('content')
        </div>
    </div>
</body>

</html>