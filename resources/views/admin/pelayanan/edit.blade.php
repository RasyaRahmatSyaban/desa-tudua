@extends('layouts.admin')

@section('title', 'Edit Pelayanan')
@section('page-title', 'Edit Pelayanan')
@section('page-description', 'Ubah data pelayanan yang sudah ada')

@section('content')
    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('admin.pelayanan.update', $pelayanan->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Layanan -->
                    <div>
                        <label for="nama_layanan" class="block text-sm font-medium text-gray-700 mb-2">Nama Layanan <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama_layanan" id="nama_layanan"
                            value="{{ old('nama_layanan', $pelayanan->nama_layanan) }}"
                            class="w-full px-4 py-3 border rounded-lg @error('nama_layanan') border-red-500 @enderror"
                            required>
                        @error('nama_layanan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="kategori" id="kategori"
                            class="w-full px-4 py-3 border rounded-lg @error('kategori') border-red-500 @enderror" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Dokumen Identitas" {{ old('kategori', $pelayanan->kategori) == 'Dokumen Identitas' ? 'selected' : '' }}>Dokumen Identitas</option>
                            <option value="Kependudukan" {{ old('kategori', $pelayanan->kategori) == 'Kependudukan' ? 'selected' : '' }}>Kependudukan</option>
                            <option value="Pencatatan Sipil" {{ old('kategori', $pelayanan->kategori) == 'Pencatatan Sipil' ? 'selected' : '' }}>Pencatatan Sipil</option>
                            <option value="Kesejahteraan Sosial" {{ old('kategori', $pelayanan->kategori) == 'Kesejahteraan Sosial' ? 'selected' : '' }}>Kesejahteraan Sosial</option>
                            <option value="Pendidikan" {{ old('kategori', $pelayanan->kategori) == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                            <option value="Lainnya" {{ old('kategori', $pelayanan->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Link Google Form -->
                    <div>
                        <label for="link_google_form" class="block text-sm font-medium text-gray-700 mb-2">Link Google Form
                            <span class="text-red-500">*</span></label>
                        <input type="text" name="link_google_form" id="link_google_form"
                            value="{{ old('link_google_form', $pelayanan->link_google_form) }}"
                            class="w-full px-4 py-3 border rounded-lg @error('link_google_form') border-red-500 @enderror"
                            required>
                        @error('link_google_form')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi"
                            value="{{ old('deskripsi', $pelayanan->deskripsi) }}"
                            class="w-full px-4 py-3 border rounded-lg @error('deskripsi') border-red-500 @enderror"
                            required>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end gap-4 pt-4">
                    <a href="{{ route('admin.pelayanan.index') }}"
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