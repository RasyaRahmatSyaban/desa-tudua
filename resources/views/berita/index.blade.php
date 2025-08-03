@extends('layouts.guest')

@section('title', 'Berita Desa')
@section('description', 'Kumpulan berita dan informasi terkini dari desa')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white pt-30 pb-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Berita Desa</h1>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                    Dapatkan informasi terkini seputar kegiatan dan perkembangan desa
                </p>
            </div>
        </div>
    </section>

    <!-- Filter & Search -->
    <section class="py-8 bg-white border-b">
        <div class="max-w-7xl mx-auto px-4">
            <form method="GET" action="{{ route('berita.index') }}" class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari berita..." value="{{ request('search') }}"
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            id="searchInput">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <select name="sort" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="Terbaru" {{ request('sort') == 'Terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="Terlama" {{ request('sort') == 'Terlama' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>
            </form>
        </div>
    </section>

    <!-- Berita Content -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Featured News -->
            @if(isset($featuredBerita) && $featuredBerita)
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Berita Utama</h2>
                    <div class="card-hover bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="grid grid-cols-1 lg:grid-cols-2">
                            <div class="relative">
                                <img src="/placeholder.svg?height=400&width=600" alt="{{ $featuredBerita->judul }}"
                                    class="w-full h-64 lg:h-full object-cover">
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded-full">
                                        {{ ucfirst($featuredBerita->kategori ?? 'Umum') }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-8">
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <i class="fas fa-calendar mr-2"></i>
                                    {{ $featuredBerita->created_at->format('d M Y') }}
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-eye mr-2"></i>
                                    {{ $featuredBerita->views ?? 0 }} views
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                    {{ $featuredBerita->judul }}
                                </h3>
                                <p class="text-gray-600 mb-6 leading-relaxed">
                                    {{ Str::limit(strip_tags($featuredBerita->konten), 200) }}
                                </p>
                                <a href="{{ route('berita.show', $featuredBerita->id) }}"
                                    class="btn-primary text-white px-6 py-3 rounded-lg font-medium inline-flex items-center">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="newsGrid">
                @forelse($berita as $item)
                    <article class="card-hover bg-white rounded-lg shadow-md overflow-hidden news-item">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                                class="w-full h-48 object-cover">
                        </div>

                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <i class="fas fa-calendar mr-2"></i>
                                {{ $item->tanggal_terbit->format('d M Y') }}
                                <span class="mx-2">-</span>
                                <i class="fas fa-pen mr-2"></i>
                                {{ $item->penulis }}
                            </div>

                            <h3 class="text-lg font-semibold text-gray-900 mb-3 line-clamp-2">
                                {{ $item->judul }}
                            </h3>

                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($item->isi), 120) }}
                            </p>

                            <a href="{{ route('berita.show', $item->id) }}"
                                class="text-blue-600 font-medium hover:text-blue-800 inline-flex items-center">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-16">
                        <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Berita</h3>
                        <p class="text-gray-500">Berita akan ditampilkan di sini ketika sudah tersedia</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(isset($berita) && $berita->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $berita->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection