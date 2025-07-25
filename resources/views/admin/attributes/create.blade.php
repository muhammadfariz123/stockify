@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <a href="{{ route('admin.attributes.index') }}" 
               class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Atribut
            </a>
        </div>
        <h1 class="text-3xl font-bold text-gray-900">Tambah Atribut Produk</h1>
        <p class="mt-2 text-sm text-gray-600">Buat atribut baru untuk produk Anda</p>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada form:</h3>
            </div>
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <form action="{{ route('admin.attributes.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <!-- Attribute Name Field -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-semibold text-gray-900">
                    Nama Atribut
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        name="name" 
                        id="name"
                        value="{{ old('name') }}"
                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400"
                        placeholder="Contoh: Warna, Ukuran, Bahan, Panjang, Berat" 
                        required>
                </div>
                <p class="text-xs text-gray-500">Masukkan nama atribut yang akan digunakan untuk produk</p>
            </div>

            <!-- Attribute Value Field -->
            <div class="space-y-2">
                <label for="value" class="block text-sm font-semibold text-gray-900">
                    Nilai
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        name="value" 
                        id="value"
                        value="{{ old('value') }}"
                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400"
                        placeholder="Contoh: Merah, L, Katun, cm, Kg" 
                        required>
                </div>
                <p class="text-xs text-gray-500">Masukkan nilai spesifik untuk atribut ini</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.attributes.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Batal
                </a>
                
                <button type="submit" 
                        class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Atribut
                </button>
            </div>
        </form>
    </div>

    <!-- Info Card -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-600 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <h3 class="text-sm font-medium text-blue-900 mb-1">Tips Membuat Atribut</h3>
                <div class="text-sm text-blue-800 space-y-1">
                    <p>• Gunakan nama atribut yang jelas dan mudah dipahami</p>
                    <p>• Nilai atribut sebaiknya spesifik dan konsisten</p>
                    <p>• Contoh yang baik: Nama "Warna" dengan nilai "Merah"</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection