@extends('layouts.staff')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Dashboard Staff Gudang</h1>
    <div class="grid grid-cols-1 gap-6">
        <div class="bg-white p-6 rounded shadow-lg">
            <h3 class="text-xl font-semibold">Tugas Hari Ini</h3>
            <ul>
                <li>Penerimaan barang - 5 item</li>
                <li>Pengeluaran barang - 8 item</li>
            </ul>
        </div>
    </div>
@endsection