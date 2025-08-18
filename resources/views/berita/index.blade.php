@extends('layouts.guest')

@section('title', 'Berita Desa')
@section('description', 'Kumpulan berita dan informasi terkini dari desa')

@section('content')
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: linear-gradient(45deg, #EAB308, #F59E0B);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #D97706, #EAB308);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(234, 179, 8, 0.3);
        }

        .hero-gradient {
            background: linear-gradient(135deg, rgba(17, 24, 39, 0.9) 0%, rgba(31, 41, 55, 0.8) 50%, rgba(55, 65, 81, 0.7) 100%);
        }
    </style>

    <!-- Filter & Search -->
    <section class="py-8 pt-24 bg-gray-900 border-b border-gray-700">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24 flex flex-row items-center justify-between">
            <div>
                <h2 class="text-2xl lg:text-3xl font-bold text-white mb-2">Semua Berita</h2>
                <p class="text-gray-400 text-base">Informasi dan kegiatan terkini dari desa</p>
            </div>
            <form method="GET" action="{{ route('berita.index') }}" class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
                    <div class="relative w-full sm:w-80 flex flex-row items-center">
                        <input type="text" name="search" placeholder="Cari berita..." value="{{ request('search') }}"
                            class="w-full pl-12 pr-4 py-1.5 bg-gray-800 border border-gray-600 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 text-white placeholder-gray-400 transition-all duration-300">
                        <i class="fas fa-search absolute left-4 text-gray-400"></i>
                    </div>
                    <select name="sort" onchange="this.form.submit()"
                        class="bg-gray-800 border border-gray-600 rounded-xl px-6 py-2 text-white focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-300 min-w-[150px]">
                        <option value="Terbaru" {{ request('sort') == 'Terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="Terlama" {{ request('sort') == 'Terlama' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>
            </form>
        </div>
    </section>

    <!-- All News Section -->
    <section class="py-10 bg-gray-900">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24">
            <div class="flex items-center justify-between">
                @if(request('search'))
                    <div class="text-gray-400 my-4">
                        <span class="text-yellow-400">{{ $berita->total() ?? 0 }}</span> hasil untuk 
                        "<span class="text-white font-medium">{{ request('search') }}</span>"
                    </div>
                @endif
            </div>

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="newsGrid">
                @forelse($berita as $item)
                    <article class="card-hover bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700 flex flex-col">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                                class="w-full h-48 object-cover transform hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 left-4">
                                <span class="bg-yellow-500 text-gray-900 px-3 py-1 rounded-full text-xs font-bold">
                                    BERITA
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-col flex-grow px-6 py-4">
                            <div class="flex items-center text-sm text-gray-400 mb-3">
                                <i class="fas fa-calendar mr-2 text-yellow-400"></i>
                                {{ $item->tanggal_terbit->format('d M Y') }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-user mr-2 text-yellow-400"></i>
                                {{ $item->penulis }}
                            </div>

                            <h3 class="text-lg font-bold text-white mb-3 line-clamp-2 hover:text-yellow-400 transition-colors duration-200">
                                {{ $item->judul }}
                            </h3>

                            <p class="text-gray-300 line-clamp-3 leading-relaxed mb-4">
                                {{ Str::limit(strip_tags($item->isi), 120) }}
                            </p>

                            <a href="{{ route('berita.show', $item->id) }}"
                                class="mt-auto inline-flex items-center text-yellow-400 font-semibold hover:text-yellow-300 transition-colors duration-200">
                                Baca Selengkapnya
                                <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="w-24 h-24 bg-gray-800 rounded-full mx-auto mb-6 flex items-center justify-center border border-gray-700">
                            <i class="fas fa-newspaper text-4xl text-gray-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">
                            @if(request('search'))
                                Tidak Ada Hasil
                            @else
                                Belum Ada Berita
                            @endif
                        </h3>
                        <p class="text-gray-400">
                            @if(request('search'))
                                Coba kata kunci yang berbeda
                            @else
                                Berita terbaru akan segera hadir
                            @endif
                        </p>
                        @if(request('search'))
                            <a href="{{ route('berita.index') }}" 
                                class="inline-flex items-center text-yellow-400 font-medium hover:text-yellow-300 transition-colors duration-200 mt-4">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Lihat Semua Berita
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(isset($berita) && $berita->hasPages())
                <div class="mt-12">
                    <div class="flex items-center justify-center">
                        <div class="flex items-center space-x-2">
                            {{-- Previous Page Link --}}
                            @if ($berita->onFirstPage())
                                <span class="px-4 py-2 text-gray-500 bg-gray-800 border border-gray-600 rounded-lg cursor-not-allowed">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $berita->previousPageUrl() }}" 
                                    class="px-4 py-2 text-white bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 transition-colors duration-200">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($berita->getUrlRange(1, $berita->lastPage()) as $page => $url)
                                @if ($page == $berita->currentPage())
                                    <span class="px-4 py-2 text-gray-900 bg-yellow-500 border border-yellow-500 rounded-lg font-semibold">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" 
                                        class="px-4 py-2 text-white bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 transition-colors duration-200">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($berita->hasMorePages())
                                <a href="{{ $berita->nextPageUrl() }}" 
                                    class="px-4 py-2 text-white bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 transition-colors duration-200">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="px-4 py-2 text-gray-500 bg-gray-800 border border-gray-600 rounded-lg cursor-not-allowed">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Pagination Info --}}
                    <div class="text-center mt-4 text-gray-400 text-sm">
                        Menampilkan {{ $berita->firstItem() ?? 0 }} - {{ $berita->lastItem() ?? 0 }} dari {{ $berita->total() }} berita
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection