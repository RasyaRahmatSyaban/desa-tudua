@extends('layouts.guest')

@section('title', 'Beranda')
@section('description', 'Website resmi desa untuk informasi dan pelayanan masyarakat')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient text-white py-20">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    Selamat Datang di <br>
                    <span class="text-yellow-300">Desa Digital</span>
                </h1>
                <p class="text-xl mb-8 text-blue-100">
                    Portal informasi dan pelayanan terpadu untuk masyarakat desa. 
                    Akses mudah, transparan, dan terpercaya.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('pelayanan') }}" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold inline-flex items-center justify-center">
                        <i class="fas fa-concierge-bell mr-2"></i>
                        Layanan Desa
                    </a>
                    <a href="{{ route('profil') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors inline-flex items-center justify-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Profil Desa
                    </a>
                </div>
            </div>
            <div class="relative">
                <img src="/placeholder.svg?height=400&width=600" 
                     alt="Pemandangan Desa" 
                     class="rounded-lg shadow-2xl">
                <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-lg shadow-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Penduduk</p>
                            <p class="text-xl font-bold text-gray-900">{{ $totalPenduduk ?? '2,543' }} Jiwa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sambutan Kepala Desa -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <div class="bg-blue-50 p-8 rounded-lg">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Sambutan Kepala Desa</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        "Assalamu'alaikum warahmatullahi wabarakatuh. Selamat datang di website resmi desa kami. 
                        Melalui platform digital ini, kami berkomitmen untuk memberikan pelayanan terbaik, 
                        informasi yang akurat, dan transparansi dalam pengelolaan desa."
                    </p>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        "Mari bersama-sama membangun desa yang maju, sejahtera, dan berkeadilan untuk 
                        kesejahteraan seluruh masyarakat."
                    </p>
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-gray-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Bapak Soekarno</p>
                            <p class="text-gray-600">Kepala Desa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <img src="/placeholder.svg?height=400&width=500" 
                     alt="Kepala Desa" 
                     class="rounded-lg shadow-lg w-full">
            </div>
        </div>
    </div>
</section>

<!-- Fitur Utama -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Fitur & Layanan Utama</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Berbagai layanan dan informasi yang dapat diakses dengan mudah untuk kemudahan masyarakat
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Berita & Informasi -->
            <div class="card-hover bg-white p-6 rounded-lg shadow-md">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Berita & Informasi</h3>
                <p class="text-gray-600 mb-4">
                    Dapatkan informasi terkini seputar kegiatan dan perkembangan desa
                </p>
                <a href="{{ route('berita') }}" class="text-blue-600 font-medium hover:text-blue-800">
                    Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <!-- Pengumuman -->
            <div class="card-hover bg-white p-6 rounded-lg shadow-md">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-bullhorn text-yellow-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Pengumuman</h3>
                <p class="text-gray-600 mb-4">
                    Pengumuman penting dari pemerintah desa untuk masyarakat
                </p>
                <a href="{{ route('pengumuman') }}" class="text-blue-600 font-medium hover:text-blue-800">
                    Lihat Pengumuman <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <!-- Pelayanan -->
            <div class="card-hover bg-white p-6 rounded-lg shadow-md">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-concierge-bell text-green-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Pelayanan Desa</h3>
                <p class="text-gray-600 mb-4">
                    Berbagai layanan administrasi dan surat-menyurat untuk masyarakat
                </p>
                <a href="{{ route('pelayanan') }}" class="text-blue-600 font-medium hover:text-blue-800">
                    Akses Layanan <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <!-- Data Penduduk -->
            <div class="card-hover bg-white p-6 rounded-lg shadow-md">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-users text-purple-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Data Penduduk</h3>
                <p class="text-gray-600 mb-4">
                    Informasi statistik dan demografi penduduk desa
                </p>
                <a href="{{ route('data-penduduk') }}" class="text-blue-600 font-medium hover:text-blue-800">
                    Lihat Data <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <!-- Dana Desa -->
            <div class="card-hover bg-white p-6 rounded-lg shadow-md">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-money-bill-wave text-emerald-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Dana Desa</h3>
                <p class="text-gray-600 mb-4">
                    Transparansi pengelolaan dan penggunaan dana desa
                </p>
                <a href="{{ route('dana-desa') }}" class="text-blue-600 font-medium hover:text-blue-800">
                    Lihat Laporan <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <!-- Kontak -->
            <div class="card-hover bg-white p-6 rounded-lg shadow-md">
                <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-phone text-pink-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Kontak & Lokasi</h3>
                <p class="text-gray-600 mb-4">
                    Hubungi kami atau kunjungi kantor desa untuk informasi lebih lanjut
                </p>
                <a href="{{ route('kontak') }}" class="text-blue-600 font-medium hover:text-blue-800">
                    Hubungi Kami <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terbaru -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Berita Terbaru</h2>
                <p class="text-gray-600">Informasi dan kegiatan terkini dari desa</p>
            </div>
            <a href="{{ route('berita') }}" class="btn-primary text-white px-6 py-2 rounded-lg font-medium">
                Lihat Semua Berita
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($recentBerita ?? [] as $berita)
            <article class="card-hover bg-white rounded-lg shadow-md overflow-hidden">
                <img src="/placeholder.svg?height=200&width=400" 
                     alt="{{ $berita->judul }}" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <i class="fas fa-calendar mr-2"></i>
                        {{ $berita->created_at->format('d M Y') }}
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 line-clamp-2">
                        {{ $berita->judul }}
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ Str::limit(strip_tags($berita->konten), 120) }}
                    </p>
                    <a href="{{ route('berita.show', $berita->id) }}" class="text-blue-600 font-medium hover:text-blue-800">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Belum ada berita tersedia</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Statistik Desa -->
<section class="py-16 bg-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Statistik Desa</h2>
            <p class="text-blue-100 max-w-2xl mx-auto">
                Data dan informasi statistik terkini tentang desa kami
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <p class="text-3xl font-bold mb-2">{{ $totalPenduduk ?? '2,543' }}</p>
                <p class="text-blue-100">Total Penduduk</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-home text-2xl"></i>
                </div>
                <p class="text-3xl font-bold mb-2">{{ $totalKeluarga ?? '687' }}</p>
                <p class="text-blue-100">Kepala Keluarga</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map text-2xl"></i>
                </div>
                <p class="text-3xl font-bold mb-2">12</p>
                <p class="text-blue-100">RT/RW</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-building text-2xl"></i>
                </div>
                <p class="text-3xl font-bold mb-2">8</p>
                <p class="text-blue-100">Fasilitas Umum</p>
            </div>
        </div>
    </div>
</section>
@endsection
