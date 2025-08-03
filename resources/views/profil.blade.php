@extends('layouts.guest')

@section('title', 'Profil Desa')
@section('description', 'Profil lengkap desa meliputi sejarah, visi misi, dan struktur organisasi')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-green-600 to-green-800 text-white pt-30 pb-20">
        <div class=" max-w-7xl mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Profil Desa</h1>
                <p class="text-xl text-green-100 max-w-2xl mx-auto">
                    Mengenal lebih dekat desa kami, sejarah, visi misi, dan struktur organisasi
                </p>
            </div>
        </div>
    </section>

    <!-- Sejarah Desa -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Sejarah Desa</h2>
                    <div class="prose prose-lg text-gray-700">
                        <p class="mb-4">
                            Desa kami didirikan pada tahun 1945 oleh para pendiri yang memiliki visi untuk
                            menciptakan komunitas yang harmonis dan sejahtera. Berawal dari sebuah perkampungan
                            kecil dengan beberapa keluarga, desa ini telah berkembang menjadi komunitas yang
                            modern namun tetap mempertahankan nilai-nilai tradisional.
                        </p>
                        <p class="mb-4">
                            Sepanjang sejarahnya, desa ini telah mengalami berbagai transformasi penting,
                            mulai dari pembangunan infrastruktur dasar, pengembangan sektor pertanian,
                            hingga modernisasi sistem administrasi dan pelayanan publik.
                        </p>
                        <p>
                            Hari ini, desa kami bangga menjadi salah satu desa percontohan dalam penerapan
                            teknologi digital untuk pelayanan masyarakat, sambil tetap melestarikan
                            budaya dan tradisi lokal yang telah diwariskan turun-temurun.
                        </p>
                    </div>
                </div>
                <div>
                    <img src="/placeholder.svg?height=400&width=600" alt="Sejarah Desa" class="rounded-lg shadow-lg w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Visi & Misi</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Komitmen kami dalam membangun desa yang maju, sejahtera, dan berkelanjutan
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Visi -->
                <div class="card-hover bg-white p-8 rounded-lg shadow-md">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-eye text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi</h3>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        "Mewujudkan desa yang maju, sejahtera, mandiri, dan berkelanjutan
                        dengan memanfaatkan potensi lokal dan teknologi modern untuk
                        kesejahteraan seluruh masyarakat."
                    </p>
                </div>

                <!-- Misi -->
                <div class="card-hover bg-white p-8 rounded-lg shadow-md">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-bullseye text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Misi</h3>
                    <ul class="text-gray-700 space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                            Meningkatkan kualitas pelayanan publik yang efektif dan efisien
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                            Mengembangkan potensi ekonomi lokal dan pemberdayaan masyarakat
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                            Melestarikan budaya dan lingkungan hidup yang berkelanjutan
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                            Meningkatkan partisipasi masyarakat dalam pembangunan desa
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Struktur Organisasi -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Struktur Organisasi</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Perangkat desa yang berkomitmen melayani masyarakat dengan dedikasi tinggi
                </p>
            </div>

            <!-- Kepala Desa -->
            <div class="text-center mb-12">
                <div class="inline-block">
                    <div class="card-hover bg-blue-50 p-8 rounded-lg shadow-md">
                        <div class="w-24 h-24 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user-tie text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Bapak Soekarno</h3>
                        <p class="text-blue-600 font-medium mb-2">Kepala Desa</p>
                        <p class="text-gray-600 text-sm">Periode 2019-2025</p>
                    </div>
                </div>
            </div>

            <!-- Perangkat Desa -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $perangkat = [
                        ['nama' => 'Ibu Siti Aminah', 'jabatan' => 'Sekretaris Desa', 'icon' => 'user-edit'],
                        ['nama' => 'Bapak Ahmad Yani', 'jabatan' => 'Kepala Urusan Keuangan', 'icon' => 'calculator'],
                        ['nama' => 'Ibu Dewi Sartika', 'jabatan' => 'Kepala Urusan Umum', 'icon' => 'clipboard-list'],
                        ['nama' => 'Bapak Sudirman', 'jabatan' => 'Kepala Dusun I', 'icon' => 'map-marker-alt'],
                        ['nama' => 'Bapak Gatot Subroto', 'jabatan' => 'Kepala Dusun II', 'icon' => 'map-marker-alt'],
                        ['nama' => 'Ibu Cut Nyak Dien', 'jabatan' => 'Kepala Dusun III', 'icon' => 'map-marker-alt'],
                    ];
                @endphp

                @foreach($perangkat as $person)
                    <div class="card-hover bg-white p-6 rounded-lg shadow-md text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-{{ $person['icon'] }} text-gray-600 text-xl"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $person['nama'] }}</h4>
                        <p class="text-gray-600">{{ $person['jabatan'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Data Desa -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Data Desa</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Informasi geografis dan demografis desa
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Luas Wilayah -->
                <div class="card-hover bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map text-green-600 text-xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-2">245 Ha</h4>
                    <p class="text-gray-600">Luas Wilayah</p>
                </div>

                <!-- Jumlah Dusun -->
                <div class="card-hover bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-home text-blue-600 text-xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-2">3</h4>
                    <p class="text-gray-600">Jumlah Dusun</p>
                </div>

                <!-- RT/RW -->
                <div class="card-hover bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-sitemap text-purple-600 text-xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-2">12/4</h4>
                    <p class="text-gray-600">RT / RW</p>
                </div>

                <!-- Ketinggian -->
                <div class="card-hover bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-mountain text-yellow-600 text-xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-2">125 mdpl</h4>
                    <p class="text-gray-600">Ketinggian</p>
                </div>
            </div>

            <!-- Batas Wilayah -->
            <div class="mt-12">
                <div class="card-hover bg-white p-8 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 text-center">Batas Wilayah</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-arrow-up text-red-600"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Utara</h4>
                            <p class="text-gray-600 text-sm">Desa Makmur</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-arrow-down text-blue-600"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Selatan</h4>
                            <p class="text-gray-600 text-sm">Desa Sejahtera</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-arrow-right text-green-600"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Timur</h4>
                            <p class="text-gray-600 text-sm">Desa Maju</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-arrow-left text-yellow-600"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Barat</h4>
                            <p class="text-gray-600 text-sm">Desa Sentosa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Desa -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Fasilitas Desa</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Berbagai fasilitas umum yang tersedia untuk mendukung kehidupan masyarakat
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @php
                    $fasilitas = [
                        ['nama' => 'Balai Desa', 'icon' => 'building', 'jumlah' => '1'],
                        ['nama' => 'Masjid', 'icon' => 'mosque', 'jumlah' => '3'],
                        ['nama' => 'Sekolah', 'icon' => 'school', 'jumlah' => '2'],
                        ['nama' => 'Puskesmas', 'icon' => 'hospital', 'jumlah' => '1'],
                        ['nama' => 'Posyandu', 'icon' => 'baby', 'jumlah' => '4'],
                        ['nama' => 'Pasar', 'icon' => 'store', 'jumlah' => '1'],
                    ];
                @endphp

                @foreach($fasilitas as $item)
                    <div class="card-hover bg-gray-50 p-6 rounded-lg text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-{{ $item['icon'] }} text-blue-600"></i>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-1">{{ $item['nama'] }}</h4>
                        <p class="text-2xl font-bold text-blue-600">{{ $item['jumlah'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection