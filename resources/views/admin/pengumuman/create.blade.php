@extends('layouts.admin')

@section('title', 'Tambah Pengumuman')
@section('page-title', 'Tambah Pengumuman')
@section('page-description', 'Buat pengumuman baru untuk masyarakat')

@section('content')
<div class="space-y-6">
    <form method="POST" action="{{ route('admin.pengumuman.store') }}" class="space-y-6">
        @csrf
        
        <div class="card bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Informasi Pengumuman</h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <!-- Judul -->
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Pengumuman <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="judul" 
                               name="judul" 
                               value="{{ old('judul') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Masukkan judul pengumuman..."
                               required>
                               @error('judul') border-red-500 @enderror
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Konten -->
                    <div>
                        <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                            Isi Pengumuman <span class="text-red-500">*</span>
                        </label>
                        <textarea id="isi" 
                                  name="isi" 
                                  rows="10"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                  placeholder="Tulis isi pengumuman di sini..."
                                  required>{{ old('isi') }}</textarea>
                                  @error('isi') border-red-500 @enderror
                        @error('isi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="space-y-6">
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status
                        </label>
                        <select id="status" 
                                name="status"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('status') border-red-500 @enderror
                            <option value="Aktif" {{ old('status') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ old('status') === 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Berlaku Hingga -->
                    <div>
                        <label for="berlaku_hingga" class="block text-sm font-medium text-gray-700 mb-2">
                            Berlaku Hingga
                        </label>
                        <input type="date" 
                               id="berlaku_hingga" 
                               name="berlaku_hingga" 
                               value="{{ old('berlaku_hingga') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                               @error('berlaku_hingga') border-red-500 @enderror
                        <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ada batas waktu</p>
                        @error('berlaku_hingga')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.pengumuman.index') }}" 
               class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            
            <button type="submit" 
                    class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                <i class="fas fa-save mr-2"></i>Simpan Pengumuman
            </button>
        </div>
    </form>
</div>
@endsection
