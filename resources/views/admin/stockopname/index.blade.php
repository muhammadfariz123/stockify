@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Stock Opname</h1>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID Transaksi</th>
                <th class="border px-4 py-2">Produk</th>
                <th class="border px-4 py-2">Jumlah Teropname</th>
                <th class="border px-4 py-2">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stockOpnames as $stockOpname)
                <tr>
                    <td class="border px-4 py-2">{{ $stockOpname->id }}</td>
                    <td class="border px-4 py-2">{{ $stockOpname->product->name }}</td>
                    <td class="border px-4 py-2">{{ $stockOpname->quantity_opname }}</td>
                    <td class="border px-4 py-2">{{ $stockOpname->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
