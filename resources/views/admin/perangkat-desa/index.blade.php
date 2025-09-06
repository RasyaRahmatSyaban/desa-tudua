@extends('layouts.admin')

@section('title', 'Kelola Perangkat Desa')
@section('page-title', 'Kelola Perangkat Desa')
@section('page-description', 'Manajemen data perangkat desa')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <form method="GET" action="{{ route('admin.perangkat-desa.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari nama, jabatan..." value="{{ request('search') }}"
                        class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        id="searchInput">
                    <i class="fas fa-search absolute left-3 top-3 text-slate-400 text-sm"></i>
                </div>
            </form>

            <a href="{{ route('admin.perangkat-desa.create') }}"
                class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                <i class="fas fa-plus mr-2"></i>
                Tambah Perangkat Desa
            </a>
        </div>

        <!-- Perangkat Desa Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="text-left py-3 px-1 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Perangkat Desa
                                </th>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Jabatan
                                </th>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    NIP
                                </th>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($perangkatDesa as $perangkat)
                                <tr class="hover:bg-slate-50 transition-colors duration-200">
                                    <td class="py-4 px-1">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-16 h-16 bg-slate-100 rounded-lg overflow-hidden flex-shrink-0 border border-slate-200">
                                                @if($perangkat->foto)
                                                    <img src="{{ asset('storage/' . $perangkat->foto) }}" alt="Foto Perangkat"
                                                        class="w-full h-full object-cover" />
                                                @else
                                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                                        <i class="fas fa-user text-slate-400 text-xl"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-sm font-medium text-slate-900 line-clamp-2 leading-relaxed">
                                                    {{ $perangkat->nama }}
                                                </p>
                                                <p class="text-xs text-slate-500 mt-1">
                                                    Perangkat Desa
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="inline-flex items-center px-2.5 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                            <i class="fas fa-briefcase mr-1 text-xs"></i>
                                            {{ $perangkat->jabatan }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        @if($perangkat->nip)
                                            <span class="inline-flex items-center px-2.5 py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded-full">
                                                <i class="fas fa-id-card mr-1 text-xs"></i>
                                                {{ $perangkat->nip }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 bg-slate-100 text-slate-500 text-xs font-medium rounded-full">
                                                <i class="fas fa-minus mr-1 text-xs"></i>
                                                Tidak ada
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-1">
                                            <a href="{{ route('admin.perangkat-desa.edit', $perangkat->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors duration-200"
                                                title="Edit Perangkat">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.perangkat-desa.destroy', $perangkat->id) }}"
                                                class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors duration-200 delete-button"
                                                    title="Hapus Perangkat">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center mb-4">
                                                <i class="fas fa-users text-2xl text-slate-400"></i>
                                            </div>
                                            <p class="text-lg font-medium text-slate-600 mb-2">Belum ada perangkat desa</p>
                                            <p class="text-sm text-slate-500 mb-4">Mulai dengan menambahkan perangkat desa pertama</p>
                                            <a href="{{ route('admin.perangkat-desa.create') }}"
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                                <i class="fas fa-plus mr-2"></i>
                                                Tambah Perangkat Desa
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($perangkatDesa->hasPages())
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-6 pt-6 border-t border-slate-200">
                        <div class="text-sm text-slate-600">
                            Menampilkan {{ $perangkatDesa->firstItem() ?? 0 }} sampai {{ $perangkatDesa->lastItem() ?? 0 }}
                            dari {{ $perangkatDesa->total() }} data
                        </div>

                        <div class="flex items-center justify-center sm:justify-end">
                            <div class="flex items-center space-x-2">
                                {{-- Previous Page Link --}}
                                @if ($perangkatDesa->onFirstPage())
                                    <span
                                        class="px-2 py-0.5 text-gray-400 bg-slate-100 border border-slate-300 rounded-lg cursor-not-allowed">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                @else
                                    <a href="{{ $perangkatDesa->previousPageUrl() }}"
                                        class="px-2 py-0.5 text-white bg-blue-600 border border-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($perangkatDesa->getUrlRange(1, $perangkatDesa->lastPage()) as $page => $url)
                                    @if ($page == $perangkatDesa->currentPage())
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
                                @if ($perangkatDesa->hasMorePages())
                                    <a href="{{ $perangkatDesa->nextPageUrl() }}"
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