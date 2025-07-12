@extends('layouts.manager')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Daftar Supplier</h1>
    
    <a href="{{ route('manager.suppliers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Tambah Supplier</a>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID Supplier</th>
                <th class="border px-4 py-2">Nama Supplier</th>
                <th class="border px-4 py-2">Alamat</th>
                <th class="border px-4 py-2">Telepon</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td class="border px-4 py-2">{{ $supplier->id }}</td>
                    <td class="border px-4 py-2">{{ $supplier->name }}</td>
                    <td class="border px-4 py-2">{{ $supplier->address }}</td>
                    <td class="border px-4 py-2">{{ $supplier->phone }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('manager.suppliers.edit', $supplier) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('manager.suppliers.destroy', $supplier) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
