@extends('layouts.guest')

@section('title', 'Profil Desa Tudua')
@section('description', 'Profil lengkap Desa Tudua meliputi sejarah, visi misi, struktur organisasi, dan data desa')

@section('content')
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }
    </style>

    <!-- Page Header -->
    <section class="pt-24 pb-12 bg-gray-800">
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
    <section class="py-16 bg-gray-800">
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

    <!-- Visi Misi -->
    <section class="py-16 bg-gray-900">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">Visi & Misi</h2>
                <p class="text-gray-400 max-w-2xl mx-auto text-lg">
                    Komitmen Desa Tudua dalam membangun desa yang maju, sejahtera, dan berkelanjutan
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Visi -->
                <div
                    class="card-hover bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-700 hover:border-blue-500/50">
                    <div
                        class="w-16 h-16 bg-blue-500/20 rounded-xl flex items-center justify-center mb-6 border border-blue-500/30">
                        <i class="fas fa-eye text-blue-400 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Visi</h3>
                    <p class="text-gray-300 text-lg leading-relaxed">
                        "Mewujudkan tata kelola pemerintahan desa Tudua, transparan, bersih dan jujur
                        serta amanah demi terciptanya desa Tudua yang maju, sejahtera bersama dan berakhlak"
                    </p>
                </div>

                <!-- Misi -->
                <div
                    class="card-hover bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-700 hover:border-green-500/50">
                    <div
                        class="w-16 h-16 bg-green-500/20 rounded-xl flex items-center justify-center mb-6 border border-green-500/30">
                        <i class="fas fa-bullseye text-green-400 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-6">Misi</h3>
                    <ul class="text-gray-300 space-y-3">
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
    <section class="py-16 bg-gray-800">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">Struktur Organisasi</h2>
                <p class="text-gray-400 max-w-2xl mx-auto text-lg">
                    Perangkat desa yang berkomitmen melayani masyarakat dengan dedikasi tinggi
                </p>
            </div>

            <!-- Kepala Desa -->
            <div class="text-center mb-12">
                <div class="inline-block">
                    <div
                        class="card-hover bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-700 hover:border-yellow-500/50">
                        <div
                            class="w-24 h-24 bg-yellow-500/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-yellow-500/30">
                            <i class="fas fa-user-tie text-yellow-400 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Hasfudin</h3>
                        <p class="text-yellow-400 font-medium mb-2">Kepala Desa</p>
                        <p class="text-gray-400 text-sm">Periode 2023-2029</p>
                    </div>
                </div>
            </div>

            <!-- Perangkat Desa -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $perangkat = [
                        ['nama' => 'Sekretaris Desa', 'jabatan' => 'Perangkat Desa', 'icon' => 'user-edit', 'color' => 'blue'],
                        ['nama' => 'Kepala Urusan Keuangan', 'jabatan' => 'Kaur Keuangan', 'icon' => 'calculator', 'color' => 'green'],
                        ['nama' => 'Kepala Urusan Umum', 'jabatan' => 'Kaur Umum', 'icon' => 'clipboard-list', 'color' => 'purple'],
                        ['nama' => 'Kepala Dusun I', 'jabatan' => 'Kadus I', 'icon' => 'map-marker-alt', 'color' => 'red'],
                        ['nama' => 'Kepala Dusun II', 'jabatan' => 'Kadus II', 'icon' => 'map-marker-alt', 'color' => 'indigo'],
                        ['nama' => 'Kepala Dusun III', 'jabatan' => 'Kadus III', 'icon' => 'map-marker-alt', 'color' => 'pink'],
                    ];
                @endphp
                @foreach($perangkat as $person)
                    <div
                        class="card-hover bg-gray-800 p-6 rounded-2xl shadow-xl text-center border border-gray-700 hover:border-{{ $person['color'] }}-500/50">
                        <div
                            class="w-16 h-16 bg-{{ $person['color'] }}-500/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-{{ $person['color'] }}-500/30">
                            <i class="fas fa-{{ $person['icon'] }} text-{{ $person['color'] }}-400 text-xl"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-white mb-2">{{ $person['nama'] }}</h4>
                        <p class="text-gray-400">{{ $person['jabatan'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Data Desa -->
    <section class="py-16 bg-gray-900">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">Data Desa</h2>
                <p class="text-gray-400 max-w-2xl mx-auto text-lg">
                    Informasi geografis dan demografis Desa Tudua
                </p>
            </div>

            <!-- Batas Wilayah -->
            <div class="card-hover bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-700">
                <h3 class="text-2xl font-bold text-white mb-8 text-center">Batas Wilayah</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div
                            class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-red-500/30">
                            <i class="fas fa-arrow-up text-red-400 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-white mb-2 text-lg">Utara</h4>
                        <p class="text-gray-400">Desa Bahontobungku</p>
                    </div>
                    <div class="text-center">
                        <div
                            class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-green-500/30">
                            <i class="fas fa-arrow-left text-green-400 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-white mb-2 text-lg">Barat</h4>
                        <p class="text-gray-400">Hutan Negara</p>
                    </div>
                    <div class="text-center">
                        <div
                            class="w-16 h-16 bg-blue-500/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-blue-500/30">
                            <i class="fas fa-arrow-down text-blue-400 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-white mb-2 text-lg">Selatan</h4>
                        <p class="text-gray-400">Laut (Perairan Teluk Tolo)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection