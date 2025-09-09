@extends('layouts.guest')

@section('title', 'Media Desa')
@section('description', 'Kumpulan dokumentasi desa dalam bentuk foto, video, dan dokumen.')

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
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-2">Media Desa</h2>
                    <p class="text-gray-400">Kumpulan dokumentasi desa dalam bentuk foto, video, dan dokumen</p>
                </div>
                <form method="GET" action="{{ route('media') }}" class="flex flex-col sm:flex-row sm:items-center items-start gap-3">
                    <div class="relative flex items-center">
                        <input type="text" name="search" placeholder="Cari media..." value="{{ request('search') }}"
                            class="pl-10 pr-4 py-2 bg-gray-800 border border-gray-600 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 text-white placeholder-gray-400 transition-all duration-300 min-w-[200px]">
                        <i class="fas fa-search absolute left-3 text-gray-400"></i>
                    </div>
                    <select name="tipe" onchange="this.form.submit()"
                        class="bg-gray-800 border border-gray-600 rounded-xl px-4 py-2 text-white focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-300 min-w-[120px]">
                        <option value="">Semua Tipe</option>
                        <option value="Foto" {{ request('tipe') == 'Foto' ? 'selected' : '' }}>Foto</option>
                        <option value="Video" {{ request('tipe') == 'Video' ? 'selected' : '' }}>Video</option>
                        <option value="Dokumen" {{ request('tipe') == 'Dokumen' ? 'selected' : '' }}>Dokumen</option>
                    </select>
                </form>
            </div>
        </div>
    </section>

    <!-- All Media Section -->
    <section class="py-12 bg-gray-900">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24">
            <div class="flex items-center justify-between">
                @if(request('search') || request('tipe'))
                    <div class="text-gray-400 my-4">
                        <span class="text-yellow-400">{{ $medias->total() ?? 0 }}</span> hasil 
                        @if(request('search'))
                            untuk "<span class="text-white font-medium">{{ request('search') }}</span>"
                        @endif
                        @if(request('tipe'))
                            <span class="text-white font-medium">{{ ucfirst(request('tipe')) }}</span>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Media Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="mediaGrid">
                @forelse($medias as $item)
                    <article class="card-hover bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700 flex flex-col">
                        @if($item->tipe == 'Foto')
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->nama }}"
                                    class="w-full h-52 object-cover transform hover:scale-110 transition-transform duration-500">
                                <div class="absolute top-4 left-4">
                                    <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                        <i class="fas fa-camera mr-1"></i>FOTO
                                    </span>
                                </div>
                            </div>

                        @elseif($item->tipe == 'Video')
                            <div class="relative overflow-hidden bg-gray-700">
                                <video class="w-full h-52 object-cover" preload="metadata">
                                    <source src="{{ asset('storage/' . $item->file) }}" type="video/mp4">
                                    Browser tidak mendukung pemutar video.
                                </video>
                                <div class="absolute top-4 left-4">
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                        <i class="fas fa-video mr-1"></i>VIDEO
                                    </span>
                                </div>
                            </div>

                        @elseif($item->tipe == 'Dokumen')
                            <div class="relative overflow-hidden bg-gradient-to-br from-gray-700 to-gray-800 h-52 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-file-alt text-6xl text-gray-400 mb-2"></i>
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                            <i class="fas fa-file mr-1"></i>DOKUMEN
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="flex flex-col flex-grow px-6 py-4">
                            <h3 class="text-lg font-bold text-white mb-3 line-clamp-2 hover:text-yellow-400 transition-colors duration-200">
                                {{ $item->nama }}
                            </h3>

                            <p class="text-gray-300 line-clamp-3 leading-relaxed mb-4">
                                {{ Str::limit($item->deskripsi, 120) }}
                            </p>

                            <div class="mt-auto flex items-center justify-between">
                                @if($item->tipe == 'Dokumen')
                                    <div class="flex gap-2">
                                        <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                            class="inline-flex items-center text-yellow-400 font-semibold hover:text-yellow-300 transition-colors duration-200 text-sm">
                                            <i class="fas fa-eye mr-1"></i>Lihat
                                        </a>
                                        <a href="{{ asset('storage/' . $item->file) }}" download
                                            class="inline-flex items-center text-green-400 font-semibold hover:text-green-300 transition-colors duration-200 text-sm">
                                            <i class="fas fa-download mr-1"></i>Unduh
                                        </a>
                                    </div>
                                @else
                                    <div class="flex gap-2">
                                        <button onclick="openModal('{{ $item->tipe }}', '{{ asset('storage/' . $item->file) }}', '{{ $item->nama }}', '{{ $item->deskripsi }}')"
                                            class="inline-flex items-center text-yellow-400 font-semibold hover:text-yellow-300 transition-colors duration-200 cursor-pointer">
                                            <i class="fas fa-eye mr-2"></i>Lihat
                                        </button>
                                        <a href="{{ asset('storage/' . $item->file) }}" download class="inline-flex items-center text-green-400 font-semibold hover:text-green-300 transition-colors duration-200 text-sm">
                                            <i class="fas fa-download mr-1"></i>Unduh
                                        </a>
                                    </div>
                                @endif

                                <span class="text-xs text-gray-400 capitalize">
                                    <i class="fas fa-tag mr-1"></i>{{ $item->tipe }}
                                </span>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="w-24 h-24 bg-gray-800 rounded-full mx-auto mb-6 flex items-center justify-center border border-gray-700">
                            <i class="fas fa-folder-open text-4xl text-gray-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">
                            @if(request('search') || request('tipe'))
                                Tidak Ada Hasil
                            @else
                                Belum Ada Media
                            @endif
                        </h3>
                        <p class="text-gray-400">
                            @if(request('search') || request('tipe'))
                                Coba kata kunci atau filter yang berbeda
                            @else
                                Media desa akan segera hadir
                            @endif
                        </p>
                        @if(request('search') || request('tipe'))
                            <a href="{{ route('media') }}" 
                                class="inline-flex items-center text-yellow-400 font-medium hover:text-yellow-300 transition-colors duration-200 mt-4">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Lihat Semua Media
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(isset($medias) && $medias->hasPages())
                <div class="mt-12">
                    <div class="flex items-center justify-center">
                        <div class="flex items-center space-x-2">
                            {{-- Previous Page Link --}}
                            @if ($medias->onFirstPage())
                                <span class="px-4 py-2 text-gray-500 bg-gray-800 border border-gray-600 rounded-lg cursor-not-allowed">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $medias->previousPageUrl() }}" 
                                    class="px-4 py-2 text-white bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 transition-colors duration-200">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($medias->getUrlRange(1, $medias->lastPage()) as $page => $url)
                                @if ($page == $medias->currentPage())
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
                            @if ($medias->hasMorePages())
                                <a href="{{ $medias->nextPageUrl() }}" 
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
                        Menampilkan {{ $medias->firstItem() ?? 0 }} - {{ $medias->lastItem() ?? 0 }} dari {{ $medias->total() }} media
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Modal for Media Preview -->
    <div id="mediaModal" class="fixed inset-0 backdrop-blur-xs z-50 hidden items-center justify-center p-4">
        <div class="bg-gray-800 rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden border border-gray-700">
            <div class="flex items-center justify-between p-6 border-b border-gray-700">
                <h3 id="modalTitle" class="text-xl font-bold text-white"></h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-white text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6">
                <div id="modalContent" class="text-center"></div>
                <p id="modalDescription" class="text-gray-300 mt-4"></p>
            </div>
        </div>
    </div>

    <script>
        function openModal(type, src, title, description) {
            const modal = document.getElementById('mediaModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalContent = document.getElementById('modalContent');
            const modalDescription = document.getElementById('modalDescription');

            modalTitle.textContent = title;
            modalDescription.textContent = description;

            if (type === 'Foto') {
                modalContent.innerHTML = `<img src="${src}" alt="${title}" class="w-full h-full rounded-lg mx-auto">`;
            } else if (type === 'Video') {
                modalContent.innerHTML = `<video controls class="w-full h-full rounded-lg mx-auto">
                    <source src="${src}" type="video/mp4">
                    Browser tidak mendukung pemutar video.
                </video>`;
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('mediaModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('mediaModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
@endsection