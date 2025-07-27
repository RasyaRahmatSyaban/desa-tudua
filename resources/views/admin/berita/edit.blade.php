@extends('layouts.admin')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')
@section('page-description', 'Ubah informasi berita yang sudah ada')

@section('content')
<div class="space-y-6">
    <form method="POST" action="{{ route('admin.berita.update', $berita->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Main Content Card -->
        <div class="card bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Informasi Berita</h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Form -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Judul -->
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Berita <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="judul" 
                               name="judul" 
                               value="{{ old('judul', $berita->judul) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" @error('judul') border-red-500 @enderror
                               placeholder="Masukkan judul berita..."
                               required>
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Konten -->
                    <div>
                        <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                            Konten Berita <span class="text-red-500">*</span>
                        </label>
                        <textarea id="isi" 
                                  name="isi" 
                                  rows="12"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                  @error('isi') border-red-500 @enderror
                                  placeholder="Tulis konten berita di sini..."
                                  required>{{ old('isi', $berita->isi) }}</textarea>
                        @error('isi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Penulis -->
                    <div>
                        <label for="penulis" class="block text-sm font-medium text-gray-700 mb-2">
                            Penulis <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="penulis" 
                               name="penulis" 
                               value="{{ old('penulis', $berita->penulis) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                               @error('penulis') border-red-500 @enderror
                               placeholder="Nama penulis"
                               required>
                        @error('penulis')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Gambar -->
                    <div>
                        <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                            Gambar Berita
                        </label>
                        
                        @if($berita->foto)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Berita" class="w-full h-auto" />
                            <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                        </div>
                        @endif
                        
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                            <input type="file" 
                                   id="foto" 
                                   name="foto" 
                                   accept="image/*"
                                   class="hidden"
                                   onchange="previewImage(this)">
                            <div id="imagePreview" class="hidden">
                                <img id="preview" class="w-full h-32 object-cover rounded-lg mb-3">
                                <button type="button" onclick="removeImage()" class="text-red-600 text-sm hover:text-red-800">
                                    <i class="fas fa-trash mr-1"></i>Hapus Gambar
                                </button>
                            </div>
                            <label for="foto" class="block rounded-lg p-6 text-center transition-colors cursor-pointer">
                            <div id="uploadPlaceholder">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                <p class="text-sm text-gray-600 mb-2">Klik untuk upload gambar baru</p>
                                <p class="text-xs text-gray-500">PNG, JPG hingga 2MB</p>
                            </div>

                            </label>
                        </div>
                        @error('foto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status Publikasi <span class="text-red-500">*</span>
                        </label>
                        <select id="status" 
                                name="status"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                @error('status') border-red-500 @enderror
                                required>
                            <option value="Draft" {{ old('status', $berita->status) === 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Dipublikasi" {{ old('status', $berita->status) === 'Dipublikasi' ? 'selected' : '' }}>Dipublikasi</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Tanggal Terbit -->
                    <div>
                        <label for="tanggal_terbit" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Terbit <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               id="tanggal_terbit" 
                               name="tanggal_terbit" 
                               value="{{ old('tanggal_terbit', $berita->tanggal_terbit ? \Carbon\Carbon::parse($berita->tanggal_terbit)->format('Y-m-d') : '') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                               @error('tanggal_terbit') border-red-500 @enderror
                               required>
                        @error('tanggal_terbit')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.berita.index') }}" 
               class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            
            <button type="submit" 
                    class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                <i class="fas fa-save mr-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
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
