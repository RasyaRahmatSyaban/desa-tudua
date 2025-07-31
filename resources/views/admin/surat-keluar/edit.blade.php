@extends('layouts.admin')

@section('title', 'Edit Surat Keluar')
@section('page-title', 'Edit Surat Keluar')
@section('page-description', 'Ubah informasi surat keluar yang sudah ada')

@section('content')
    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Form Edit Surat Keluar</h3>

            <form action="{{ route('admin.surat-keluar.update', $suratKeluar->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nomor Surat -->
                    <div>
                        <label for="nomor_surat" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Surat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nomor_surat" name="nomor_surat"
                            value="{{ old('nomor_surat', $suratKeluar->nomor_surat) }}"
                            class="w-full px-4 py-3 border rounded-lg @error('nomor_surat') border-red-500 @enderror"
                            required>
                        @error('nomor_surat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Penerima -->
                    <div>
                        <label for="penerima" class="block text-sm font-medium text-gray-700 mb-2">
                            Penerima <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="penerima" name="penerima"
                            value="{{ old('penerima', $suratKeluar->penerima) }}"
                            class="w-full px-4 py-3 border rounded-lg @error('penerima') border-red-500 @enderror" required>
                        @error('penerima')
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
                        <input type="text" id="perihal" name="perihal" value="{{ old('perihal', $suratKeluar->perihal) }}"
                            class="w-full px-4 py-3 border rounded-lg @error('perihal') border-red-500 @enderror" required>
                        @error('perihal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Kirim -->
                    <div>
                        <label for="tanggal_kirim" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Kirim <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tanggal_kirim" name="tanggal_kirim"
                            value="{{ old('tanggal_kirim', $suratKeluar->tanggal_kirim ? \Carbon\Carbon::parse($suratKeluar->tanggal_kirim)->format('Y-m-d') : '') }}"
                            class="w-full px-4 py-3 border rounded-lg @error('tanggal_kirim') border-red-500 @enderror"
                            required>
                        @error('tanggal_kirim')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- File -->
                <div class="space-y-2">
                    <label for="file" class="block text-sm font-medium text-gray-700">File Surat</label>
                    @if($suratKeluar->file)
                        <div>
                            <a href="{{ asset('storage/' . $suratKeluar->file) }}" target="_blank"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                <i class="fas fa-file-pdf mr-2"></i>Lihat File Saat Ini
                            </a>
                        </div>
                    @endif
                    <input type="file" id="file" name="file" accept=".pdf,.doc,.docx"
                        class="block w-full text-sm text-gray-700 file:border file:border-gray-300 file:rounded-lg file:py-2 file:px-4 file:text-sm file:bg-white file:hover:bg-gray-50 @error('file') border-red-500 @enderror">
                    <p class="text-xs text-gray-500">Upload file baru jika ingin mengganti (PDF, DOC, DOCX - Max 5MB)</p>
                    @error('file')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('admin.surat-keluar.index') }}"
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