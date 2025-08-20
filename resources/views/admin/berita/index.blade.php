@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('page-title', 'Kelola Berita')
@section('page-description', 'Manajemen berita dan informasi desa')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <form method="GET" action="{{ route('admin.berita.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari berita..." value="{{ request('search') }}"
                        class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        id="searchInput">
                    <i class="fas fa-search absolute left-3 top-3 text-slate-400 text-sm"></i>
                </div>
                <select name="status" onchange="this.form.submit()"
                    class="bg-white border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    <option value="">Semua Status</option>
                    <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                    <option value="Dipublikasi" {{ request('status') == 'Dipublikasi' ? 'selected' : '' }}>Dipublikasi
                    </option>
                </select>
            </form>

            <a href="{{ route('admin.berita.create') }}"
                class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                <i class="fas fa-plus mr-2"></i>
                Tambah Berita
            </a>
        </div>

        <!-- Stats Summary -->
        @if($berita->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Berita</p>
                            <p class="text-xl font-bold text-slate-800">{{ $berita->total() }}</p>
                        </div>
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-newspaper text-blue-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Dipublikasi</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $berita->where('status', 'Dipublikasi')->count() }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-emerald-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Draft</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $berita->where('status', 'Draft')->count() }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-amber-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Bulan Ini</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $berita->where('created_at', '>=', now()->startOfMonth())->count() }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar text-violet-600 text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Berita Cards -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($berita as $item)
                        <div
                            class="bg-slate-50 rounded-lg shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-shadow duration-200 flex flex-col">
                            <!-- Foto Berita -->
                            <div class="relative w-full h-48">
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                                    class="w-full h-48 object-cover">
                                <!-- Status Badge -->
                                <div class="absolute top-2 right-2">
                                    @if($item->status === 'Dipublikasi')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded-full">
                                            <i class="fas fa-check-circle mr-1 text-xs"></i>
                                            Dipublikasi
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 bg-amber-100 text-amber-800 text-xs font-medium rounded-full">
                                            <i class="fas fa-clock mr-1 text-xs"></i>
                                            Draft
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-4 space-y-3">
                                <h3 class="font-semibold text-sm text-slate-800 line-clamp-2 leading-relaxed">
                                    {{ $item->judul }}
                                </h3>
                                <p class="text-xs text-slate-500 line-clamp-4 leading-relaxed">
                                    {{ Str::limit(strip_tags($item->isi), 250) }}
                                </p>
                            </div>

                            <div class="px-4 pb-3 mt-auto">
                                <div class="space-y-1">
                                    <span
                                        class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                        <i class="fas fa-user mr-1 text-xs"></i>
                                        {{ $item->penulis }}
                                    </span>
                                    <div class="text-xs text-slate-500">
                                        {{ $item->updated_at ? $item->updated_at->format('d M Y H:i') : ($item->created_at ? $item->created_at->format('d M Y H:i') : '-') }}
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="px-4 py-3 bg-white border-t border-slate-100 flex justify-between items-center">
                                <div class="flex gap-1">
                                    <a href="{{ route('admin.berita.show', $item->id) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                                        title="Lihat Detail">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                    <a href="{{ route('admin.berita.edit', $item->id) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors duration-200"
                                        title="Edit Berita">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.berita.destroy', $item->id) }}"
                                        class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors duration-200 delete-button"
                                            title="Hapus Berita">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="flex flex-col items-center py-12">
                                <div class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center mb-4">
                                    <i class="fas fa-newspaper text-2xl text-slate-400"></i>
                                </div>
                                <p class="text-lg font-medium text-slate-600 mb-2">Belum ada berita</p>
                                <p class="text-sm text-slate-500 mb-4">Mulai dengan menambahkan berita pertama</p>
                                <a href="{{ route('admin.berita.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                    <i class="fas fa-plus mr-2"></i>
                                    Tambah Berita
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($berita->hasPages())
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-6 pt-6 border-t border-slate-200">
                        <div class="text-sm text-slate-600">
                            Menampilkan {{ $berita->firstItem() ?? 0 }} sampai {{ $berita->lastItem() ?? 0 }}
                            dari {{ $berita->total() }} data
                        </div>

                        <div class="flex items-center justify-center sm:justify-end">
                            <div class="flex items-center space-x-2">
                                {{-- Previous Page Link --}}
                                @if ($berita->onFirstPage())
                                    <span
                                        class="px-2 py-0.5 text-gray-400 bg-slate-100 border border-slate-300 rounded-lg cursor-not-allowed">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                @else
                                    <a href="{{ $berita->previousPageUrl() }}"
                                        class="px-2 py-0.5 text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($berita->getUrlRange(1, $berita->lastPage()) as $page => $url)
                                    @if ($page == $berita->currentPage())
                                        <span
                                            class="px-2 py-0.5 text-white bg-blue-500 border border-blue-500 rounded-lg font-semibold">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}"
                                            class="px-2 py-0.5 text-blue-600 bg-white border border-slate-300 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($berita->hasMorePages())
                                    <a href="{{ $berita->nextPageUrl() }}"
                                        class="px-2 py-0.5 text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                @else
                                    <span
                                        class="px-2 py-0.5 text-gray-400 bg-slate-100 border border-slate-300 rounded-lg cursor-not-allowed">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection