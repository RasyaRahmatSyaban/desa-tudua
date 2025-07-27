@extends('layouts.admin')

@section('title', 'Kelola Pengumuman')
@section('page-title', 'Kelola Pengumuman')
@section('page-description', 'Manajemen pengumuman dan informasi penting desa')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <!-- Filter Form -->
<form method="GET" action="{{ route('admin.pengumuman.index') }}" class="flex items-center space-x-4">
    <div class="relative">
        <input type="text" 
               name="search"
               placeholder="Cari pengumuman..." 
               value="{{ request('search') }}"
               class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
               id="searchInput">
        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
    </div>

    <select name="status" 
            class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <option value="">Semua Status</option>
        <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
        <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
    </select>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
        Filter
    </button>
</form>

        
<a href="{{ route('admin.pengumuman.create') }}" class="btn-primary text-white px-6 py-2 rounded-lg font-medium inline-flex items-center">
    <i class="fas fa-plus mr-2"></i>
    Tambah Pengumuman
</a>
</div>
    
    <!-- Pengumuman Table -->
    <div class="card bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
        <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengumuman</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berlaku Hingga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($pengumuman as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-bullhorn text-yellow-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $item->judul }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit(strip_tags($item->konten), 60) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->status === 'Aktif')
                                    <span class="px-2 py-1 text-xs font-medium bg-green-200 text-green-800 rounded-full">
                                        <i class="fas fa-check-circle mr-1"></i>Aktif
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium bg-gray-200 text-gray-800 rounded-full">
                                        <i class="fas fa-pause-circle mr-1"></i>Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->berlaku_hingga ? \Carbon\Carbon::parse($item->berlaku_hingga)->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.pengumuman.show', $item->id) }}" 
                                       class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.pengumuman.edit', $item->id) }}" 
                                       class="text-yellow-600 hover:text-yellow-900 p-2 rounded-lg hover:bg-yellow-50">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.pengumuman.destroy', $item->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50"
                                                onclick="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-bullhorn text-4xl mb-4"></i>
                                    <p class="text-lg font-medium mb-2">Belum ada pengumuman</p>
                                    <p class="text-sm">Mulai dengan menambahkan pengumuman pertama</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="flex items-center justify-between mt-6">
                <div class="text-sm text-gray-700">
                    Menampilkan {{ $pengumuman->firstItem() ?? 0 }} sampai {{ $pengumuman->lastItem() ?? 0 }} 
                    dari {{ $pengumuman->total() }} data
                </div>
                {{ $pengumuman->links() }}
            </div>
            </div>
    </div>
</div>
@endsection
