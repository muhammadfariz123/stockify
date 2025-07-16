@extends('layouts.admin')

@section('content')
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Laporan Aktivitas</h1>
                <p class="text-sm text-gray-600 mt-1">Pantau semua aktivitas pengguna dalam sistem</p>
            </div>
            <div class="flex items-center gap-2">
                <div class="bg-purple-50 border border-purple-200 rounded-lg px-3 py-2">
                    <span class="text-sm font-medium text-purple-700">Total: {{ $activities->count() }} aktivitas</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section (Optional) -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="p-4 border-b border-gray-200">
            <div class="flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2">
                    <i data-feather="filter" class="w-4 h-4 text-gray-500"></i>
                    <span class="text-sm font-medium text-gray-700">Filter</span>
                </div>
                <select class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option>Semua Pengguna</option>
                    <option>Admin</option>
                    <option>Staff</option>
                </select>
                <input type="date" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                <input type="text" placeholder="Cari aktivitas..." class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-1">
                                <i data-feather="hash" class="w-4 h-4"></i>
                                ID Aktivitas
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-1">
                                <i data-feather="user" class="w-4 h-4"></i>
                                Nama Pengguna
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-1">
                                <i data-feather="activity" class="w-4 h-4"></i>
                                Deskripsi Aktivitas
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-1">
                                <i data-feather="calendar" class="w-4 h-4"></i>
                                Tanggal
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($activities as $activity)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-xs font-medium text-purple-600">#</span>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">{{ $activity->id }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-sm font-semibold text-white">
                                            {{ strtoupper(substr($activity->user->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $activity->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $activity->user->email ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                        @if(str_contains(strtolower($activity->description), 'login'))
                                            <i data-feather="log-in" class="w-4 h-4 text-green-600"></i>
                                        @elseif(str_contains(strtolower($activity->description), 'logout'))
                                            <i data-feather="log-out" class="w-4 h-4 text-red-600"></i>
                                        @elseif(str_contains(strtolower($activity->description), 'create') || str_contains(strtolower($activity->description), 'tambah'))
                                            <i data-feather="plus-circle" class="w-4 h-4 text-blue-600"></i>
                                        @elseif(str_contains(strtolower($activity->description), 'update') || str_contains(strtolower($activity->description), 'edit'))
                                            <i data-feather="edit-2" class="w-4 h-4 text-yellow-600"></i>
                                        @elseif(str_contains(strtolower($activity->description), 'delete') || str_contains(strtolower($activity->description), 'hapus'))
                                            <i data-feather="trash-2" class="w-4 h-4 text-red-600"></i>
                                        @elseif(str_contains(strtolower($activity->description), 'view') || str_contains(strtolower($activity->description), 'lihat'))
                                            <i data-feather="eye" class="w-4 h-4 text-gray-600"></i>
                                        @else
                                            <i data-feather="activity" class="w-4 h-4 text-gray-600"></i>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-sm text-gray-900 leading-relaxed">{{ $activity->description }}</div>
                                        @if(str_contains(strtolower($activity->description), 'produk'))
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-1">
                                                <i data-feather="package" class="w-3 h-3 mr-1"></i>
                                                Produk
                                            </span>
                                        @elseif(str_contains(strtolower($activity->description), 'stok'))
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-1">
                                                <i data-feather="layers" class="w-3 h-3 mr-1"></i>
                                                Stok
                                            </span>
                                        @elseif(str_contains(strtolower($activity->description), 'user') || str_contains(strtolower($activity->description), 'pengguna'))
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 mt-1">
                                                <i data-feather="users" class="w-3 h-3 mr-1"></i>
                                                Pengguna
                                            </span>
                                        @elseif(str_contains(strtolower($activity->description), 'login') || str_contains(strtolower($activity->description), 'logout'))
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mt-1">
                                                <i data-feather="shield" class="w-3 h-3 mr-1"></i>
                                                Auth
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center text-sm text-gray-900">
                                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                        <i data-feather="calendar" class="w-4 h-4 text-gray-600"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium">{{ $activity->created_at->format('d-m-Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $activity->created_at->format('H:i:s') }}</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Empty State -->
        @if($activities->isEmpty())
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-feather="activity" class="w-8 h-8 text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada aktivitas</h3>
                <p class="text-sm text-gray-500">Belum ada aktivitas yang tercatat dalam sistem.</p>
            </div>
        @endif
    </div>

    <!-- Activity Timeline Summary (Optional enhancement) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i data-feather="log-in" class="w-6 h-6 text-green-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Login</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $activities->filter(fn($a) => str_contains(strtolower($a->description), 'login'))->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i data-feather="plus-circle" class="w-6 h-6 text-blue-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Create</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $activities->filter(fn($a) => str_contains(strtolower($a->description), 'create') || str_contains(strtolower($a->description), 'tambah'))->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i data-feather="edit-2" class="w-6 h-6 text-yellow-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Update</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $activities->filter(fn($a) => str_contains(strtolower($a->description), 'update') || str_contains(strtolower($a->description), 'edit'))->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i data-feather="trash-2" class="w-6 h-6 text-red-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Delete</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $activities->filter(fn($a) => str_contains(strtolower($a->description), 'delete') || str_contains(strtolower($a->description), 'hapus'))->count() }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Re-initialize feather icons after dynamic content
    feather.replace();
</script>
@endpush