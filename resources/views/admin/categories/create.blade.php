<!-- resources/views/admin/categories/create.blade.php -->
@extends('layouts.admin')

@section('content')
  <h1 class="text-3xl font-bold mb-6">Tambah Kategori Baru</h1>

  <form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf

    <div class="mb-4">
      <label for="name" class="block font-medium">Nama Kategori</label>
      <input type="text" name="name" id="name"
             class="w-full p-2 border rounded"
             value="{{ old('name') }}" required>
    </div>

    <div class="mb-4">
      <label for="description" class="block font-medium">Deskripsi</label>
      <textarea name="description" id="description" rows="4"
                class="w-full p-2 border rounded">{{ old('description') }}</textarea>
    </div>

    <button type="submit"
            class="bg-green-500 text-white py-2 px-4 rounded">
      Simpan Kategori
    </button>
    <a href="{{ route('admin.categories.index') }}"
       class="ml-2 text-gray-600">Batal</a>
  </form>
@endsection
