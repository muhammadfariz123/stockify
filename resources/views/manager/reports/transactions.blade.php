@extends('layouts.manager')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Laporan Transaksi</h1>
    
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID Transaksi</th>
                <th class="border px-4 py-2">Produk</th>
                <th class="border px-4 py-2">Jumlah</th>
                <th class="border px-4 py-2">Tanggal Transaksi</th>
                <th class="border px-4 py-2">Jenis Transaksi</th> <!-- Kolom Baru -->
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td class="border px-4 py-2">{{ $transaction->id }}</td>
                    <td class="border px-4 py-2">{{ $transaction->product->name }}</td>
                    <td class="border px-4 py-2">{{ $transaction->quantity }}</td>
                    <td class="border px-4 py-2">{{ $transaction->created_at->format('d-m-Y') }}</td>
                    <td class="border px-4 py-2">
                        @if($transaction->type === 'in')
                            <span class="text-green-600 font-semibold">Masuk</span>
                        @elseif($transaction->type === 'out')
                            <span class="text-red-600 font-semibold">Keluar</span>
                        @else
                            <span class="text-gray-500 italic">Tidak Diketahui</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
