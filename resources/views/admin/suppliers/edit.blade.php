@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-semibold">Edit Supplier</h1>
    <form action="{{ route('admin.suppliers.update', $supplier) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Nama Supplier</label>
            <input type="text" name="name" id="name" class="border border-gray-300 p-2 rounded w-full"
                value="{{ $supplier->name }}" required>
        </div>
        <div class="mb-4">
            <label for="address" class="block text-sm font-medium">Alamat</label>
            <textarea name="address" id="address"
                class="border border-gray-300 p-2 rounded w-full">{{ $supplier->address }}</textarea>
        </div>
        <div class="mb-4">
            <label for="contact" class="block text-sm font-medium">Kontak</label>
            <input type="text" name="contact" id="contact" class="border border-gray-300 p-2 rounded w-full"
                value="{{ $supplier->contact }}">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
@endsection