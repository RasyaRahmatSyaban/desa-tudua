@extends('layouts.guest')

@section('title', 'Data Penduduk Desa')
@section('description', 'Informasi statistik dan demografi penduduk desa')

@section('content')
    <div class="container mx-auto px-4 pt-24 pb-20">
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
                        <p class="text-3xl font-bold">{{ $totalPenduduk }}</p>
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
                        <p class="text-3xl font-bold">{{ $totalKepalaKeluarga }}</p>
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
                        <p class="text-3xl font-bold">{{ $totalLakiLaki }}</p>
                        <p class="text-purple-200 text-xs mt-1">{{ $persenLaki }}%</p>
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
                        <p class="text-3xl font-bold">{{ $totalPerempuan }}</p>
                        <p class="text-purple-200 text-xs mt-1">{{ $persenPerempuan }}%</p>
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
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Kelompok Usia</h3>
                <div class="space-y-4">
                    @foreach ($ageGroups as $group)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700 text-xl">{{ $group['label'] }}</span>
                            <div class="flex items-center space-x-3">
                                <div class="w-48 bg-gray-200 rounded-full h-2">
                                    <div class="{{ $group['color'] }} h-2 rounded-full" style="width: {{ $group['percent'] }}%">
                                    </div>
                                </div>
                                <div class="text-right w-16">
                                    <span class="text-md font-semibold text-gray-900 block">{{ $group['count'] }}</span>
                                    <span class="text-sm text-gray-500">{{ $group['percent'] }}%</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Religion -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Komposisi Agama</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-mosque text-white text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-900 text-xl">Islam</span>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-green-600">{{$islam}}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-cross text-white text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-900 text-xl">Katolik</span>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-blue-600">{{$katolik}}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-church text-white text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-900 text-xl">Protestan</span>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-purple-600">{{ $protestan }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-om text-white text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-900 text-xl">Hindu</span>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-orange-600">{{ $hindu }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-dharmachakra text-white text-sm"></i>
                            </div>
                            <span class="font-medium text-gray-900 text-xl">Buddha</span>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-yellow-600">{{ $buddha }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection