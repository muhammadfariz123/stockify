@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Edit Pengguna</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Pengguna</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
            <input type="password" id="password" name="password" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
            <select id="role" name="role" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                <option value="Staff Gudang" {{ $user->role == 'Staff Gudang' ? 'selected' : '' }}>Staff Gudang</option>
                <option value="Manajer Gudang" {{ $user->role == 'Manajer Gudang' ? 'selected' : '' }}>Manajer Gudang</option>
                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Perbarui Pengguna</button>
    </form>
@endsection
