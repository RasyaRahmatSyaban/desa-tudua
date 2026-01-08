@extends('layouts.admin')

@section('title', 'Tambah Surat Keluar')
@section('page-title', 'Tambah Surat Keluar')
@section('page-description', 'Form untuk menambahkan surat keluar baru')

@section('content')
    <div class="space-y-6">
        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <form action="{{ route('admin.surat-keluar.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                <!-- Main Content Card -->
                <div class="card bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Informasi Surat</h3>
                    @csrf

                    <!-- Basic Information -->
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nomor_surat" class="block text-sm font-medium text-slate-700 mb-2">
                                    Nomor Surat <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text"
                                        class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                        id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}"
                                        placeholder="Contoh: 001/KEL/2024" required>
                                    <i class="fas fa-hashtag absolute left-3 top-3.5 text-slate-400 text-sm"></i>
                                </div>
                                @error('nomor_surat')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="tanggal_kirim" class="block text-sm font-medium text-slate-700 mb-2">
                                    Tanggal Kirim <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="date"
                                        class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                        id="tanggal_kirim" name="tanggal_kirim" value="{{ old('tanggal_kirim') }}" required>
                                    <i class="fas fa-calendar absolute left-3 top-3.5 text-slate-400 text-sm"></i>
                                </div>
                                @error('tanggal_kirim')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Detail Information -->
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="pt-6">
                                <label for="perihal" class="block text-sm font-medium text-slate-700 mb-2">
                                    Perihal <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text"
                                        class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                        id="perihal" name="perihal" value="{{ old('perihal') }}"
                                        placeholder="Perihal/subjek surat" required>
                                    <i class="fas fa-file-alt absolute left-3 top-3.5 text-slate-400 text-sm"></i>
                                </div>
                                @error('perihal')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="pt-6">
                                <label for="penerima" class="block text-sm font-medium text-slate-700 mb-2">
                                    Penerima <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text"
                                        class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                        id="penerima" name="penerima" value="{{ old('penerima') }}"
                                        placeholder="Nama instansi/organisasi penerima" required>
                                    <i class="fas fa-building absolute left-3 top-3.5 text-slate-400 text-sm"></i>
                                </div>
                                @error('penerima')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="pt-6">
                                <label for="file" class="block text-sm font-medium text-slate-700 mb-2">
                                    File Surat <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="file"
                                        class="w-full px-4 py-3 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                        id="file" name="file" accept=".pdf,.doc,.docx">
                                </div>
                                <div class="mt-2 flex items-center text-xs text-slate-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    <span>Format: PDF, DOC, DOCX • Maksimal 5MB</span>
                                </div>
                                @error('file')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end space-x-3 pt-6">
                        <a href="{{ route('admin.surat-keluar.index') }}"
                            class="inline-flex items-center px-4 py-2.5 border border-slate-300 rounded-lg text-slate-700 text-sm font-medium hover:bg-slate-50 transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2 text-xs"></i>
                            Kembali
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                            <i class="fas fa-save mr-2 text-xs"></i>
                            Simpan Surat
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection