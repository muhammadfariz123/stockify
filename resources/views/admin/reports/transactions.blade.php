@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Laporan Transaksi</h1>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID Transaksi</th>
                <th class="border px-4 py-2">Produk</th>
                <th class="border px-4 py-2">Jumlah</th>
                <th class="border px-4 py-2">Tipe</th> <!-- Tipe transaksi (Masuk/Keluar) -->
                <th class="border px-4 py-2">Status</th> <!-- Menambahkan kolom Status -->
                <th class="border px-4 py-2">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td class="border px-4 py-2">{{ $transaction->id }}</td>
                    <td class="border px-4 py-2">{{ $transaction->product->name }}</td>
                    <td class="border px-4 py-2">{{ $transaction->quantity }}</td>
                    <td class="border px-4 py-2">{{ $transaction->type }}</td> <!-- Menampilkan tipe transaksi -->
                    <td class="border px-4 py-2">
                        <!-- Menampilkan status transaksi -->
                        <span class="text-sm font-semibold 
                            @if($transaction->status == 'pending') text-yellow-500 
                            @elseif($transaction->status == 'confirmed') text-green-500 
                            @else text-gray-500 @endif">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </td>
                    <td class="border px-4 py-2">{{ $transaction->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
