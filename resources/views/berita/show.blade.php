@extends('layouts.guest')

@section('title', $berita->judul)
@section('meta-description', Str::limit(strip_tags($berita->isi), 160))

@section('content')
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3),
                0 10px 10px -5px rgba(0, 0, 0, 0.2);
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

        .share-btn {
            transition: all 0.3s ease;
        }

        .share-btn:hover {
            transform: translateY(-2px);
        }
    </style>

    <div class="bg-gray-900 min-h-screen pt-20 pb-6">
        <div class="w-full mx-auto px-6 lg:px-8 py-6">
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="xl:col-span-2">
                    <article class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700 w-full">

                        <!-- Article Header -->
                        <div class="px-6 lg:px-8 py-3 border-b border-gray-700">
                            <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white leading-tight">
                                {{ $berita->judul }}
                            </h1>

                            <div class="flex flex-wrap items-center gap-6 text-sm text-gray-400">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar mr-2 text-yellow-400"></i>
                                    <span>{{ $berita->tanggal_terbit->format('d F Y') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-user mr-3 text-xs text-yellow-500"></i>
                                    <span class="text-gray-300">{{ $berita->penulis ?? 'Admin Desa' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        @if($berita->foto)
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}"
                                    class="w-full h-64 md:h-96 object-cover rounded-xl">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/50 to-transparent"></div>
                            </div>
                        @endif

                        <!-- Article Content -->
                        <div class="p-6 lg:p-8">
                            <div class="prose prose-lg max-w-none text-gray-300 leading-relaxed">
                                <div class="text-base sm:text-lg leading-6 sm:leading-8 
                                                            space-y-4 sm:space-y-6 break-words whitespace-pre-line">
                                    {!! nl2br(e($berita->isi)) !!}
                                </div>
                            </div>

                            <!-- Share Buttons -->
                            <div class="mt-3 pt-3 border-t border-gray-700">
                                <h4 class="text-lg font-semibold text-white mb-3">Bagikan artikel ini:</h4>
                                <div class="flex flex-wrap items-center gap-4">
                                    <button onclick="shareToFacebook()"
                                        class="share-btn flex items-center px-2 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700">
                                        <i class="fa-brands fa-facebook"></i>
                                    </button>
                                    <button onclick="shareToTwitter()"
                                        class="share-btn flex items-center px-2 py-2 bg-blue-400 text-white rounded-full hover:bg-blue-500">
                                        <i class="fa-brands fa-twitter"></i>
                                    </button>
                                    <button onclick="shareToWhatsApp()"
                                        class="share-btn flex items-center px-2 py-2 bg-green-500 text-white rounded-full hover:bg-green-600">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </button>
                                    <button onclick="copyLink()"
                                        class="share-btn flex items-center px-2 py-2 bg-gray-600 text-white rounded-full hover:bg-gray-500">
                                        <i class="fa-solid fa-link"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Sidebar (Berita Terkait untuk XL ke atas) -->
                <aside class="lg:col-span-1 hidden xl:block">
                    <div class="bg-gray-800 rounded-2xl shadow-xl border border-gray-700 top-24">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-6 border-b border-gray-700 pb-4">
                                Berita Terkait
                            </h3>

                            <div class="space-y-6">
                                @forelse ($beritaTerkait as $item)
                                    <a href="{{ route('berita.show', $item->id) }}"
                                        class="card-hover block group bg-gray-700 rounded-xl overflow-hidden border border-gray-600 hover:border-yellow-500/50 transition-all duration-300">
                                        <div class="flex gap-4 pr-2">
                                            <div class="w-52 h-44 rounded-lg overflow-hidden bg-gray-600 flex-shrink-0">
                                                @if ($item->foto)
                                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                                                        class="object-cover w-full h-full">
                                                @else
                                                    <div class="flex items-center justify-center w-full h-full text-gray-400">
                                                        <i class="fas fa-newspaper text-lg"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4
                                                    class="text-xl font-semibold text-white group-hover:text-yellow-400 line-clamp-2 leading-snug mb-1">
                                                    {{ $item->judul }}
                                                </h4>
                                                <p class="text-sm text-gray-400 flex items-center mb-4">
                                                    <i class="fas fa-calendar mr-1"></i>
                                                    {{ $item->tanggal_terbit->format('d M Y') }}
                                                </p>
                                                <p class="text-lg text-gray-300 line-clamp-2">
                                                    {{ Str::limit(strip_tags($item->isi), 200) }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center py-8">
                                        <i class="fas fa-newspaper text-3xl text-gray-500 mb-3"></i>
                                        <p class="text-gray-400 text-sm">Tidak ada berita terkait</p>
                                    </div>
                                @endforelse
                            </div>

                            <div class="mt-8 pt-6 border-t border-gray-700">
                                <a href="{{ route('berita.index') }}"
                                    class="btn-primary w-full text-center text-gray-900 py-3 rounded-xl font-semibold inline-flex items-center justify-center hover:shadow-lg transition-all duration-300">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Lihat Semua Berita
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>

        <!-- Berita Terkait untuk < XL -->
        <section class="py-8 md:py-12 lg:py-16 bg-gray-900 xl:hidden">
            <div class="w-full mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-24">

                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 md:mb-12 gap-4">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white">Berita Terkait</h2>
                    <a href="{{ route('berita.index') }}"
                        class="btn-primary text-gray-900 px-6 md:px-8 py-3 rounded-xl font-medium hover:shadow-lg transition-all duration-300 text-center text-sm md:text-base">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Lihat Semua Berita
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @forelse($beritaTerkait as $b)
                        <article class="card-hover bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700">
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('storage/' . $b->foto) }}" alt="{{ $b->judul }}"
                                    class="w-full h-40 md:h-48 object-cover transform hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="p-4 md:p-6">
                                <div class="flex items-center text-xs md:text-sm text-gray-400 mb-1">
                                    <i class="fas fa-calendar mr-2 text-yellow-400"></i>
                                    {{ $b->created_at->format('d M Y') }}
                                </div>
                                <h3 class="text-base md:text-lg font-bold text-white mb-4 line-clamp-2 hover:text-yellow-400">
                                    {{ $b->judul }}
                                </h3>
                                <p class="text-sm md:text-base text-gray-300 mb-4 line-clamp-3 leading-relaxed">
                                    {{ Str::limit(strip_tags($b->isi), 200) }}
                                </p>
                                <a href="{{ route('berita.show', $b->id) }}"
                                    class="inline-flex items-center text-yellow-400 font-semibold hover:text-yellow-300 text-sm md:text-base">
                                    Baca Selengkapnya
                                    <i
                                        class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full text-center py-12 md:py-16">
                            <div
                                class="w-20 h-20 md:w-24 md:h-24 bg-gray-800 rounded-full mx-auto mb-6 flex items-center justify-center border border-gray-700">
                                <i class="fas fa-newspaper text-3xl md:text-4xl text-gray-500"></i>
                            </div>
                            <h3 class="text-lg md:text-xl font-semibold text-white mb-2">Belum Ada Berita</h3>
                            <p class="text-gray-400 text-sm md:text-base">Berita terbaru akan segera hadir</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

    <script>
        function shareToFacebook() {
            const url = encodeURIComponent(window.location.href);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
        }
        function shareToTwitter() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('{{ $berita->judul }}');
            window.open(`https://twitter.com/intent/tweet?url=${url}&text=${title}`, '_blank', 'width=600,height=400');
        }
        function shareToWhatsApp() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('{{ $berita->judul }}');
            window.open(`https://wa.me/?text=${title} ${url}`, '_blank');
        }
        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(function () {
                const notification = document.createElement('div');
                notification.className =
                    'fixed top-24 right-6 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 transform translate-x-full transition-transform duration-300';
                notification.innerHTML = '<i class="fas fa-check mr-2"></i>Link berhasil disalin!';
                document.body.appendChild(notification);
                setTimeout(() => notification.classList.remove('translate-x-full'), 100);
                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => document.body.removeChild(notification), 300);
                }, 3000);
            }).catch(() => alert('Link berhasil disalin!'));
        }
    </script>
@endsection