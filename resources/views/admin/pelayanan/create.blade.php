@extends('layouts.admin')

@section('title', 'Tambah Pelayanan')
@section('page-title', 'Tambah Pelayanan')
@section('page-description', 'Tambah data pelayanan baru')

@section('content')
    <div class="space-y-6">
        <form action="{{ route('admin.pelayanan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="card bg-white rounded-lg shadow-md p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label for="nama_layanan" class="block text-sm font-medium text-gray-700 mb-2">Nama Layanan <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama_layanan" id="nama_layanan" value="{{ old('nama_layanan') }}"
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('nama_layanan') border-red-500 @enderror placeholder="Surat Keterangan Tidak Mampu"
                            required>
                        @error('nama_layanan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="kategori" id="kategori" @error('kategori') border-red-500 @enderror
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                            <option value="">Pilih Kategori</option>
                            <option value="Dokumen Identitas" {{ old('kategori') == 'Dokumen Identitas' ? 'selected' : '' }}>
                                Dokumen Identitas</option>
                            <option value="Kependudukan" {{ old('kategori') == 'Kependudukan' ? 'selected' : '' }}>
                                Kependudukan</option>
                            <option value="Pencatatan Sipil" {{ old('kategori') == 'Pencatatan Sipil' ? 'selected' : '' }}>
                                Pencatatan Sipil</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Link -->
                    <div>
                        <label for="link_google_form" class="block text-sm font-medium text-gray-700 mb-2">Link Google
                            Form<span class="text-red-500">*</span></label>
                        <input type="text" name="link_google_form" id="link_google_form"
                            value="{{ old('link_google_form') }}"
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('link_google_form') border-red-500 @enderror
                            placeholder="https://forms.gle/NFXpo5LaqTK9xrYE7" required>
                        @error('link_google_form')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi" value="{{ old('deskripsi') }}"
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('deskripsi') border-red-500 @enderror placeholder="Layanan ini merupakan layanan"
                            required>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

            </div>
            <!-- Tombol -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('admin.pelayanan.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection