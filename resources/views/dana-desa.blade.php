@extends('layouts.guest')

@section('title', 'Dana Desa')
@section('description', 'Transparansi pengelolaan dan penggunaan dana desa')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-emerald-600 to-emerald-800 text-white py-16">
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
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Ringkasan Anggaran 2024</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Total anggaran dan realisasi dana desa tahun 2024
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
            $anggaran = [
                [
                    'judul' => 'Total Anggaran',
                    'nilai' => 'Rp 1.250.000.000',
                    'icon' => 'wallet',
                    'color' => 'blue',
                    'deskripsi' => 'Anggaran dana desa tahun 2024'
                ],
                [
                    'judul' => 'Dana Masuk',
                    'nilai' => 'Rp 1.125.000.000',
                    'icon' => 'arrow-down',
                    'color' => 'green',
                    'deskripsi' => 'Total dana yang sudah masuk'
                ],
                [
                    'judul' => 'Dana Keluar',
                    'nilai' => 'Rp 875.000.000',
                    'icon' => 'arrow-up',
                    'color' => 'red',
                    'deskripsi' => 'Total dana yang sudah digunakan'
                ]
            ];
            @endphp
            
            @foreach($anggaran as $item)
            <div class="card-hover bg-white p-8 rounded-lg shadow-md border border-gray-200 text-center">
                <div class="w-16 h-16 bg-{{ $item['color'] }}-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-{{ $item['icon'] }} text-{{ $item['color'] }}-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $item['nilai'] }}</h3>
                <p class="text-lg font-semibold text-{{ $item['color'] }}-600 mb-2">{{ $item['judul'] }}</p>
                <p class="text-gray-600">{{ $item['deskripsi'] }}</p>
            </div>
            @endforeach
        </div>
        
        <!-- Progress Bar -->
        <div class="mt-12 bg-gray-50 p-8 rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Realisasi Anggaran</h3>
                <span class="text-2xl font-bold text-emerald-600">70%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class="bg-emerald-600 h-4 rounded-full" style="width: 70%"></div>
            </div>
            <div class="flex justify-between text-sm text-gray-600 mt-2">
                <span>Rp 0</span>
                <span>Rp 875.000.000 / Rp 1.250.000.000</span>
            </div>
        </div>
    </div>
</section>

