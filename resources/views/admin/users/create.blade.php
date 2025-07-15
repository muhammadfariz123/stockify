@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Tambah Pengguna</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Pengguna</label>
            <input type="text" id="name" name="name" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
            <input type="email" id="email" name="email" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
        </div>

        <div class="mb-4 relative">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
            <input type="password" id="password" name="password" class="mt-1 block w-full border border-gray-300 rounded-md p-2 pr-10" required>
            <span onclick="togglePassword('password')" class="absolute right-3 top-9 cursor-pointer text-gray-500">
                👁️
            </span>
        </div>

        <div class="mb-4 relative">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-md p-2 pr-10" required>
            <span onclick="togglePassword('password_confirmation')" class="absolute right-3 top-9 cursor-pointer text-gray-500">
                👁️
            </span>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
            <select id="role" name="role" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                <option value="Staff Gudang">Staff Gudang</option>
                <option value="Manajer Gudang">Manajer Gudang</option>
                <option value="Admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Pengguna</button>
    </form>

    {{-- Toggle Password JS --}}
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
@endsection
