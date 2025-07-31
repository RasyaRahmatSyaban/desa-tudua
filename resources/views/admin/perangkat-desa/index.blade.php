@extends('layouts.admin')

@section('title', 'Kelola Perangkat Desa')
@section('page-title', 'Kelola Perangkat Desa')
@section('page-description', 'Manajemen data perangkat desa desa')

@section('content')
    <div class="space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 flex-wrap">
            <!-- Kiri: Search dan filter -->
            <div class="flex flex-wrap items-center gap-4">
                <!-- Search -->
                <form method="GET" action="{{ route('admin.perangkat-desa.index') }}" class="relative">
                    <input type="text" name="search" placeholder="Cari nama, jabatan..." value="{{ request('search') }}"
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </form>
            </div>

            <!-- Kanan: Optional Export Button -->
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.perangkat-desa.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Perangkat Desa
                </a>
            </div>
        </div>
    </div>


    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jabatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($perangkatDesa as $perangkat)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($perangkat->foto)
                                        <img src="{{ asset('storage/' . $perangkat->foto) }}" alt="Foto"
                                            class="w-12 h-12 rounded-full object-cover">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $perangkat->nama }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $perangkat->jabatan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $perangkat->nip ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.perangkat-desa.show', $perangkat->id) }}"
                                            class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.perangkat-desa.edit', $perangkat->id) }}"
                                            class="text-yellow-600 hover:text-yellow-900 p-2 rounded-lg hover:bg-yellow-50">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.perangkat-desa.destroy', $perangkat->id) }}" method="POST"
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
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    Tidak ada data perangkat desa
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="flex items-center justify-between mt-6">
                <div class="text-sm text-gray-700">
                    Menampilkan {{ $perangkatDesa->firstItem() ?? 0 }} sampai {{ $perangkatDesa->lastItem() ?? 0 }}
                    dari {{ $perangkatDesa->total() }} data
                </div>
                {{ $perangkatDesa->links() }}
            </div>
        </div>
    </div>
    </div>
@endsection