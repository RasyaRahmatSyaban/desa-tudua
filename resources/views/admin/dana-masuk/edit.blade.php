@extends('layouts.admin')

@section('title', 'Edit Dana Masuk')
@section('page-title', 'Edit Dana Masuk')
@section('page-description', 'Ubah data dana masuk yang sudah ada')

@section('content')
    <div class="space-y-6">
        <form method="POST" action="{{ route('admin.dana-masuk.update', $danaMasuk->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="card bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Informasi Dana Masuk</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tanggal -->
                    <div>
                        <label for="bulan" class="block text-sm font-medium text-gray-700 mb-2">
                            Bulan <span class="text-red-500">*</span>
                        </label>
                        <select id="bulan" name="bulan"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('bulan') border-red-500 @enderror required>
                            <option value="">-- Pilih Bulan --</option>
                            @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $i => $bln)
                                <option value="{{ $i + 1 }}" {{ old('bulan', $danaMasuk->bulan) == $i + 1 ? 'selected' : '' }}>
                                    {{ $bln }}
                                </option>
                            @endforeach
                        </select>
                        @error('bulan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">
                            Tahun <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="tahun" name="tahun"
                            value="{{ old('tahun', $danaMasuk->tahun ?? date('Y')) }}" min="1900" max="2100"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('tahun') border-red-500 @enderror required>
                        @error('tahun')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah -->
                    <div>
                        <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-2">
                            Jumlah (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $danaMasuk->jumlah) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('jumlah') border-red-500 @enderror placeholder="Masukkan jumlah dana" min="0" step="1000"
                            required>
                        @error('jumlah')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- sumber -->
                    <div>
                        <label for="sumber" class="block text-sm font-medium text-gray-700 mb-2">
                            Sumber Dana <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('sumber') border-red-500 @enderror id="sumber" name="sumber"
                            value="{{ old('sumber', $danaMasuk->sumber) }}"
                            placeholder="Contoh: APBD, Bantuan Pemerintah, dll" required>
                        @error('sumber')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="mt-6">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                        Keterangan
                    </label>
                    <textarea id="keterangan" name="keterangan" rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        @error('keterangan') border-red-500 @enderror
                        placeholder="Keterangan tambahan (opsional)">{{ old('keterangan', $danaMasuk->keterangan) }}</textarea>
                    @error('keterangan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.dana-masuk.index') }}"
                    class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>

                <button type="submit" class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection