@extends('layouts.admin')

@section('title', 'Tambah Dana Keluar')
@section('page-title', 'Tambah Dana Keluar')
@section('page-description', 'Tambah data dana keluar baru')

@section('content')
    <div class="space-y-6">
        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <form action="{{ route('admin.dana-keluar.store') }}" method="POST" class="">
                    @csrf

                    <!-- Periode Section -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-slate-800 uppercase tracking-wider">Informasi Dana Keluar</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="bulan" class="block text-sm font-medium text-slate-700">
                                    Bulan <span class="text-red-500">*</span>
                                </label>
                                <select id="bulan" name="bulan"
                                    class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    required>
                                    <option value="">Pilih Bulan</option>
                                    @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $i => $bln)
                                        <option value="{{ $i + 1 }}" {{ old('bulan') == $i + 1 ? 'selected' : '' }}>
                                            {{ $bln }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('bulan')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="tahun" class="block text-sm font-medium text-slate-700">
                                    Tahun <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="tahun" name="tahun" value="{{ old('tahun', date('Y')) }}"
                                    min="1900" max="2100"
                                    class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    required>
                                @error('tahun')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Detail Dana Section -->
                    <div class="space-y-4 pt-6">
                        <h3 class="text-sm font-semibold text-slate-800 uppercase tracking-wider">Detail Dana</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="jumlah" class="block text-sm font-medium text-slate-700">
                                    Jumlah Dana <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-slate-500 text-sm font-medium">Rp</span>
                                    </div>
                                    <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah') }}"
                                        placeholder="0" required
                                        class="w-full pl-12 pr-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                </div>
                                @error('jumlah')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="kategori" class="block text-sm font-medium text-slate-700">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select id="kategori" name="kategori"
                                    class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Pembangunan" {{ old('kategori') == 'Pembangunan' ? 'selected' : '' }}>
                                        <i class="fas fa-hammer"></i> Pembangunan
                                    </option>
                                    <option value="Operasional" {{ old('kategori') == 'Operasional' ? 'selected' : '' }}>
                                        Operasional
                                    </option>
                                    <option value="Sosial" {{ old('kategori') == 'Sosial' ? 'selected' : '' }}>
                                        Sosial
                                    </option>
                                    <option value="Kesehatan" {{ old('kategori') == 'Kesehatan' ? 'selected' : '' }}>
                                        Kesehatan
                                    </option>
                                    <option value="Pendidikan" {{ old('kategori') == 'Pendidikan' ? 'selected' : '' }}>
                                        Pendidikan
                                    </option>
                                    <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya
                                    </option>
                                </select>
                                @error('kategori')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan Section -->
                    <div class="space-y-4 pt-6">
                        <h3 class="text-sm font-semibold text-slate-800 uppercase tracking-wider">Keterangan</h3>
                        <div class="space-y-2">
                            <label for="keterangan" class="block text-sm font-medium text-slate-700">
                                Detail Keterangan <span class="text-red-500">*</span>
                            </label>
                            <textarea id="keterangan" name="keterangan" rows="4"
                                placeholder="Jelaskan detail pengeluaran dana, tujuan penggunaan, dan informasi penting lainnya..."
                                class="w-full px-4 py-3 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none"
                                required>{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-slate-500">Minimum 10 karakter, maksimum 500 karakter</p>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3 pt-6">
                        <a href="{{ route('admin.dana-keluar.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 hover:border-slate-400 transition-colors duration-200">
                            <i class="fas fa-times mr-2 text-xs"></i>
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 hover:border-blue-700 transition-colors duration-200 shadow-sm">
                            <i class="fas fa-save mr-2 text-xs"></i>
                            Simpan Dana Keluar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection