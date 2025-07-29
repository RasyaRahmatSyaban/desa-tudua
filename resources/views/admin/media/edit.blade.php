@extends('layouts.admin')

@section('title', 'Edit Media')

@section('content')
    <div class="space-y-6">
        <!-- Form Edit -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.media.update', $media->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Media <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $media->nama) }}"
                            class="w-full px-4 py-3 border rounded-lg @error('nama') border-red-500 @enderror" required>
                        @error('nama')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipe -->
                    <div>
                        <label for="tipe" class="block text-sm font-medium text-gray-700 mb-2">Tipe <span
                                class="text-red-500">*</span></label>
                        <select id="tipe" name="tipe"
                            class="w-full px-4 py-3 border rounded-lg @error('tipe') border-red-500 @enderror" required>
                            <option value="">Pilih tipe</option>
                            <option value="Foto" {{ old('tipe', $media->tipe) == 'Foto' ? 'selected' : '' }}>Foto</option>
                            <option value="Video" {{ old('tipe', $media->tipe) == 'Video' ? 'selected' : '' }}>Video</option>
                            <option value="Dokumen" {{ old('tipe', $media->tipe) == 'Dokumen' ? 'selected' : '' }}>Dokumen
                            </option>
                        </select>
                        @error('tipe')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File -->
                    <div>
                        @if($media->file)
                            <label class="block text-sm font-medium text-gray-700 mb-2">File Saat Ini</label>
                            <div class="border p-2 rounded mb-2 inline-block">
                                @if($media->tipe === 'Foto')
                                    <img src="{{ asset('storage/' . $media->file) }}" alt="{{ $media->nama }}"
                                        class="max-h-52 w-full object-contain rounded">
                                @elseif($media->tipe === 'Video')
                                    <video controls class="max-h-52 rounded">
                                        <source src="{{ asset('storage/' . $media->file) }}" type="video/mp4">
                                        Browser tidak mendukung video.
                                    </video>
                                @else
                                    <div class="flex items-center space-x-3 mb-2">
                                        <i class="fas fa-file-alt text-4xl mr-2"></i>
                                        <div>
                                            <p class="font-semibold">{{ basename($media->file) }}</p>
                                            <p class="text-xs text-gray-500">{{ $media->tipe }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="{{ asset('storage/' . $media->file) }}" target="_blank">Lihat File</a>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">File Media</label>
                        <input type="file" id="file" name="file" accept="image/*,video/*,.pdf,.doc,.docx"
                            class="block w-full text-sm text-gray-700 file:border file:border-gray-300 file:rounded-lg file:py-2 file:px-4 file:text-sm file:bg-white file:hover:bg-gray-50 @error('file') border-red-500 @enderror">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah file. Max 10MB.</p>
                        @error('file')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"
                            class="w-full px-4 py-3 border rounded-lg @error('deskripsi') border-red-500 @enderror"
                            placeholder="Deskripsikan media ini...">{{ old('deskripsi', $media->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('admin.media.index') }}"
                        class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection