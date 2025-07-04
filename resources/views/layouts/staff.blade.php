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
            </ul>
        </div>

        <!-- Content -->
        <div class="flex-1 p-6">
            @yield('content')
        </div>
    </div>
</body>

</html>