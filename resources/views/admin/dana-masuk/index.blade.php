@extends('layouts.admin')

@section('title', 'Kelola Dana Masuk')
@section('page-title', 'Kelola Dana Masuk')
@section('page-description', 'Manajemen data dana masuk desa')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
    <!-- Kiri: Search dan filter -->
    <div class="flex flex-wrap items-center gap-4">
        <!-- Search -->
        <form method="GET" action="{{ route('admin.dana-masuk.index') }}" class="relative">
            <input type="text" 
                   name="search" 
                   placeholder="Cari berdasarkan sumber atau keterangan..." 
                   value="{{ request('search') }}"
                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </form>

        <!-- Bulan -->
        <form method="GET" action="{{ route('admin.dana-masuk.index') }}" class="flex items-center gap-4">
            <input type="hidden" name="search" value="{{ request('search') }}">

            <!-- Filter Bulan -->
            <select name="bulan" onchange="this.form.submit()"
                class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Bulan</option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                    </option>
                @endfor
            </select>

            <!-- Filter Tahun -->
            <select name="tahun" onchange="this.form.submit()"
                class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Tahun</option>
                @for($year = date('Y'); $year >= 2020; $year--)
                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endfor
            </select>
        </form>
    </div>

    <!-- Kanan: Tombol -->
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.dana-masuk.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium inline-flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Dana Masuk
        </a>
    </div>
</div>
    
    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bulan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sumber Dana</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($danaMasuk as $dana)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $dana->nama_bulan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $dana->tahun }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $dana->sumber }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">Rp {{ number_format($dana->jumlah, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($dana->keterangan, 50) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.dana-masuk.show', $dana->id) }}" class="inline-flex items-center px-2 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs rounded transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.dana-masuk.edit', $dana->id) }}" class="inline-flex items-center px-2 py-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 text-xs rounded transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.dana-masuk.destroy', $dana->id) }}" method="POST" class="inline">
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
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Tidak ada data dana masuk
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="text-sm text-gray-700">
                    Menampilkan {{ $danaMasuk->firstItem() ?? 0 }} sampai {{ $danaMasuk->lastItem() ?? 0 }} 
                    dari {{ $danaMasuk->total() }} data
                </div>
                {{ $danaMasuk->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
