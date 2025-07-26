@extends('layouts.guest')

@section('title', $berita->judul)
@section('meta-description', Str::limit(strip_tags($berita->isi), 160))

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <i class="fas fa-home mr-2"></i>
                    Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <a href="{{ route('berita.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600">Berita</a>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <article class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Article Header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                            {{ $berita->kategori ?? 'Umum' }}
                        </span>
                        <span class="text-gray-500 text-sm">
                            <i class="fas fa-calendar mr-1"></i>
                            {{ $berita->tanggal_terbit ? \Carbon\Carbon::parse($berita->tanggal_terbit)->format('d F Y') : $berita->created_at->format('d F Y') }}
                        </span>
                        <span class="text-gray-500 text-sm">
                            <i class="fas fa-eye mr-1"></i>
                            {{ rand(50, 500) }} views
                        </span>
                    </div>
                    
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $berita->judul }}</h1>
                    
                    <div class="flex items-center text-sm text-gray-600">
                        <div class="flex items-center mr-6">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-user text-white text-xs"></i>
                            </div>
                            <span>{{ $berita->penulis ?? 'Admin Desa' }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-1"></i>
                            <span>{{ ceil(str_word_count(strip_tags($berita->isi)) / 200) }} menit baca</span>
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                @if($berita->foto)
                <div class="relative">
                    <img src="{{ $berita->foto }}" 
                         alt="{{ $berita->judul }}" 
                         class="w-full h-64 md:h-96 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
                @endif

                <!-- Article Content -->
                <div class="p-6">
                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($berita->isi)) !!}
                    </div>

                    <!-- Tags -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center flex-wrap gap-2">
                            <span class="text-sm font-medium text-gray-700 mr-2">Tags:</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">#berita</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">#desa</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">#{{ strtolower($berita->kategori ?? 'umum') }}</span>
                        </div>
                    </div>

                    <!-- Share Buttons -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Bagikan artikel ini:</h4>
                        <div class="flex items-center space-x-3">
                            <button onclick="shareToFacebook()" class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f mr-2"></i>
                                Facebook
                            </button>
                            <button onclick="shareToTwitter()" class="flex items-center px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition-colors">
                                <i class="fab fa-twitter mr-2"></i>
                                Twitter
                            </button>
                            <button onclick="shareToWhatsApp()" class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                                <i class="fab fa-whatsapp mr-2"></i>
                                WhatsApp
                            </button>
                            <button onclick="copyLink()" class="flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                                <i class="fas fa-link mr-2"></i>
                                Copy Link
                            </button>
                        </div>
                    </div>
                </div>
            </article>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Related News -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Berita Terkait</h3>
                <div class="space-y-4">
                    @for($i = 1; $i <= 3; $i++)
                    <div class="flex space-x-3">
                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex-shrink-0 flex items-center justify-center">
                            <i class="fas fa-newspaper text-gray-400"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900 mb-1 line-clamp-2">
                                Berita Terkait {{ $i }} - Lorem ipsum dolor sit amet consectetur
                            </h4>
                            <p class="text-xs text-gray-500">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ now()->subDays($i)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                    @endfor
                </div>
                <a href="{{ route('berita.index') }}" class="block mt-4 text-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Lihat Semua Berita →
                </a>
            </div>

            <!-- Popular News -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Berita Populer</h3>
                <div class="space-y-4">
                    @for($i = 1; $i <= 3; $i++)
                    <div class="flex items-start space-x-3">
                        <span class="flex-shrink-0 w-6 h-6 bg-blue-500 text-white text-xs font-bold rounded-full flex items-center justify-center">
                            {{ $i }}
                        </span>
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900 mb-1 line-clamp-2">
                                Berita Populer {{ $i }} - Lorem ipsum dolor sit amet
                            </h4>
                            <p class="text-xs text-gray-500">
                                <i class="fas fa-eye mr-1"></i>
                                {{ rand(100, 1000) }} views
                            </p>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            <!-- Newsletter -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-md p-6 text-white">
                <h3 class="text-lg font-semibold mb-2">Newsletter Desa</h3>
                <p class="text-blue-100 text-sm mb-4">Dapatkan update berita terbaru langsung ke email Anda</p>
                <form class="space-y-3">
                    <input type="email" placeholder="Email Anda" class="w-full px-3 py-2 rounded-lg text-gray-900 text-sm">
                    <button type="submit" class="w-full bg-white text-blue-600 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                        Berlangganan
                    </button>
                </form>
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
    navigator.clipboard.writeText(window.location.href).then(function() {
        alert('Link berhasil disalin!');
    });
}
</script>
@endsection
