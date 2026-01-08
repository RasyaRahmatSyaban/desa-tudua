@extends('layouts.admin')

@section('title', 'Detail Data Penduduk')
@section('page-title', 'Detail Data Penduduk')
@section('page-description', 'Informasi lengkap data penduduk dan keluarga')

@section('content')
    <div class="space-y-6">
        <!-- Header Info -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-xl font-bold text-slate-800 flex items-center">
                <i class="fas fa-user-tie mr-3 text-blue-600"></i>
                Kepala Keluarga: {{ $data->kepalaKeluarga?->nama ?? $data->nama }}
            </h3>
        </div>

        <!-- Data Keluarga -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                        <i class="fas fa-users mr-2 text-blue-600"></i>
                        Data Keluarga
                    </h3>
                </div>

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
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($keluarga as $k)
                                <tr
                                    class="hover:bg-slate-50 transition-colors duration-200 {{ $k->id === $data->id ? 'bg-blue-50' : '' }}">
                                    <td class="py-4 px-1">
                                        <div>
                                            <div class="text-sm font-medium text-slate-900 flex items-center">
                                                {{ $k->nama }}
                                                @if($k->id === $data->id)
                                                    <span
                                                        class="ml-2 inline-flex items-center px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                                        Sedang Dilihat
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="text-xs text-slate-500 mt-1">NIK: {{ $k->nik }}</div>
                                            <div class="text-xs text-slate-500">Nomor KK: {{ $k->nomor_kk }}</div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full {{ $k->jenis_kelamin === 'Laki-laki' ? 'bg-emerald-100 text-emerald-800' : 'bg-pink-100 text-pink-800' }}">
                                            <i
                                                class="fas fa-{{ $k->jenis_kelamin === 'Laki-laki' ? 'male' : 'female' }} mr-1 text-xs"></i>
                                            {{ $k->jenis_kelamin === 'Laki-laki' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-sm text-slate-600">
                                        <div class="font-medium">{{ $k->tempat_lahir }}</div>
                                        <div class="text-xs text-slate-500 mt-1">
                                            {{ \Carbon\Carbon::parse($k->tanggal_lahir)->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-sm text-slate-600 max-w-xs">
                                        <div class="line-clamp-2 leading-relaxed">{{ $k->alamat }}</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 bg-violet-100 text-violet-800 text-xs font-medium rounded-full">
                                            <i class="fas fa-user-tie mr-1 text-xs"></i>
                                            {{ $k->kepalaKeluarga ? $k->kepalaKeluarga->nama : 'Ya' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center mb-4">
                                                <i class="fas fa-users text-2xl text-slate-400"></i>
                                            </div>
                                            <p class="text-lg font-medium text-slate-600 mb-2">Tidak ada data keluarga</p>
                                            <p class="text-sm text-slate-500">Data keluarga tidak ditemukan</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="{{ route('admin.penduduk.index') }}"
                class="inline-flex items-center px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-slate-700 text-sm font-medium hover:bg-slate-50 hover:border-slate-400 transition-colors duration-200 shadow-sm">
                <i class="fas fa-arrow-left mr-2 text-sm"></i>
                Kembali
            </a>

            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.penduduk.edit', $data->id) }}"
                    class="inline-flex items-center px-4 py-2.5 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                    <i class="fas fa-edit mr-2 text-sm"></i>
                    Edit Data
                </a>
                <form method="POST" action="{{ route('admin.penduduk.destroy', $data->id) }}" class="inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                        <i class="fas fa-trash mr-2 text-sm"></i>
                        Hapus Data
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection