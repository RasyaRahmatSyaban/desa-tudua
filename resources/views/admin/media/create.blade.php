@extends('layouts.admin')

@section('title', 'Upload Media')
@section('page-title', 'Upload Media')
@section('page-description', 'Tambah media baru ke dalam sistem')

@section('content')
    <div class="space-y-6">
        <!-- Form Upload -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900">Informasi Media</h3>
                <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Media -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-slate-700 mb-2">
                                Nama Media <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                placeholder="Contoh: Musyawah Besar 2025" required>
                            @error('nama')
                                <p class="text-sm text-red-600 mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Tipe Media -->
                        <div>
                            <label for="tipe" class="block text-sm font-medium text-slate-700 mb-2">
                                Tipe Media <span class="text-red-500">*</span>
                            </label>
                            <select name="tipe" id="tipe"
                                class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                required>
                                <option value="">Pilih tipe media</option>
                                <option value="Foto" {{ old('tipe') == 'Foto' ? 'selected' : '' }}>
                                    <i class="fas fa-image"></i> Foto
                                </option>
                                <option value="Video" {{ old('tipe') == 'Video' ? 'selected' : '' }}>
                                    <i class="fas fa-video"></i> Video
                                </option>
                                <option value="Dokumen" {{ old('tipe') == 'Dokumen' ? 'selected' : '' }}>
                                    <i class="fas fa-file-alt"></i> Dokumen
                                </option>
                            </select>
                            @error('tipe')
                                <p class="text-sm text-red-600 mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div>
                        <label for="file" class="block text-sm font-medium text-slate-700 mb-2">
                            File Media <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="file" id="file" name="file" accept="image/*,video/*,.pdf,.doc,.docx" class="block w-full text-sm text-slate-700 bg-white border border-slate-300 rounded-lg cursor-pointer focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200
                                                        file:mr-4 file:py-2.5 file:px-4 file:border-0 file:text-sm file:font-medium file:bg-slate-50 file:text-slate-700 hover:file:bg-slate-100 file:rounded-l-lg
                                                    " required>
                        </div>
                        <div class="mt-2 flex items-center gap-4">
                            <p class="text-xs text-slate-500 flex items-center">
                                <i class="fas fa-info-circle mr-1 text-slate-400"></i>
                                Format: JPG, PNG, GIF, MP4, AVI, MOV, PDF, DOC, DOCX
                            </p>
                            <p class="text-xs text-slate-500 flex items-center">
                                <i class="fas fa-weight-hanging mr-1 text-slate-400"></i>
                                Maksimal 10MB
                            </p>
                        </div>
                        @error('file')
                            <p class="text-sm text-red-600 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-2">
                            Deskripsi Media
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"
                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none"
                            placeholder="Deskripsikan media ini secara singkat...">{{ old('deskripsi') }}</textarea>
                        <p class="text-xs text-slate-500 mt-1 flex items-center">
                            <i class="fas fa-lightbulb mr-1 text-slate-400"></i>
                            Opsional: Berikan deskripsi untuk memudahkan pencarian
                        </p>
                        @error('deskripsi')
                            <p class="text-sm text-red-600 mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-6 border-t border-slate-200">
                        <a href="{{ route('admin.media.index') }}"
                            class="inline-flex items-center justify-center px-6 py-2.5 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 hover:border-slate-400 transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2 text-xs"></i>
                            Kembali
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                            <i class="fas fa-upload mr-2 text-xs"></i>
                            Upload Media
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection