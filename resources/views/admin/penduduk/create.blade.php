@extends('layouts.admin')

@section('title', 'Tambah Data Penduduk')
@section('page-title', 'Tambah Data Penduduk')
@section('page-description', 'Input data penduduk baru')

@section('content')
    <div class="space-y-6">
        <form method="POST" action="{{ route('admin.penduduk.store') }}" class="space-y-6">
            @csrf

            <!-- Data Pribadi -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-6 flex items-center">
                    Data Penduduk
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-medium text-slate-700 mb-2">
                            NIK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nik" name="nik" value="{{ old('nik') }}"
                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 {{ $errors->has('nik') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                            placeholder="Masukkan NIK (16 digit)" maxlength="16" required>
                        @error('nik')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-slate-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 {{ $errors->has('nama') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                            placeholder="Masukkan nama lengkap" required>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-slate-700 mb-2">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 {{ $errors->has('jenis_kelamin') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                            required>
                            <option value="" class="text-slate-400">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' }}
                                class="text-slate-700">Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}
                                class="text-slate-700">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-slate-700 mb-2">
                            Tempat Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 {{ $errors->has('tempat_lahir') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                            placeholder="Masukkan tempat lahir" required>
                        @error('tempat_lahir')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-slate-700 mb-2">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 {{ $errors->has('tanggal_lahir') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                            required>
                        @error('tanggal_lahir')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Agama -->
                    <div>
                        <label for="agama" class="block text-sm font-medium text-slate-700 mb-2">
                            Agama <span class="text-red-500">*</span>
                        </label>
                        <select id="agama" name="agama"
                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 {{ $errors->has('agama') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                            required>
                            <option value="" class="text-slate-400">Pilih Agama</option>
                            <option value="Islam" {{ old('agama') === 'Islam' ? 'selected' : '' }} class="text-slate-700">
                                Islam</option>
                            <option value="Kristen" {{ old('agama') === 'Kristen' ? 'selected' : '' }} class="text-slate-700">
                                Kristen</option>
                            <option value="Katolik" {{ old('agama') === 'Katolik' ? 'selected' : '' }} class="text-slate-700">
                                Katolik</option>
                            <option value="Hindu" {{ old('agama') === 'Hindu' ? 'selected' : '' }} class="text-slate-700">
                                Hindu</option>
                            <option value="Buddha" {{ old('agama') === 'Buddha' ? 'selected' : '' }} class="text-slate-700">
                                Buddha</option>
                        </select>
                        @error('agama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dropdown Pilih kepala -->
                    <div>
                        <div id="kepalaKeluargaSelectWrapper" style="{{ old('isKepalaKeluarga') ? 'display:none;' : '' }}">
                            <label for="id_kepalakeluarga" class="block text-sm font-medium text-slate-700 mb-2">
                                Kepala Keluarga <span class="text-red-500">*</span>
                            </label>
                            <select name="id_kepalakeluarga" id="id_kepalakeluarga"
                                class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 {{ $errors->has('id_kepalakeluarga') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}">
                                <option value="" class="text-slate-400">Pilih Kepala Keluarga</option>
                                @foreach($listKepalaKeluarga as $k)
                                    <option value="{{ $k->id }}" {{ old('id_kepalakeluarga') == $k->id ? 'selected' : '' }}
                                        class="text-slate-700 py-2">
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
                            <label for="nomorKK" class="block text-sm font-medium text-slate-700 mb-2">
                                Nomor Kartu Keluarga <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nomorKK" name="nomorKK" value="{{ old('nomorKK') }}"
                                class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 {{ $errors->has('nomorKK') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                                placeholder="Masukkan Nomor Kartu Keluarga (16 digit)" maxlength="16" required>
                            @error('nomorKK')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Checkbox -->
                        <div class="mt-4">
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="checkbox" name="isKepalaKeluarga" id="isKepalaKeluarga" value="1"
                                    class="h-4 w-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500 focus:ring-2 transition-colors duration-200"
                                    {{ old('isKepalaKeluarga') ? 'checked' : '' }}>
                                <span
                                    class="text-sm text-slate-700 group-hover:text-slate-900 transition-colors duration-200">Kepala
                                    Keluarga</span>
                            </label>
                            @error('isKepalaKeluarga')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-slate-700 mb-2">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}"
                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 {{ $errors->has('alamat') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                            placeholder="Masukkan alamat lengkap" required>
                        @error('alamat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-4">
                <a href="{{ route('admin.penduduk.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-slate-700 text-sm font-medium hover:bg-slate-50 hover:border-slate-400 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2 text-sm"></i>Kembali
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                    <i class="fas fa-save mr-2 text-sm"></i>Simpan Data Penduduk
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
            toggleKepalaKeluarga();
            checkbox.addEventListener('change', toggleKepalaKeluarga);
        });
    </script>
@endsection