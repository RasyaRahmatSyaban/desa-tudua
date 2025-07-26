@extends('layouts.admin')

@section('title', 'Kelola Media')
@section('page-title', 'Kelola Media')
@section('page-description', 'Manajemen data media desa')

@section('content')
<div class="space-y-6">
    <!-- Flash Messages -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
    </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
    <!-- Kiri: Filter & Search -->
    <form method="GET" action="{{ route('admin.media.index') }}" class="flex flex-wrap items-center gap-4">
        <!-- Search -->
        <input type="text" name="search" placeholder="Cari judul media..." value="{{ request('search') }}"
               class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent relative">
        <i class="fas fa-search absolute ml-3 mt-3 text-gray-400"></i>

        <!-- Tipe -->
        <select name="tipe" onchange="this.form.submit()"
                class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="">Semua Tipe</option>
            <option value="foto" {{ request('tipe') == 'foto' ? 'selected' : '' }}>Foto</option>
            <option value="video" {{ request('tipe') == 'video' ? 'selected' : '' }}>Video</option>
        </select>

        <!-- Kategori -->
        <select name="kategori" onchange="this.form.submit()"
                class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="">Semua Kategori</option>
            <option value="Kegiatan" {{ request('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
            <option value="Pembangunan" {{ request('kategori') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
            <option value="Budaya" {{ request('kategori') == 'Budaya' ? 'selected' : '' }}>Budaya</option>
            <option value="Sosial" {{ request('kategori') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
            <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
        </select>
    </form>

    <!-- Kanan: Tombol -->
    <a href="{{ route('admin.media.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium inline-flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Media
    </a>
</div>


    <!-- Media Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($medias as $media)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="relative">
                @if($media->tipe == 'foto')
                    <img src="{{ asset('storage/' . $media->file_path) }}"
                         alt="{{ $media->judul }}"
                         class="w-full h-48 object-cover">
                    <div class="absolute top-2 right-2 bg-green-600 text-white text-xs px-2 py-1 rounded-full">
                        <i class="fas fa-image mr-1"></i> Foto
                    </div>
                @else
                    <div class="w-full h-48 bg-black flex items-center justify-center">
                        <i class="fas fa-play-circle text-white text-4xl"></i>
                    </div>
                    <div class="absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full">
                        <i class="fas fa-video mr-1"></i> Video
                    </div>
                @endif
            </div>

            <div class="p-4 space-y-2">
                <h3 class="font-semibold text-sm">{{ $media->judul }}</h3>
                <p class="text-sm text-gray-500">{{ Str::limit($media->deskripsi, 80) }}</p>
                <div class="flex justify-between items-center text-sm text-gray-500">
                    <span><i class="fas fa-calendar mr-1"></i>{{ $media->created_at->format('d M Y') }}</span>
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">{{ $media->kategori }}</span>
                </div>
            </div>

            <div class="p-3 border-t flex justify-between items-center">
                <button type="button" data-modal-target="#viewModal{{ $media->id }}"
                        class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-eye"></i>
                </button>
                <a href="{{ route('admin.media.edit', $media->id) }}" class="text-yellow-600 hover:text-yellow-800">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.media.destroy', $media->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- View Modal -->
        <div id="viewModal{{ $media->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 overflow-y-auto flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg max-w-3xl w-full p-6 relative">
                <button onclick="this.closest('div[id^=viewModal]').classList.add('hidden')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
                <h2 class="text-xl font-bold mb-4">{{ $media->judul }}</h2>
                @if($media->tipe == 'foto')
                    <img src="{{ asset('storage/' . $media->file_path) }}" alt="{{ $media->judul }}" class="w-full rounded mb-4">
                @else
                    <video controls class="w-full mb-4">
                        <source src="{{ asset('storage/' . $media->file_path) }}" type="video/mp4">
                        Browser Anda tidak mendukung video.
                    </video>
                @endif

                <div class="grid md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p><strong>Kategori:</strong> {{ $media->kategori }}</p>
                        <p><strong>Tipe:</strong> {{ ucfirst($media->tipe) }}</p>
                        <p><strong>Tanggal:</strong> {{ $media->created_at->format('d F Y') }}</p>
                    </div>
                    <div>
                        <p><strong>Ukuran File:</strong> {{ number_format(Storage::size('public/' . $media->file_path) / 1024, 2) }} KB</p>
                    </div>
                </div>

                @if($media->deskripsi)
                <hr class="my-4">
                <p><strong>Deskripsi:</strong></p>
                <p class="text-gray-700">{{ $media->deskripsi }}</p>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-10 text-gray-500">
            <i class="fas fa-images text-4xl mb-2"></i>
            <h4 class="text-lg font-semibold">Belum ada media</h4>
            <p class="text-sm mb-4">Upload foto atau video pertama Anda</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6">
            <div class="text-sm text-gray-700">
                Menampilkan {{ $medias->firstItem() ?? 0 }} sampai {{ $medias->lastItem() ?? 0 }} 
                dari {{ $medias->total() }} data
            </div>
            {{ $medias->links() }}
        </div>
</div>
@endsection
