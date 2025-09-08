@extends('layouts.guest')

@section('title', 'Pelayanan Desa')
@section('description', 'Berbagai layanan administrasi dan surat-menyurat yang tersedia di desa')

@section('content')
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }
    </style>

    <!-- Header Section -->
    <section class="py-12 pt-24 bg-gray-900 border-b border-gray-700">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Layanan Utama</h2>
            <p class="text-gray-400 max-w-2xl mx-auto">
                Berbagai layanan administrasi yang dapat Anda akses di kantor desa
            </p>
        </div>
    </section>

    <!-- Jam Pelayanan -->
    <section class="py-10 bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach($pelayanans as $item)
                    <div
                        class="card-hover bg-gray-800 rounded-2xl shadow-xl border border-gray-700 hover:border-yellow-500/50 transition-all duration-300 p-6">
                        <div class="flex items-start space-x-4 mb-4">
                            <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-file-alt text-yellow-400 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold text-white mb-2">{{ $item->nama_layanan }}</h3>
                                <span
                                    class="inline-block px-3 py-1 bg-blue-500/20 text-blue-400 text-xs font-medium rounded-full">
                                    {{ $item->kategori }}
                                </span>
                            </div>
                        </div>

                        <p class="text-gray-400 mb-6 leading-relaxed">{{ $item->deskripsi }}</p>

                        @if($item->link_google_form)
                            <div class="flex space-x-3">
                                <a href="{{ $item->link_google_form }}" target="_blank"
                                    class="flex-1 bg-yellow-600 hover:bg-yellow-500 text-white text-center px-4 py-3 rounded-lg font-semibold transition-all duration-300 hover:shadow-lg">
                                    <i class="fas fa-external-link-alt mr-2"></i>
                                    Ajukan Online
                                </a>
                            </div>
                        @else
                            <div class="bg-gray-700/50 rounded-lg p-4 text-center">
                                <i class="fas fa-building text-gray-500 mb-2"></i>
                                <p class="text-gray-500 text-sm">Kunjungi kantor desa untuk layanan ini</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div
                class="card-hover bg-gray-800 rounded-2xl shadow-xl border border-gray-700 hover:border-blue-500/50 transition-all duration-300 p-6 mb-12">
                <h3 class="text-2xl font-bold text-white mb-6 text-center flex items-center justify-center">
                    <i class="fas fa-info-circle text-blue-400 mr-3"></i>
                    Informasi Pelayanan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-500/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-clock text-2xl text-blue-400"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-white mb-2">Jam Pelayanan</h4>
                        <p class="text-gray-400">Senin - Jumat <br>08:00 - 15:00</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-500/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-phone text-2xl text-green-400"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-white mb-2">Kontak</h4>
                        <p class="text-gray-400">xxx-xxx</p>
                        <p class="text-gray-400">xxx@desa.example.id</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-500/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-map-marker-alt text-2xl text-purple-400"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-white mb-2">Lokasi</h4>
                        <p class="text-gray-400">Kantor Desa Tudua</p>
                        <p class="text-gray-400">Jl. Melati No. 2, Dusun 3</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection