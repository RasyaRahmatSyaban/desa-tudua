@extends('layouts.admin')

@section('title', 'Upload Media')

@section('content')
    <div class="space-y-6">


        <!-- Form Upload -->
        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Media -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Media <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                            class="w-full px-4 py-3 border rounded-lg" @error('nama') border-red-500 @enderror
                            placeholder="Musyawah Besar 2025" required>
                        @error('nama')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="tipe" class="block text-sm font-medium text-gray-700 mb-2">Tipe <span
                                class="text-red-500">*</span></label>
                        <select name="tipe" id="tipe"
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('tipe') border-red-500 @enderror required>
                            <option value="">Pilih tipe</option>
                            <option value="Foto" {{ old('tipe') == 'Foto' ? 'selected' : '' }}>Foto</option>
                            <option value="Video" {{ old('tipe') == 'Video' ? 'selected' : '' }}>Video</option>
                            <option value="Dokumen" {{ old('tipe') == 'Dokumen' ? 'selected' : '' }}>Dokumen</option>
                        </select>
                        @error('tipe')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Upload -->
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">File Media <span
                                class="text-red-500">*</span></label>
                        <input type="file" id="file" name="file" accept="image/*,video/*,.pdf,.doc.docx"
                            class="block w-full text-sm text-gray-700 file:border file:border-gray-300 file:rounded-lg file:py-2 file:px-4 file:text-sm file:bg-white file:hover:bg-gray-50"
                            @error('file') border-red-500 @enderror required>
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF, MP4, AVI, MOV. Maksimal 10MB.</p>
                        @error('file')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="w-full px-4 py-3 border rounded-lg"
                            @error('deskripsi') border-red-500 @enderror
                            placeholder="Deskripsikan media ini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
        </div>
        <!-- Buttons -->
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.media.index') }}"
                class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition">
                <i class="fas fa-times mr-2"></i>Batal
            </a>
            <button type="submit"
                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
                <i class="fas fa-upload mr-2"></i>Upload
            </button>
        </div>
        </form>
    </div>
@endsection