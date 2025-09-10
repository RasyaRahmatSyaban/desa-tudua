@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit User')
@section('page-description', 'Edit data pengguna')

@section('content')
    <div class="space-y-6">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Data User -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-6 flex items-center">
                    <i class="fas fa-user-edit mr-3 text-blue-600"></i>
                    Edit Data User
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 {{ $errors->has('name') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                            placeholder="Masukkan nama lengkap" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 {{ $errors->has('email') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                            placeholder="Masukkan alamat email" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                            Password Baru
                        </label>
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 {{ $errors->has('password') ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : '' }}"
                            placeholder="Masukkan password baru">
                        <p class="mt-1 text-xs text-slate-500">Kosongkan jika tidak ingin mengubah password. Minimal 8
                            karakter</p>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">
                            Konfirmasi Password Baru
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                            placeholder="Ulangi password baru">
                        <p class="mt-1 text-xs text-slate-500">Harus sama dengan password baru di atas</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Akun -->
            <div class="bg-slate-50 rounded-xl border border-slate-200 p-6">
                <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-3 text-slate-500"></i>
                    Informasi Akun
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tanggal Dibuat -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Tanggal Dibuat
                        </label>
                        <input type="text"
                            class="w-full px-4 py-2.5 bg-slate-100 border border-slate-300 rounded-lg text-sm text-slate-600"
                            value="{{ $user->created_at->format('d/m/Y H:i:s') }}" readonly>
                    </div>

                    <!-- ID User -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            ID User
                        </label>
                        <input type="text"
                            class="w-full px-4 py-2.5 bg-slate-100 border border-slate-300 rounded-lg text-sm text-slate-600"
                            value="{{ $user->id }}" readonly>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-4">
                <a href="{{ route('admin.users.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-slate-700 text-sm font-medium hover:bg-slate-50 hover:border-slate-400 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2 text-sm"></i>Kembali
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                    <i class="fas fa-save mr-2 text-sm"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection