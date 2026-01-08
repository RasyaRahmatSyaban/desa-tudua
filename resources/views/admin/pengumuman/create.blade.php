@extends('layouts.admin')

@section('title', 'Tambah Pengumuman')
@section('page-title', 'Tambah Pengumuman')
@section('page-description', 'Buat pengumuman baru untuk masyarakat')

@section('content')
    <div class="space-y-6">
        <form method="POST" action="{{ route('admin.pengumuman.store') }}" class="space-y-6">
            @csrf

            <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Informasi Pengumuman</h3>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Judul -->
                            <div>
                                <label for="judul" class="block text-sm font-medium text-slate-700 mb-2">
                                    Judul Pengumuman <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                                    class="w-full px-4 py-3 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    placeholder="Masukkan judul pengumuman..." required>
                                @error('judul')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Konten -->
                            <div>
                                <label for="isi" class="block text-sm font-medium text-slate-700 mb-2">
                                    Isi Pengumuman <span class="text-red-500">*</span>
                                </label>
                                <textarea id="isi" name="isi" rows="12"
                                    class="w-full px-4 py-3 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none"
                                    placeholder="Tulis isi pengumuman secara lengkap dan jelas..."
                                    required>{{ old('isi') }}</textarea>
                                @error('isi')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-xs text-slate-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Tulis pengumuman dengan bahasa yang mudah dipahami masyarakat
                                </p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-slate-700 mb-2">
                                    Status Pengumuman
                                </label>
                                <select id="status" name="status"
                                    class="w-full px-4 py-3 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    <option value="Aktif" {{ old('status', 'Aktif') === 'Aktif' ? 'selected' : '' }}>
                                        <i class="fas fa-check-circle mr-2"></i>Aktif
                                    </option>
                                    <option value="Nonaktif" {{ old('status') === 'Nonaktif' ? 'selected' : '' }}>
                                        <i class="fas fa-pause-circle mr-2"></i>Nonaktif
                                    </option>
                                </select>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-xs text-slate-500">
                                    <i class="fas fa-lightbulb mr-1"></i>
                                    Pengumuman aktif akan ditampilkan di website
                                </p>
                            </div>

                            <!-- Berlaku Hingga -->
                            <div>
                                <label for="berlaku_hingga" class="block text-sm font-medium text-slate-700 mb-2">
                                    Berlaku Hingga
                                </label>
                                <div class="relative">
                                    <input type="date" id="berlaku_hingga" name="berlaku_hingga"
                                        value="{{ old('berlaku_hingga') }}"
                                        class="w-full px-4 py-3 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                </div>
                                @error('berlaku_hingga')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-4">
                <a href="{{ route('admin.pengumuman.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 hover:border-slate-400 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2 text-xs"></i>
                    Kembali
                </a>

                <div class="flex items-center space-x-3">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                        <i class="fas fa-bullhorn mr-2 text-xs"></i>
                        Publikasikan Pengumuman
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection