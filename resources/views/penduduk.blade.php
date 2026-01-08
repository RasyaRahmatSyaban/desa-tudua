@extends('layouts.guest')

@section('title', 'Data Penduduk Desa')
@section('description', 'Informasi statistik dan demografi penduduk desa')

@section('content')
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }

        .hero-gradient {
            background: linear-gradient(135deg, rgba(17, 24, 39, 0.9) 0%, rgba(31, 41, 55, 0.8) 50%, rgba(55, 65, 81, 0.7) 100%);
        }
    </style>

    <!-- Header Section -->
    <section class="py-12 pt-24 bg-gray-900 border-b border-gray-700">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24 text-center">
            <h1 class="text-3xl lg:text-4xl font-bold text-white mb-4">Data Penduduk Desa</h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                Informasi statistik dan demografi penduduk desa berdasarkan data terkini
            </p>
        </div>
    </section>

    <!-- Main Statistics -->
    <section class="py-10 bg-gray-900">
        <div class="w-full mx-auto px-6 md:px-12 lg:px-24">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Total Penduduk -->
                <div
                    class="card-hover bg-gray-800 rounded-2xl shadow-xl border border-gray-700 hover:border-blue-500/50 transition-all duration-300 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-400 text-sm font-medium mb-1">Total Penduduk</p>
                            <p class="text-3xl font-bold text-white">{{ $totalPenduduk }}</p>
                            <p class="text-gray-400 text-xs mt-1">Jiwa</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-users text-2xl text-blue-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Kepala Keluarga -->
                <div
                    class="card-hover bg-gray-800 rounded-2xl shadow-xl border border-gray-700 hover:border-green-500/50 transition-all duration-300 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-400 text-sm font-medium mb-1">Kepala Keluarga</p>
                            <p class="text-3xl font-bold text-white">{{ $totalKepalaKeluarga }}</p>
                            <p class="text-gray-400 text-xs mt-1">KK</p>
                        </div>
                        <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-home text-2xl text-green-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Laki-laki -->
                <div
                    class="card-hover bg-gray-800 rounded-2xl shadow-xl border border-gray-700 hover:border-purple-500/50 transition-all duration-300 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-400 text-sm font-medium mb-1">Laki-laki</p>
                            <p class="text-3xl font-bold text-white">{{ $totalLakiLaki }}</p>
                            <p class="text-gray-400 text-xs mt-1">{{ $persenLaki }}%</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-male text-2xl text-purple-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Perempuan -->
                <div
                    class="card-hover bg-gray-800 rounded-2xl shadow-xl border border-gray-700 hover:border-pink-500/50 transition-all duration-300 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-pink-400 text-sm font-medium mb-1">Perempuan</p>
                            <p class="text-3xl font-bold text-white">{{ $totalPerempuan }}</p>
                            <p class="text-gray-400 text-xs mt-1">{{ $persenPerempuan }}%</p>
                        </div>
                        <div class="w-12 h-12 bg-pink-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-female text-2xl text-pink-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Demographics Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Age Groups -->
                <div
                    class="card-hover bg-gray-800 rounded-2xl shadow-xl border border-gray-700 hover:border-yellow-500/50 transition-all duration-300 p-6">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-chart-bar text-yellow-400 mr-3"></i>
                        Kelompok Usia
                    </h3>
                    <div class="space-y-5">
                        @foreach ($ageGroups as $group)
                            <div class="bg-gray-700/50 rounded-xl p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-gray-300 font-medium">{{ $group['label'] }}</span>
                                    <div class="text-right">
                                        <span class="text-lg font-bold text-white block">{{ $group['count'] }}</span>
                                        <span class="text-sm text-gray-400">{{ $group['percent'] }}%</span>
                                    </div>
                                </div>
                                <div class="w-full bg-gray-600 rounded-full h-2">
                                    <div class="{{ $group['color'] }} h-2 rounded-full transition-all duration-500 ease-out"
                                        style="width: {{ $group['percent'] }}%">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Religion -->
                <div
                    class="card-hover bg-gray-800 rounded-2xl shadow-xl border border-gray-700 hover:border-yellow-500/50 transition-all duration-300 p-6">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-pray text-yellow-400 mr-3"></i>
                        Komposisi Agama
                    </h3>
                    <div class="space-y-4">
                        <div
                            class="flex items-center justify-between p-4 bg-gray-700/50 rounded-xl hover:bg-gray-700 transition-colors duration-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-mosque text-green-400"></i>
                                </div>
                                <span class="font-medium text-white text-lg">Islam</span>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-green-400 text-lg">{{ $islam }}</p>
                                <p class="text-xs text-gray-400">Jiwa</p>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between p-4 bg-gray-700/50 rounded-xl hover:bg-gray-700 transition-colors duration-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-cross text-blue-400"></i>
                                </div>
                                <span class="font-medium text-white text-lg">Katolik</span>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-blue-400 text-lg">{{ $katolik }}</p>
                                <p class="text-xs text-gray-400">Jiwa</p>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between p-4 bg-gray-700/50 rounded-xl hover:bg-gray-700 transition-colors duration-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-church text-purple-400"></i>
                                </div>
                                <span class="font-medium text-white text-lg">Kristen</span>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-purple-400 text-lg">{{ $kristen }}</p>
                                <p class="text-xs text-gray-400">Jiwa</p>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between p-4 bg-gray-700/50 rounded-xl hover:bg-gray-700 transition-colors duration-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-om text-orange-400"></i>
                                </div>
                                <span class="font-medium text-white text-lg">Hindu</span>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-orange-400 text-lg">{{ $hindu }}</p>
                                <p class="text-xs text-gray-400">Jiwa</p>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between p-4 bg-gray-700/50 rounded-xl hover:bg-gray-700 transition-colors duration-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-dharmachakra text-yellow-400"></i>
                                </div>
                                <span class="font-medium text-white text-lg">Buddha</span>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-yellow-400 text-lg">{{ $buddha }}</p>
                                <p class="text-xs text-gray-400">Jiwa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection