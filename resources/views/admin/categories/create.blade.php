@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-green-50 p-6">
  <div class="max-w-4xl mx-auto">
    <!-- Header Section -->
    <div class="mb-8">
      <div class="flex items-center space-x-3 mb-2">
        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
          <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-900">Tambah Kategori Baru</h1>
      </div>
      <p class="text-gray-600 text-sm">Buat kategori baru untuk mengorganisir konten dengan lebih baik</p>
    </div>

    <!-- Main Form Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
      <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-6">
        <h2 class="text-xl font-semibold text-white flex items-center">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
          </svg>
          Informasi Kategori
        </h2>
        <p class="text-green-100 text-sm mt-1">Lengkapi form di bawah untuk membuat kategori baru</p>
      </div>

      <form action="{{ route('admin.categories.store') }}" method="POST" class="p-8 space-y-6">
        @csrf

        <!-- Name Field -->
        <div class="group">
          <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            Nama Kategori
            <span class="text-red-500 ml-1">*</span>
          </label>
          <div class="relative">
            <input type="text" name="name" id="name"
                   class="w-full px-4 py-3 pl-12 text-gray-900 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 hover:bg-white hover:border-gray-300"
                   value="{{ old('name') }}" 
                   required
                   placeholder="Masukkan nama kategori">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
              </svg>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-100">
          <a href="{{ route('admin.categories.index') }}"
             class="inline-flex items-center px-6 py-3 text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition-all duration-200 font-medium">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Batal
          </a>
          
          <button type="submit"
                  class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 font-medium">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Simpan Kategori
          </button>
        </div>
      </form>
    </div>

    <!-- Info Card -->
    <div class="mt-6 bg-green-50 border border-green-200 rounded-xl p-4">
      <div class="flex items-start">
        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
        </svg>
        <div>
          <h3 class="text-sm font-medium text-green-900">Tips Membuat Kategori</h3>
          <p class="text-sm text-green-700 mt-1">Pilih nama yang singkat dan deskriptif. Kategori yang baik membantu pengguna menemukan konten dengan mudah.</p>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
        <div class="flex items-center space-x-3">
          <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <div>
            <h4 class="text-sm font-medium text-gray-900">Simpan & Lanjutkan</h4>
            <p class="text-xs text-gray-500">Buat kategori lebih banyak</p>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
        <div class="flex items-center space-x-3">
          <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
          </div>
          <div>
            <h4 class="text-sm font-medium text-gray-900">Preview</h4>
            <p class="text-xs text-gray-500">Lihat hasil sebelum simpan</p>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
        <div class="flex items-center space-x-3">
          <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
          </div>
          <div>
            <h4 class="text-sm font-medium text-gray-900">Kelola Kategori</h4>
            <p class="text-xs text-gray-500">Organisasi yang lebih baik</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .group:hover .group-hover\:scale-105 {
    transform: scale(1.05);
  }
  
  input:focus, textarea:focus {
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
  }
  
  .group input:focus + .absolute svg,
  .group textarea:focus + .absolute svg {
    color: #22c55e;
  }
</style>
@endsection
