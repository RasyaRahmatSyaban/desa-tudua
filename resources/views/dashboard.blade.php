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

        .hero-gradient {
            background: linear-gradient(135deg, rgba(17, 24, 39, 0.9) 0%, rgba(31, 41, 55, 0.8) 50%, rgba(55, 65, 81, 0.7) 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
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

        /* Custom glassmorphism effect */
        .glass-effect {
            background: rgba(31, 41, 55, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>

    <!-- Hero Section -->
    <section class="overflow-hidden min-h-screen flex flex-col justify-between bg-gray-800">
        <!-- Hero Carousel -->
        <div id="hero-carousel"
            class="relative py-12 px-6 md:px-12 lg:px-20 flex-1 flex items-center bg-cover bg-center transition-all duration-1000"
            style="background-image: url('{{ asset('images/foto-bersama.jpg') }}')">

            <!-- Overlay with gradient -->
            <div class="absolute inset-0 hero-gradient"></div>

            <!-- Konten -->
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center w-full">
                <div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold my-6 leading-tight text-white">
                        Selamat Datang di <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-300">
                            Desa Digital Tudua
                        </span>
                    </h1>
                    <p class="text-xl mb-8 text-gray-200 max-w-xl leading-relaxed">
                        Portal informasi dan pelayanan terpadu untuk masyarakat desa.
                        Akses mudah, transparan, dan terpercaya untuk kemajuan bersama.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('profil') }}"
                            class="bg-gradient-to-r from-yellow-500 to-yellow-400 text-gray-900 px-8 py-4 rounded-xl font-semibold hover:from-yellow-400 hover:to-yellow-300 transition-all duration-300 inline-flex items-center justify-center shadow-lg hover:shadow-xl">
                            <i class="fas fa-info-circle mr-2"></i>
                            Profil Desa
                        </a>
                        <a href="{{ route('pelayanan') }}"
                            class="border-2 border-white/30 text-white px-8 py-4 rounded-xl font-semibold hover:bg-white/10 hover:border-white/50 transition-all duration-300 inline-flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-concierge-bell mr-2"></i>
                            Layanan Desa
                        </a>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-2 gap-4 lg:gap-6">
                    <div
                        class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300">
                        <div class="text-3xl font-bold text-yellow-400 mb-2">1,234</div>
                        <div class="text-gray-200 text-sm">Total Penduduk</div>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300">
                        <div class="text-3xl font-bold text-yellow-400 mb-2">456</div>
                        <div class="text-gray-200 text-sm">Kepala Keluarga</div>
                    </div>
                </div>
            </div>

            <!-- Indikator -->
            <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-3 z-20">
                <button class="w-3 h-3 rounded-full bg-white/50 hover:bg-yellow-400 transition-all duration-300"
                    data-index="0"></button>
                <button class="w-3 h-3 rounded-full bg-white/50 hover:bg-yellow-400 transition-all duration-300"
                    data-index="1"></button>
            </div>
        </div>

        <!-- Marquee / Pengumuman -->
        <div
            class="bg-gradient-to-r from-yellow-500 to-yellow-400 overflow-hidden whitespace-nowrap my-6 mx-4 md:mx-10 rounded-2xl relative h-10 flex items-center shadow-lg">
            <!-- Icon di kiri -->
            <div
                class="absolute top-1/2 transform -translate-y-1/2 z-20 bg-yellow-500 px-3 rounded-l-2xl h-full flex items-center">
                <i class="fas fa-bullhorn text-gray-800 text-lg"></i>
            </div>

            <!-- Jalur marquee -->
            <div class="marquee-track flex animate-marquee pl-16">
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
    <section class="py-20 bg-gray-800">
        <div class="w-full mx-auto px-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <!-- Teks Sambutan -->
                <div class="order-2 lg:order-1">
                    <div class="glass-effect p-8 lg:p-10 rounded-3xl shadow-xl relative overflow-hidden">
                        <!-- Decorative element -->
                        <div
                            class="absolute top-0 left-0 w-20 h-20 bg-gradient-to-br from-yellow-400/30 to-yellow-500/20 rounded-full -translate-x-10 -translate-y-10">
                        </div>

                        <div class="relative">
                            <span
                                class="inline-block bg-yellow-500/20 text-yellow-300 px-4 py-2 rounded-full text-sm font-medium mb-6">
                                <i class="fas fa-quote-left mr-2"></i>Sambutan
                            </span>
                            <h2 class="text-3xl lg:text-4xl font-extrabold text-white mb-6">Kepala Desa</h2>
                            <p class="text-gray-300 mb-5 leading-relaxed text-lg">
                                "Assalamu'alaikum warahmatullahi wabarakatuh. Selamat datang di website resmi desa kami.
                                Melalui platform digital ini, kami berkomitmen untuk memberikan pelayanan terbaik,
                                informasi yang akurat, dan transparansi dalam pengelolaan desa."
                            </p>
                            <p class="text-gray-300 mb-8 leading-relaxed text-lg">
                                "Mari bersama-sama membangun desa yang maju, sejahtera, dan berkeadilan untuk
                                kesejahteraan seluruh masyarakat."
                            </p>
                            <div class="flex items-center space-x-5 p-4 bg-gray-800/50 rounded-2xl border border-gray-700">
                                <div class="w-16 h-16 rounded-full overflow-hidden border-3 border-yellow-400 shadow-lg">
                                    <img src="{{ asset('storage/' . $kepalaDesa->foto) }}" alt="Foto Kepala Desa"
                                        class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="font-bold text-white text-lg">{{$kepalaDesa->nama}}</p>
                                    <p class="text-yellow-300 text-sm font-medium">{{$kepalaDesa->jabatan}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gambar Kepala Desa -->
                <div class="order-1 lg:order-2 text-center">
                    <div class="relative inline-block">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-yellow-400/30 to-yellow-500/20 rounded-3xl transform rotate-6">
                        </div>
                        <img src="{{ asset('storage/' . $kepalaDesa->foto) }}" alt="{{$kepalaDesa->nama}}"
                            class="relative rounded-3xl shadow-2xl w-full max-w-sm mx-auto mb-6 transform hover:scale-105 transition-transform duration-300 border border-gray-700">
                    </div>
                    <h3 class="font-bold text-white text-xl mb-2">{{$kepalaDesa->nama}}</h3>
                    <p class="text-yellow-300 font-medium">{{$kepalaDesa->jabatan}}</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section class="py-10 bg-gray-900">
        <div class="w-full mx-auto px-24">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold mb-4 text-white">Fitur & Layanan Utama</h2>
                <p class="text-gray-400 max-w-2xl mx-auto text-lg">
                    Berbagai layanan dan informasi yang dapat diakses dengan mudah untuk kemudahan masyarakat
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Berita & Informasi -->
                <div
                    class="card-hover bg-gray-700 p-8 rounded-2xl border border-gray-600 hover:border-yellow-500/50 transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-newspaper text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-white">Berita & Informasi</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Dapatkan informasi terkini seputar kegiatan dan perkembangan desa
                    </p>
                    <a href="{{ route('berita.index') }}"
                        class="text-yellow-400 font-medium hover:text-yellow-300 transition-colors duration-200 inline-flex items-center">
                        Baca Selengkapnya
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Pengumuman -->
                <div
                    class="card-hover bg-gray-700 p-8 rounded-2xl border border-gray-600 hover:border-yellow-500/50 transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-bullhorn text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-white">Pengumuman</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Pengumuman penting dari pemerintah desa untuk masyarakat
                    </p>
                    <span class="text-gray-400 font-medium">Coming Soon</span>
                </div>

                <!-- Pelayanan -->
                <div
                    class="card-hover bg-gray-700 p-8 rounded-2xl border border-gray-600 hover:border-yellow-500/50 transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-concierge-bell text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-white">Pelayanan Desa</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Berbagai layanan administrasi dan surat-menyurat untuk masyarakat
                    </p>
                    <a href="{{ route('pelayanan') }}"
                        class="text-yellow-400 font-medium hover:text-yellow-300 transition-colors duration-200 inline-flex items-center">
                        Lihat Layanan
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Data Penduduk -->
                <div
                    class="card-hover bg-gray-700 p-8 rounded-2xl border border-gray-600 hover:border-yellow-500/50 transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-white">Data Penduduk</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Informasi statistik dan demografi penduduk desa
                    </p>
                    <a href="{{ route('data-penduduk') }}"
                        class="text-yellow-400 font-medium hover:text-yellow-300 transition-colors duration-200 inline-flex items-center">
                        Lihat Data
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Dana Desa -->
                <div
                    class="card-hover bg-gray-700 p-8 rounded-2xl border border-gray-600 hover:border-yellow-500/50 transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-money-bill-wave text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-white">Dana Desa</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Transparansi pengelolaan dan penggunaan dana desa
                    </p>
                    <a href="{{ route('dana-desa') }}"
                        class="text-yellow-400 font-medium hover:text-yellow-300 transition-colors duration-200 inline-flex items-center">
                        Lihat Laporan
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Kontak -->
                <div
                    class="card-hover bg-gray-700 p-8 rounded-2xl border border-gray-600 hover:border-yellow-500/50 transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-phone text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-white">Kontak & Lokasi</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Hubungi kami atau kunjungi kantor desa untuk informasi lebih lanjut
                    </p>
                    <a href="{{ route('kontak') }}"
                        class="text-yellow-400 font-medium hover:text-yellow-300 transition-colors duration-200 inline-flex items-center">
                        Hubungi Kami
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru -->
    <section class="py-10 bg-gray-800">
        <div class="w-full mx-auto px-24">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-bold text-white mb-2">Berita Terbaru</h2>
                    <p class="text-gray-400 text-lg">Informasi dan kegiatan terkini dari desa</p>
                </div>
                <a href="{{ route('berita.index') }}"
                    class="btn-primary text-gray-900 px-8 py-3 rounded-xl font-medium hover:shadow-lg transition-all duration-300">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Lihat Semua Berita
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($berita as $b)
                    <article class="card-hover bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-700">
                        <div class="relative overflow-hidden">
                            <img src="{{asset('storage/' . $b->foto)}}" alt="{{ $b->judul }}"
                                class="w-full h-48 object-cover transform hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 left-4">
                                <span class="bg-yellow-500 text-gray-900 px-3 py-1 rounded-full text-xs font-bold">
                                    BERITA
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-400 mb-3">
                                <i class="fas fa-calendar mr-2 text-yellow-400"></i>
                                {{ $b->created_at->format('d M Y') }}
                            </div>
                            <h3
                                class="text-lg font-bold text-white mb-3 line-clamp-2 hover:text-yellow-400 transition-colors duration-200">
                                {{ $b->judul }}
                            </h3>
                            <p class="text-gray-300 mb-4 line-clamp-3 leading-relaxed">
                                {{ Str::limit(strip_tags($b->isi), 120) }}
                            </p>
                            <a href="{{ route('berita.show', $b->id) }}"
                                class="inline-flex items-center text-yellow-400 font-semibold hover:text-yellow-300 transition-colors duration-200">
                                Baca Selengkapnya
                                <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div
                            class="w-24 h-24 bg-gray-800 rounded-full mx-auto mb-6 flex items-center justify-center border border-gray-700">
                            <i class="fas fa-newspaper text-4xl text-gray-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Belum Ada Berita</h3>
                        <p class="text-gray-400">Berita terbaru akan segera hadir</p>
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
                        btn.classList.add("bg-yellow-400", "scale-125");
                        btn.classList.remove("bg-white/50");
                    } else {
                        btn.classList.add("bg-white/50");
                        btn.classList.remove("bg-yellow-400", "scale-125");
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