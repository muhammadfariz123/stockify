@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-semibold">Detail Supplier</h1>
    <div class="mt-4">
        <strong>Nama Supplier:</strong> {{ $supplier->name }}<br>
        <strong>Alamat:</strong> {{ $supplier->address }}<br>
        <strong>Kontak:</strong> {{ $supplier->contact }}<br>
    </div>
@endsection