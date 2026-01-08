@extends('layouts.admin')

@section('title', 'Edit Dana Masuk')
@section('page-title', 'Edit Dana Masuk')
@section('page-description', 'Ubah data dana masuk yang sudah ada')

@section('content')
    <div class="space-y-6">
        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <form method="POST" action="{{ route('admin.dana-masuk.update', $danaMasuk->id) }}" class="">
                    @csrf
                    @method('PUT')

                    <!-- Periode Section -->
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="bulan" class="block text-sm font-medium text-slate-700">
                                    Bulan <span class="text-red-500">*</span>
                                </label>
                                <select id="bulan" name="bulan"
                                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    required>
                                    <option value="">-- Pilih Bulan --</option>
                                    @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $i => $bln)
                                        <option value="{{ $i + 1 }}" {{ old('bulan', $danaMasuk->bulan) == $i + 1 ? 'selected' : '' }}>
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
                                <input type="number" id="tahun" name="tahun"
                                    value="{{ old('tahun', $danaMasuk->tahun ?? date('Y')) }}" min="1900" max="2100"
                                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    required>
                                @error('tahun')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Detail Dana Section -->
                    <div class="pt-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="">
                                <label for="jumlah" class="block text-sm font-medium text-slate-700">
                                    Jumlah Dana <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number" id="jumlah" name="jumlah"
                                        value="{{ old('jumlah', $danaMasuk->jumlah) }}" placeholder="0" min="0" step="1000"
                                        class="w-full mt-4 py-2.5 px-4 border border-slate-300 rounded-lg text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                        required>
                                </div>
                                @error('jumlah')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="">
                                <label for="sumber" class="block text-sm font-medium text-slate-700">
                                    Sumber Dana <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    class="w-full mt-4 px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    @error('sumber') border-red-500 @enderror id="sumber" name="sumber"
                                    value="{{ old('sumber', $danaMasuk->sumber) }}" placeholder="Contoh: APBD, Bantuan Pemerintah, dll"
                                    required>
                                @error('sumber')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                                @error('sumber')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan Section -->
                    <div class="space-y-4 pt-6">
                        <div class="space-y-2">
                            <label for="keterangan" class="block text-sm font-medium text-slate-700">
                                Detail Keterangan
                            </label>
                            <textarea id="keterangan" name="keterangan" rows="4"
                                placeholder="Jelaskan detail sumber dana masuk, tujuan penggunaan, dan informasi penting lainnya..."
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none">{{ old('keterangan', $danaMasuk->keterangan) }}</textarea>
                            @error('keterangan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-slate-500">Maksimum 500 karakter</p>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3 pt-6">
                        <a href="{{ route('admin.dana-masuk.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 hover:border-slate-400 transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2 text-xs"></i>
                            Kembali
                        </a>

                        <div class="flex gap-3">
                            <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-amber-600 border border-amber-600 rounded-lg hover:bg-amber-700 hover:border-amber-700 transition-colors duration-200 shadow-sm">
                                <i class="fas fa-save mr-2 text-xs"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection