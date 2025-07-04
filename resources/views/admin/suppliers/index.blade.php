@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-semibold">Daftar Supplier</h1>
    <a href="{{ route('admin.suppliers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Supplier</a>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Alamat</th>
                <th class="border px-4 py-2">Kontak</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
                <tr>
                    <td class="border px-4 py-2">{{ $supplier->name }}</td>
                    <td class="border px-4 py-2">{{ $supplier->address }}</td>
                    <td class="border px-4 py-2">{{ $supplier->contact }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="text-blue-500">Edit</a> |
                        <form action="{{ route('admin.suppliers.destroy', $supplier) }}" method="POST" style="display:inline;">
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
