<!-- resources/views/manager/dashboard.blade.php -->
@extends('layouts.manager')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">Dashboard Manajer Gudang</h1>

        <!-- Stok Menipis -->
        <h2 class="text-lg font-semibold mb-4">Stok Menipis</h2>
        <ul>
            @foreach($lowStockProducts as $product)
                <li>{{ $product->name }} - Stok: {{ $product->stock }}</li>
            @endforeach
        </ul>

        <!-- Barang Masuk Hari Ini -->
        <h2 class="text-lg font-semibold mt-6 mb-4">Barang Masuk Hari Ini</h2>
        <ul>
            @foreach($todayIn as $transaction)
                <li>{{ $transaction->product->name }} - Jumlah: {{ $transaction->quantity }} - Tanggal: {{ $transaction->transaction_date }}</li>
            @endforeach
        </ul>

        <!-- Barang Keluar Hari Ini -->
        <h2 class="text-lg font-semibold mt-6 mb-4">Barang Keluar Hari Ini</h2>
        <ul>
            @foreach($todayOut as $transaction)
                <li>{{ $transaction->product->name }} - Jumlah: {{ $transaction->quantity }} - Tanggal: {{ $transaction->transaction_date }}</li>
            @endforeach
        </ul>
    </div>
@endsection
