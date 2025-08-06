@extends('layouts.guest')

@section('title', 'Media Desa')
@section('description', 'Kumpulan dokumentasi desa dalam bentuk foto, video, dan dokumen.')

@section('content')
    <!-- Header -->
    <section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Media Desa</h1>
            <p class="text-lg text-green-100 max-w-2xl mx-auto">
                Kumpulan dokumentasi desa dalam bentuk foto, video, dan dokumen.
            </p>
        </div>
    </section>

    <!-- Filter & Search -->
    <section class="py-8 bg-white border-b">
        <div class="max-w-7xl mx-auto px-4">
            <form method="GET" action="{{ route('media.index') }}"
                class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex flex-1 items-center gap-4">
                    <div class="relative w-full">
                        <input type="text" name="search" placeholder="Cari media..." value="{{ request('search') }}"
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <select name="type" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">Semua</option>
                        <option value="foto" {{ request('type') == 'foto' ? 'selected' : '' }}>Foto</option>
                        <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video</option>
                        <option value="dokumen" {{ request('type') == 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                    </select>
                </div>
            </form>
        </div>
    </section>

    <!-- Galeri Media -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            @forelse($media as $item)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($media as $item)
                        <div class="bg-white rounded-lg shadow hover:shadow-lg overflow-hidden transition">
                            <div class="p-4">
                                @if($item->tipe == 'foto')
                                    <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->nama }}"
                                        class="w-full h-48 object-cover rounded">
                                    <h3 class="text-lg font-semibold mt-4">{{ $item->nama }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($item->deskripsi, 100) }}</p>

                                @elseif($item->tipe == 'video')
                                    <video controls class="w-full h-48 rounded">
                                        <source src="{{ asset('storage/' . $item->file) }}" type="video/mp4">
                                        Browser tidak mendukung pemutar video.
                                    </video>
                                    <h3 class="text-lg font-semibold mt-4">{{ $item->nama }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($item->deskripsi, 100) }}</p>

                                @elseif($item->tipe == 'dokumen')
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <div class="text-5xl mb-4">📄</div>
                                        <h3 class="text-lg font-semibold text-center">{{ $item->nama }}</h3>
                                        <p class="text-sm text-gray-600 text-center">{{ Str::limit($item->deskripsi, 100) }}</p>
                                        <div class="mt-4 flex gap-2">
                                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                                class="text-green-600 hover:underline text-sm font-medium">Lihat File</a>
                                            <a href="{{ asset('storage/' . $item->file) }}" download
                                                class="text-green-600 hover:underline text-sm font-medium">Unduh</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="text-center py-16 text-gray-500">
                    <i class="fas fa-folder-open text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Belum ada media desa yang tersedia</h3>
                    <p>Media akan ditampilkan di sini ketika sudah tersedia.</p>
                </div>
            @endforelse

            <!-- Pagination -->
            @if(isset($media) && $media->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $media->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection