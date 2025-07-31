@extends('layouts.admin')

@section('title', 'Kelola Kepala Keluarga')
@section('page-title', 'Kelola Kepala Keluarga')
@section('page-description', 'Manajemen data kepala keluarga desa')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <!-- Kiri: Search + Filters -->
            <div class="flex flex-wrap items-center gap-4">
                <!-- Search -->
                <form method="GET" action="{{ route('admin.kepala-keluarga.index') }}" class="relative">
                    <input type="text" name="search" placeholder="Cari nama, NIK, No KK..." value="{{ request('search') }}"
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </form>

                <!-- Dusun -->
                <form method="GET" action="{{ route('admin.kepala-keluarga.index') }}">
                    <select name="dusun" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Dusun</option>
                        <option value="Dusun 1" {{ request('dusun') == 'Dusun 1' ? 'selected' : '' }}>Dusun 1</option>
                        <option value="Dusun 2" {{ request('dusun') == 'Dusun 2' ? 'selected' : '' }}>Dusun 2</option>
                        <option value="Dusun 3" {{ request('dusun') == 'Dusun 3' ? 'selected' : '' }}>Dusun 3</option>
                    </select>
                </form>

                <!-- Status -->
                <form method="GET" action="{{ route('admin.kepala-keluarga.index') }}">
                    <select name="status" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="pindah" {{ request('status') == 'pindah' ? 'selected' : '' }}>Pindah</option>
                        <option value="meninggal" {{ request('status') == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                    </select>
                </form>
            </div>

            <!-- Kanan: Tombol -->
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.kepala-keluarga.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Kepala Keluarga
                </a>
            </div>
        </div>
        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No KK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Kepala Keluarga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Alamat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Anggota</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($kepalaKeluarga as $kk)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $kk->no_kk }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $kk->nama_kepala_keluarga }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kk->nik_kepala_keluarga }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $kk->alamat }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $kk->jumlah_anggota ?? 0 }} orang
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($kk->status == 'aktif')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                        @elseif($kk->status == 'pindah')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pindah</span>
                                        @elseif($kk->status == 'meninggal')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Meninggal</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.kepala-keluarga.show', $kk->id) }}"
                                                class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.kepala-keluarga.edit', $kk->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900 p-2 rounded-lg hover:bg-yellow-50">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.kepala-keluarga.destroy', $dana->id) }}" method="POST"
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
                                    <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                            </path>
                                        </svg>
                                        Tidak ada data kepala keluarga
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="text-sm text-gray-700">
                        Menampilkan {{ $kepalaKeluarga->firstItem() ?? 0 }} sampai {{ $kepalaKeluarga->lastItem() ?? 0 }}
                        dari {{ $kepalaKeluarga->total() }} data
                    </div>
                    {{ $kepalaKeluarga->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection