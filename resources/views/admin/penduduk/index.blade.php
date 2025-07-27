@extends('layouts.admin')

@section('title', 'Kelola Penduduk')
@section('page-title', 'Kelola Penduduk')
@section('page-description', 'Manajemen data penduduk desa')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="card bg-white rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Penduduk</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalPenduduk }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-blue-600"></i>
                </div>
            </div>
        </div>
        
        <div class="card bg-white rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Laki-laki</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalLakiLaki }}</p>
                </div>
                <div class="w-12 h-12 bg-green-200 rounded-lg flex items-center justify-center">
                    <i class="fas fa-male text-green-600"></i>
                </div>
            </div>
        </div>
        
        <div class="card bg-white rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Perempuan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalPerempuan }}</p>
                </div>
                <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-female text-pink-600"></i>
                </div>
            </div>
        </div>
        
        <div class="card bg-white rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Kepala Keluarga</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalKepalaKeluarga }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-tie text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <form method="GET" action="{{ route('admin.penduduk.index') }}" class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" 
                        name="search"
                       placeholder="Cari penduduk..." 
                       value="{{ request('search') }}"
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       id="searchInput">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>

            <select name="jenis_kelamin"
            class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Jenis Kelamin</option>
                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Filter
            </button>
        </form>
        
        <div class="flex items-center space-x-2">
            <a href="{{ route('admin.penduduk.create') }}" class="btn-primary text-white px-6 py-2 rounded-lg font-medium inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Tambah Penduduk
            </a>
        </div>
    </div>
    
    <!-- Penduduk Table -->
    <div class="card bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK/Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tempat/Tgl Lahir</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kepala Keluarga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($penduduk as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                                    <div class="text-sm text-gray-500">NIK: {{ $item->nik }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium {{ $item->jenis_kelamin === 'Laki-laki' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }} rounded-full">
                                    <i class="fas fa-{{ $item->jenis_kelamin === 'Laki-laki' ? 'male' : 'female' }} mr-1"></i>
                                    {{ $item->jenis_kelamin === 'Laki-laki' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div>{{ $item->tempat_lahir }}</div>
                                <div>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d M Y') }}</div>
                            </td>                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->alamat }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->kepalaKeluarga->nama ?? 'Tidak Ada' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.penduduk.show', $item->id) }}" 
                                       class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.penduduk.edit', $item->id) }}" 
                                       class="text-yellow-600 hover:text-yellow-900 p-2 rounded-lg hover:bg-yellow-50">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.penduduk.destroy', $item->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50"
                                                onclick="return confirm('Yakin ingin menghapus data penduduk ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-users text-4xl mb-4"></i>
                                    <p class="text-lg font-medium mb-2">Belum ada data penduduk</p>
                                    <p class="text-sm">Mulai dengan menambahkan data penduduk pertama</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="flex items-center justify-between mt-6">
                <div class="text-sm text-gray-700">
                    Menampilkan {{ $penduduk->firstItem() ?? 0 }} sampai {{ $penduduk->lastItem() ?? 0 }} 
                    dari {{ $penduduk->total() }} data
                </div>
                {{ $penduduk->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
