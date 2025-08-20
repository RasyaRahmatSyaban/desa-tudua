@extends('layouts.admin')

@section('title', 'Kelola Dana Keluar')
@section('page-title', 'Kelola Dana Keluar')
@section('page-description', 'Manajemen data dana keluar desa')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <form method="GET" action="{{ route('admin.dana-keluar.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari berdasarkan kategori..."
                        value="{{ request('search') }}"
                        class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        id="searchInput">
                    <i class="fas fa-search absolute left-3 top-3 text-slate-400 text-sm"></i>
                </div>

                <select name="bulan" onchange="this.form.submit()"
                    class="w-full sm:w-auto border border-slate-300 rounded-lg px-4 py-2.5 bg-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    <option value="">Semua Bulan</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                        </option>
                    @endfor
                </select>

                <select name="tahun" onchange="this.form.submit()"
                    class="w-full sm:w-auto border border-slate-300 rounded-lg px-4 py-2.5 bg-white text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    <option value="">Semua Tahun</option>
                    @for($year = date('Y'); $year >= 2020; $year--)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </form>

            <a href="{{ route('admin.dana-keluar.create') }}"
                class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                <i class="fas fa-plus mr-2"></i>
                Tambah Dana Keluar
            </a>
        </div>

        <!-- Stats Summary -->
        @if($danaKeluar->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Transaksi</p>
                            <p class="text-xl font-bold text-slate-800">{{ $danaKeluar->total() }}</p>
                        </div>
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-arrow-up text-red-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Bulan Ini</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $danaKeluar->where('created_at', '>=', now()->startOfMonth())->count() }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar text-emerald-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Dana</p>
                            <p class="text-xl font-bold text-red-600">
                                Rp {{ number_format($danaKeluar->sum('jumlah'), 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-money-bill-wave text-violet-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Rata-rata</p>
                            <p class="text-xl font-bold text-slate-800">
                                Rp {{ number_format($danaKeluar->avg('jumlah'), 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-line text-amber-600 text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Dana Keluar Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Periode
                                </th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Jumlah
                                </th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Keterangan
                                </th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($danaKeluar as $dana)
                                <tr class="hover:bg-slate-50 transition-colors duration-200">
                                    <td class="py-4 px-4">
                                        <div class="text-sm font-medium text-slate-900">{{ $dana->nama_bulan }}</div>
                                        <div class="text-xs text-slate-500">{{ $dana->tahun }}</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="inline-flex items-center text-xs font-medium rounded-full">
                                            {{ $dana->kategori }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm font-semibold text-red-600">
                                            Rp {{ number_format($dana->jumlah, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-slate-900 line-clamp-2 leading-relaxed max-w-xs">
                                            {{ Str::limit($dana->keterangan, 50) }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-1">
                                            <a href="{{ route('admin.dana-keluar.show', $dana->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye text-sm"></i>
                                            </a>
                                            <a href="{{ route('admin.dana-keluar.edit', $dana->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors duration-200"
                                                title="Edit Dana">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>
                                            <form action="{{ route('admin.dana-keluar.destroy', $dana->id) }}" method="POST"
                                                class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors duration-200 delete-button"
                                                    title="Hapus Dana">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center mb-4">
                                                <i class="fas fa-arrow-up text-2xl text-slate-400"></i>
                                            </div>
                                            <p class="text-lg font-medium text-slate-600 mb-2">Belum ada data dana keluar</p>
                                            <p class="text-sm text-slate-500 mb-4">Mulai dengan menambahkan data dana keluar
                                                pertama</p>
                                            <a href="{{ route('admin.dana-keluar.create') }}"
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                                <i class="fas fa-plus mr-2"></i>
                                                Tambah Dana Keluar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($danaKeluar->hasPages())
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-6 pt-6 border-t border-slate-200">
                        <div class="text-sm text-slate-600">
                            Menampilkan {{ $danaKeluar->firstItem() ?? 0 }} sampai {{ $danaKeluar->lastItem() ?? 0 }}
                            dari {{ $danaKeluar->total() }} data
                        </div>

                        <div class="flex items-center justify-center sm:justify-end">
                            <div class="flex items-center space-x-2">
                                {{-- Previous Page Link --}}
                                @if ($danaKeluar->onFirstPage())
                                    <span
                                        class="px-2 py-0.5 text-gray-400 bg-slate-100 border border-slate-300 rounded-lg cursor-not-allowed">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                @else
                                    <a href="{{ $danaKeluar->previousPageUrl() }}"
                                        class="px-2 py-0.5 text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($danaKeluar->getUrlRange(1, $danaKeluar->lastPage()) as $page => $url)
                                    @if ($page == $danaKeluar->currentPage())
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
                                @if ($danaKeluar->hasMorePages())
                                    <a href="{{ $danaKeluar->nextPageUrl() }}"
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