<!-- Sumber Dana -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Sumber Dana</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Berbagai sumber pendapatan dana desa
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @php
            $sumberDana = [
                [
                    'nama' => 'Dana Desa (APBN)',
                    'jumlah' => 'Rp 750.000.000',
                    'persentase' => 60,
                    'icon' => 'university',
                    'color' => 'blue'
                ],
                [
                    'nama' => 'Alokasi Dana Desa',
                    'jumlah' => 'Rp 300.000.000',
                    'persentase' => 24,
                    'icon' => 'hand-holding-usd',
                    'color' => 'green'
                ],
                [
                    'nama' => 'Bagi Hasil Pajak',
                    'jumlah' => 'Rp 125.000.000',
                    'persentase' => 10,
                    'icon' => 'percentage',
                    'color' => 'yellow'
                ],
                [
                    'nama' => 'Bantuan Provinsi/Kabupaten',
                    'jumlah' => 'Rp 75.000.000',
                    'persentase' => 6,
                    'icon' => 'gift',
                    'color' => 'purple'
                ]
            ];
            @endphp
            
            @foreach($sumberDana as $item)
            <div class="card-hover bg-white p-6 rounded-lg shadow-md">
                <div class="w-12 h-12 bg-{{ $item['color'] }}-100 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-{{ $item['icon'] }} text-{{ $item['color'] }}-600"></i>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $item['nama'] }}</h4>
                <p class="text-2xl font-bold text-{{ $item['color'] }}-600 mb-2">{{ $item['jumlah'] }}</p>
                <div class="flex items-center space-x-2">
                    <div class="flex-1 bg-gray-200 rounded-full h-2">
                        <div class="bg-{{ $item['color'] }}-600 h-2 rounded-full" style="width: {{ $item['persentase'] }}%"></div>
                    </div>
                    <span class="text-sm text-gray-600">{{ $item['persentase'] }}%</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Penggunaan Dana -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Penggunaan Dana</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Alokasi penggunaan dana desa berdasarkan bidang
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Chart Placeholder -->
            <div class="bg-gray-50 p-8 rounded-lg">
                <h3 class="text-xl font-semibold text-gray-900 mb-6 text-center">Distribusi Penggunaan Dana</h3>
                <div class="h-64 bg-white rounded-lg flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-chart-pie text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">Grafik distribusi dana</p>
                        <p class="text-sm text-gray-500 mt-2">Chart akan ditampilkan di sini</p>
                    </div>
                </div>
            </div>
            
            <!-- Detail Penggunaan -->
            <div class="space-y-6">
                @php
                $penggunaanDana = [
                    [
                        'bidang' => 'Pembangunan Infrastruktur',
                        'jumlah' => 'Rp 350.000.000',
                        'persentase' => 40,
                        'icon' => 'road',
                        'color' => 'blue',
                        'deskripsi' => 'Jalan, jembatan, drainase'
                    ],
                    [
                        'bidang' => 'Pemberdayaan Masyarakat',
                        'jumlah' => 'Rp 175.000.000',
                        'persentase' => 20,
                        'icon' => 'users',
                        'color' => 'green',
                        'deskripsi' => 'Pelatihan, UMKM, koperasi'
                    ],
                    [
                        'bidang' => 'Pelayanan Umum',
                        'jumlah' => 'Rp 131.250.000',
                        'persentase' => 15,
                        'icon' => 'clipboard-list',
                        'color' => 'purple',
                        'deskripsi' => 'Administrasi, pelayanan publik'
                    ],
                    [
                        'bidang' => 'Kesehatan',
                        'jumlah' => 'Rp 87.500.000',
                        'persentase' => 10,
                        'icon' => 'heartbeat',
                        'color' => 'red',
                        'deskripsi' => 'Posyandu, obat-obatan'
                    ],
                    [
                        'bidang' => 'Pendidikan',
                        'jumlah' => 'Rp 87.500.000',
                        'persentase' => 10,
                        'icon' => 'graduation-cap',
                        'color' => 'yellow',
                        'deskripsi' => 'Beasiswa, sarana pendidikan'
                    ],
                    [
                        'bidang' => 'Keamanan & Ketertiban',
                        'jumlah' => 'Rp 43.750.000',
                        'persentase' => 5,
                        'icon' => 'shield-alt',
                        'color' => 'indigo',
                        'deskripsi' => 'Siskamling, pos ronda'
                    ]
                ];
                @endphp
                
                @foreach($penggunaanDana as $item)
                <div class="card-hover bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-{{ $item['color'] }}-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-{{ $item['icon'] }} text-{{ $item['color'] }}-600"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-lg font-semibold text-gray-900">{{ $item['bidang'] }}</h4>
                                <span class="text-lg font-bold text-{{ $item['color'] }}-600">{{ $item['persentase'] }}%</span>
                            </div>
                            <p class="text-2xl font-bold text-gray-900 mb-1">{{ $item['jumlah'] }}</p>
                            <p class="text-sm text-gray-600">{{ $item['deskripsi'] }}</p>
                            <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
                                <div class="bg-{{ $item['color'] }}-600 h-2 rounded-full" style="width: {{ $item['persentase'] * 2.5 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Laporan Keuangan -->
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <div class="w-16 h-16 bg-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-file-download text-white text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Download Laporan Dana Desa</h2>
        <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
            Unduh laporan lengkap pengelolaan dana desa dalam berbagai format
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button class="btn-primary text-white px-6 py-3 rounded-lg font-medium inline-flex items-center">
                <i class="fas fa-file-pdf mr-2"></i>Laporan PDF
            </button>
            <button class="bg-green-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-700 transition-colors inline-flex items-center">
                <i class="fas fa-file-excel mr-2"></i>Laporan Excel
            </button>
            <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-chart-bar mr-2"></i>Grafik Analisis
            </button>
        </div>
        
        <p class="text-sm text-gray-500 mt-6">
            Laporan terakhir diperbarui: {{ date('d M Y') }} | Data periode Januari - September 2024
        </p>
    </div>
</section>
@endsection
