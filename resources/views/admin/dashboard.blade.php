@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan data dan statistik desa')

@section('content')
    <div class="space-y-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Penduduk -->
            <div class="card group">
                <div class="p-6 pb-4">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="form-label text-xs uppercase tracking-wider mb-2">Total Penduduk</p>
                            <p
                                class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                                {{ number_format($totalPenduduk ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-users text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Surat Masuk -->
            <div class="card group">
                <div class="p-6 pb-4">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="form-label text-xs uppercase tracking-wider mb-2">Surat Masuk</p>
                            <p
                                class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                                {{ number_format($totalSuratMasuk ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-inbox text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dana Masuk -->
            <div class="card group">
                <div class="p-6 pb-4">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="form-label text-xs uppercase tracking-wider mb-2">Dana Masuk</p>
                            <p
                                class="text-xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
                                Rp {{ number_format($totalDanaMasuk ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-arrow-down text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dana Keluar -->
            <div class="card group">
                <div class="p-6 pb-4">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="form-label text-xs uppercase tracking-wider mb-2">Dana Keluar</p>
                            <p
                                class="text-xl font-bold bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent">
                                Rp {{ number_format($totalDanaKeluar ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-arrow-up text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Recent Activity -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            <!-- Recent Berita -->
            <div class="card">
                <div class="card-header p-6 pb-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-newspaper text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Berita Terbaru</h3>
                                <p class="text-sm text-gray-500">Artikel dan informasi terkini</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.berita.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 hover:text-blue-700 rounded-xl transition-all duration-200 text-sm font-medium group">
                            Lihat Semua
                            <i
                                class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                        </a>
                    </div>
                </div>

                <div class="p-6 pt-2">
                    <div class="relative">
                        <!-- Scroll Container -->
                        <div id="beritaContainer" class="flex space-x-4 overflow-x-auto scroll-smooth pb-4 scrollbar-hide">
                            @forelse($berita as $b)
                                <div
                                    class="min-w-[280px] bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 group">
                                    <div class="relative overflow-hidden rounded-t-2xl">
                                        <img src="{{ asset('storage/' . $b->foto) }}" alt="Thumbnail Berita"
                                            class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                    </div>
                                    <div class="p-4">
                                        <h4 class="font-semibold text-gray-800 line-clamp-2 text-sm leading-relaxed"
                                            title="{{ $b->judul }}">
                                            {{ $b->judul }}
                                        </h4>
                                        <div class="flex items-center justify-between mt-3">
                                            <span class="badge badge-info">
                                                {{ \Carbon\Carbon::parse($b->created_at)->diffForHumans() }}
                                            </span>
                                            <i class="fas fa-external-link-alt text-gray-400 text-xs"></i>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="flex-1 text-center py-12 text-gray-500">
                                    <div
                                        class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-newspaper text-2xl text-gray-400"></i>
                                    </div>
                                    <p class="font-medium">Belum ada berita</p>
                                    <p class="text-sm mt-1">Mulai dengan membuat berita pertama</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Scroll Controls -->
                        @if(count($berita ?? []) > 1)
                            <div class="flex justify-center mt-4 space-x-2">
                                <button type="button" onclick="scrollContainer('beritaContainer', 'left')"
                                    class="w-10 h-10 bg-white hover:bg-gray-50 border border-gray-200 rounded-xl shadow-sm hover:shadow transition-all duration-200 flex items-center justify-center group">
                                    <i
                                        class="fas fa-chevron-left text-gray-600 group-hover:text-blue-600 transition-colors duration-200"></i>
                                </button>
                                <button type="button" onclick="scrollContainer('beritaContainer', 'right')"
                                    class="w-10 h-10 bg-white hover:bg-gray-50 border border-gray-200 rounded-xl shadow-sm hover:shadow transition-all duration-200 flex items-center justify-center group">
                                    <i
                                        class="fas fa-chevron-right text-gray-600 group-hover:text-blue-600 transition-colors duration-200"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Pengumuman -->
            <div class="card">
                <div class="card-header p-6 pb-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center">
                                <i class="fas fa-bullhorn text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Pengumuman Terbaru</h3>
                                <p class="text-sm text-gray-500">Informasi penting desa</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.pengumuman.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 hover:text-yellow-700 rounded-xl transition-all duration-200 text-sm font-medium group">
                            Lihat Semua
                            <i
                                class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                        </a>
                    </div>
                </div>

                <div class="p-6 pt-2">
                    @forelse($pengumuman as $item)
                        <div
                            class="flex items-start space-x-4 p-4 rounded-2xl hover:bg-gray-50 transition-colors duration-200 border border-transparent hover:border-yellow-200">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-yellow-100 to-orange-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-bullhorn text-yellow-600"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-900 line-clamp-2 text-sm">{{ $item->judul }}</h4>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-xs text-gray-500">
                                        Berlaku hingga:
                                        {{ \Carbon\Carbon::parse($item->berlaku_hingga)->translatedFormat('d M Y') }}
                                    </span>
                                    <span class="badge badge-warning">
                                        {{ \Carbon\Carbon::parse($item->berlaku_hingga)->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-500">
                            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-bullhorn text-2xl text-gray-400"></i>
                            </div>
                            <p class="font-medium">Belum ada pengumuman</p>
                            <p class="text-sm mt-1">Buat pengumuman untuk memberikan informasi penting</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header p-6 pb-4">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-bolt text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Aksi Cepat</h3>
                        <p class="text-sm text-gray-500">Shortcuts untuk aktivitas umum</p>
                    </div>
                </div>
            </div>

            <div class="p-6 pt-2">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <a href="{{ route('admin.berita.create') }}"
                        class="group flex flex-col items-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-2xl transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border border-blue-200">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <span class="text-sm font-semibold text-blue-800 text-center">Tambah Berita</span>
                    </a>

                    <a href="{{ route('admin.pengumuman.create') }}"
                        class="group flex flex-col items-center p-6 bg-gradient-to-br from-yellow-50 to-orange-100 hover:from-yellow-100 hover:to-orange-200 rounded-2xl transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border border-yellow-200">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-bullhorn text-white"></i>
                        </div>
                        <span class="text-sm font-semibold text-yellow-800 text-center">Tambah Pengumuman</span>
                    </a>

                    <a href="{{ route('admin.penduduk.create') }}"
                        class="group flex flex-col items-center p-6 bg-gradient-to-br from-green-50 to-emerald-100 hover:from-green-100 hover:to-emerald-200 rounded-2xl transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border border-green-200">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-user-plus text-white"></i>
                        </div>
                        <span class="text-sm font-semibold text-green-800 text-center">Tambah Penduduk</span>
                    </a>

                    <a href="{{ route('admin.surat-masuk.create') }}"
                        class="group flex flex-col items-center p-6 bg-gradient-to-br from-purple-50 to-indigo-100 hover:from-purple-100 hover:to-indigo-200 rounded-2xl transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border border-purple-200">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-inbox text-white"></i>
                        </div>
                        <span class="text-sm font-semibold text-purple-800 text-center">Input Surat</span>
                    </a>

                    <a href="{{ route('admin.dana-masuk.create') }}"
                        class="group flex flex-col items-center p-6 bg-gradient-to-br from-emerald-50 to-teal-100 hover:from-emerald-100 hover:to-teal-200 rounded-2xl transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border border-emerald-200">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-money-bill-wave text-white"></i>
                        </div>
                        <span class="text-sm font-semibold text-emerald-800 text-center">Input Dana</span>
                    </a>

                    <a href="{{ route('admin.media.create') }}"
                        class="group flex flex-col items-center p-6 bg-gradient-to-br from-pink-50 to-rose-100 hover:from-pink-100 hover:to-rose-200 rounded-2xl transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border border-pink-200">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-upload text-white"></i>
                        </div>
                        <span class="text-sm font-semibold text-pink-800 text-center">Upload Media</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Custom animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .hover\:float:hover {
            animation: float 2s ease-in-out infinite;
        }

        /* Gradient text utilities */
        .text-gradient-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .text-gradient-green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>

    <script>
        function scrollContainer(containerId, direction) {
            const container = document.getElementById(containerId);
            const scrollAmount = 300;

            if (direction === 'left') {
                container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            } else {
                container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }

        // Add intersection observer for animations
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.card');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            }, { threshold: 0.1 });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                observer.observe(card);
            });

            // Add loading states for quick actions
            const quickActionLinks = document.querySelectorAll('[href*="create"]');
            quickActionLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    const icon = this.querySelector('i');
                    const originalClass = icon.className;

                    icon.className = 'fas fa-spinner fa-spin text-white';

                    setTimeout(() => {
                        icon.className = originalClass;
                    }, 1000);
                });
            });
        });
    </script>
@endsection