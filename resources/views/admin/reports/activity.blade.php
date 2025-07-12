@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Laporan Aktivitas</h1>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID Aktivitas</th>
                <th class="border px-4 py-2">Nama Pengguna</th>
                <th class="border px-4 py-2">Deskripsi Aktivitas</th>
                <th class="border px-4 py-2">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activities as $activity)
                <tr>
                    <td class="border px-4 py-2">{{ $activity->id }}</td>
                    <td class="border px-4 py-2">{{ $activity->user->name }}</td>  <!-- Menampilkan nama pengguna -->
                    <td class="border px-4 py-2">{{ $activity->description }}</td>
                    <td class="border px-4 py-2">{{ $activity->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
