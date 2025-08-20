@extends('layouts.admin')

@section('title', 'Kelola Media')
@section('page-title', 'Kelola Media')
@section('page-description', 'Manajemen data media desa')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <form method="GET" action="{{ route('admin.media.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari nama media..." value="{{ request('search') }}"
                        class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        id="searchInput">
                    <i class="fas fa-search absolute left-3 top-3 text-slate-400 text-sm"></i>
                </div>
                <select name="tipe" onchange="this.form.submit()"
                    class="bg-white border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    <option value="">Semua Tipe</option>
                    <option value="Foto" {{ request('tipe') == 'Foto' ? 'selected' : '' }}>Foto</option>
                    <option value="Video" {{ request('tipe') == 'Video' ? 'selected' : '' }}>Video</option>
                    <option value="Dokumen" {{ request('tipe') == 'Dokumen' ? 'selected' : '' }}>Dokumen</option>
                </select>
            </form>

            <a href="{{ route('admin.media.create') }}"
                class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                <i class="fas fa-plus mr-2"></i>
                Tambah Media
            </a>
        </div>

        <!-- Stats Summary -->
        @if($medias->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Media</p>
                            <p class="text-xl font-bold text-slate-800">{{ $medias->total() }}</p>
                        </div>
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-photo-video text-blue-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Foto</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $medias->where('tipe', 'Foto')->count() }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-image text-emerald-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Video</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $medias->where('tipe', 'Video')->count() }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-video text-red-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Dokumen</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $medias->where('tipe', 'Dokumen')->count() }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-file-alt text-violet-600 text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Media Grid -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($medias as $media)
                        <div
                            class="bg-slate-50 rounded-lg shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-shadow duration-200">
                            <div class="relative">
                                @if($media->tipe === 'Foto')
                                    <div class="relative w-full h-48">
                                        <img src="{{ asset('storage/' . $media->file) }}" alt="{{ $media->nama }}"
                                            class="w-full h-48 object-cover">
                                        <div class="absolute top-2 right-2">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded-full">
                                                <i class="fas fa-image mr-1 text-xs"></i>
                                                Foto
                                            </span>
                                        </div>
                                    </div>
                                @elseif($media->tipe === 'Video')
                                    <div class="relative w-full h-48 bg-slate-900 overflow-hidden">
                                        <video class="w-full h-full object-cover">
                                            <source src="{{ asset('storage/' . $media->file) }}" type="video/mp4">
                                            Browser Anda tidak mendukung pemutar video.
                                        </video>
                                        <div class="absolute top-2 right-2">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                                <i class="fas fa-video mr-1 text-xs"></i>
                                                Video
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="relative w-full h-48 bg-slate-200 flex items-center justify-center">
                                        <i class="fas fa-file-alt text-4xl text-slate-400"></i>
                                        <div class="absolute top-2 right-2">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 bg-violet-100 text-violet-800 text-xs font-medium rounded-full">
                                                <i class="fas fa-file-alt mr-1 text-xs"></i>
                                                Dokumen
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="p-4 space-y-3">
                                <h3 class="font-semibold text-sm text-slate-800 line-clamp-2 leading-relaxed">
                                    {{ $media->nama }}
                                </h3>
                                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                    {{ Str::limit($media->deskripsi, 80) }}
                                </p>
                            </div>

                            <div class="px-4 py-3 bg-white border-t border-slate-100 flex justify-between gap-1 items-center">
                                <div class="flex justify-between items-center">
                                    <button type="button"
                                        class="viewModal inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                                        data-type="{{ strtolower($media->tipe) }}"
                                        data-url="{{ asset('storage/' . $media->file) }}" title="Lihat Preview">
                                        <i class="fas fa-eye text-sm"></i>
                                    </button>
                                    <a href="{{ route('admin.media.edit', $media->id) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors duration-200"
                                        title="Edit Media">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <form action="{{ route('admin.media.destroy', $media->id) }}" method="POST"
                                        class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors duration-200 delete-button"
                                            title="Hapus Media">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="flex justify-between items-center">
                                    <a href="{{ asset('storage/' . $media->file) }}" target="_blank" download
                                        class="text-xs text-green-600 hover:text-green-700 hover:underline font-medium">
                                        <i class="fas fa-download text-sm"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="flex flex-col items-center py-12">
                                <div class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center mb-4">
                                    <i class="fas fa-photo-video text-2xl text-slate-400"></i>
                                </div>
                                <p class="text-lg font-medium text-slate-600 mb-2">Belum ada media</p>
                                <p class="text-sm text-slate-500 mb-4">Upload foto, video, atau dokumen pertama</p>
                                <a href="{{ route('admin.media.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                    <i class="fas fa-plus mr-2"></i>
                                    Tambah Media
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($medias->hasPages())
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-6 pt-6 border-t border-slate-200">
                        <div class="text-sm text-slate-600">
                            Menampilkan {{ $medias->firstItem() ?? 0 }} sampai {{ $medias->lastItem() ?? 0 }}
                            dari {{ $medias->total() }} data
                        </div>

                        <div class="flex items-center justify-center sm:justify-end">
                            <div class="flex items-center space-x-2">
                                {{-- Previous Page Link --}}
                                @if ($medias->onFirstPage())
                                    <span
                                        class="px-2 py-0.5 text-gray-400 bg-slate-100 border border-slate-300 rounded-lg cursor-not-allowed">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                @else
                                    <a href="{{ $medias->previousPageUrl() }}"
                                        class="px-2 py-0.5 text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($medias->getUrlRange(1, $medias->lastPage()) as $page => $url)
                                    @if ($page == $medias->currentPage())
                                        <span
                                            class="px-2 py-0.5 text-white bg-blue-500 border border-blue-500 rounded-lg font-semibold">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}"
                                            class="px-2 py-0.5 text-blue-600 bg-white border border-slate-300 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($medias->hasMorePages())
                                    <a href="{{ $medias->nextPageUrl() }}"
                                        class="px-2 py-0.5 text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                @else
                                    <span
                                        class="px-2 py-0.5 text-gray-400 bg-slate-100 border border-slate-300 rounded-lg cursor-not-allowed">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection