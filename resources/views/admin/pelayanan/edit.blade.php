@extends('layouts.admin')

@section('title', 'Edit Pelayanan')
@section('page-title', 'Edit Pelayanan')
@section('page-description', 'Ubah data pelayanan yang sudah ada')

@section('content')
    <div class="space-y-6">
        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <div class="flex items-center space-x-3 mb-6 pb-6 border-b border-slate-200">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Edit Pelayanan</h3>
                    </div>
                </div>

                <form action="{{ route('admin.pelayanan.update', $pelayanan->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Layanan -->
                        <div>
                            <label for="nama_layanan" class="block text-sm font-medium text-slate-700 mb-2">
                                Nama Layanan
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_layanan" id="nama_layanan"
                                value="{{ old('nama_layanan', $pelayanan->nama_layanan) }}"
                                class="w-full px-4 py-3 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                placeholder="Contoh: Surat Keterangan Tidak Mampu" required>
                            @error('nama_layanan')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-slate-700 mb-2">
                                Kategori
                                <span class="text-red-500">*</span>
                            </label>
                            <select name="kategori" id="kategori"
                                class="w-full px-4 py-3 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                required>
                                <option value="">Pilih Kategori</option>
                                <option value="Dokumen Identitas" {{ old('kategori', $pelayanan->kategori) == 'Dokumen Identitas' ? 'selected' : '' }}>
                                    Dokumen Identitas
                                </option>
                                <option value="Kependudukan" {{ old('kategori', $pelayanan->kategori) == 'Kependudukan' ? 'selected' : '' }}>
                                    Kependudukan
                                </option>
                                <option value="Pencatatan Sipil" {{ old('kategori', $pelayanan->kategori) == 'Pencatatan Sipil' ? 'selected' : '' }}>
                                    Pencatatan Sipil
                                </option>
                                <option value="Kesejahteraan Sosial" {{ old('kategori', $pelayanan->kategori) == 'Kesejahteraan Sosial' ? 'selected' : '' }}>
                                    Kesejahteraan Sosial
                                </option>
                                <option value="Pendidikan" {{ old('kategori', $pelayanan->kategori) == 'Pendidikan' ? 'selected' : '' }}>
                                    Pendidikan
                                </option>
                                <option value="Lainnya" {{ old('kategori', $pelayanan->kategori) == 'Lainnya' ? 'selected' : '' }}>
                                    Lainnya
                                </option>
                            </select>
                            @error('kategori')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Link Google Form -->
                        <div>
                            <label for="link_google_form" class="block text-sm font-medium text-slate-700 mb-2">
                                Link Google Form
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="url" name="link_google_form" id="link_google_form"
                                    value="{{ old('link_google_form', $pelayanan->link_google_form) }}"
                                    class="w-full pl-10 pr-4 py-3 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    placeholder="https://forms.gle/NFXpo5LaqTK9xrYE7" required>
                                <i class="fas fa-link absolute left-3 top-3.5 text-slate-400 text-sm"></i>
                            </div>
                            @error('link_google_form')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-2 text-xs text-slate-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Pastikan link dapat diakses oleh publik
                            </p>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-2">
                                Deskripsi
                            </label>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                class="w-full px-4 py-3 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none"
                                placeholder="Deskripsikan pelayanan ini secara singkat dan jelas...">{{ old('deskripsi', $pelayanan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1 text-xs"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-6 border-t border-slate-200">
                        <a href="{{ route('admin.pelayanan.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 hover:border-slate-400 transition-colors duration-200">
                            <i class="fas fa-times mr-2"></i>
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2.5 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection