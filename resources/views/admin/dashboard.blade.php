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
                    <p class="text-3xl font-bold text-gray-900">{{ $totalPenduduk ?? 0 }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up"></i> +2.5% dari bulan lalu
                    </p>
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
                    <p class="text-3xl font-bold text-gray-900">{{ $totalSuratMasuk ?? 0 }}</p>
                    <p class="text-sm text-blue-600 mt-1">
                        <i class="fas fa-inbox"></i> Bulan ini
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-inbox text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Dana Masuk -->
        <div class="card bg-white rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Dana Masuk</p>
                    <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($totalDanaMasuk ?? 0, 0, ',', '.') }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up"></i> Total tahun ini
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-arrow-down text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Dana Keluar -->
        <div class="card bg-white rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Dana Keluar</p>
                    <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($totalDanaKeluar ?? 0, 0, ',', '.') }}</p>
                    <p class="text-sm text-red-600 mt-1">
                        <i class="fas fa-arrow-up"></i> Total tahun ini
                    </p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
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
                <a href="{{ route('admin.berita.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="space-y-4">
                @forelse($recentBerita ?? [] as $berita)
                <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-newspaper text-blue-600"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $berita->judul }}</p>
                        <p class="text-xs text-gray-500">{{ $berita->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-newspaper text-4xl mb-2"></i>
                    <p>Belum ada berita</p>
                </div>
                @endforelse
            </div>
        </div>
        
        <!-- Recent Pengumuman -->
        <div class="card bg-white rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Pengumuman Terbaru</h3>
                <a href="{{ route('admin.pengumuman.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="space-y-4">
                @forelse($recentPengumuman ?? [] as $pengumuman)
                <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-bullhorn text-yellow-600"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $pengumuman->judul }}</p>
                        <p class="text-xs text-gray-500">{{ $pengumuman->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-bullhorn text-4xl mb-2"></i>
                    <p>Belum ada pengumuman</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="card bg-white rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <a href="{{ route('admin.berita.create') }}" class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                <i class="fas fa-plus-circle text-blue-600 text-2xl mb-2"></i>
                <span class="text-sm font-medium text-blue-800">Tambah Berita</span>
            </a>
            
            <a href="{{ route('admin.pengumuman.create') }}" class="flex flex-col items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors">
                <i class="fas fa-plus-circle text-yellow-600 text-2xl mb-2"></i>
                <span class="text-sm font-medium text-yellow-800">Tambah Pengumuman</span>
            </a>
            
            <a href="{{ route('admin.penduduk.create') }}" class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                <i class="fas fa-user-plus text-green-600 text-2xl mb-2"></i>
                <span class="text-sm font-medium text-green-800">Tambah Penduduk</span>
            </a>
            
            <a href="{{ route('admin.surat-masuk.create') }}" class="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                <i class="fas fa-inbox text-purple-600 text-2xl mb-2"></i>
                <span class="text-sm font-medium text-purple-800">Input Surat</span>
            </a>
            
            <a href="{{ route('admin.dana-masuk.create') }}" class="flex flex-col items-center p-4 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors">
                <i class="fas fa-money-bill-wave text-emerald-600 text-2xl mb-2"></i>
                <span class="text-sm font-medium text-emerald-800">Input Dana</span>
            </a>
            
            <a href="{{ route('admin.media.create') }}" class="flex flex-col items-center p-4 bg-pink-50 rounded-lg hover:bg-pink-100 transition-colors">
                <i class="fas fa-upload text-pink-600 text-2xl mb-2"></i>
                <span class="text-sm font-medium text-pink-800">Upload Media</span>
            </a>
        </div>
    </div>
</div>
@endsection
