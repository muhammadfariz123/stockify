@extends('layouts.manager')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Daftar Supplier</h1>


    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID Supplier</th>
                <th class="border px-4 py-2">Nama Supplier</th>
                <th class="border px-4 py-2">Alamat</th>
                <th class="border px-4 py-2">Telepon</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td class="border px-4 py-2">{{ $supplier->id }}</td>
                    <td class="border px-4 py-2">{{ $supplier->name }}</td>
                    <td class="border px-4 py-2">{{ $supplier->address }}</td>
                    <td class="border px-4 py-2">{{ $supplier->contact }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection