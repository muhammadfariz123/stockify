@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Transaksi Masuk</h1>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID Transaksi</th>
                <th class="border px-4 py-2">Produk</th>
                <th class="border px-4 py-2">Jumlah</th>
                <th class="border px-4 py-2">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactionsIn as $transaction)
                <tr>
                    <td class="border px-4 py-2">{{ $transaction->id }}</td>
                    <td class="border px-4 py-2">{{ $transaction->product->name }}</td>
                    <td class="border px-4 py-2">{{ $transaction->quantity }}</td>
                    <td class="border px-4 py-2">{{ $transaction->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
