<!-- resources/views/admin/categories/show.blade.php -->
@extends('layouts.admin')

@section('content')
  <h1 class="text-3xl font-bold mb-6">Detail Kategori</h1>

  <div class="mb-4">
    <strong class="block">Nama Kategori:</strong>
    <p>{{ $category->name }}</p>
  </div>

  <div class="mb-4">
    <strong class="block">Deskripsi:</strong>
    <p>{{ $category->description }}</p>
  </div>

  <a href="{{ route('admin.categories.edit', $category) }}"
     class="bg-yellow-500 text-white py-2 px-4 rounded">
    Edit
  </a>

  <form action="{{ route('admin.categories.destroy', $category) }}"
        method="POST" class="inline">
    @csrf @method('DELETE')
    <button class="bg-red-500 text-white py-2 px-4 rounded"
            onclick="return confirm('Hapus kategori ini?')">
      Hapus
    </button>
  </form>

  <a href="{{ route('admin.categories.index') }}"
     class="block mt-4 text-gray-600">Kembali ke Daftar Kategori</a>
@endsection
