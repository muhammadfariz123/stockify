@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Daftar Pengguna</h1>
    <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Tambah Pengguna</a>
    
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID Pengguna</th>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Role</th>
                <th class="border px-4 py-2">Tanggal Dibuat</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->id }}</td>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">{{ $user->role }}</td>
                    <td class="border px-4 py-2">{{ $user->created_at->format('d-m-Y') }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
