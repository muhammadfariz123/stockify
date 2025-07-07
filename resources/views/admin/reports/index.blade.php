<!-- resources/views/admin/reports/index.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-semibold mb-6">Laporan</h1>

    <!-- Tampilkan laporan di sini -->
    <div class="bg-white p-5 shadow-lg rounded-lg">
        <h2 class="text-xl font-medium mb-4">Ringkasan Laporan</h2>
        
        <!-- Table of report data -->
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Nama Produk</th>
                    <th class="px-4 py-2 border">Jumlah Masuk</th>
                    <th class="px-4 py-2 border">Jumlah Keluar</th>
                </tr>
            </thead>
            <tbody>
                <!-- Contoh data, Anda bisa menggantinya dengan data dari database -->
                <tr>
                    <td class="px-4 py-2 border">1</td>
                    <td class="px-4 py-2 border">Produk A</td>
                    <td class="px-4 py-2 border">100</td>
                    <td class="px-4 py-2 border">50</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border">2</td>
                    <td class="px-4 py-2 border">Produk B</td>
                    <td class="px-4 py-2 border">200</td>
                    <td class="px-4 py-2 border">150</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
