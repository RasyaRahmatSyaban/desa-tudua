@extends('layouts.guest')

@section('title', 'Surat Desa')
@section('description', 'Daftar surat masuk dan keluar yang dikelola oleh kantor desa.')

@section('content')
    <!-- Header -->
    <section class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Surat Desa</h1>
            <p class="text-lg text-indigo-100">Daftar surat masuk dan keluar yang dikelola oleh kantor desa.</p>
        </div>
    </section>

    <!-- Filter & Search -->
    <section class="bg-white py-8 border-b">
        <div class="max-w-7xl mx-auto px-4">
            <form method="GET" action="{{ route('surat.index') }}"
                class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <input type="text" name="nomor_surat" placeholder="Cari Nomor Surat" value="{{ request('nomor_surat') }}"
                    class="border border-gray-300 rounded-lg px-4 py-2 w-full">

                <input type="text" name="pengirim" placeholder="Cari Pengirim (Surat Masuk)"
                    value="{{ request('pengirim') }}" class="border border-gray-300 rounded-lg px-4 py-2 w-full">

                <input type="text" name="penerima" placeholder="Cari Penerima (Surat Keluar)"
                    value="{{ request('penerima') }}" class="border border-gray-300 rounded-lg px-4 py-2 w-full">

                <input type="text" name="perihal" placeholder="Cari Perihal" value="{{ request('perihal') }}"
                    class="border border-gray-300 rounded-lg px-4 py-2 w-full">

                <select name="jenis" class="border border-gray-300 rounded-lg px-4 py-2 w-full">
                    <option value="">Semua Jenis</option>
                    <option value="masuk" {{ request('jenis') == 'masuk' ? 'selected' : '' }}>Surat Masuk</option>
                    <option value="keluar" {{ request('jenis') == 'keluar' ? 'selected' : '' }}>Surat Keluar</option>
                </select>

                <select name="sort" class="border border-gray-300 rounded-lg px-4 py-2 w-full">
                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                </select>

                <div class="md:col-span-3 lg:col-span-4 text-right">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 font-semibold">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Daftar Surat -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            @forelse($surat as $item)
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $item->nomor_surat }}</h2>
                            <p class="text-sm text-gray-600 mb-1">
                                @if($item->jenis == 'masuk')
                                    <span class="inline-block bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full mr-2">
                                        Surat Masuk
                                    </span>
                                    <strong>Pengirim:</strong> {{ $item->pengirim }} <br>
                                    <strong>Tanggal Terima:</strong>
                                    {{ \Carbon\Carbon::parse($item->tanggal_terima)->translatedFormat('d F Y') }}
                                @else
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full mr-2">
                                        Surat Keluar
                                    </span>
                                    <strong>Penerima:</strong> {{ $item->penerima }} <br>
                                    <strong>Tanggal Kirim:</strong>
                                    {{ \Carbon\Carbon::parse($item->tanggal_kirim)->translatedFormat('d F Y') }}
                                @endif
                            </p>
                            <p class="text-gray-700"><strong>Perihal:</strong> {{ $item->perihal }}</p>
                        </div>

                        @if($item->file)
                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                class="inline-flex items-center bg-indigo-100 text-indigo-700 px-4 py-2 rounded-lg hover:bg-indigo-200 text-sm">
                                <i class="fas fa-download mr-2"></i> Unduh
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-20">
                    <i class="fas fa-envelope-open-text text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600">Belum ada surat untuk ditampilkan saat ini.</h3>
                </div>
            @endforelse

            <!-- Pagination -->
            @if(isset($surat) && $surat->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $surat->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection