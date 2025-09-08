@extends('layouts.guest')

@section('title', 'Profil Desa Tudua')
@section('description', 'Profil lengkap Desa Tudua meliputi sejarah, visi misi, struktur organisasi, dan data desa')

@section('content')
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3),
                0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }

        .carousel-item {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%) scale(1);
            transition: transform 0.7s ease-in-out, opacity 0.7s ease-in-out;
            will-change: transform, opacity;
        }
    </style>

    <!-- Page Header -->
    <section class="pt-24 pb-12 bg-gray-900">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24">
            <div class="text-center">
                <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4">Profil Desa Tudua</h1>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Mengenal lebih dekat Desa Tudua, sejarah, visi misi, dan struktur organisasi
                </p>
            </div>
        </div>
    </section>

    <!-- Sejarah Desa -->
    <section class="py-16 bg-gray-900">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">Sejarah Desa</h2>
                    <div class="prose prose-lg text-gray-300">
                        <p class="mb-4 leading-relaxed">
                            Desa Tudua merupakan salah satu dari 13 desa yang ada di Kecamatan Bungku Tengah
                            dan merupakan desa terkecil dengan luas 10,50 Km², yang terdiri dari 3 dusun dan 6 RT.
                            Nama "Tudua" berasal dari bahasa Bungku yang berarti "Tempat Turun" karena dahulu
                            pemukiman penduduk berada di pengunungan.
                        </p>
                        <p class="mb-4 leading-relaxed">
                            Desa Tudua awalnya masih bergabung dengan Desa Puungkoilu dan mekar menjadi desa
                            definitif pada tanggal 4 Desember 2004. Sejak terbentuk hingga saat ini, desa
                            telah dipimpin oleh beberapa kepala desa: Usman.P (2005-2023) yang menjabat selama
                            tiga periode berturut-turut, dan kini dilanjutkan oleh Hasfudin (2023-sekarang).
                        </p>
                        <p class="leading-relaxed">
                            Sepanjang sejarahnya sejak menjadi desa definitif, Desa Tudua terus berkembang
                            dalam berbagai aspek pembangunan, mulai dari infrastruktur dasar, pengembangan
                            sektor ekonomi, hingga peningkatan kualitas pelayanan publik untuk kesejahteraan
                            masyarakat.
                        </p>
                    </div>
                </div>
                <div>
                    <img src={{ asset('images/foto-bersama.jpg') }} alt="Sejarah Desa Tudua"
                        class="rounded-2xl shadow-xl w-full border border-gray-700">
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="py-16 bg-gray-900">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">Visi & Misi</h2>
                <p class="text-gray-400 max-w-2xl mx-auto text-lg">
                    Komitmen Desa Tudua dalam membangun desa yang maju, sejahtera, dan berkelanjutan
                </p>
            </div>

            <div class="space-y-10">
                <!-- Visi -->
                <div
                    class="card-hover bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-700 hover:border-blue-500/50">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-14 h-14 bg-blue-500/20 rounded-xl flex items-center justify-center border border-blue-500/30">
                            <i class="fas fa-eye text-blue-400 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white ml-4">Visi</h3>
                    </div>
                    <p class="text-gray-300 text-lg leading-relaxed">
                        "Mewujudkan tata kelola pemerintahan desa Tudua, transparan, bersih dan jujur
                        serta amanah demi terciptanya desa Tudua yang maju, sejahtera bersama dan berakhlak"
                    </p>
                </div>

                <!-- Misi -->
                <div
                    class="card-hover bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-700 hover:border-green-500/50">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-14 h-14 bg-green-500/20 rounded-xl flex items-center justify-center border border-green-500/30">
                            <i class="fas fa-bullseye text-green-400 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white ml-4">Misi</h3>
                    </div>
                    <ul class="text-gray-300 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @php
                            $misi = [
                                "Pelaksanaan pemerintahan desa yang amanah dan transparan",
                                "Pelaksanaan penggunaan anggaran yang tepat sasaran",
                                "Melaksanakan pembangunan di semua sektor secara adil dan merata",
                                "Meningkatkan sarana dan prasarana keagamaan serta memfasilitasi kegiatan keagamaan",
                                "Mengutamakan musyawarah untuk mufakat dalam pengambilan keputusan",
                                "Menggali potensi anak muda lewat karang taruna di bidang olahraga, seni dan lainnya",
                                "Memfasilitasi kegiatan masyarakat untuk meningkatkan sumber pendapatan ekonomi",
                                "Menjaga potensi ruang wilayah desa agar tidak disalahgunakan serta menjaga kebersihan",
                                "Menggali potensi wisata dan aset desa untuk menjadi sumber pendapatan",
                                "Mendorong optimalisasi bumdes agar manfaatnya dirasakan oleh masyarakat"
                            ];
                          @endphp
                        @foreach($misi as $item)
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-400 mt-1 mr-3 flex-shrink-0"></i>
                                <span class="leading-relaxed">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Struktur Organisasi -->
    <section class="py-16 bg-gray-900">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24 ">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">Struktur Organisasi</h2>
                <p class="text-gray-400 max-w-2xl mx-auto text-lg">
                    Perangkat desa yang berkomitmen melayani masyarakat dengan dedikasi tinggi
                </p>
            </div>

            <div class="relative w-full mx-auto h-[28rem] flex">
                <div id="aparaturCarousel" class="relative w-full h-full flex items-center justify-center">
                    @forelse($perangkatDesa as $key => $perangkat)
                        <div class="carousel-item card w-64 bg-gray-800 shadow-xl border border-gray-700"
                            data-index="{{ $key }}">
                            <figure class="px-4 pt-4 h-80">
                                <img src="{{ asset("storage/" . $perangkat->foto) }}" alt="{{ $perangkat->nama }}"
                                    class="rounded-xl w-full h-full object-cover" />
                            </figure>
                            <div class="card-body items-center text-center">
                                <h2 class="card-title text-white text-lg">{{ $perangkat->nama }}</h2>
                                <p class="text-sm text-gray-400">{{ $perangkat->jabatan }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="w-full text-center text-gray-400">
                            Data perangkat desa tidak ditemukan.
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="flex flex-row justify-center gap-6 mt-14">
                <button
                    class="z-20 w-8 sm:w-10 h-8 sm:h-10 bg-gray-800 rounded-full flex items-center justify-center shadow hover:bg-gray-700"
                    onclick="prevSlide()">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <button
                    class="z-20 w-8 sm:w-10 h-8 sm:h-10 bg-gray-800 rounded-full flex items-center justify-center shadow hover:bg-gray-700"
                    onclick="nextSlide()">
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </section>

    <script>
        const carouselContainer = document.getElementById('aparaturCarousel');
        const items = Array.from(carouselContainer.children);
        const totalItems = items.length;
        let currentIndex = 0; // Mulai dari 0

        // Pastikan ada item yang bisa di-loop. Jika tidak ada, jangan jalankan script.
        if (totalItems === 0) {
            console.warn('Tidak ada item carousel yang ditemukan.');
        } else {
            // Fungsi untuk mendapatkan item dengan looping
            function getItemAt(index) {
                // Gunakan modulo untuk memastikan indeks selalu berada dalam rentang yang valid
                return items[(index + totalItems) % totalItems];
            }

            function updateCarousel() {
                // Sembunyikan semua item terlebih dahulu untuk memuat ulang
                items.forEach((item) => {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.5)';
                    item.style.zIndex = '1';
                });

                // Tentukan posisi dan properti visual untuk 5 slot
                const positions = [
                    { offset: -2, x: -420, scale: 0.85, opacity: 0.6, z: 10 }, // left2
                    { offset: -1, x: -220, scale: 0.95, opacity: 0.8, z: 15 }, // left1
                    { offset: 0, x: 0, scale: 1.2, opacity: 1, z: 20 },      // active
                    { offset: 1, x: 220, scale: 0.95, opacity: 0.8, z: 15 }, // right1
                    { offset: 2, x: 420, scale: 0.85, opacity: 0.6, z: 10 }, // right2
                ];

                // Terapkan properti visual untuk 5 item yang di-loop
                positions.forEach((pos) => {
                    // Hitung indeks yang benar dengan looping
                    const itemIndex = (currentIndex + pos.offset + totalItems) % totalItems;
                    const item = items[itemIndex];

                    if (item) {
                        item.style.cssText = `
                                                                                                                                                opacity: ${pos.opacity};
                                                                                                                                                transform: translateX(calc(-50% + ${pos.x}px)) scale(${pos.scale});
                                                                                                                                                z-index: ${pos.z};
                                                                                                                                                transition: transform 0.7s ease-in-out, opacity 0.7s ease-in-out;
                                                                                                                                            `;
                    }
                });
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % totalItems;
                updateCarousel();
            }

            function prevSlide() {
                currentIndex = (currentIndex - 1 + totalItems) % totalItems;
                updateCarousel();
            }

            document.addEventListener('DOMContentLoaded', () => {
                updateCarousel();
            });
        }
    </script>
@endsection