@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan data dan statistik desa')

@section('content')
    <div class="space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Penduduk -->
            <div
                class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-200">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Total Penduduk</p>
                            <p class="text-2xl font-bold text-slate-800">
                                {{ number_format($totalPenduduk ?? 0, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-slate-400 mt-1">Jiwa terdaftar</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Surat Masuk -->
            <div
                class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-200">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Surat Masuk</p>
                            <p class="text-2xl font-bold text-slate-800">
                                {{ number_format($totalSuratMasuk ?? 0, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-slate-400 mt-1">Surat diterima</p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-inbox text-emerald-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dana Masuk -->
            <div
                class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-200">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Dana Masuk</p>
                            <p class="text-lg font-bold text-slate-800">
                                Rp {{ number_format($totalDanaMasuk ?? 0, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-slate-400 mt-1">Total penerimaan</p>
                        </div>
                        <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-arrow-down text-green-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dana Keluar -->
            <div
                class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-200">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Dana Keluar</p>
                            <p class="text-lg font-bold text-slate-800">
                                Rp {{ number_format($totalDanaKeluar ?? 0, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-slate-400 mt-1">Total pengeluaran</p>
                        </div>
                        <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-arrow-up text-red-600"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-5 border-b border-slate-100">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-bolt text-violet-600 text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Aksi Cepat</h3>
                        <p class="text-sm text-slate-500">Shortcuts untuk aktivitas umum</p>
                    </div>
                </div>
            </div>

            <div class="p-5">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <a href="{{ route('admin.berita.create') }}"
                        class="group flex flex-col items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-all duration-200 hover:shadow-sm border border-blue-100 hover:border-blue-200">
                        <div
                            class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mb-2 group-hover:scale-105 transition-transform duration-200">
                            <i class="fas fa-plus text-white text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-blue-700 text-center">Tambah Berita</span>
                    </a>

                    <a href="{{ route('admin.pengumuman.create') }}"
                        class="group flex flex-col items-center p-4 bg-amber-50 hover:bg-amber-100 rounded-xl transition-all duration-200 hover:shadow-sm border border-amber-100 hover:border-amber-200">
                        <div
                            class="w-10 h-10 bg-amber-600 rounded-lg flex items-center justify-center mb-2 group-hover:scale-105 transition-transform duration-200">
                            <i class="fas fa-bullhorn text-white text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-amber-700 text-center">Tambah Pengumuman</span>
                    </a>

                    <a href="{{ route('admin.penduduk.create') }}"
                        class="group flex flex-col items-center p-4 bg-emerald-50 hover:bg-emerald-100 rounded-xl transition-all duration-200 hover:shadow-sm border border-emerald-100 hover:border-emerald-200">
                        <div
                            class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center mb-2 group-hover:scale-105 transition-transform duration-200">
                            <i class="fas fa-user-plus text-white text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-emerald-700 text-center">Tambah Penduduk</span>
                    </a>

                    <a href="{{ route('admin.surat-masuk.create') }}"
                        class="group flex flex-col items-center p-4 bg-violet-50 hover:bg-violet-100 rounded-xl transition-all duration-200 hover:shadow-sm border border-violet-100 hover:border-violet-200">
                        <div
                            class="w-10 h-10 bg-violet-600 rounded-lg flex items-center justify-center mb-2 group-hover:scale-105 transition-transform duration-200">
                            <i class="fas fa-inbox text-white text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-violet-700 text-center">Input Surat</span>
                    </a>

                    <a href="{{ route('admin.dana-masuk.create') }}"
                        class="group flex flex-col items-center p-4 bg-green-50 hover:bg-green-100 rounded-xl transition-all duration-200 hover:shadow-sm border border-green-100 hover:border-green-200">
                        <div
                            class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mb-2 group-hover:scale-105 transition-transform duration-200">
                            <i class="fas fa-money-bill-wave text-white text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-green-700 text-center">Input Dana</span>
                    </a>

                    <a href="{{ route('admin.media.create') }}"
                        class="group flex flex-col items-center p-4 bg-rose-50 hover:bg-rose-100 rounded-xl transition-all duration-200 hover:shadow-sm border border-rose-100 hover:border-rose-200">
                        <div
                            class="w-10 h-10 bg-rose-600 rounded-lg flex items-center justify-center mb-2 group-hover:scale-105 transition-transform duration-200">
                            <i class="fas fa-upload text-white text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-rose-700 text-center">Upload Media</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <!-- Recent Berita -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="p-5 border-b border-slate-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-newspaper text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800">Berita Terbaru</h3>
                                <p class="text-sm text-slate-500">Artikel dan informasi terkini</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.berita.index') }}"
                            class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors duration-200 text-sm font-medium">
                            Lihat Semua
                            <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                        </a>
                    </div>
                </div>

                <div class="p-5">
                    @forelse($berita as $b)
                        <div
                            class="flex items-start space-x-3 p-3 -mx-3 rounded-lg hover:bg-slate-50 transition-colors duration-200 {{ !$loop->last ? 'border-b border-slate-100 mb-3 pb-3' : '' }}">
                            <img src="{{ asset('storage/' . $b->foto) }}" alt="Thumbnail"
                                class="w-16 h-16 object-cover rounded-lg flex-shrink-0 border border-slate-200">
                            <div class="flex-1 min-w-0">
                                <h4 class="font-medium text-slate-800 text-sm line-clamp-2 leading-relaxed mb-2">
                                    {{ $b->judul }}
                                </h4>
                                <div class="flex items-center justify-between">
                                    <span
                                        class="inline-flex items-center px-2 py-1 bg-slate-100 text-slate-600 rounded text-xs font-medium">
                                        <i class="fas fa-clock mr-1 text-xs"></i>
                                        {{ \Carbon\Carbon::parse($b->created_at)->diffForHumans() }}
                                    </span>
                                    <i class="fas fa-external-link-alt text-slate-400 text-xs"></i>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-newspaper text-slate-400 text-xl"></i>
                            </div>
                            <p class="text-slate-600 font-medium">Belum ada berita</p>
                            <p class="text-sm text-slate-500 mt-1">Mulai dengan membuat berita pertama</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Pengumuman -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="p-5 border-b border-slate-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-bullhorn text-amber-600 text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800">Pengumuman Terbaru</h3>
                                <p class="text-sm text-slate-500">Informasi penting desa</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.pengumuman.index') }}"
                            class="inline-flex items-center px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-600 rounded-lg transition-colors duration-200 text-sm font-medium">
                            Lihat Semua
                            <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                        </a>
                    </div>
                </div>

                <div class="p-5">
                    @forelse($pengumuman as $item)
                        <div
                            class="flex items-start space-x-3 p-3 -mx-3 rounded-lg hover:bg-slate-50 transition-colors duration-200 {{ !$loop->last ? 'border-b border-slate-100 mb-3 pb-3' : '' }}">
                            <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-bullhorn text-amber-600 text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-medium text-slate-800 text-sm line-clamp-2 leading-relaxed mb-2">
                                    {{ $item->judul }}
                                </h4>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-slate-500">
                                        Berlaku hingga:
                                        {{ \Carbon\Carbon::parse($item->berlaku_hingga)->translatedFormat('d M Y') }}
                                    </span>
                                    <span
                                        class="inline-flex items-center px-2 py-1 bg-amber-100 text-amber-700 rounded text-xs font-medium">
                                        {{ \Carbon\Carbon::parse($item->berlaku_hingga)->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-bullhorn text-slate-400 text-xl"></i>
                            </div>
                            <p class="text-slate-600 font-medium">Belum ada pengumuman</p>
                            <p class="text-sm text-slate-500 mt-1">Buat pengumuman untuk memberikan informasi penting</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

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

        document.addEventListener('DOMContentLoaded', function () {
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

        // Hide scrollbar for berita container
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('beritaContainer');
            if (container) {
                container.style.setProperty('-webkit-scrollbar', 'none', 'important');
                container.style.setProperty('scrollbar-width', 'none', 'important');
                container.style.setProperty('-ms-overflow-style', 'none', 'important');
            }
        });
    </script>
@endsection