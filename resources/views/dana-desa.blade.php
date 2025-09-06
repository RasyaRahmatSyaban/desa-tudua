@extends('layouts.guest')

@section('title', 'Dana Desa')
@section('description', 'Transparansi pengelolaan dan penggunaan dana desa')

@section('content')
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(55, 65, 81, 0.9) 0%, rgba(31, 41, 55, 0.8) 100%);
        }

        .stat-card-green {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .stat-card-blue {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(29, 78, 216, 0.1) 100%);
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .stat-card-red {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* Fixed table column widths */
        .dana-table {
            table-layout: fixed;
        }

        .dana-table .col-tahun {
            width: 10%;
        }

        .dana-table .col-bulan {
            width: 15%;
        }

        .dana-table .col-jumlah {
            width: 20%;
        }

        .dana-table .col-kategori {
            width: 20%;
        }

        .dana-table .col-keterangan {
            width: 35%;
        }
    </style>

    <!-- Header -->
    <section class="pt-24 pb-12 bg-gray-900">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24">
            <div class="text-center">
                <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4">Dana Desa</h1>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Transparansi pengelolaan dan penggunaan dana desa untuk kesejahteraan masyarakat
                </p>
            </div>
        </div>
    </section>

    <!-- Filter Tahun -->
    <section class="py-8 bg-gray-900 border-b border-gray-700">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-2">Ringkasan Anggaran {{ $tahunDipilih }}</h2>
                    <p class="text-gray-400">Total anggaran dan realisasi dana desa tahun {{ $tahunDipilih }}</p>
                </div>

                <form method="GET" class="flex items-center gap-3">
                    <label for="tahun" class="text-sm font-medium text-gray-300">Pilih Tahun:</label>
                    <select name="tahun" id="tahun" onchange="this.form.submit()" class="bg-gray-800 border border-gray-600 rounded-xl px-4 py-2 text-white focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-300 min-w-[120px]">
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}" {{ $tahunDipilih == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </section>

    <!-- Ringkasan Anggaran -->
    <section class="py-12 bg-gray-900">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Dana Masuk -->
                <div class="card-hover stat-card stat-card-green rounded-2xl shadow-xl p-6 text-center">
                    <div
                        class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-green-500/30">
                        <i class="fas fa-arrow-down text-green-400 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</h3>
                    <p class="text-green-400 font-semibold">Dana Masuk</p>
                </div>

                <!-- Saldo -->
                <div class="card-hover stat-card stat-card-blue rounded-2xl shadow-xl p-6 text-center">
                    <div
                        class="w-16 h-16 bg-blue-500/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-blue-500/30">
                        <i class="fas fa-wallet text-blue-400 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Rp {{ number_format($saldo, 0, ',', '.') }}</h3>
                    <p class="text-blue-400 font-semibold">Saldo</p>
                </div>

                <!-- Dana Keluar -->
                <div class="card-hover stat-card stat-card-red rounded-2xl shadow-xl p-6 text-center">
                    <div
                        class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-red-500/30">
                        <i class="fas fa-arrow-up text-red-400 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</h3>
                    <p class="text-red-400 font-semibold">Dana Keluar</p>
                </div>
            </div>

            <!-- Dana Masuk per Bulan -->
            <div
                class="card-hover bg-gray-800 rounded-2xl shadow-xl border border-gray-700 hover:border-green-500/50 p-6 mb-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-green-500/20 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-arrow-down text-green-400 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">Dana Masuk</h3>
                        <p class="text-gray-400">Tahun {{ $tahunDipilih }}</p>
                    </div>
                </div>

                @if ($danaMasukDetailBulanan->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-700 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-inbox text-3xl text-gray-500"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-white mb-2">Belum Ada Data</h4>
                        <p class="text-gray-400">Belum ada data dana masuk untuk tahun ini.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full dana-table">
                            <thead>
                                <tr class="border-b border-gray-700">
                                    <th class="col-tahun px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Tahun</th>
                                    <th class="col-bulan px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Bulan</th>
                                    <th class="col-jumlah px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Jumlah</th>
                                    <th class="col-kategori px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Sumber</th>
                                    <th class="col-keterangan px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach ($danaMasukDetailBulanan as $bulan => $details)
                                    @foreach ($details as $index => $detail)
                                        <tr class="hover:bg-gray-700/50 transition-colors duration-200">
                                            @if ($index === 0)
                                                <td class="col-tahun px-4 py-3 text-white font-medium" rowspan="{{ count($details) }}">
                                                    {{ $tahunDipilih }}</td>
                                                <td class="col-bulan px-4 py-3 text-white font-medium" rowspan="{{ count($details) }}">
                                                    <span
                                                        class="bg-gray-700 px-3 py-1 rounded-full text-sm">{{ $bulanMapping[$bulan] }}</span>
                                                </td>
                                            @endif
                                            <td class="col-jumlah px-4 py-3 text-green-400 font-semibold">Rp
                                                {{ number_format($detail['jumlah'], 0, ',', '.') }}</td>
                                            <td class="col-kategori px-4 py-3 text-gray-300">{{ $detail['sumber'] }}</td>
                                            <td class="col-keterangan px-4 py-3 text-gray-300">{{ $detail['keterangan'] }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Dana Keluar per Bulan -->
            <div class="card-hover bg-gray-800 rounded-2xl shadow-xl border border-gray-700 hover:border-red-500/50 p-6">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-red-500/20 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-arrow-up text-red-400 text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">Dana Keluar</h3>
                        <p class="text-gray-400">Tahun {{ $tahunDipilih }}</p>
                    </div>
                </div>

                @if ($danaKeluarDetailBulanan->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-700 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-file-invoice text-3xl text-gray-500"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-white mb-2">Belum Ada Data</h4>
                        <p class="text-gray-400">Belum ada data dana keluar untuk tahun ini.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full dana-table">
                            <thead>
                                <tr class="border-b border-gray-700">
                                    <th class="col-tahun px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Tahun</th>
                                    <th class="col-bulan px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Bulan</th>
                                    <th class="col-jumlah px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Jumlah</th>
                                    <th class="col-kategori px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Kategori</th>
                                    <th class="col-keterangan px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach ($danaKeluarDetailBulanan as $bulan => $details)
                                    @foreach ($details as $index => $detail)
                                        <tr class="hover:bg-gray-700/50 transition-colors duration-200">
                                            @if ($index === 0)
                                                <td class="col-tahun px-4 py-3 text-white font-medium" rowspan="{{ count($details) }}">
                                                    {{ $tahunDipilih }}</td>
                                                <td class="col-bulan px-4 py-3 text-white font-medium" rowspan="{{ count($details) }}">
                                                    <span
                                                        class="bg-gray-700 px-3 py-1 rounded-full text-sm">{{ $bulanMapping[$bulan] }}</span>
                                                </td>
                                            @endif
                                            <td class="col-jumlah px-4 py-3 text-red-400 font-semibold">Rp
                                                {{ number_format($detail['jumlah'], 0, ',', '.') }}</td>
                                            <td class="col-kategori px-4 py-3 text-gray-300">{{ $detail['kategori'] }}</td>
                                            <td class="col-keterangan px-4 py-3 text-gray-300">{{ $detail['keterangan'] }}</td>
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