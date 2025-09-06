@extends('layouts.guest')

@section('title', 'Surat Desa')
@section('description', 'Daftar surat masuk dan keluar yang dikelola oleh kantor desa.')

@section('content')
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
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

        .hero-gradient {
            background: linear-gradient(135deg, rgba(17, 24, 39, 0.9) 0%, rgba(31, 41, 55, 0.8) 50%, rgba(55, 65, 81, 0.7) 100%);
        }
    </style>

    <!-- Filter & Search -->
    <section class="py-8 pt-24 bg-gray-900 border-b border-gray-700">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
            <div>
                <h2 class="text-2xl lg:text-3xl font-bold text-white mb-2">Arsip Surat</h2>
                <p class="text-gray-400 text-base">Kelola dan cari surat masuk dan keluar desa</p>
            </div>

            <form method="GET" action="{{ route('arsip') }}" class="flex flex-col md:flex-row items-center justify-between gap-6 w-full lg:w-auto">
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
                    <div class="relative w-full sm:w-80 flex flex-row items-center">
                        <input type="text" 
                            name="search" 
                            placeholder="Cari nomor, pengirim, penerima, atau perihal surat..." 
                            value="{{ request('search') }}"
                            class="w-full pl-12 pr-4 py-1.5 bg-gray-800 border border-gray-600 rounded-xl 
                                    focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 
                                    text-white placeholder-gray-400 transition-all duration-300">
                        <i class="fas fa-search absolute left-4 text-gray-400"></i>
                    </div>

                    <select name="jenis" onchange="this.form.submit()"
                            class="bg-gray-800 border border-gray-600 rounded-xl px-6 py-2 text-white 
                                focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 
                                transition-all duration-300 min-w-[150px]">
                        <option value="">Semua Jenis</option>
                        <option value="masuk" {{ request('jenis') == 'masuk' ? 'selected' : '' }}>Surat Masuk</option>
                        <option value="keluar" {{ request('jenis') == 'keluar' ? 'selected' : '' }}>Surat Keluar</option>
                    </select>

                    <select name="sort" onchange="this.form.submit()"
                            class="bg-gray-800 border border-gray-600 rounded-xl px-6 py-2 text-white 
                                focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 
                                transition-all duration-300 min-w-[150px]">
                        <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>
            </form>
        </div>
    </section>

    <!-- Daftar Surat -->
    <section class="py-10 bg-gray-900 min-h-screen">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($surat as $item)
                    <div class="card-hover bg-gray-800 rounded-2xl shadow-xl border border-gray-700 hover:border-yellow-500/50 transition-all duration-300">
                        <div class="p-6 flex flex-row h-full justify-between">
                            <!-- Info Surat -->
                            <div>
                                <!-- Header dengan badge dan nomor surat -->
                                <div class="flex flex-wrap items-center gap-3 mb-3">
                                    @if($item->jenis == 'masuk')
                                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold inline-flex items-center">
                                            <i class="fas fa-inbox mr-2"></i> SURAT MASUK
                                        </span>
                                    @else
                                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold inline-flex items-center">
                                            <i class="fas fa-paper-plane mr-2"></i> SURAT KELUAR
                                        </span>
                                    @endif
                                    <span class="text-gray-400 text-sm font-mono">{{ $item->nomor_surat }}</span>
                                </div>

                                <!-- Perihal -->
                                <h3 class="text-lg font-bold text-white leading-tight mb-2">
                                    {{ $item->perihal }}
                                </h3>

                                <!-- Detail surat -->
                                <div class="space-y-1.5 text-sm text-gray-300">
                                    @if($item->jenis == 'masuk')
                                        <div class="flex items-center">
                                            <i class="fas fa-user text-yellow-400 mr-2 w-4"></i>
                                            <span><strong>Pengirim:</strong> {{ $item->pengirim }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-alt text-yellow-400 mr-2 w-4"></i>
                                            <span><strong>Tanggal Terima:</strong> {{ $item->tanggal_terima->translatedFormat('d F Y') }}</span>
                                        </div>
                                    @else
                                        <div class="flex items-center">
                                            <i class="fas fa-user-check text-yellow-400 mr-2 w-4"></i>
                                            <span><strong>Penerima:</strong> {{ $item->penerima }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-alt text-yellow-400 mr-2 w-4"></i>
                                            <span><strong>Tanggal Kirim:</strong> {{ $item->tanggal_kirim->translatedFormat('d F Y') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="mt-4">
                                @if($item->file)
                                    <div class="flex flex-wrap flex-col gap-3">
                                        <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                            class="px-4 py-2 bg-yellow-400 text-gray-900 font-semibold rounded-xl shadow hover:bg-yellow-300 transition-all duration-300">
                                            <i class="fas fa-eye mr-2"></i>Lihat File
                                        </a>
                                        <a href="{{ asset('storage/' . $item->file) }}" download
                                            class="px-4 py-2 bg-gray-200 text-gray-900 font-semibold rounded-xl shadow hover:bg-gray-300 transition-all duration-300">
                                            <i class="fas fa-download mr-2"></i>Unduh File
                                        </a>
                                    </div>
                                @else
                                    <div class="flex items-center text-gray-500 px-4 py-3 bg-gray-700 rounded-xl border border-gray-600">
                                        <i class="fas fa-file-times mr-2"></i> Tidak Ada File
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="w-24 h-24 bg-gray-800 rounded-full mx-auto mb-6 flex items-center justify-center border border-gray-700">
                            <i class="fas fa-envelope-open-text text-4xl text-gray-500"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">
                            @if(request('search') || request('jenis'))
                                Tidak Ada Surat Ditemukan
                            @else
                                Belum Ada Surat
                            @endif
                        </h3>
                        <p class="text-gray-400 mb-6">
                            @if(request('search') || request('jenis'))
                                Coba ubah kata kunci pencarian atau filter yang digunakan
                            @else
                                Arsip surat akan ditampilkan di sini ketika sudah tersedia
                            @endif
                        </p>
                        @if(request('search') || request('jenis'))
                            <a href="{{ route('arsip') }}" 
                                class="inline-flex items-center text-yellow-400 font-medium hover:text-yellow-300 transition-colors duration-200">
                                <i class="fas fa-arrow-left mr-2"></i> Lihat Semua Surat
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(isset($surat) && $surat->hasPages())
                <div class="mt-12">
                    <div class="flex items-center justify-center">
                        <div class="flex items-center space-x-2">
                            {{-- Previous Page Link --}}
                            @if ($surat->onFirstPage())
                                <span class="px-4 py-2 text-gray-500 bg-gray-800 border border-gray-600 rounded-lg cursor-not-allowed">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $surat->previousPageUrl() }}" 
                                    class="px-4 py-2 text-white bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 transition-colors duration-200">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($surat->getUrlRange(1, $surat->lastPage()) as $page => $url)
                                @if ($page == $surat->currentPage())
                                    <span class="px-4 py-2 text-gray-900 bg-yellow-500 border border-yellow-500 rounded-lg font-semibold">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" 
                                        class="px-4 py-2 text-white bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 transition-colors duration-200">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($surat->hasMorePages())
                                <a href="{{ $surat->nextPageUrl() }}" 
                                    class="px-4 py-2 text-white bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 transition-colors duration-200">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="px-4 py-2 text-gray-500 bg-gray-800 border border-gray-600 rounded-lg cursor-not-allowed">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Pagination Info --}}
                    <div class="text-center mt-4 text-gray-400 text-sm">
                        Menampilkan {{ $surat->firstItem() ?? 0 }} - {{ $surat->lastItem() ?? 0 }} dari {{ $surat->total() }} surat
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection