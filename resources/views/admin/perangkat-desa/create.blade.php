@extends('layouts.admin')

@section('title', 'Tambah Perangkat Desa')
@section('page-title', 'Tambah Perangkat Desa')
@section('page-description', 'Tambah data perangkat desa baru')

@section('content')
    <div class="space-y-6">
        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="pt-6 px-6">
                <div class="flex items-center space-x-3">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Form Tambah Perangkat Desa</h3>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.perangkat-desa.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-slate-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                                class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                placeholder="Masukkan nama lengkap">
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                                Jabatan<span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                @error('jabatan') border-red-500 @enderror id="jabatan" name="jabatan"
                                value="{{ old('jabatan') }}" placeholder="Kepala Desa" required>
                            @error('jabatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('jabatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIP -->
                        <div>
                            <label for="nip" class="block text-sm font-medium text-slate-700 mb-2">
                                NIP
                            </label>
                            <input type="text" id="nip" name="nip" value="{{ old('nip') }}"
                                class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                placeholder="Masukkan NIP (opsional)">
                            @error('nip')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <!-- Foto Upload -->
                        <label for="foto" class="block text-sm font-medium text-slate-700 mb-2">
                            Foto Perangkat Desa
                        </label>
                        <div
                            class="flex justify-center items-center px-6 pt-14 pb-18 border-2 border-slate-300 border-dashed rounded-lg hover:border-slate-400 transition-colors duration-200">
                            <div class="space-y-1 text-center">
                                <div id="image-preview" class="hidden">
                                    <img id="preview-img" src="" alt="Preview"
                                        class="mx-auto h-32 w-32 object-cover rounded-lg">
                                </div>
                                <div id="upload-placeholder">
                                    <i class=" fas fa-camera mx-auto h-12 w-12 text-slate-400 text-4xl mb-4"></i>
                                    <div class="flex text-sm text-slate-600">
                                        <label for="foto"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span>Upload foto</span>
                                            <input id="foto" name="foto" type="file" class="sr-only" accept="image/*">
                                        </label>
                                        <p class="pl-1">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-slate-500">PNG, JPG, JPEG hingga 2MB</p>
                                </div>
                            </div>
                        </div>
                        @error('foto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div
                    class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3 mt-8 pt-6 border-t border-slate-200">
                    <a href="{{ route('admin.perangkat-desa.index') }}"
                        class="inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2 text-xs"></i>
                        Kembali
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 shadow-sm">
                        <i class="fas fa-save mr-2 text-xs"></i>
                        Simpan Perangkat Desa
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('foto').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                    document.getElementById('upload-placeholder').classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection