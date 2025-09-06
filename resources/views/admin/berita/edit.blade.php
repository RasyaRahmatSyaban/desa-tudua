@extends('layouts.admin')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')
@section('page-description', 'Ubah informasi berita yang sudah ada')

@section('content')
    <div class="space-y-6">
        <form method="POST" action="{{ route('admin.berita.update', $berita->id) }}" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Main Content Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="p-6">
                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                        <!-- Main Form -->
                        <div class="xl:col-span-2 space-y-5">
                            <!-- Penulis -->
                            <div>
                                <label for="penulis" class="block text-sm font-medium text-slate-700 mb-2">
                                    Penulis <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="penulis" name="penulis"
                                    value="{{ old('penulis', $berita->penulis) }}"
                                    class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    placeholder="Masukkan nama penulis..." required>
                                @error('penulis')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Judul -->
                            <div>
                                <label for="judul" class="block text-sm font-medium text-slate-700 mb-2">
                                    Judul Berita <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}"
                                    class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    placeholder="Masukkan judul berita yang menarik..." required>
                                @error('judul')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Isi Berita -->
                            <div>
                                <label for="isi" class="block text-sm font-medium text-slate-700 mb-2">
                                    Isi Berita <span class="text-red-500">*</span>
                                </label>
                                <textarea id="isi" name="isi" rows="12"
                                    class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none"
                                    placeholder="Tulis isi berita dengan detail dan informatif..."
                                    required>{{ old('isi', $berita->isi) }}</textarea>
                                @error('isi')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="space-y-5">
                            <!-- Upload Foto -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">
                                    Foto Berita
                                </label>

                                @if($berita->foto)
                                    <div class="mb-4">
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Berita"
                                                class="w-full h-40 object-cover rounded-lg border border-slate-200" />
                                            <div
                                                class="absolute inset-0 bg-black bg-opacity-40 rounded-lg opacity-0 hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                                                <p class="text-white text-sm font-medium">Foto Saat Ini</p>
                                            </div>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-2 text-center">Foto yang sedang digunakan</p>
                                    </div>
                                @endif

                                <div class="relative">
                                    <label for="foto"
                                        class="block border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:border-blue-400 hover:bg-blue-50 transition-all duration-200 cursor-pointer">
                                        <input type="file" id="foto" name="foto" accept="image/*" class="hidden"
                                            onchange="previewImage(this)">
                                        <div id="imagePreview" class="hidden">
                                            <img id="preview"
                                                class="w-full h-40 object-cover rounded-lg mb-3 border border-slate-200">
                                            <button type="button" onclick="removeImage()"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 text-sm font-medium rounded-lg transition-colors duration-200">
                                                <i class="fas fa-trash mr-1"></i>Hapus Foto
                                            </button>
                                        </div>
                                        <div id="uploadPlaceholder">
                                            <div
                                                class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                                <i class="fas fa-camera text-slate-400 text-lg"></i>
                                            </div>
                                            <p class="text-sm font-medium text-slate-600 mb-1">Klik untuk upload foto baru
                                            </p>
                                            <p class="text-xs text-slate-500">PNG, JPG maksimal 2MB</p>
                                        </div>
                                    </label>
                                    @error('foto')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-slate-700 mb-2">
                                    Status Publikasi <span class="text-red-500">*</span>
                                </label>
                                <select id="status" name="status"
                                    class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    <option value="Draft" {{ old('status', $berita->status) === 'Draft' ? 'selected' : '' }}>
                                        Draft
                                    </option>
                                    <option value="Dipublikasi" {{ old('status', $berita->status) === 'Dipublikasi' ? 'selected' : '' }}>
                                        Dipublikasi
                                    </option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Tanggal Publikasi -->
                            <div>
                                <label for="tanggal_terbit" class="block text-sm font-medium text-slate-700 mb-2">
                                    Tanggal Publikasi <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="tanggal_terbit" name="tanggal_terbit"
                                    value="{{ old('tanggal_terbit', $berita->tanggal_terbit ? \Carbon\Carbon::parse($berita->tanggal_terbit)->format('Y-m-d') : '') }}"
                                    class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    required>
                                @error('tanggal_terbit')
                                    <p class="mt-1 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-4 pt-2">
                <a href="{{ route('admin.berita.index') }}"
                    class="inline-flex items-center justify-center px-6 py-2.5 bg-white border border-slate-300 rounded-lg text-slate-700 text-sm font-medium hover:bg-slate-50 hover:border-slate-400 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>

                <div class="flex items-center space-x-3">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                    document.getElementById('uploadPlaceholder').classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            document.getElementById('foto').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('uploadPlaceholder').classList.remove('hidden');
        }
    </script>
@endsection