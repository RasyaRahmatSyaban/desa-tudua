@extends('layouts.guest')

@section('title', $berita->judul)
@section('meta-description', Str::limit(strip_tags($berita->isi), 160))

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

        .share-btn {
            transition: all 0.3s ease;
        }

        .share-btn:hover {
            transform: translateY(-2px);
        }
    </style>

    <div class="bg-gray-900 min-h-screen pt-20 pb-6">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24 py-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <article class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700">
                        <!-- Article Header -->
                        <div class="p-6 lg:p-8 border-b border-gray-700">
                            <div class="flex items-center mb-4">
                                <span class="bg-yellow-500 text-gray-900 px-4 py-2 rounded-full text-sm font-bold">
                                    BERITA
                                </span>
                            </div>

                            <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-6 leading-tight">
                                {{ $berita->judul }}
                            </h1>

                            <div class="flex flex-wrap items-center gap-6 text-sm text-gray-400">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar mr-2 text-yellow-400"></i>
                                    <span>{{ $berita->tanggal_terbit->format('d F Y') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-gray-900 text-xs"></i>
                                    </div>
                                    <span class="text-gray-300">{{ $berita->penulis ?? 'Admin Desa' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        @if($berita->foto)
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}"
                                    class="w-full h-64 md:h-96 object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/50 to-transparent"></div>
                            </div>
                        @endif

                        <!-- Article Content -->
                        <div class="p-6 lg:p-8">
                            <div class="prose prose-lg max-w-none text-gray-300 leading-relaxed">
                                <div class="text-lg leading-8 space-y-6">
                                    {!! nl2br(e($berita->isi)) !!}
                                </div>
                            </div>

                            <!-- Share Buttons -->
                            <div class="mt-12 pt-8 border-t border-gray-700">
                                <h4 class="text-lg font-semibold text-white mb-6">Bagikan artikel ini:</h4>
                                <div class="flex flex-wrap items-center gap-4">
                                    <button onclick="shareToFacebook()"
                                        class="share-btn flex items-center px-6 py-1 bg-blue-600 text-white rounded-xl hover:bg-blue-700 font-medium shadow-lg">
                                        <i class="fab fa-facebook-f mr-3"></i>
                                        Facebook
                                    </button>
                                    <button onclick="shareToTwitter()"
                                        class="share-btn flex items-center px-6 py-1 bg-blue-400 text-white rounded-xl hover:bg-blue-500 font-medium shadow-lg">
                                        <i class="fab fa-twitter mr-3"></i>
                                        Twitter
                                    </button>
                                    <button onclick="shareToWhatsApp()"
                                        class="share-btn flex items-center px-6 py-1 bg-green-500 text-white rounded-xl hover:bg-green-600 font-medium shadow-lg">
                                        <i class="fab fa-whatsapp mr-3"></i>
                                        WhatsApp
                                    </button>
                                    <button onclick="copyLink()"
                                        class="share-btn flex items-center px-6 py-1 bg-gray-600 text-white rounded-xl hover:bg-gray-500 font-medium shadow-lg">
                                        <i class="fas fa-link mr-3"></i>
                                        Copy Link
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Berita Terkait Card -->
                    <div class="bg-gray-800 rounded-2xl shadow-xl border border-gray-700 top-24">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-6 border-b border-gray-700 pb-4">
                                Berita Terkait
                            </h3>

                            <div class="space-y-6">
                                @forelse ($beritaTerkait as $item)
                                    <a href="{{ route('berita.show', $item->id) }}"
                                        class="card-hover block group bg-gray-700 rounded-xl overflow-hidden border border-gray-600 hover:border-yellow-500/50 transition-all duration-300">
                                        <div class="flex gap-4 p-4">
                                            <div class="w-20 h-16 rounded-lg overflow-hidden bg-gray-600 flex-shrink-0">
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
                                                    class="text-sm font-semibold text-white group-hover:text-yellow-400 line-clamp-2 leading-snug mb-2 transition-colors duration-200">
                                                    {{ $item->judul }}
                                                </h4>
                                                <p class="text-xs text-gray-400 flex items-center mb-2">
                                                    <i class="fas fa-calendar mr-1"></i>
                                                    {{ $item->tanggal_terbit->format('d M Y') }}
                                                </p>
                                                <p class="text-xs text-gray-300 line-clamp-2">
                                                    {{ Str::limit(strip_tags($item->isi), 60) }}
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
                </div>
            </div>
        </div>
    </div>

    <script>
        function shareToFacebook() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('{{ $berita->judul }}');
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
                // Custom notification
                const notification = document.createElement('div');
                notification.className = 'fixed top-24 right-6 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 transform translate-x-full transition-transform duration-300';
                notification.innerHTML = '<i class="fas fa-check mr-2"></i>Link berhasil disalin!';
                document.body.appendChild(notification);

                // Show notification
                setTimeout(() => {
                    notification.classList.remove('translate-x-full');
                }, 100);

                // Hide notification
                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 3000);
            }).catch(function () {
                alert('Link berhasil disalin!');
            });
        }
    </script>
@endsection