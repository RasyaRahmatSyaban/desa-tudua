@extends('layouts.guest')

@section('title', 'Beranda')
@section('description', 'Website resmi desa untuk informasi dan pelayanan masyarakat')

@section('content')
    <style>
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-marquee {
            animation: marquee 25s linear infinite;
            display: flex;
            width: fit-content;
            will-change: transform;
        }
    </style>
    <!-- Hero Section -->
    <section class="overflow-hidden min-h-screen flex flex-col justify-between text-white">
        <!-- Hero Carousel -->
        <div id="hero-carousel"
            class="relative py-12 px-6 md:px-12 lg:px-20 flex-1 flex items-center bg-cover bg-center transition-all duration-1000"
            style="background-image: url('{{ asset('images/foto-bersama.jpg') }}')">

            <!-- Overlay gelap -->
            <div class="absolute inset-0 bg-black/65 z-0"></div>

            <!-- Konten -->
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center w-full">
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                        Selamat Datang di <br>
                        <span class="text-yellow-300">Desa Digital Tudua</span>
                    </h1>
                    <p class="text-xl mb-8 text-blue-100 max-w-xl">
                        Portal informasi dan pelayanan terpadu untuk masyarakat desa.
                        Akses mudah, transparan, dan terpercaya.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('profil') }}"
                            class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors inline-flex items-center justify-center shadow-md">
                            <i class="fas fa-info-circle mr-2"></i>
                            Profil Desa
                        </a>
                    </div>
                </div>
            </div>

            <!-- Indikator -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-3 z-20">
                <button class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 transition-all"
                    data-index="0"></button>
                <button class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 transition-all"
                    data-index="1"></button>
                <!-- <button class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100 transition-all"
                                                    data-index="2"></button> -->
            </div>
        </div>

        <!-- Marquee / Pengumuman -->
        <div class="bg-yellow-200 overflow-hidden whitespace-nowrap my-6 mx-10 rounded-2xl relative h-10 flex items-center">
            <!-- Icon di kiri dan tengah secara vertikal -->
            <div class="absolute top-1/2 transform -translate-y-1/2 z-20 bg-yellow-200 px-2">
                <i class="fas fa-bullhorn text-gray-800 text-lg"></i>
            </div>

            <!-- Jalur marquee, beri padding kiri agar tidak menabrak icon -->
            <div class="marquee-track flex animate-marquee pl-14">
                @foreach($pengumumanAktif as $item)
                    <div class="flex items-center space-x-2 shrink-0 px-36 mx-6">
                        <span class="text-md font-bold text-gray-800">
                            {{ $item->judul }} — <span class="font-medium">{{ $item->isi }}</span>
                        </span>
                    </div>
                @endforeach

                {{-- Duplikat --}}
                @foreach($pengumumanAktif as $item)
                    <div class="flex items-center space-x-2 shrink-0 px-36 mx-6">
                        <span class="text-md font-bold text-gray-800">
                            {{ $item->judul }} — <span class="font-medium">{{ $item->isi }}</span>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Sambutan Kepala Desa -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <!-- Teks Sambutan -->
                <div class="order-2 lg:order-1">
                    <div class="bg-blue-50 p-10 rounded-2xl shadow-md">
                        <h2 class="text-4xl font-extrabold text-gray-900 mb-6">Sambutan Kepala Desa</h2>
                        <p class="text-gray-700 mb-5 leading-relaxed text-lg">
                            "Assalamu'alaikum warahmatullahi wabarakatuh. Selamat datang di website resmi desa kami.
                            Melalui platform digital ini, kami berkomitmen untuk memberikan pelayanan terbaik,
                            informasi yang akurat, dan transparansi dalam pengelolaan desa."
                        </p>
                        <p class="text-gray-700 mb-8 leading-relaxed text-lg">
                            "Mari bersama-sama membangun desa yang maju, sejahtera, dan berkeadilan untuk
                            kesejahteraan seluruh masyarakat."
                        </p>
                        <div class="flex items-center space-x-5">
                            <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-white shadow">
                                <img src="{{ asset('storage/' . $kepalaDesa->foto) }}" alt="Foto Kepala Desa"
                                    class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 text-lg">{{$kepalaDesa->nama}}</p>
                                <p class="text-gray-600 text-sm">{{$kepalaDesa->jabatan}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gambar Kepala Desa -->
                <div class="order-1 lg:order-2 text-center">
                    <img src="{{ asset('storage/' . $kepalaDesa->foto) }}" alt="{{$kepalaDesa->nama}}"
                        class="rounded-xl shadow-xl w-full max-w-xs mx-auto mb-3">
                    <p class="font-semibold text-gray-900 text-lg">{{$kepalaDesa->nama}}</p>
                    <p class="text-gray-600 text-sm">{{$kepalaDesa->jabatan}}</p>
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
                    <a href="{{ route('berita.index') }}" class="text-blue-600 font-medium hover:text-blue-800">
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
                <a href="{{ route('berita.index') }}" class="btn-primary text-white px-6 py-2 rounded-lg font-medium">
                    Lihat Semua Berita
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($berita as $b)
                    <article class="card-hover bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{asset('storage/' . $b->foto)}}" alt="{{ $b->judul }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <i class="fas fa-calendar mr-2"></i>
                                {{ $b->created_at->format('d M Y') }}
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-3 line-clamp-2">
                                {{ $b->judul }}
                            </h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($b->isi), 120) }}
                            </p>
                            <a href="{{ route('berita.show', $b->id) }}" class="text-blue-600 font-medium hover:text-blue-800">
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const images = [
                "{{ asset('images/foto-bersama.jpg') }}",
                "{{ asset('images/foto-bersama2.jpg') }}",
            ];

            let index = 0;
            const hero = document.getElementById("hero-carousel");
            const buttons = document.querySelectorAll("[data-index]");

            function updateSlide(newIndex) {
                index = newIndex;
                hero.style.backgroundImage = `url('${images[index]}')`;
                updateIndicators();
            }

            function updateIndicators() {
                buttons.forEach((btn, i) => {
                    if (i === index) {
                        btn.classList.add("opacity-100", "bg-yellow-300");
                        btn.classList.remove("opacity-50", "bg-white");
                    } else {
                        btn.classList.add("opacity-50", "bg-white");
                        btn.classList.remove("opacity-100", "bg-yellow-300");
                    }
                });
            }

            // Klik indikator
            buttons.forEach(btn => {
                btn.addEventListener("click", () => {
                    updateSlide(parseInt(btn.dataset.index));
                });
            });

            // Auto slide
            setInterval(() => {
                index = (index + 1) % images.length;
                updateSlide(index);
            }, 5000);

            // Set awal
            updateIndicators();
        });
    </script>
@endsection