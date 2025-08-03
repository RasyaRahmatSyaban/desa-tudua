@extends('layouts.guest')

@section('title', $berita->judul)
@section('meta-description', Str::limit(strip_tags($berita->isi), 160))

@section('content')
    <div class="container mx-auto px-4 py-20">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <i class="fas fa-home mr-2"></i>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <a href="{{ route('berita.index') }}"
                            class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600">Berita</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-gray-500">{{ Str::limit($berita->judul, 50) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
            <!-- Main Content -->
            <div class="lg:col-span-2 h-full">
                <article class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col h-full">
                    <!-- Article Header -->
                    <div class="px-6 py-1 border-b border-gray-200">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $berita->judul }}</h1>

                        <div class="flex items-center space-x-4 mb-2">
                            <span class="text-gray-500 text-sm">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $berita->tanggal_terbit->format('d F Y') }}
                            </span>
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-user text-white text-xs"></i>
                            </div>
                            <span>{{ $berita->penulis ?? 'Admin Desa' }}</span>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    @if($berita->foto)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}"
                                class="w-full h-64 md:h-96 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>
                    @endif

                    <!-- Article Content -->
                    <div class="p-6 flex flex-col flex-1">
                        <div class="prose prose-lg max-w-none">
                            {!! nl2br(e($berita->isi)) !!}
                        </div>

                        <!-- Share Buttons -->
                        <div class="mt-auto pt-6 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-700 mb-3">Bagikan artikel ini:</h4>
                            <div class="flex items-center space-x-3">
                                <button onclick="shareToFacebook()"
                                    class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    <i class="fab fa-facebook-f mr-2"></i>
                                    Facebook
                                </button>
                                <button onclick="shareToTwitter()"
                                    class="flex items-center px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition-colors">
                                    <i class="fab fa-twitter mr-2"></i>
                                    Twitter
                                </button>
                                <button onclick="shareToWhatsApp()"
                                    class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                                    <i class="fab fa-whatsapp mr-2"></i>
                                    WhatsApp
                                </button>
                                <button onclick="copyLink()"
                                    class="flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                                    <i class="fas fa-link mr-2"></i>
                                    Copy Link
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="flex flex-col">
                <!-- Card Berita Terkait -->
                <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between flex-1">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-6 border-b pb-2">Berita Terkait</h3>
                        <div class="space-y-5">
                            @foreach ($beritaTerkait as $item)
                                <a href="{{ route('berita.show', $item->id) }}" class="flex items-start space-x-4 group">
                                    <div class="w-28 h-24 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                                                class="object-cover w-full h-full">
                                        @else
                                            <div class="flex items-center justify-center w-full h-full text-gray-400">
                                                <i class="fas fa-newspaper text-xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-xl font-semibold text-gray-800 group-hover:text-blue-600 line-clamp-2">
                                            {{ $item->judul }}
                                        </h4>
                                        <p class="text-xs text-gray-500 mt-1">
                                            <i class="fas fa-calendar mr-1"></i>
                                            {{ $item->tanggal_terbit->format('d M Y') }}
                                        </p>
                                        <p class="text-md text-gray-600 mb-6 leading-relaxed">
                                            {{ Str::limit(strip_tags($item->isi), 40) }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('berita.index') }}"
                        class="mt-6 text-center text-md font-medium text-blue-600 hover:underline">
                        Lihat Semua Berita →
                    </a>
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
                alert('Link berhasil disalin!');
            });
        }
    </script>
@endsection