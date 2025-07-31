@extends('layouts.admin')

@section('title', 'Tambah Perangkat Desa')

@section('content')
    <div class="space-y-6">

        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Form Tambah Perangkat Desa</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.perangkat-desa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                @error('nama') border-red-500 @enderror id="nama" name="nama" value="{{ old('nama') }}"
                                placeholder="Rasya S. Kom" required>
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="nip" class="block text-sm font-medium text-gray-700 mb-2">
                                NIP<span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                @error('nip') border-red-500 @enderror id="nip" name="nip" placeholder="67843"
                                value="{{ old('nip') }}">
                            @error('nip')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
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
                        </div>
                        <div>
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                                Foto<span class="text-red-500">*</span>
                            </label>
                            <input type="file"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                @error('foto') border-red-500 @enderror id="foto" name="foto" accept="image/*">
                            <p class="mt-1 text-sm text-gray-500">Upload foto maksimal 2MB (JPG, PNG)</p>
                            @error('foto')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-4 mt-8">
                        <a href="{{ route('admin.perangkat-desa.index') }}"
                            class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                </path>
                            </svg>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection