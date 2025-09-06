@extends('layouts.admin')

@section('title', 'Kelola Surat Keluar')
@section('page-title', 'Kelola Surat Keluar')
@section('page-description', 'Manajemen data surat keluar desa')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <form method="GET" action="{{ route('admin.surat-keluar.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari nomor surat, penerima..."
                        value="{{ request('search') }}"
                        class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        id="searchInput">
                    <i class="fas fa-search absolute left-3 top-3 text-slate-400 text-sm"></i>
                </div>
            </form>

            <a href="{{ route('admin.surat-keluar.create') }}"
                class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                <i class="fas fa-plus mr-2"></i>
                Tambah Surat Keluar
            </a>
        </div>

        <!-- Stats Summary -->
        @if($suratKeluar->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Surat</p>
                            <p class="text-xl font-bold text-slate-800">{{ $suratKeluar->total() }}</p>
                        </div>
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-paper-plane text-blue-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Bulan Ini</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $suratKeluar->where('created_at', '>=', now()->startOfMonth())->count() }}
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
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Minggu Ini</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $suratKeluar->where('created_at', '>=', now()->startOfWeek())->count() }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-violet-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Hari Ini</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $suratKeluar->where('created_at', '>=', now()->today())->count() }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-envelope text-amber-600 text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Surat Keluar Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th
                                    class="text-left py-3 px-1 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    File
                                </th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Tanggal Kirim
                                </th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    No. Surat
                                </th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Penerima
                                </th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Perihal
                                </th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($suratKeluar as $surat)
                                <tr class="hover:bg-slate-50 transition-colors duration-200">
                                    <td class="py-4 px-1">
                                        <a href="{{ asset('storage/' . $surat->file) }}" target="_blank" download
                                            class="inline-flex items-center px-3 py-2 bg-red-50 hover:bg-red-100 text-red-700 text-sm font-medium rounded-lg transition-colors duration-200 group">
                                            <i
                                                class="fas fa-file-pdf mr-2 text-lg group-hover:scale-110 transition-transform duration-200"></i>
                                            <span class="text-xs">Lihat PDF</span>
                                        </a>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm font-medium text-slate-900">
                                            {{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-slate-500">
                                            {{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('H:i') }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                            <i class="fas fa-hashtag mr-1 text-xs"></i>
                                            {{ $surat->nomor_surat }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm font-medium text-slate-900">{{ $surat->penerima }}</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-slate-900 line-clamp-2 leading-relaxed">
                                            {{ Str::limit($surat->perihal, 50) }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-1">
                                            <a href="{{ route('admin.surat-keluar.edit', $surat->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors duration-200"
                                                title="Edit Surat">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>
                                            <form action="{{ route('admin.surat-keluar.destroy', $surat->id) }}" method="POST"
                                                class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors duration-200 delete-button"
                                                    title="Hapus Surat">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center mb-4">
                                                <i class="fas fa-paper-plane text-2xl text-slate-400"></i>
                                            </div>
                                            <p class="text-lg font-medium text-slate-600 mb-2">Belum ada surat keluar</p>
                                            <p class="text-sm text-slate-500 mb-4">Mulai dengan menambahkan surat keluar pertama
                                            </p>
                                            <a href="{{ route('admin.surat-keluar.create') }}"
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                                <i class="fas fa-plus mr-2"></i>
                                                Tambah Surat Keluar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($suratKeluar->hasPages())
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-6 pt-6 border-t border-slate-200">
                        <div class="text-sm text-slate-600">
                            Menampilkan {{ $suratKeluar->firstItem() ?? 0 }} sampai {{ $suratKeluar->lastItem() ?? 0 }}
                            dari {{ $suratKeluar->total() }} data
                        </div>

                        <div class="flex items-center justify-center sm:justify-end">
                            <div class="flex items-center space-x-2">
                                {{-- Previous Page Link --}}
                                @if ($suratKeluar->onFirstPage())
                                    <span
                                        class="px-2 py-0.5 text-gray-400 bg-slate-100 border border-slate-300 rounded-lg cursor-not-allowed">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                @else
                                    <a href="{{ $suratKeluar->previousPageUrl() }}"
                                        class="px-2 py-0.5 text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($suratKeluar->getUrlRange(1, $suratKeluar->lastPage()) as $page => $url)
                                    @if ($page == $suratKeluar->currentPage())
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
                                @if ($suratKeluar->hasMorePages())
                                    <a href="{{ $suratKeluar->nextPageUrl() }}"
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