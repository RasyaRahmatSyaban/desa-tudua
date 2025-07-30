@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan data dan statistik desa')

@section('content')
    <div class="space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Penduduk -->
            <div class="card bg-white rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Penduduk</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalPenduduk }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Surat Masuk -->
            <div class="card bg-white rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Surat Masuk</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalSuratMasuk }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-200 rounded-lg flex items-center justify-center">
                        <i class="fas fa-inbox text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Dana Masuk -->
            <div class="card bg-white rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Dana Masuk</p>
                        <p class="text-2xl font-bold text-gray-900">Rp
                            {{ number_format($totalDanaMasuk ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-200 rounded-lg flex items-center justify-center">
                        <i class="fas fa-arrow-down text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Dana Keluar -->
            <div class="card bg-white rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Dana Keluar</p>
                        <p class="text-2xl font-bold text-gray-900">Rp
                            {{ number_format($totalDanaKeluar ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-red-200 rounded-lg flex items-center justify-center">
                        <i class="fas fa-arrow-up text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Berita -->
            <div class="card bg-white rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Berita Terbaru</h3>
                    <a href="{{ route('admin.berita.index') }}"
                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <div class="relative">
                    {{-- Kontainer Berita --}}
                    <div id="beritaContainer" class="flex space-x-4 overflow-hidden scroll-smooth px-1 pb-2">
                        @forelse($berita as $b)
                            <div
                                class="min-w-[220px] bg-white rounded-xl shadow hover:shadow-md transition-shadow duration-300 mb-2">
                                <img src="{{ asset('storage/' . $b->foto) }}" alt="Thumbnail Berita"
                                    class="w-full h-32 object-cover rounded-t-xl">
                                <div class="p-4">
                                    <p class="text-sm font-semibold text-gray-800 truncate" title="{{ $b->judul }}">
                                        {{ $b->judul }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500 w-full">
                                <i class="fas fa-newspaper text-4xl mb-2"></i>
                                <p>Belum ada berita</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Tombol Scroll di bawah --}}
                    <div class="flex justify-center mt-4 space-x-4">
                        <button type="button" onclick="scrollContainer('beritaContainer', 'left')"
                            class="bg-white p-2 rounded-full shadow hover:bg-gray-100">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button type="button" onclick="scrollContainer('beritaContainer', 'right')"
                            class="bg-white p-2 rounded-full shadow hover:bg-gray-100">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>


            <!-- Recent Pengumuman -->
            <div class="card bg-white rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Pengumuman Terbaru</h3>
                    <a href="{{ route('admin.pengumuman.index') }}"
                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="relative">
                    {{-- Container Scroll Horizontal --}}
                    <div id="pengumumanContainer" class="overflow-hidden scroll-smooth whitespace-nowrap px-4 py-4">

                        {{-- Grid 2 Baris dalam 1 Kolom Horizontal --}}
                        <div class="grid grid-rows-2 auto-cols-max gap-4 grid-flow-col snap-x snap-mandatory">
                            @foreach ($pengumuman as $item)
                                <div class="w-64 p-2 bg-white rounded-xl shadow snap-start">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center mt-1">
                                            <i class="fas fa-bullhorn text-yellow-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <span class="font-semibold text-gray-900 block">{{ $item->judul }}</span>
                                            <span class="text-sm text-gray-500 block mt-1 leading-snug">
                                                Berlaku hingga: <br>
                                                {{ \Carbon\Carbon::parse($item->berlaku_hingga)->translatedFormat('d F Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Tombol Scroll Kiri-Kanan --}}
                    <div class="flex justify-center mt-4 space-x-4">
                        <button onclick="scrollContainer('pengumumanContainer', 'left')"
                            class="bg-white p-2 rounded-full shadow hover:bg-gray-100">
                            <i class="fas fa-chevron-left text-gray-600"></i>
                        </button>
                        <button onclick="scrollContainer('pengumumanContainer', 'right')"
                            class="bg-white p-2 rounded-full shadow hover:bg-gray-100">
                            <i class="fas fa-chevron-right text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card bg-white rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <a href="{{ route('admin.berita.create') }}"
                    class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                    <i class="fas fa-plus-circle text-blue-600 text-2xl mb-2"></i>
                    <span class="text-sm font-medium text-blue-800">Tambah Berita</span>
                </a>

                <a href="{{ route('admin.pengumuman.create') }}"
                    class="flex flex-col items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors">
                    <i class="fas fa-plus-circle text-yellow-600 text-2xl mb-2"></i>
                    <span class="text-sm font-medium text-yellow-800">Tambah Pengumuman</span>
                </a>

                <a href="{{ route('admin.penduduk.create') }}"
                    class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-200 transition-colors">
                    <i class="fas fa-user-plus text-green-600 text-2xl mb-2"></i>
                    <span class="text-sm font-medium text-green-800">Tambah Penduduk</span>
                </a>

                <a href="{{ route('admin.surat-masuk.create') }}"
                    class="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                    <i class="fas fa-inbox text-purple-600 text-2xl mb-2"></i>
                    <span class="text-sm font-medium text-purple-800">Input Surat</span>
                </a>

                <a href="{{ route('admin.dana-masuk.create') }}"
                    class="flex flex-col items-center p-4 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors">
                    <i class="fas fa-money-bill-wave text-emerald-600 text-2xl mb-2"></i>
                    <span class="text-sm font-medium text-emerald-800">Input Dana</span>
                </a>

                <a href="{{ route('admin.media.create') }}"
                    class="flex flex-col items-center p-4 bg-pink-50 rounded-lg hover:bg-pink-100 transition-colors">
                    <i class="fas fa-upload text-pink-600 text-2xl mb-2"></i>
                    <span class="text-sm font-medium text-pink-800">Upload Media</span>
                </a>
            </div>
        </div>
    </div>
    <script>
        function scrollContainer(containerId, direction) {
            const container = document.getElementById(containerId);
            const scrollAmount = 250;

            if (direction === 'left') {
                container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            } else {
                container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }
    </script>
@endsection