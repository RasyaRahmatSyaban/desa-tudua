@extends('layouts.guest')

@section('title', 'Kontak Desa')
@section('description', 'Hubungi kami untuk informasi lebih lanjut atau kunjungi kantor desa')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-teal-600 to-teal-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Kontak Desa</h1>
            <p class="text-xl text-teal-100 max-w-2xl mx-auto">
                Hubungi kami untuk informasi lebih lanjut atau kunjungi kantor desa
            </p>
        </div>
    </div>
</section>

<!-- Contact Information -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Details -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Informasi Kontak</h2>
                
                <div class="space-y-6">
                    <!-- Alamat -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-teal-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Alamat Kantor</h3>
                            <p class="text-gray-600">
                                Jl. Raya Desa No. 123<br>
                                Kecamatan Example<br>
                                Kabupaten Example, Provinsi Example<br>
                                Kode Pos: 12345
                            </p>
                        </div>
                    </div>
                    
                    <!-- Telepon -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-teal-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Telepon</h3>
                            <p class="text-gray-600">
                                Kantor: (021) 1234-5678<br>
                                Fax: (021) 1234-5679<br>
                                WhatsApp: +62 812-3456-7890
                            </p>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-teal-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Email</h3>
                            <p class="text-gray-600">
                                info@desa.example.id<br>
                                pelayanan@desa.example.id<br>
                                kepala.desa@desa.example.id
                            </p>
                        </div>
                    </div>
                    
                    <!-- Jam Operasional -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-teal-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Jam Operasional</h3>
                            <p class="text-gray-600">
                                Senin - Jumat: 08:00 - 15:00 WIB<br>
                                Sabtu: 08:00 - 12:00 WIB<br>
                                Minggu & Hari Libur: Tutup
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Media Sosial</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center text-white hover:bg-pink-700 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center text-white hover:bg-red-700 transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white hover:bg-green-700 transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div>
                <div class="card bg-gray-50 p-8 rounded-lg">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>
                    
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="nama" 
                                       name="nama" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                       placeholder="Masukkan nama lengkap"
                                       required>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                       placeholder="Masukkan email"
                                       required>
                            </div>
                        </div>
                        
                        <div>
                            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Telepon
                            </label>
                            <input type="tel" 
                                   id="telepon" 
                                   name="telepon" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                   placeholder="Masukkan nomor telepon">
                        </div>
                        
                        <div>
                            <label for="subjek" class="block text-sm font-medium text-gray-700 mb-2">
                                Subjek <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="subjek" 
                                   name="subjek" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                   placeholder="Masukkan subjek pesan"
                                   required>
                        </div>
                        
                        <div>
                            <label for="pesan" class="block text-sm font-medium text-gray-700 mb-2">
                                Pesan <span class="text-red-500">*</span>
                            </label>
                            <textarea id="pesan" 
                                      name="pesan" 
                                      rows="5"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                      placeholder="Tulis pesan Anda di sini..."
                                      required></textarea>
                        </div>
                        
                        <button type="submit" 
                                class="w-full btn-primary text-white px-6 py-3 rounded-lg font-medium">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Lokasi Kantor Desa</h2>
            <p class="text-gray-600">
                Temukan lokasi kantor desa kami di peta
            </p>
        </div>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-96 bg-gray-200 flex items-center justify-center">
                <div class="text-center">
                    <i class="fas fa-map-marked-alt text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">Peta lokasi akan ditampilkan di sini</p>
                    <p class="text-sm text-gray-500 mt-2">
                        Integrasi dengan Google Maps atau penyedia peta lainnya
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Contact -->
<section class="py-16 bg-teal-600 text-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Butuh Bantuan Segera?</h2>
            <p class="text-xl text-teal-100 max-w-2xl mx-auto">
                Hubungi kami melalui berbagai saluran komunikasi yang tersedia
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-phone text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Telepon</h3>
                <p class="text-teal-100 mb-4">Hubungi langsung untuk informasi cepat</p>
                <a href="tel:+62211234567" class="bg-white text-teal-600 px-6 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                    (021) 1234-5678
                </a>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fab fa-whatsapp text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">WhatsApp</h3>
                <p class="text-teal-100 mb-4">Chat langsung via WhatsApp</p>
                <a href="https://wa.me/6281234567890" class="bg-white text-teal-600 px-6 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                    Chat Sekarang
                </a>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Email</h3>
                <p class="text-teal-100 mb-4">Kirim email untuk pertanyaan detail</p>
                <a href="mailto:info@desa.example.id" class="bg-white text-teal-600 px-6 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                    Kirim Email
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
