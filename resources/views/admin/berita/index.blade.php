@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('page-title', 'Kelola Berita')
@section('page-description', 'Manajemen berita dan informasi desa')

@section('content')
    <div class="space-y-8">
        <!-- Header Actions -->
        <div class="card">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                    <!-- Search and Filter -->
                    <form method="GET" action="{{ route('admin.berita.index') }}" class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
                            <div class="relative">
                                <input type="text" name="search" placeholder="Cari berita..." value="{{ request('search') }}"
                                    class="pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 hover:bg-white w-full sm:w-80"
                                    id="searchInput">
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg transition-colors duration-200 text-sm">
                                    Cari
                                </button>
                            </div>
                            <select name="status" onchange="this.form.submit()"
                                class="border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 hover:bg-white min-w-[150px]">
                                <option value="">Semua Status</option>
                                <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                                <option value="Dipublikasi" {{ request('status') == 'Dipublikasi' ? 'selected' : '' }}>Dipublikasi</option>
                            </select>
                        </div>
                    </form>

                    <!-- Add Button -->
                    <a href="{{ route('admin.berita.create') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 font-medium group">
                        <div class="w-5 h-5 bg-white/20 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-plus text-sm"></i>
                        </div>
                        Tambah Berita
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="card group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="form-label text-xs uppercase tracking-wider mb-2">Total Berita</p>
                            <p class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                                {{ number_format($berita->total() ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-newspaper text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="form-label text-xs uppercase tracking-wider mb-2">Dipublikasi</p>
                            <p class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                                {{ number_format($berita->where('status', 'Dipublikasi')->count() ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="form-label text-xs uppercase tracking-wider mb-2">Draft</p>
                            <p class="text-2xl font-bold bg-gradient-to-r from-yellow-600 to-orange-600 bg-clip-text text-transparent">
                                {{ number_format($berita->where('status', 'Draft')->count() ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Berita Table -->
        <div class="card">
            <div class="card-header p-6 pb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-list text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Daftar Berita</h3>
                        <p class="text-sm text-gray-500">Kelola semua berita dan informasi desa</p>
                    </div>
                </div>
            </div>

            <div class="p-6 pt-2">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Berita</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Penulis</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tanggal</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($berita as $item)
                                <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent transition-all duration-200 group">
                                    <td class="px-6 py-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="relative w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center overflow-hidden shadow-sm">
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Berita"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="text-sm font-semibold text-gray-900 leading-relaxed">
                                                    <div class="overflow-hidden" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                        {{ $item->judul }}
                                                    </div>
                                                </div>
                                                <div class="text-xs text-gray-500 mt-1">
                                                    {{ \Str::limit(strip_tags($item->isi ?? ''), 80) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-8 h-8 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-user text-blue-600 text-sm"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $item->penulis }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        @if($item->status === 'Dipublikasi')
                                            <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 rounded-xl border border-green-200">
                                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                                                Dipublikasi
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 rounded-xl border border-yellow-200">
                                                <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                                                Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <div class="text-sm text-gray-600">
                                            {{ $item->created_at->translatedFormat('d M Y') }}
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            {{ $item->created_at->diffForHumans() }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <div class="flex items-center justify-center space-x-1">
                                            <a href="{{ route('admin.berita.show', $item->id) }}"
                                                class="w-10 h-10 bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 text-blue-600 rounded-xl flex items-center justify-center transition-all duration-200 hover:scale-110 hover:shadow-md group/btn"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye text-sm group-hover/btn:scale-110 transition-transform duration-200"></i>
                                            </a>
                                            <a href="{{ route('admin.berita.edit', $item->id) }}"
                                                class="w-10 h-10 bg-gradient-to-br from-yellow-50 to-orange-100 hover:from-yellow-100 hover:to-orange-200 text-yellow-600 rounded-xl flex items-center justify-center transition-all duration-200 hover:scale-110 hover:shadow-md group/btn"
                                                title="Edit Berita">
                                                <i class="fas fa-edit text-sm group-hover/btn:scale-110 transition-transform duration-200"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.berita.destroy', $item->id) }}"
                                                class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-10 h-10 bg-gradient-to-br from-red-50 to-pink-100 hover:from-red-100 hover:to-pink-200 text-red-600 rounded-xl flex items-center justify-center transition-all duration-200 hover:scale-110 hover:shadow-md group/btn delete-button"
                                                    title="Hapus Berita">
                                                    <i class="fas fa-trash text-sm group-hover/btn:scale-110 transition-transform duration-200"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center mb-6">
                                                <i class="fas fa-newspaper text-3xl text-gray-400"></i>
                                            </div>
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada berita</h3>
                                            <p class="text-sm text-gray-500 mb-6 max-w-sm">
                                                Mulai dengan menambahkan berita pertama untuk memberikan informasi kepada masyarakat desa
                                            </p>
                                            <a href="{{ route('admin.berita.create') }}"
                                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 font-medium group">
                                                <i class="fas fa-plus mr-2 group-hover:scale-110 transition-transform duration-200"></i>
                                                Tambah Berita Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($berita->hasPages())
                    <div class="flex flex-col sm:flex-row items-center justify-between mt-8 pt-6 border-t border-gray-100 space-y-4 sm:space-y-0">
                        <div class="text-sm text-gray-600">
                            <span class="font-medium">{{ $berita->firstItem() ?? 0 }}</span>
                            -
                            <span class="font-medium">{{ $berita->lastItem() ?? 0 }}</span>
                            dari
                            <span class="font-medium">{{ number_format($berita->total(), 0, ',', '.') }}</span>
                            data
                        </div>
                        <div class="flex items-center space-x-2">
                            {{ $berita->appends(request()->query())->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Real-time search functionality
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('tbody tr');
            
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    
                    tableRows.forEach(row => {
                        if (row.querySelector('td')) { // Skip empty state row
                            const text = row.textContent.toLowerCase();
                            if (text.includes(searchTerm)) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        }
                    });
                });
            }

            // Add loading state to action buttons
            const actionButtons = document.querySelectorAll('a[href*="admin.berita"]');
            actionButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!this.href.includes('#')) {
                        const icon = this.querySelector('i');
                        if (icon) {
                            const originalClass = icon.className;
                            icon.className = 'fas fa-spinner fa-spin text-sm';
                            
                            // Restore original icon after a short delay
                            setTimeout(() => {
                                icon.className = originalClass;
                            }, 1000);
                        }
                    }
                });
            });
        });
    </script>
@endsection