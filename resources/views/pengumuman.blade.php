@extends('layouts.guest')

@section('title', 'Pengumuman Desa')
@section('meta-description', 'Pengumuman dan informasi penting dari pemerintah desa')

@section('content')
    <div class="container mx-auto px-4 pt-24 pb-20">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Pengumuman Desa</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Informasi penting dan pengumuman terbaru dari pemerintah desa untuk masyarakat
            </p>
        </div>

        <!-- Filter and Search -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form method="GET" action="{{ route('pengumuman') }}" class="flex items-center justify-between">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari berita..." value="{{ request('search') }}"
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        id="searchInput">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </form>
        </div>
        <!-- All Announcements -->
        <div class="">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Semua Pengumuman</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="announcementsList">
                @forelse ($pengumuman as $item)
                    <div class="bg-white rounded-lg shadow-md p-6 announcement-item">
                        <div class="flex items-start justify-between mb-4">
                            <span class="text-gray-500 text-sm">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $item->created_at->format('d M Y') }}
                            </span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $item->judul }}</h3>
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit(strip_tags($item->isi), 200) }}
                        </p>
                        <div class="flex items-center justify-between">
                            @if($item->berlaku_hingga)
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-clock mr-1"></i>
                                    <span>Berlaku hingga:
                                        {{ $item->berlaku_hingga->format('d M Y') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-gray-500 text-center py-12">
                        Tidak ada pengumuman yang tersedia.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection