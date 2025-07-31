@extends('layouts.admin')

@section('title', 'Edit Data Penduduk')
@section('page-title', 'Edit Data Penduduk')
@section('page-description', 'Ubah data penduduk yang sudah ada')

@section('content')
    <div class="space-y-6">
        <form method="POST" action="{{ route('admin.penduduk.update', $penduduk->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Data Pribadi -->
            <div class="card bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Data Pribadi</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">
                            NIK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nik" name="nik" value="{{ old('nik', $penduduk->nik) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('nik') border-red-500 @enderror placeholder="Masukkan NIK (16 digit)" maxlength="16"
                            required>
                        @error('nik')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $penduduk->nama) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('nama') border-red-500 @enderror placeholder="Masukkan nama lengkap" required>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('jenis_kelamin') border-red-500 @enderror required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2">
                            Tempat Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir"
                            value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('tempat_lahir') border-red-500 @enderror placeholder="Masukkan tempat lahir" required>
                        @error('tempat_lahir')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                            value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir ? \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('Y-m-d') : '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('tanggal_lahir') border-red-500 @enderror required>
                        @error('tanggal_lahir')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Agama -->
                    <div>
                        <label for="agama" class="block text-sm font-medium text-gray-700 mb-2">
                            Agama <span class="text-red-500">*</span>
                        </label>
                        <select id="agama" name="agama"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('agama') border-red-500 @enderror required>
                            <option value="">Pilih Agama</option>
                            <option value="Islam" {{ old('agama', $penduduk->agama) === 'Islam' ? 'selected' : '' }}>Islam
                            </option>
                            <option value="Kristen" {{ old('agama', $penduduk->agama) === 'Kristen' ? 'selected' : '' }}>
                                Kristen</option>
                            <option value="Katolik" {{ old('agama', $penduduk->agama) === 'Katolik' ? 'selected' : '' }}>
                                Katolik</option>
                            <option value="Hindu" {{ old('agama', $penduduk->agama) === 'Hindu' ? 'selected' : '' }}>Hindu
                            </option>
                            <option value="Buddha" {{ old('agama', $penduduk->agama) === 'Buddha' ? 'selected' : '' }}>Buddha
                            </option>
                            <option value="Konghucu" {{ old('agama', $penduduk->agama) === 'Konghucu' ? 'selected' : '' }}>
                                Konghucu</option>
                        </select>
                        @error('agama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dropdown Pilih kepala -->
                    <div>
                        <div id="kepalaKeluargaSelectWrapper" style="{{ old('isKepalaKeluarga') ? 'display:none;' : '' }}">
                            <label for="id_kepalakeluarga" class="block text-sm font-medium text-gray-700 mb-2">
                                Kepala Keluarga <span class="text-red-500">*</span>
                            </label>
                            <select name="id_kepalakeluarga" id="id_kepalakeluarga"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                @error('id_kepalakeluarga') border-red-500 @enderror>
                                <option value="" class="text-gray-400">Pilih Kepala Keluarga</option>
                                @foreach($listKepalaKeluarga as $k)
                                    <option value="{{ $k->id }}" {{ old('id_kepalakeluarga', $penduduk->id_kepalakeluarga) == $k->id ? 'selected' : '' }} class="text-gray-700 py-2">
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kepalakeluarga')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nomor KK -->
                        <div id="nomorKKSelectWrapper" style="{{ old('isKepalaKeluarga') ? '' : 'display:none;' }}">
                            <label for="nomorKK" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Kartu Keluarga <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nomorKK" name="nomorKK"
                                value="{{ old('nomorKK', $penduduk->kepalaKeluarga->nomor_kk) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                @error('nomorKK') border-red-500 @enderror
                                placeholder="Masukkan Nomor Kartu Keluarga (16 digit)" maxlength="16" required>
                            @error('nomorKK')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Checkbox -->
                        <div class="mt-4">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="isKepalaKeluarga" id="isKepalaKeluarga" value="1"
                                    class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500" {{ old('isKepalaKeluarga') ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">Kepala Keluarga</span>
                            </label>
                            @error('isKepalaKeluarga')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $penduduk->alamat) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            @error('alamat') border-red-500 @enderror placeholder="Masukkan alamat lengkap" required>
                        @error('alamat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.penduduk.index') }}"
                    class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>

                <button type="submit" class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('isKepalaKeluarga');
            const kepKelWrapper = document.getElementById('kepalaKeluargaSelectWrapper');
            const nomorKKWrapper = document.getElementById('nomorKKSelectWrapper');
            const nomorKKInput = document.getElementById('nomorKK');

            function toggleKepalaKeluarga() {
                if (checkbox.checked) {
                    kepKelWrapper.style.display = 'none';
                    nomorKKWrapper.style.display = 'block';
                    nomorKKInput.setAttribute('required', 'required');
                } else {
                    kepKelWrapper.style.display = 'block';
                    nomorKKWrapper.style.display = 'none';
                    nomorKKInput.removeAttribute('required');
                }
            }

            // Trigger saat halaman dimuat
            toggleKepalaKeluarga();

            // Trigger saat checkbox berubah
            checkbox.addEventListener('change', toggleKepalaKeluarga);
        });
    </script>
@endsection