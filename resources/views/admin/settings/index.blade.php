@extends('layouts.admin')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Pengaturan Aplikasi</h1>

    <form action="#" method="POST">
        @csrf
        <!-- Tambahkan form pengaturan aplikasi yang diperlukan di sini -->
        <div class="mb-4">
            <label for="app_name" class="block text-sm font-medium">Nama Aplikasi</label>
            <input type="text" id="app_name" name="app_name" value="{{ old('app_name', 'Stockify') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
        </div>

        <div class="mb-4">
            <label for="app_email" class="block text-sm font-medium">Email Aplikasi</label>
            <input type="email" id="app_email" name="app_email" value="{{ old('app_email', 'info@stockify.com') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Pengaturan</button>
    </form>
@endsection
