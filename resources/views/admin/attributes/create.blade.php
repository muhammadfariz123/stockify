@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-semibold mb-4">Tambah Atribut Produk</h1>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.attributes.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label class="block font-semibold mb-1">Nama Atribut</label>
        <input type="text" name="name" class="w-full border p-2 rounded" placeholder="Contoh: Warna, Ukuran, Bahan, Panjang, Berat" required>
    </div>
    <div class="mb-4">
        <label class="block font-semibold mb-1">Nilai</label>
        <input type="text" name="value" class="w-full border p-2 rounded" placeholder="Contoh: Merah, L, Katun, cm, Kg" required>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
