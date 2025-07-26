@extends('layouts.guest')

@section('title', 'Data Penduduk Desa')
@section('description', 'Informasi statistik dan demografi penduduk desa')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Data Penduduk Desa</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Informasi statistik dan demografi penduduk desa berdasarkan data terkini
        </p>
    </div>

    <!-- Main Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Penduduk</p>
                    <p class="text-3xl font-bold">2,847</p>
                    <p class="text-blue-200 text-xs mt-1">Jiwa</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Kepala Keluarga</p>
                    <p class="text-3xl font-bold">892</p>
                    <p class="text-green-200 text-xs mt-1">KK</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-home text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Laki-laki</p>
                    <p class="text-3xl font-bold">1,456</p>
                    <p class="text-purple-200 text-xs mt-1">51.1%</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-male text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-pink-100 text-sm font-medium">Perempuan</p>
                    <p class="text-3xl font-bold">1,391</p>
                    <p class="text-pink-200 text-xs mt-1">48.9%</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-female text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Demographics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <!-- Age Groups -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-6">Kelompok Usia</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">0-4 tahun</span>
                    <div class="flex items-center space-x-3">
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 8%"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-900 w-12">228</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">5-14 tahun</span>
                    <div class="flex items-center space-x-3">
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 18%"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-900 w-12">512</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">15-24 tahun</span>
                    <div class="flex items-center space-x-3">
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 16%"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-900 w-12">455</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">25-54 tahun</span>
                    <div class="flex items-center space-x-3">
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 42%"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-900 w-12">1,196</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">55-64 tahun</span>
                    <div class="flex items-center space-x-3">
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-orange-500 h-2 rounded-full" style="width: 12%"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-900 w-12">342</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">65+ tahun</span>
                    <div class="flex items-center space-x-3">
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 4%"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-900 w-12">114</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Education Level -->
        <!-- <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-6">Tingkat Pendidikan</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">Tidak Sekolah</span>
                    <div class="flex items-center space-x-3">
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 5%"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-900 w-12">142</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">SD/Sederajat</span>
                    <div class="flex items-center space-x-3">
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-orange-500 h-2 rounded-full" style="width: 35%"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-900 w-12">996</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">SMP/Sederajat</span>
                    <div class="flex items-center space-x-3">
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 28%"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-900 w-12">797</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">SMA/Sederajat</span>
                    <div class="flex items-center space-x-3">
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 25%"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-900 w-12">712</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">Diploma/S1</span>
                    <div class="flex items-center space-x-3">
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 6%"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-900 w-12">171</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">S2/S3</span>
                    <div class="flex items-center space-x-3">
                        <div class="w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 1%"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-900 w-12">29</span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Occupation and Religion -->
    <!-- <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-6">Mata Pencaharian</h3>
            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="fas fa-seedling text-white"></i>
                        </div>
                        <p class="text-2xl font-bold text-green-600">1,247</p>
                        <p class="text-sm text-gray-600">Petani</p>
                    </div>
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="fas fa-store text-white"></i>
                        </div>
                        <p class="text-2xl font-bold text-blue-600">423</p>
                        <p class="text-sm text-gray-600">Pedagang</p>
                    </div>
                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                        <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="fas fa-briefcase text-white"></i>
                        </div>
                        <p class="text-2xl font-bold text-purple-600">312</p>
                        <p class="text-sm text-gray-600">Pegawai</p>
                    </div>
                    <div class="text-center p-4 bg-orange-50 rounded-lg">
                        <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="fas fa-hammer text-white"></i>
                        </div>
                        <p class="text-2xl font-bold text-orange-600">289</p>
                        <p class="text-sm text-gray-600">Buruh</p>
                    </div>
                </div>
                <div class="pt-4 border-t border-gray-200">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Lainnya (Pensiunan, Mahasiswa, dll)</span>
                        <span class="font-medium">576 orang</span>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Religion -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-6">Komposisi Agama</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-mosque text-white text-sm"></i>
                        </div>
                        <span class="font-medium text-gray-900">Islam</span>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-green-600">2,654</p>
                        <p class="text-xs text-gray-500">93.2%</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-cross text-white text-sm"></i>
                        </div>
                        <span class="font-medium text-gray-900">Kristen</span>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-blue-600">142</p>
                        <p class="text-xs text-gray-500">5.0%</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-church text-white text-sm"></i>
                        </div>
                        <span class="font-medium text-gray-900">Katolik</span>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-purple-600">37</p>
                        <p class="text-xs text-gray-500">1.3%</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-om text-white text-sm"></i>
                        </div>
                        <span class="font-medium text-gray-900">Lainnya</span>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-orange-600">14</p>
                        <p class="text-xs text-gray-500">0.5%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Population by Village Area -->
    <!-- <div class="bg-white rounded-lg shadow-md p-6 mb-12">
        <h3 class="text-xl font-semibold text-gray-900 mb-6">Data Penduduk per Dusun</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dusun</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kepala Keluarga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Laki-laki</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perempuan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persentase</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Dusun Mawar</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">234</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">389</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">367</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">756</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">26.5%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Dusun Melati</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">198</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">321</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">312</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">633</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">22.2%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Dusun Kenanga</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">187</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">298</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">289</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">587</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">20.6%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Dusun Anggrek</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">156</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">267</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">254</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">521</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">18.3%</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Dusun Dahlia</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">117</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">181</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">169</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">350</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium bg-orange-100 text-orange-800 rounded-full">12.3%</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> -->

    <!-- Download Section -->
    <!-- <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-8 text-center">
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Download Data Penduduk</h3>
        <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
            Unduh data penduduk dalam berbagai format untuk keperluan penelitian, perencanaan, atau analisis
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <button class="flex items-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                <i class="fas fa-file-pdf mr-2"></i>
                Download PDF
            </button>
            <button class="flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-file-excel mr-2"></i>
                Download Excel
            </button>
            <button class="flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-file-csv mr-2"></i>
                Download CSV
            </button>
        </div>
        <p class="text-xs text-gray-500 mt-4">
            Data terakhir diperbarui: {{ now()->format('d F Y') }}
        </p>
    </div> -->
</div>
@endsection
