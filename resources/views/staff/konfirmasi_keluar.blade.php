@extends('layouts.staff')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 lg:p-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Konfirmasi Barang Keluar</h1>

            <!-- Menampilkan transaksi keluar yang perlu dikonfirmasi -->
            @foreach ($outgoingItems as $item)
                <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                    <h2 class="text-xl font-semibold">{{ $item->product->name }}</h2>
                    <p class="text-gray-600">Jumlah: {{ $item->quantity }}</p>
                    <p class="text-gray-600">Tanggal Keluar: {{ $item->transaction_date }}</p>

                    <!-- Form untuk konfirmasi barang keluar -->
                    <form action="{{ route('staff.stock.send', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                            Selesai Kirim
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection