@extends('layouts.admin')

@section('title', 'Kelola Media')
@section('page-title', 'Kelola Media')
@section('page-description', 'Manajemen data media desa')

@section('content')
    <div class="space-y-6">

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
                    <option value="Foto" {{ request('tipe') == 'Foto' ? 'selected' : '' }}>Foto</option>
                    <option value="Video" {{ request('tipe') == 'Video' ? 'selected' : '' }}>Video</option>
                    <option value="Dokumen" {{ request('tipe') == 'Dokumen' ? 'selected' : '' }}>Dokumen</option>
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
                        @if($media->tipe === 'Foto')
                            <div class="relative w-full h-48">
                                <img src="{{ asset('storage/' . $media->file) }}" alt="{{ $media->nama }}"
                                    class="w-full h-48 object-cover rounded-lg">
                                <div class="absolute top-2 right-2 bg-green-600 text-white text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-image mr-1"></i> Foto
                                </div>
                            </div>
                        @elseif($media->tipe === 'Video')
                            <div class="relative w-full h-48 bg-black rounded-lg overflow-hidden">
                                <video controls class="w-full h-full object-cover">
                                    <source src="{{ asset('storage/' . $media->file) }}" type="video/mp4">
                                    Browser Anda tidak mendukung pemutar video.
                                </video>
                                <div class="absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-video mr-1"></i> Video
                                </div>
                            </div>
                        @else
                            <div class="relative w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center text-gray-500">
                                <i class="fas fa-file-alt text-4xl mr-2"></i>
                                <div class="absolute top-2 right-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-video mr-1"></i> Dokumen
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="p-4 space-y-2">
                        <h3 class="font-semibold text-sm">{{ $media->nama }}</h3>
                        <div class="flex items-center">
                            <p class="text-sm text-gray-500 flex-grow">{{ Str::limit($media->deskripsi, 80) }}</p>
                            <div class="flex gap-2 shrink-0">
                                <a href="{{ asset('storage/' . $media->file) }}" target="_blank"
                                    class="text-sm text-blue-500 hover:underline">
                                    Lihat File
                                </a>
                                <a href="{{ asset('storage/' . $media->file) }}" target="_blank" download
                                    class="text-sm text-blue-500 hover:underline">
                                    Unduh
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 border-t flex justify-start gap-4 items-center">
                        <button type="button" data-modal-target="#viewModal{{ $media->id }}"
                            class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                        </button>
                        <a href="{{ route('admin.media.edit', $media->id) }}" class="text-yellow-600 hover:text-yellow-800">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.media.destroy', $media->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
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