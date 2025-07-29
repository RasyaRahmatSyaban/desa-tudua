@extends('layouts.admin')

@section('title', 'Tambah Surat Keluar')

@section('content')
<div class="space-y-6">

    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form Tambah Surat Keluar</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.surat-keluar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nomor_surat" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Surat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                        @error('nomor_surat') border-red-500 @enderror 
                               id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" placeholder="0XX/X/20XX" required>
                        @error('nomor_surat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="tanggal_kirim" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Kirim <span class="text-red-500">*</span>
                        </label>
                        <input type="date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                        @error('tanggal_kirim') border-red-500 @enderror 
                               id="tanggal_kirim" name="tanggal_kirim" value="{{ old('tanggal_kirim') }}" required>
                        @error('tanggal_kirim')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="perihal" class="block text-sm font-medium text-gray-700 mb-2">
                            Perihal <span class="text-red-500">*</span>
                        </label>
                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                        @error('perihal') border-red-500 @enderror 
                        id="perihal" name="perihal" value="{{ old('perihal') }}"placeholder="Perihal/subjek surat" required>
                        @error('perihal')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="penerima" class="block text-sm font-medium text-gray-700 mb-2">
                            Penerima <span class="text-red-500">*</span>
                        </label>
                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" @error('penerima') border-red-500 @enderror 
                               id="penerima" name="penerima" value="{{ old('penerima') }}" 
                               placeholder="Nama instansi/organisasi penerima" required>
                        @error('penerima')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                            File Surat (PDF, DOC, DOCS) <span class="text-red-500">*</span>
                        </label>
                        <input type="file" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" @error('file') border-red-500 @enderror 
                               id="file" name="file" accept=".pdf,.doc.docx">
                        <p class="mt-1 text-sm text-gray-500">Format: PDF, DOC, DOCS Maksimal 5MB</p>
                        @error('file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4 mt-8">
                    <a href="{{ route('admin.surat-keluar.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                        </svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
