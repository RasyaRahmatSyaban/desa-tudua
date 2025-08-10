@extends('layouts.admin')

@section('title', 'Kelola Pengumuman')
@section('page-title', 'Kelola Pengumuman')
@section('page-description', 'Manajemen pengumuman dan informasi penting desa')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <form method="GET" action="{{ route('admin.pengumuman.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari pengumuman..." value="{{ request('search') }}"
                        class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        id="searchInput">
                    <i class="fas fa-search absolute left-3 top-3 text-slate-400 text-sm"></i>
                </div>
                <select name="status" onchange="this.form.submit()"
                    class="bg-white border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    <option value="">Semua Status</option>
                    <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </form>

            <a href="{{ route('admin.pengumuman.create') }}"
                class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                <i class="fas fa-plus mr-2"></i>
                Tambah Pengumuman
            </a>
        </div>

        <!-- Stats Summary -->
        @if($pengumuman->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Pengumuman</p>
                            <p class="text-xl font-bold text-slate-800">{{ $pengumuman->total() }}</p>
                        </div>
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bullhorn text-amber-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Aktif</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $pengumuman->where('status', 'Aktif')->count() }}
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
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Nonaktif</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $pengumuman->where('status', 'Nonaktif')->count() }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-pause-circle text-gray-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Bulan Ini</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $pengumuman->where('created_at', '>=', now()->startOfMonth())->count() }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar text-violet-600 text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Pengumuman Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="text-left py-3 px-1 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Pengumuman
                                </th>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Berlaku Hingga
                                </th>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($pengumuman as $item)
                                <tr class="hover:bg-slate-50 transition-colors duration-200">
                                    <td class="py-4 px-1">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0 border border-amber-200">
                                                <i class="fas fa-bullhorn text-amber-600"></i>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-sm font-medium text-slate-900 line-clamp-2 leading-relaxed">
                                                    {{ $item->judul }}
                                                </p>
                                                <p class="text-xs text-slate-500 mt-1">
                                                    {{ Str::limit(strip_tags($item->konten), 60) }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        @if($item->status === 'Aktif')
                                            <span class="inline-flex items-center px-2.5 py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded-full">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                                                <i class="fas fa-pause-circle mr-1 text-xs"></i>
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-slate-600">
                                            {{ $item->berlaku_hingga ? \Carbon\Carbon::parse($item->berlaku_hingga)->format('d M Y') : '-' }}
                                        </div>
                                        @if($item->berlaku_hingga)
                                            <div class="text-xs text-slate-500">
                                                {{ \Carbon\Carbon::parse($item->berlaku_hingga)->format('H:i') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-1">
                                            <a href="{{ route('admin.pengumuman.show', $item->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye text-sm"></i>
                                            </a>
                                            <a href="{{ route('admin.pengumuman.edit', $item->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors duration-200"
                                                title="Edit Pengumuman">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.pengumuman.destroy', $item->id) }}"
                                                class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors duration-200 delete-button"
                                                    title="Hapus Pengumuman">
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
                                            <div class="w-16 h-16 bg-amber-100 rounded-xl flex items-center justify-center mb-4">
                                                <i class="fas fa-bullhorn text-2xl text-amber-400"></i>
                                            </div>
                                            <p class="text-lg font-medium text-slate-600 mb-2">Belum ada pengumuman</p>
                                            <p class="text-sm text-slate-500 mb-4">Mulai dengan menambahkan pengumuman pertama</p>
                                            <a href="{{ route('admin.pengumuman.create') }}"
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                                <i class="fas fa-plus mr-2"></i>
                                                Tambah Pengumuman
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($pengumuman->hasPages())
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-6 pt-6 border-t border-slate-200">
                        <div class="text-sm text-slate-600">
                            Menampilkan {{ $pengumuman->firstItem() ?? 0 }} sampai {{ $pengumuman->lastItem() ?? 0 }}
                            dari {{ $pengumuman->total() }} data
                        </div>
                        <div class="flex justify-center sm:justify-end">
                            {{ $pengumuman->appends(request()->query())->links('pagination::tailwind') }}
                        </div>
                    </div>
                @else
                    @if($pengumuman->count() > 0)
                        <div class="flex items-center justify-between mt-6">
                            <div class="text-sm text-slate-600">
                                Menampilkan {{ $pengumuman->firstItem() ?? 0 }} sampai {{ $pengumuman->lastItem() ?? 0 }}
                                dari {{ $pengumuman->total() }} data
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection