@extends('layouts.admin')

@section('title', 'Edit Media')
@section('page-title', 'Edit Media')
@section('page-description', 'Ubah informasi dan file media')

@section('content')
    <div class="space-y-6">
        <!-- Form Edit -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900">Informasi Media</h3>
                <form action="{{ route('admin.media.update', $media->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Media -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-slate-700 mb-2">
                                Nama Media <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama', $media->nama) }}"
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
                            <select id="tipe" name="tipe"
                                class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                required>
                                <option value="">Pilih tipe media</option>
                                <option value="Foto" {{ old('tipe', $media->tipe) == 'Foto' ? 'selected' : '' }}>
                                    Foto
                                </option>
                                <option value="Video" {{ old('tipe', $media->tipe) == 'Video' ? 'selected' : '' }}>
                                    Video
                                </option>
                                <option value="Dokumen" {{ old('tipe', $media->tipe) == 'Dokumen' ? 'selected' : '' }}>
                                    Dokumen
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

                    <!-- File Saat Ini & Upload Baru -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- File Saat Ini -->
                        @if($media->file)
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">File Saat Ini</label>
                                <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
                                    @if($media->tipe === 'Foto')
                                        <div class="relative w-full h-48 mb-3">
                                            <img src="{{ asset('storage/' . $media->file) }}" alt="{{ $media->nama }}"
                                                class="w-full h-full object-cover rounded-lg shadow-sm">
                                            <div class="absolute top-2 right-2">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded-full">
                                                    <i class="fas fa-image mr-1 text-xs"></i>
                                                    Foto
                                                </span>
                                            </div>
                                        </div>
                                    @elseif($media->tipe === 'Video')
                                        <div class="relative w-full h-48 mb-3">
                                            <video controls class="w-full h-full object-cover rounded-lg shadow-sm">
                                                <source src="{{ asset('storage/' . $media->file) }}" type="video/mp4">
                                                Browser tidak mendukung video.
                                            </video>
                                            <div class="absolute top-2 right-2">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                                    <i class="fas fa-video mr-1 text-xs"></i>
                                                    Video
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-center space-x-4 mb-3">
                                            <div class="w-12 h-12 bg-violet-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-file-alt text-violet-600 text-lg"></i>
                                            </div>
                                            <div class="flex-1">
                                                <p class="font-medium text-slate-800 text-sm">{{ basename($media->file) }}</p>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 bg-violet-100 text-violet-800 text-xs font-medium rounded-full mt-1">
                                                    <i class="fas fa-file-alt mr-1 text-xs"></i>
                                                    {{ $media->tipe }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="flex items-center justify-between pt-3 border-t border-slate-200">
                                        <a href="{{ asset('storage/' . $media->file) }}" target="_blank"
                                            class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700 font-medium">
                                            <i class="fas fa-external-link-alt mr-2 text-xs"></i>
                                            Lihat File
                                        </a>
                                        <a href="{{ asset('storage/' . $media->file) }}" target="_blank" download
                                            class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700 font-medium">
                                            <i class="fas fa-download mr-2 text-xs"></i>
                                            Unduh
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Upload File Baru -->
                        <div>
                            <label for="file" class="block text-sm font-medium text-slate-700 mb-2">
                                File Media Baru
                            </label>
                            <div class="relative">
                                <input type="file" id="file" name="file" accept="image/*,video/*,.pdf,.doc,.docx" class="block w-full text-sm text-slate-700 bg-white border border-slate-300 rounded-lg cursor-pointer focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200
                                                            file:mr-4 file:py-2.5 file:px-4 file:border-0 file:text-sm file:font-medium file:bg-slate-50 file:text-slate-700 hover:file:bg-slate-100 file:rounded-l-lg
                                                        ">
                            </div>
                            <div class="mt-2 space-y-1">
                                <p class="text-xs text-slate-500 flex items-center">
                                    <i class="fas fa-info-circle mr-1 text-slate-400"></i>
                                    Kosongkan jika tidak ingin mengubah file
                                </p>
                                <div class="flex items-center gap-4">
                                    <p class="text-xs text-slate-500 flex items-center">
                                        <i class="fas fa-file-check mr-1 text-slate-400"></i>
                                        Format: JPG, PNG, GIF, MP4, AVI, MOV, PDF, DOC, DOCX
                                    </p>
                                    <p class="text-xs text-slate-500 flex items-center">
                                        <i class="fas fa-weight-hanging mr-1 text-slate-400"></i>
                                        Maksimal 10MB
                                    </p>
                                </div>
                            </div>
                            @error('file')
                                <p class="text-sm text-red-600 mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-2">
                            Deskripsi Media
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"
                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none"
                            placeholder="Deskripsikan media ini secara singkat...">{{ old('deskripsi', $media->deskripsi) }}</textarea>
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
                            <i class="fas fa-save mr-2 text-xs"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection