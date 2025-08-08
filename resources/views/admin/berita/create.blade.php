@extends('layouts.admin')

@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita')
@section('page-description', 'Buat berita baru untuk dipublikasikan')

@section('content')
    <div class="space-y-8">
        <!-- Breadcrumb -->
        <div class="card">
            <div class="p-4">
                <nav class="flex items-center space-x-2 text-sm text-gray-600">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors duration-200">
                        <i class="fas fa-home"></i>
                    </a>
                    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    <a href="{{ route('admin.berita.index') }}" class="hover:text-blue-600 transition-colors duration-200">
                        Kelola Berita
                    </a>
                    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    <span class="text-gray-900 font-medium">Tambah Berita</span>
                </nav>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Header Card -->
            <div class="card">
                <div class="card-header p-6 pb-4">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-newspaper text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Informasi Berita</h3>
                            <p class="text-sm text-gray-500">Lengkapi detail berita yang akan dipublikasikan</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 pt-2">
                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                        <!-- Main Form -->
                        <div class="xl:col-span-2 space-y-6">
                            <!-- Penulis -->
                            <div class="group">
                                <label for="penulis" class="block text-sm font-semibold text-gray-700 mb-3">
                                    <div class="flex items-center space-x-2">
                                        <i
                                            class="fas fa-user text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200"></i>
                                        <span>Penulis</span>
                                        <span class="text-red-500">*</span>
                                    </div>
                                </label>
                                <div class="relative">
                                    <input type="text" id="penulis" name="penulis" value="{{ old('penulis') }}"
                                        class="w-full px-4 py-4 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 hover:bg-white group-focus-within:bg-white"
                                        placeholder="Masukkan nama penulis berita..." required>
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                        <i class="fas fa-pen text-gray-400 text-sm"></i>
                                    </div>
                                </div>
                                @error('penulis')
                                    <div class="mt-2 flex items-center space-x-2 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle text-xs"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <!-- Judul -->
                            <div class="group">
                                <label for="judul" class="block text-sm font-semibold text-gray-700 mb-3">
                                    <div class="flex items-center space-x-2">
                                        <i
                                            class="fas fa-heading text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200"></i>
                                        <span>Judul Berita</span>
                                        <span class="text-red-500">*</span>
                                    </div>
                                </label>
                                <div class="relative">
                                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                                        class="w-full px-4 py-4 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 hover:bg-white group-focus-within:bg-white"
                                        placeholder="Masukkan judul berita yang menarik..." required>
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                        <i class="fas fa-font text-gray-400 text-sm"></i>
                                    </div>
                                </div>
                                @error('judul')
                                    <div class="mt-2 flex items-center space-x-2 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle text-xs"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <!-- Konten -->
                            <div class="group">
                                <label for="isi" class="block text-sm font-semibold text-gray-700 mb-3">
                                    <div class="flex items-center space-x-2">
                                        <i
                                            class="fas fa-edit text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200"></i>
                                        <span>Isi Berita</span>
                                        <span class="text-red-500">*</span>
                                    </div>
                                </label>
                                <textarea id="isi" name="isi" rows="14"
                                    class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 hover:bg-white resize-y"
                                    placeholder="Tulis isi berita dengan detail dan jelas..."
                                    required>{{ old('isi') }}</textarea>
                                @error('isi')
                                    <div class="mt-2 flex items-center space-x-2 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle text-xs"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="mt-2 text-xs text-gray-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Tulis berita dengan bahasa yang mudah dipahami masyarakat
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="space-y-6">
                            <!-- Upload Gambar -->
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-100 p-6">
                                <label for="foto" class="block text-sm font-semibold text-gray-700 mb-4">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-image text-gray-400"></i>
                                        <span>Gambar Berita</span>
                                    </div>
                                </label>

                                <label for="foto"
                                    class="block border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 cursor-pointer group">
                                    <input type="file" id="foto" name="foto" accept="image/*" class="hidden"
                                        onchange="previewImage(this)">

                                    <div id="imagePreview" class="hidden">
                                        <img id="preview" class="w-full h-40 object-cover rounded-xl mb-4 shadow-sm">
                                        <button type="button" onclick="removeImage()"
                                            class="inline-flex items-center px-4 py-2 bg-red-100 hover:bg-red-200 text-red-700 text-sm rounded-lg transition-colors duration-200">
                                            <i class="fas fa-trash text-xs mr-2"></i>
                                            Hapus foto
                                        </button>
                                    </div>

                                    <div id="uploadPlaceholder"
                                        class="group-hover:scale-105 transition-transform duration-300">
                                        <div
                                            class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors duration-300">
                                            <i class="fas fa-cloud-upload-alt text-2xl text-blue-600"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 mb-2">Klik untuk upload gambar</p>
                                        <p class="text-xs text-gray-500">PNG, JPG maksimal 2MB</p>
                                    </div>
                                </label>

                                @error('foto')
                                    <div class="mt-3 flex items-center space-x-2 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle text-xs"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <!-- Status Publikasi -->
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-100 p-6">
                                <label for="status" class="block text-sm font-semibold text-gray-700 mb-4">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-toggle-on text-gray-400"></i>
                                        <span>Status Publikasi</span>
                                    </div>
                                </label>
                                <select id="status" name="status"
                                    class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duratio"
                                    n-200 bg-white>
                                    <option value="Draft" {{ old('status', 'Draft') === 'Draft' ? 'selected' : '' }}>
                                        Draft - Belum dipublikasi
                                    </option>
                                    <option value="Dipublikasi" {{ old('status') === 'Dipublikasi' ? 'selected' : '' }}>
                                        Dipublikasi - Tampil di website
                                    </option>
                                </select>
                                @error('status')
                                    <div class="mt-2 flex items-center space-x-2 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle text-xs"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <!-- Tanggal Publikasi -->
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-100 p-6">
                                <label for="tanggal_terbit" class="block text-sm font-semibold text-gray-700 mb-4">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-calendar-alt text-gray-400"></i>
                                        <span>Tanggal Publikasi</span>
                                    </div>
                                </label>
                                <input type="date" id="tanggal_terbit" name="tanggal_terbit"
                                    value="{{ old('tanggal_terbit', now()->format('Y-m-d')) }}"
                                    class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duratio"
                                    n-200 bg-white>
                                @error('tanggal_terbit')
                                    <div class="mt-2 flex items-center space-x-2 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle text-xs"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="mt-2 text-xs text-gray-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Tanggal berita akan ditampilkan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('admin.berita.index') }}"
                            class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition-all duration-200 font-medium group">
                            <i
                                class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-200"></i>
                            Kembali ke Daftar
                        </a>

                        <div class="flex items-center space-x-3">
                            <button type="button" onclick="saveDraft()"
                                class="inline-flex items-center px-6 py-3 bg-yellow-100 hover:bg-yellow-200 text-yellow-800 rounded-xl transition-all duration-200 font-medium group">
                                <i class="fas fa-save mr-2 group-hover:scale-110 transition-transform duration-200"></i>
                                Simpan Draft
                            </button>

                            <button type="submit"
                                class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 font-medium group">
                                <div
                                    class="w-5 h-5 bg-white/20 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-paper-plane text-sm"></i>
                                </div>
                                Publikasikan Berita
                                <i
                                    class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                            </button>
                        </div>
                    </div>
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

        function saveDraft() {
            // Set status to Draft before submitting
            document.getElementById('status').value = 'Draft';
            document.querySelector('form').submit();
        }

        // Auto-resize textarea
        document.addEventListener('DOMContentLoaded', function () {
            const textarea = document.getElementById('isi');
            textarea.addEventListener('input', function () {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });

            // Add loading state to submit button
            const form = document.querySelector('form');
            form.addEventListener('submit', function () {
                const submitBtn = document.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
                submitBtn.disabled = true;

                // Restore button after 3 seconds (fallback)
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            });

            // Character counter for textarea
            const isiTextarea = document.getElementById('isi');
            isiTextarea.addEventListener('input', function () {
                const charCount = this.value.length;
                const minLength = 100;

                if (charCount < minLength) {
                    this.style.borderColor = '#fbbf24';
                } else {
                    this.style.borderColor = '#10b981';
                }
            });
        });
    </script>
@endsection