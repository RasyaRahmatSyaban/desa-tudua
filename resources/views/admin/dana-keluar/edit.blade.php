@extends('layouts.admin')

@section('title', 'Edit Dana Keluar')
@section('page-title', 'Edit Dana Keluar')
@section('page-description', 'Ubah data dana keluar yang sudah ada')

@section('content')
<div class="max-w-4xl">
    <form method="POST" action="{{ route('admin.dana-keluar.update', $danaKeluar->id) }}" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="card bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Informasi Dana Keluar</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           id="tanggal" 
                           name="tanggal" 
                           value="{{ old('tanggal', $danaKeluar->tanggal ? \Carbon\Carbon::parse($danaKeluar->tanggal)->format('Y-m-d') : '') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal') border-red-500 @enderror"
                           required>
                    @error('tanggal')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Keperluan -->
                <div>
                    <label for="keperluan" class="block text-sm font-medium text-gray-700 mb-2">
                        Keperluan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="keperluan" 
                           name="keperluan" 
                           value="{{ old('keperluan', $danaKeluar->keperluan) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('keperluan') border-red-500 @enderror"
                           placeholder="Masukkan keperluan dana"
                           required>
                    @error('keperluan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Jumlah -->
                <div>
                    <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-2">
                        Jumlah (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           id="jumlah" 
                           name="jumlah" 
                           value="{{ old('jumlah', $danaKeluar->jumlah) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jumlah') border-red-500 @enderror"
                           placeholder="Masukkan jumlah dana"
                           min="0"
                           step="1000"
                           required>
                    @error('jumlah')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Kategori -->
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select id="kategori" 
                            name="kategori"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kategori') border-red-500 @enderror"
                            required>
                        <option value="">Pilih Kategori</option>
                        <option value="Pemerintahan" {{ old('kategori', $danaKeluar->kategori) === 'Pemerintahan' ? 'selected' : '' }}>Pemerintahan</option>
                        <option value="Pembangunan" {{ old('kategori', $danaKeluar->kategori) === 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                        <option value="Pemberdayaan" {{ old('kategori', $danaKeluar->kategori) === 'Pemberdayaan' ? 'selected' : '' }}>Pemberdayaan</option>
                        <option value="Kemasyarakatan" {{ old('kategori', $danaKeluar->kategori) === 'Kemasyarakatan' ? 'selected' : '' }}>Kemasyarakatan</option>
                        <option value="Operasional" {{ old('kategori', $danaKeluar->kategori) === 'Operasional' ? 'selected' : '' }}>Operasional</option>
                    </select>
                    @error('kategori')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Keterangan -->
            <div class="mt-6">
                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                    Keterangan
                </label>
                <textarea id="keterangan" 
                          name="keterangan" 
                          rows="4"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('keterangan') border-red-500 @enderror"
                          placeholder="Keterangan tambahan (opsional)">{{ old('keterangan', $danaKeluar->keterangan) }}</textarea>
                @error('keterangan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.dana-keluar.index') }}" 
               class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            
            <button type="submit" 
                    class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                <i class="fas fa-save mr-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
