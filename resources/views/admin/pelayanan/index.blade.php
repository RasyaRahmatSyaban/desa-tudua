@extends('layouts.admin')

@section('title', 'Kelola Pelayanan')
@section('page-title', 'Kelola Pelayanan')
@section('page-description', 'Manajemen data pelayanan desa')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <form method="GET" action="{{ route('admin.pelayanan.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari nama pelayanan..." value="{{ request('search') }}"
                        class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    <i class="fas fa-search absolute left-3 top-3 text-slate-400 text-sm"></i>
                </div>
                <select name="kategori" onchange="this.form.submit()"
                    class="bg-white border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    <option value="">Semua Kategori</option>
                    <option value="Dokumen Identitas" {{ request('kategori') == 'Dokumen Identitas' ? 'selected' : '' }}>
                        Dokumen Identitas</option>
                    <option value="Kependudukan" {{ request('kategori') == 'Kependudukan' ? 'selected' : '' }}>Kependudukan
                    </option>
                    <option value="Pencatatan Sipil" {{ request('kategori') == 'Pencatatan Sipil' ? 'selected' : '' }}>
                        Pencatatan Sipil</option>
                    <option value="Kesejahteraan Sosial" {{ request('kategori') == 'Kesejahteraan Sosial' ? 'selected' : '' }}>
                        Kesejahteraan Sosial</option>
                    <option value="Pendidikan" {{ request('kategori') == 'Pendidikan' ? 'selected' : '' }}>
                        Pendidikan</option>
                    <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>
                        Lainnya</option>
                </select>
            </form>

            <a href="{{ route('admin.pelayanan.create') }}"
                class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                <i class="fas fa-plus mr-2"></i>
                Tambah Pelayanan
            </a>
        </div>

        <!-- Stats Summary -->
        @if($pelayanans->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Pelayanan</p>
                            <p class="text-xl font-bold text-slate-800">{{ $pelayanans->total() }}</p>
                        </div>
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-concierge-bell text-blue-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Dokumen Identitas</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $pelayanans->where('kategori', 'Dokumen Identitas')->count() }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-id-card text-emerald-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Kependudukan</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $pelayanans->where('kategori', 'Kependudukan')->count() }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-amber-600 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Lainnya</p>
                            <p class="text-xl font-bold text-slate-800">
                                {{ $pelayanans->whereNotIn('kategori', ['Dokumen Identitas', 'Kependudukan'])->count() }}
                            </p>
                        </div>
                        <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clipboard-list text-violet-600 text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Pelayanan Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th
                                    class="text-left py-3 px-1 text-xs font-semibold text-slate-600 uppercase tracking-wider w-16">
                                    No
                                </th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Nama Pelayanan
                                </th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Link
                                </th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($pelayanans as $index => $pelayanan)
                                <tr class="hover:bg-slate-50 transition-colors duration-200">
                                    <td class="py-4 px-1 text-sm text-slate-600">
                                        {{ $pelayanans->firstItem() + $index }}
                                    </td>
                                    <td class="py-4 px-4">
                                        <div>
                                            <p class="text-sm font-medium text-slate-900">{{ $pelayanan->nama_layanan }}</p>
                                            <p class="text-xs text-slate-500 mt-1">{{ Str::limit($pelayanan->deskripsi, 60) }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        @php
                                            $kategoriColors = [
                                                'Dokumen Identitas' => 'bg-blue-100 text-blue-800',
                                                'Kependudukan' => 'bg-emerald-100 text-emerald-800',
                                                'Pencatatan Sipil' => 'bg-purple-100 text-purple-800',
                                                'Kesejahteraan Sosial' => 'bg-pink-100 text-pink-800',
                                                'Pendidikan' => 'bg-yellow-100 text-yellow-800',
                                                'Lainnya' => 'bg-gray-100 text-gray-800'
                                            ];
                                            $colorClass = $kategoriColors[$pelayanan->kategori] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 {{ $colorClass }} text-xs font-medium rounded-full">
                                            {{ $pelayanan->kategori }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <a href="{{ $pelayanan->link_google_form }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-700 text-sm hover:underline">
                                            {{ Str::limit($pelayanan->link_google_form, 30) }}
                                        </a>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-1">
                                            <a href="{{ route('admin.pelayanan.show', $pelayanan->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye text-sm"></i>
                                            </a>
                                            <a href="{{ route('admin.pelayanan.edit', $pelayanan->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors duration-200"
                                                title="Edit Pelayanan">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>
                                            <form action="{{ route('admin.pelayanan.destroy', $pelayanan->id) }}" method="POST"
                                                class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors duration-200 delete-button"
                                                    title="Hapus Pelayanan">
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
                                                <i class="fas fa-concierge-bell text-2xl text-slate-400"></i>
                                            </div>
                                            <p class="text-lg font-medium text-slate-600 mb-2">Belum ada pelayanan</p>
                                            <p class="text-sm text-slate-500 mb-4">Mulai dengan menambahkan pelayanan pertama
                                            </p>
                                            <a href="{{ route('admin.pelayanan.create') }}"
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                                <i class="fas fa-plus mr-2"></i>
                                                Tambah Pelayanan
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($pelayanans->hasPages())
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-6 pt-6 border-t border-slate-200">
                        <div class="text-sm text-slate-600">
                            Menampilkan {{ $pelayanans->firstItem() ?? 0 }} sampai {{ $pelayanans->lastItem() ?? 0 }}
                            dari {{ $pelayanans->total() }} data
                        </div>
                        <div class="flex justify-center sm:justify-end">
                            {{ $pelayanans->appends(request()->query())->links('pagination::tailwind') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection