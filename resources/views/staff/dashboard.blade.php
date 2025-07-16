@extends('layouts.staff')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 lg:p-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-800 mb-6 text-center">Dashboard Staff Gudang</h1>
            <p class="text-lg text-gray-600 mb-8 text-center">Daftar tugas yang harus diselesaikan hari ini:</p>

            <!-- Grid untuk Kartu Tugas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Barang Masuk -->
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Barang Masuk</h2>
                    <p class="text-gray-600 mb-4">Konfirmasi barang yang baru diterima.</p>
                    <a href="{{ route('staff.stock.in') }}" class="text-blue-500 hover:underline font-semibold">Lihat Barang Masuk</a>
                </div>

                <!-- Barang Keluar -->
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Barang Keluar</h2>
                    <p class="text-gray-600 mb-4">Siapkan barang untuk pengiriman.</p>
                    <a href="{{ route('staff.stock.out') }}" class="text-blue-500 hover:underline font-semibold">Lihat Barang Keluar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
