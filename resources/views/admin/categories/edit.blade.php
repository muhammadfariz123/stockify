<!-- resources/views/admin/categories/edit.blade.php -->
@extends('layouts.admin')

@section('content')
  <h1 class="text-3xl font-bold mb-6">Edit Kategori</h1>

  <form action="{{ route('admin.categories.update', $category) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-4">
      <label for="name" class="block font-medium">Nama Kategori</label>
      <input type="text" name="name" id="name"
             class="w-full p-2 border rounded"
             value="{{ old('name', $category->name) }}" required>
    </div>

    <div class="mb-4">
      <label for="description" class="block font-medium">Deskripsi</label>
      <textarea name="description" id="description" rows="4"
                class="w-full p-2 border rounded">{{ old('description', $category->description) }}</textarea>
    </div>

    <button type="submit"
            class="bg-blue-500 text-white py-2 px-4 rounded">
      Perbarui Kategori
    </button>
    <a href="{{ route('admin.categories.index') }}"
       class="ml-2 text-gray-600">Batal</a>
  </form>
@endsection
