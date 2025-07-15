@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-semibold mb-4">Daftar Atribut Produk</h1>

<a href="{{ route('admin.attributes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Atribut</a>

<table class="min-w-full bg-white border border-gray-200">
    <thead>
        <tr>
            <th class="px-4 py-2 border">Nama</th>
            <th class="px-4 py-2 border">Nilai</th>
            <th class="px-4 py-2 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($attributes as $attribute)
            <tr>
                <td class="border px-4 py-2">{{ $attribute->name }}</td>
                <td class="border px-4 py-2">{{ $attribute->value }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('admin.attributes.edit', $attribute->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    |
                    <form action="{{ route('admin.attributes.destroy', $attribute->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin menghapus atribut ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
