@extends('layouts.admin')

@section('title', 'Edit Perangkat Desa')
@section('page-title', 'Edit Perangkat Desa')
@section('page-description', 'Ubah informasi perangkat desa yang sudah ada')

@section('content')
    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('admin.perangkat-desa.update', $perangkatDesa->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $perangkatDesa->nama) }}"
                            class="w-full px-4 py-3 border rounded-lg @error('nama') border-red-500 @enderror" required>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIP -->
                    <div>
                        <label for="nip" class="block text-sm font-medium text-gray-700 mb-2">NIP</label>
                        <input type="text" id="nip" name="nip" value="{{ old('nip', $perangkatDesa->nip) }}"
                            class="w-full px-4 py-3 border rounded-lg @error('nip') border-red-500 @enderror">
                        @error('nip')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Foto -->
                    <div>
                        <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
                        <input type="file" id="foto" name="foto" accept="image/*"
                            class="block w-full text-sm text-gray-700 file:border file:border-gray-300 file:rounded-lg file:py-2 file:px-4 file:text-sm file:bg-white file:hover:bg-gray-50 @error('foto') border-red-500 @enderror">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah. Format: JPG, PNG (Max:
                            2MB)</p>
                        @error('foto')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror

                        @if ($perangkatDesa->foto)
                            <div class="mt-4">
                                <img src="{{ Storage::url($perangkatDesa->foto) }}" alt="{{ $perangkatDesa->nama }}"
                                    class="w-32 h-32 object-cover rounded border border-gray-300">
                            </div>
                        @endif
                    </div>
                    <!-- Jabatan -->
                    <div>
                        <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                            Jabatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan', $perangkatDesa->jabatan) }}"
                            placeholder="Kepala Desa" required
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jabatan') border-red-500 @enderror">
                        @error('jabatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('admin.perangkat-desa.index') }}"
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