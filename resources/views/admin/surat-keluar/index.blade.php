@extends('layouts.admin')

@section('title', 'Kelola Surat Keluar')
@section('page-title', 'Kelola Surat Keluar')
@section('page-description', 'Manajemen data surat keluar desa')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
    <!-- Kiri: Search dan filter -->
    <div class="flex flex-wrap items-center gap-4">
        <!-- Search -->
        <form method="GET" action="{{ route('admin.surat-keluar.index') }}" class="relative">
            <input type="text" 
                   name="search" 
                   placeholder="Cari nomor surat, asal..." 
                   value="{{ request('search') }}"
                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </form>
    </div>

    <!-- Kanan: Tombol -->
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.surat-keluar.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium inline-flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Surat Keluar
        </a>
    </div>
</div>

    
    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kirim</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Surat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penerima</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perihal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($suratKeluar as $surat)
                        <tr class="hover:bg-gray-50">
                            <td class="flex items-center px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <a href="{{ asset('storage/' . $surat->file) }}" target="_blank" download class="flex items-center space-x-2">
                                        <i class="fas fa-file-pdf mr-2 text-2xl"></i>
                                    </a>
                                    <span>
                                        <a href="{{ asset('storage/'. $surat->file) }}" target="_blank">
                                            </i>Lihat File
                                        </a>
                                    </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mediu   m text-gray-900">{{ $surat->nomor_surat }}</td>
                            <td class="px-6 py-4 whitespace-normal text-sm text-gray-900">{{ $surat->penerima }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($surat->perihal, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.surat-keluar.show', $surat->id) }}" class="inline-flex items-center px-2 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs rounded transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.surat-keluar.edit', $surat->id) }}" class="inline-flex items-center px-2 py-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 text-xs rounded transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.surat-keluar.destroy', $surat->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-2 py-1 bg-red-200 hover:bg-red-300 text-red-700 text-xs rounded transition-colors" onclick="return confirm('Yakin ingin menghapus?')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Tidak ada data surat keluar
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="text-sm text-gray-700">
                    Menampilkan {{ $suratKeluar->firstItem() ?? 0 }} sampai {{ $suratKeluar->lastItem() ?? 0 }} 
                    dari {{ $suratKeluar->total() }} data
                </div>
                {{ $suratKeluar->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
