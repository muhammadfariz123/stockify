@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-semibold mb-4">Edit Atribut Produk</h1>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.attributes.update', $attribute->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block font-semibold mb-1">Nama Atribut</label>
        <input type="text" name="name" class="w-full border p-2 rounded" value="{{ $attribute->name }}" required>
    </div>
    <div class="mb-4">
        <label class="block font-semibold mb-1">Nilai</label>
        <input type="text" name="value" class="w-full border p-2 rounded" value="{{ $attribute->value }}" required>
    </div>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
