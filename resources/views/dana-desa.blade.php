@extends('layouts.guest')

@section('title', 'Dana Desa')
@section('description', 'Transparansi pengelolaan dan penggunaan dana desa')

@section('content')
    <!-- Header -->
    <section class="bg-gradient-to-r from-emerald-600 to-emerald-800 text-white pt-28 pb-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Dana Desa</h1>
                <p class="text-xl text-emerald-100 max-w-2xl mx-auto">
                    Transparansi pengelolaan dan penggunaan dana desa untuk kesejahteraan masyarakat
                </p>
            </div>
        </div>
    </section>

    <!-- Ringkasan Anggaran -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Ringkasan Anggaran {{ $tahunDipilih }}</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Total anggaran dan realisasi dana desa tahun {{ $tahunDipilih }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Dana Masuk -->
                <div class="bg-white p-6 rounded-lg shadow border text-center">
                    <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-arrow-down text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</h3>
                    <p class="text-green-600 font-medium mt-1">Dana Masuk</p>
                </div>

                <!-- Saldo -->
                <div class="bg-white p-6 rounded-lg shadow border text-center">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-wallet text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Rp {{ number_format($saldo, 0, ',', '.') }}</h3>
                    <p class="text-blue-600 font-medium mt-1">Saldo</p>
                </div>

                <!-- Dana Keluar -->
                <div class="bg-white p-6 rounded-lg shadow border text-center">
                    <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-arrow-up text-red-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</h3>
                    <p class="text-red-600 font-medium mt-1">Dana Keluar</p>
                </div>
            </div>

            <!-- Filter Tahun -->
            <div class="text-center mt-12 mb-8">
                <form method="GET">
                    <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">Pilih Tahun</label>
                    <select name="tahun" id="tahun" onchange="this.form.submit()"
                        class="inline-block w-40 px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-emerald-500">
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}" {{ $tahunDipilih == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <!-- Dana Masuk per Bulan -->
            <div class="bg-white p-6 rounded-lg shadow-md border mb-10">
                <h3 class="text-xl font-semibold text-green-600 mb-4 flex items-center">
                    <i class="fas fa-arrow-down mr-2"></i> Dana Masuk - {{ $tahunDipilih }}
                </h3>
                @if ($danaMasukDetailBulanan->isEmpty())
                    <p class="text-gray-500">Belum ada data dana masuk untuk tahun ini.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tahun</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Bulan</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Sumber</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($danaMasukDetailBulanan as $bulan => $details)
                                    @foreach ($details as $index => $detail)
                                        <tr>
                                            @if ($index === 0)
                                                <td class="px-4 py-2 border" rowspan="{{ count($details) }}">{{ $tahunDipilih }}</td>
                                                <td class="px-4 py-2 border" rowspan="{{ count($details) }}">{{ $bulanMapping[$bulan] }}</td>
                                            @endif
                                            <td class="px-4 py-2 border">Rp {{ number_format($detail['jumlah'], 0, ',', '.') }}</td>
                                            <td class="px-4 py-2 border">{{ $detail['sumber'] }}</td>
                                            <td class="px-4 py-2 border">{{ $detail['keterangan'] }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Dana Keluar per Bulan -->
            <div class="bg-white p-6 rounded-lg shadow-md border">
                <h3 class="text-xl font-semibold text-red-600 mb-4 flex items-center">
                    <i class="fas fa-arrow-up mr-2"></i> Dana Keluar - {{ $tahunDipilih }}
                </h3>
                @if ($danaKeluarDetailBulanan->isEmpty())
                    <p class="text-gray-500">Belum ada data dana keluar untuk tahun ini.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tahun</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Bulan</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($danaKeluarDetailBulanan as $bulan => $details)
                                    @foreach ($details as $index => $detail)
                                        <tr>
                                            @if ($index === 0)
                                                <td class="px-4 py-2 border" rowspan="{{ count($details) }}">{{ $tahunDipilih }}</td>
                                                <td class="px-4 py-2 border" rowspan="{{ count($details) }}">{{ $bulanMapping[$bulan] }}</td>
                                            @endif
                                            <td class="px-4 py-2 border">Rp {{ number_format($detail['jumlah'], 0, ',', '.') }}</td>
                                            <td class="px-4 py-2 border">{{ $detail['kategori'] }}</td>
                                            <td class="px-4 py-2 border">{{ $detail['keterangan'] }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection