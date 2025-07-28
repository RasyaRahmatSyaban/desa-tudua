@extends('layouts.admin')

@section('title', 'Edit Surat Masuk')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Surat Masuk</h1>
        <a href="{{ route('admin.surat-masuk.index') }}"
           class="inline-flex items-center px-6 py-2 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Form Edit Surat Masuk</h3>

        <form action="{{ route('admin.surat-masuk.update', $suratMasuk->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nomor Surat -->
                <div>
                    <label for="nomor_surat" class="block text-sm font-medium text-gray-700 mb-2">
                        Nomor Surat <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nomor_surat" name="nomor_surat"
                           value="{{ old('nomor_surat', $suratMasuk->nomor_surat) }}"
                           class="w-full px-4 py-3 border rounded-lg" @error('nomor_surat') border-red-500 @enderror
                           required>
                    @error('nomor_surat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pengirim -->
                <div>
                    <label for="pengirim" class="block text-sm font-medium text-gray-700 mb-2">
                        Pengirim <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="pengirim" name="pengirim"
                           value="{{ old('pengirim', $suratMasuk->pengirim) }}"
                           class="w-full px-4 py-3 border rounded-lg" 
                           @error('pengirim') border-red-500 @enderror
                           required>
                    @error('pengirim')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Perihal -->
                <div>
                    <label for="perihal" class="block text-sm font-medium text-gray-700 mb-2">
                        Perihal <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="perihal" name="perihal"
                           value="{{ old('perihal', $suratMasuk->perihal) }}"
                           class="w-full px-4 py-3 border rounded-lg" 
                           @error('perihal') border-red-500 @enderror
                           required>
                    @error('perihal')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Terima -->
                <div>
                    <label for="tanggal_terima" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Terima <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="tanggal_terima" name="tanggal_terima"
                           value="{{ old('tanggal_terima', $suratMasuk->tanggal_terima ? \Carbon\Carbon::parse($suratMasuk->tanggal_terima)->format('Y-m-d') : '') }}"
                           class="w-full px-4 py-3 border rounded-lg"
                           @error('tanggal_terima') border-red-500 @enderror 
                           required> 
                    @error('tanggal_terima')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- File -->
            <div class="space-y-2">
                <label for="file" class="block text-sm font-medium text-gray-700">File Surat</label>
                @if($suratMasuk->file)
                    <div>
                        <a href="{{ asset('storage/'. $suratMasuk->file) }}" target="_blank"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                            <i class="fas fa-file-pdf mr-2"></i>Lihat File Saat Ini
                        </a>
                    </div>
                @endif
                <input type="file" id="file" name="file" accept=".pdf,.doc,.docx"
                    @error('file') border-red-500 @enderror  
                    class="block w-full text-sm text-gray-700 file:border file:border-gray-300 file:rounded-lg file:py-2 file:px-4 file:text-sm file:bg-white file:hover:bg-gray-50">
                <p class="text-xs text-gray-500">Upload file baru jika ingin mengganti (PDF, DOC, DOCX - Max 5MB)</p>
                @error('file')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('admin.surat-masuk.index') }}"
                   class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
