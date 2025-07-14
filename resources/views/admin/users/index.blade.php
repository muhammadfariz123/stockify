@extends('layouts.admin')

@section('content')
    <div class="min-h-screen p-6">
        <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-xl p-8">
            <h1 class="text-3xl font-semibold text-gray-900 mb-6">Daftar Pengguna</h1>
            <a href="{{ route('admin.users.create') }}" class="bg-gradient-to-r from-[#0065F8] to-[#0048c1] text-white px-6 py-3 rounded-xl mb-6 inline-flex items-center gap-3 hover:from-[#0048c1] hover:to-[#0065F8] transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Pengguna
            </a>
            
            <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-[#0065F8] to-[#0048c1] text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase">ID Pengguna</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Tanggal Dibuat</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $user->id }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $user->role }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $user->created_at->format('d-m-Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.users.edit', $user) }}" 
                                           class="inline-flex items-center px-3 py-2 bg-[#0065F8] text-white hover:bg-[#0048c1] rounded-lg transition-all duration-200 gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            <span class="font-medium">Edit</span>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')"
                                                    class="inline-flex items-center px-3 py-2 bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-800 rounded-lg transition-all duration-200 gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                <span class="font-medium">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
