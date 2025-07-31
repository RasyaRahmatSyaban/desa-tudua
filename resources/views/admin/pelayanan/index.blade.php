@extends('layouts.admin')

@section('title', 'Kelola Pelayanan')
@section('page-title', 'Kelola Pelayanan')
@section('page-description', 'Manajemen data pelayanan desa')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <!-- Kiri: Filter -->
            <div class="flex flex-wrap items-center gap-4">
                <div class="flex flex-wrap items-center gap-4">
                    <!-- Search -->
                    <form method="GET" action="{{ route('admin.pelayanan.index') }}" class="relative">
                        <input type="text" name="search" placeholder="Cari nama pelayanan..."
                            value="{{ request('search') }}"
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>

                <!-- Kategori -->
                <select name="kategori" id="kategori" onchange="this.form.submit()"
                    class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Pilih Kategori</option>
                    <option value="Dokumen Identitas" {{ request('kategori') == 'Dokumen Identitas' ? 'selected' : '' }}>
                        Dokumen Identitas</option>
                    <option value="Kependudukan" {{ request('kategori') == 'Kependudukan' ? 'selected' : '' }}>Kependudukan
                    </option>
                    <option value="Pencatatan Sipil" {{ request('kategori') == 'Pencatatan Sipil' ? 'selected' : '' }}>
                        Pencatatan Sipil</option>
                </select>
                </form>
            </div>

            <!-- Kanan: Tombol -->
            <a href="{{ route('admin.pelayanan.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium inline-flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Pelayanan
            </a>
        </div>

        <!-- Data Table -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">
                                    No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Pelayanan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Link</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pelayanans as $index => $pelayanan)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $pelayanans->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $pelayanan->nama_layanan }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($pelayanan->deskripsi, 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $pelayanan->kategori }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ $pelayanan->link_google_form }}" target="_blank"
                                            class="text-blue-600 hover:underline">
                                            {{ $pelayanan->link_google_form }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.pelayanan.show', $pelayanan->id) }}"
                                                class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.pelayanan.edit', $pelayanan->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900 p-2 rounded-lg hover:bg-yellow-50">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.pelayanan.destroy', $pelayanan->id) }}" method="POST"
                                                class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 delete-button">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h2m0-13h10a2 2 0 012 2v11a2 2 0 01-2 2H9m0-13v13">
                                            </path>
                                        </svg>
                                        <p>Tidak ada data pelayanan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-6">
                    <div class="text-sm text-gray-700">
                        Menampilkan {{ $pelayanans->firstItem() ?? 0 }} sampai {{ $pelayanans->lastItem() ?? 0 }}
                        dari {{ $pelayanans->total() }} data
                    </div>
                    {{ $pelayanans->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection