@extends('layouts.admin')

@section('title', 'Kelola Penduduk')
@section('page-title', 'Kelola Penduduk')
@section('page-description', 'Manajemen data penduduk desa')

@section('content')
    <div class="space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Penduduk</p>
                        <p class="text-xl font-bold text-slate-800">{{ $totalPenduduk }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Laki-laki</p>
                        <p class="text-xl font-bold text-slate-800">{{ $totalLakiLaki }}</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-male text-emerald-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Perempuan</p>
                        <p class="text-xl font-bold text-slate-800">{{ $totalPerempuan }}</p>
                    </div>
                    <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-female text-pink-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Kepala Keluarga</p>
                        <p class="text-xl font-bold text-slate-800">{{ $totalKepalaKeluarga }}</p>
                    </div>
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-tie text-violet-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <form method="GET" action="{{ route('admin.penduduk.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari penduduk..." value="{{ request('search') }}"
                        class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        id="searchInput">
                    <i class="fas fa-search absolute left-3 top-3 text-slate-400 text-sm"></i>
                </div>

                <select name="jenis_kelamin" onchange="this.form.submit()"
                    class="bg-white border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    <option value="">Semua Jenis Kelamin</option>
                    <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </form>

            <a href="{{ route('admin.penduduk.create') }}"
                class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                <i class="fas fa-plus mr-2"></i>
                Tambah Penduduk
            </a>
        </div>

        <!-- Penduduk Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th
                                    class="text-left py-3 px-1 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    NIK/Nama</th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Jenis Kelamin</th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Tempat/Tgl Lahir</th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Alamat</th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Kepala Keluarga</th>
                                <th
                                    class="text-left py-3 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($penduduk as $item)
                                <tr class="hover:bg-slate-50 transition-colors duration-200">
                                    <td class="py-4 px-1">
                                        <div>
                                            <div class="text-sm font-medium text-slate-900">{{ $item->nama }}</div>
                                            <div class="text-xs text-slate-500 mt-1">NIK: {{ $item->nik }}</div>
                                            <div class="text-xs text-slate-500">
                                                Nomor KK:
                                                {{ $kepalaKeluargaByNik[$item->nik]->nomor_kk ?? $item->kepalaKeluarga->nomor_kk ?? '-' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full {{ $item->jenis_kelamin === 'Laki-laki' ? 'bg-emerald-100 text-emerald-800' : 'bg-pink-100 text-pink-800' }}">
                                            <i
                                                class="fas fa-{{ $item->jenis_kelamin === 'Laki-laki' ? 'male' : 'female' }} mr-1 text-xs"></i>
                                            {{ $item->jenis_kelamin === 'Laki-laki' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-sm text-slate-600">
                                        <div class="font-medium">{{ $item->tempat_lahir }}</div>
                                        <div class="text-xs text-slate-500 mt-1">
                                            {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d M Y') }}</div>
                                    </td>
                                    <td class="py-4 px-4 text-sm text-slate-600 max-w-xs">
                                        <div class="line-clamp-2 leading-relaxed">{{ $item->alamat }}</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                            <i class="fas fa-user mr-1 text-xs"></i>
                                            {{ $item->kepalaKeluarga->nama ?? 'Ya' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-1">
                                            <a href="{{ route('admin.penduduk.show', $item->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye text-sm"></i>
                                            </a>
                                            <a href="{{ route('admin.penduduk.edit', $item->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors duration-200"
                                                title="Edit Penduduk">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.penduduk.destroy', $item->id) }}"
                                                class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors duration-200"
                                                    title="Hapus Penduduk">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center mb-4">
                                                <i class="fas fa-users text-2xl text-slate-400"></i>
                                            </div>
                                            <p class="text-lg font-medium text-slate-600 mb-2">Belum ada data penduduk</p>
                                            <p class="text-sm text-slate-500 mb-4">Mulai dengan menambahkan data penduduk
                                                pertama</p>
                                            <a href="{{ route('admin.penduduk.create') }}"
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                                <i class="fas fa-plus mr-2"></i>
                                                Tambah Penduduk
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($penduduk->hasPages())
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-6 pt-6 border-t border-slate-200">
                        <div class="text-sm text-slate-600">
                            Menampilkan {{ $penduduk->firstItem() ?? 0 }} sampai {{ $penduduk->lastItem() ?? 0 }}
                            dari {{ $penduduk->total() }} data
                        </div>
                        <div class="flex justify-center sm:justify-end">
                            {{ $penduduk->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection