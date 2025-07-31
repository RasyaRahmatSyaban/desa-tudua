@extends('layouts.admin')

@section('title', 'Kelola Surat Masuk')
@section('page-title', 'Kelola Surat Masuk')
@section('page-description', 'Manajemen data surat masuk desa')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <!-- Kiri: Search dan filter -->
            <div class="flex flex-wrap items-center gap-4">
                <!-- Search -->
                <form method="GET" action="{{ route('admin.surat-masuk.index') }}" class="relative">
                    <input type="text" name="search" placeholder="Cari nomor surat, asal..." value="{{ request('search') }}"
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </form>
            </div>

            <!-- Kanan: Tombol -->
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.surat-masuk.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Surat Masuk
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
                                    File</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal Masuk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No. Surat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pengirim</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Perihal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($suratMasuk as $surat)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex">
                                        <a href="{{ asset('storage/' . $surat->file) }}" target="_blank" download
                                            class="flex items-center space-x-2">
                                            <i class="fas fa-file-pdf mr-2 text-2xl"></i>
                                        </a>
                                        <span>
                                            <a href="{{ asset('storage/' . $surat->file) }}" target="_blank">
                                                </i>Lihat File
                                            </a>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $surat->tanggal_terima }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $surat->nomor_surat }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $surat->pengirim }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($surat->perihal, 40) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.surat-masuk.show', $surat->id) }}"
                                                class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.surat-masuk.edit', $surat->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900 p-2 rounded-lg hover:bg-yellow-50">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.surat-masuk.destroy', $surat->id) }}" method="POST"
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
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        Tidak ada data surat masuk
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="flex items-center justify-between mt-6">
                    <div class="text-sm text-gray-700">
                        Menampilkan {{ $suratMasuk->firstItem() ?? 0 }} sampai {{ $suratMasuk->lastItem() ?? 0 }}
                        dari {{ $suratMasuk->total() }} data
                    </div>
                    {{ $suratMasuk->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection