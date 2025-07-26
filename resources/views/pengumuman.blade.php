@extends('layouts.guest')

@section('title', 'Pengumuman Desa')
@section('meta-description', 'Pengumuman dan informasi penting dari pemerintah desa')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Pengumuman Desa</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Informasi penting dan pengumuman terbaru dari pemerintah desa untuk masyarakat
        </p>
    </div>

    <!-- Filter and Search -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="relative">
                <input type="text" 
                       id="searchInput"
                       placeholder="Cari pengumuman..." 
                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-4 text-gray-400"></i>
            </div>
            <select id="priorityFilter" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Prioritas</option>
                <option value="tinggi">Prioritas Tinggi</option>
                <option value="sedang">Prioritas Sedang</option>
                <option value="rendah">Prioritas Rendah</option>
            </select>
            <select id="categoryFilter" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Kategori</option>
                <option value="umum">Umum</option>
                <option value="kesehatan">Kesehatan</option>
                <option value="pendidikan">Pendidikan</option>
                <option value="ekonomi">Ekonomi</option>
                <option value="sosial">Sosial</option>
            </select>
        </div>
    </div>

    <!-- Important Announcements -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
            Pengumuman Penting
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-start justify-between mb-4">
                    <span class="px-3 py-1 bg-white/20 text-white text-sm font-medium rounded-full">
                        PENTING
                    </span>
                    <span class="text-red-100 text-sm">
                        <i class="fas fa-calendar mr-1"></i>
                        15 Jan 2024
                    </span>
                </div>
                <h3 class="text-xl font-bold mb-3">Pemberlakuan Jam Malam Sementara</h3>
                <p class="text-red-100 mb-4">
                    Mulai tanggal 20 Januari 2024, diberlakukan jam malam sementara dari pukul 22.00 - 05.00 WIB untuk menjaga keamanan desa.
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-red-100">
                        <i class="fas fa-clock mr-1"></i>
                        Berlaku hingga: 31 Jan 2024
                    </span>
                    <button class="text-white hover:text-red-200 font-medium">
                        Baca Selengkapnya →
                    </button>
                </div>
            </div>

            <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-start justify-between mb-4">
                    <span class="px-3 py-1 bg-white/20 text-white text-sm font-medium rounded-full">
                        URGENT
                    </span>
                    <span class="text-orange-100 text-sm">
                        <i class="fas fa-calendar mr-1"></i>
                        12 Jan 2024
                    </span>
                </div>
                <h3 class="text-xl font-bold mb-3">Pemadaman Listrik Terjadwal</h3>
                <p class="text-orange-100 mb-4">
                    PLN akan melakukan pemadaman listrik terjadwal pada tanggal 18 Januari 2024 pukul 08.00 - 16.00 WIB untuk maintenance.
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-orange-100">
                        <i class="fas fa-clock mr-1"></i>
                        Durasi: 8 jam
                    </span>
                    <button class="text-white hover:text-orange-200 font-medium">
                        Baca Selengkapnya →
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- All Announcements -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Semua Pengumuman</h2>
        <div class="space-y-6" id="announcementsList">
            <!-- Announcement 1 -->
            <div class="bg-white rounded-lg shadow-md p-6 announcement-item" data-priority="sedang" data-category="umum">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bullhorn text-blue-600"></i>
                        </div>
                        <div>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                Prioritas Sedang
                            </span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full ml-2">
                                Umum
                            </span>
                        </div>
                    </div>
                    <span class="text-gray-500 text-sm">
                        <i class="fas fa-calendar mr-1"></i>
                        10 Jan 2024
                    </span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Jadwal Pelayanan Administrasi Bulan Februari</h3>
                <p class="text-gray-600 mb-4">
                    Pelayanan administrasi kependudukan di kantor desa akan beroperasi normal pada bulan Februari 2024. 
                    Jam operasional: Senin-Jumat 08.00-15.00, Sabtu 08.00-12.00.
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-clock mr-1"></i>
                        <span>Berlaku: 1 Feb - 29 Feb 2024</span>
                    </div>
                    <button class="text-blue-600 hover:text-blue-800 font-medium">
                        Baca Selengkapnya →
                    </button>
                </div>
            </div>

            <!-- Announcement 2 -->
            <div class="bg-white rounded-lg shadow-md p-6 announcement-item" data-priority="tinggi" data-category="kesehatan">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-heartbeat text-green-600"></i>
                        </div>
                        <div>
                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                Prioritas Tinggi
                            </span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full ml-2">
                                Kesehatan
                            </span>
                        </div>
                    </div>
                    <span class="text-gray-500 text-sm">
                        <i class="fas fa-calendar mr-1"></i>
                        8 Jan 2024
                    </span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Program Vaksinasi COVID-19 Booster Kedua</h3>
                <p class="text-gray-600 mb-4">
                    Puskesmas akan mengadakan program vaksinasi COVID-19 booster kedua untuk masyarakat desa. 
                    Pendaftaran dibuka mulai 15 Januari 2024 di kantor desa atau melalui WhatsApp.
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        <span>Lokasi: Balai Desa</span>
                    </div>
                    <button class="text-blue-600 hover:text-blue-800 font-medium">
                        Baca Selengkapnya →
                    </button>
                </div>
            </div>

            <!-- Announcement 3 -->
            <div class="bg-white rounded-lg shadow-md p-6 announcement-item" data-priority="rendah" data-category="ekonomi">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-coins text-purple-600"></i>
                        </div>
                        <div>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                Prioritas Rendah
                            </span>
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full ml-2">
                                Ekonomi
                            </span>
                        </div>
                    </div>
                    <span class="text-gray-500 text-sm">
                        <i class="fas fa-calendar mr-1"></i>
                        5 Jan 2024
                    </span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Pelatihan Kewirausahaan UMKM</h3>
                <p class="text-gray-600 mb-4">
                    Dinas Koperasi akan mengadakan pelatihan kewirausahaan untuk pelaku UMKM di desa. 
                    Pelatihan gratis dengan sertifikat dan bantuan modal usaha bagi peserta terpilih.
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-users mr-1"></i>
                        <span>Kuota: 50 peserta</span>
                    </div>
                    <button class="text-blue-600 hover:text-blue-800 font-medium">
                        Baca Selengkapnya →
                    </button>
                </div>
            </div>

            <!-- Announcement 4 -->
            <div class="bg-white rounded-lg shadow-md p-6 announcement-item" data-priority="sedang" data-category="pendidikan">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-indigo-600"></i>
                        </div>
                        <div>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                Prioritas Sedang
                            </span>
                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs font-medium rounded-full ml-2">
                                Pendidikan
                            </span>
                        </div>
                    </div>
                    <span class="text-gray-500 text-sm">
                        <i class="fas fa-calendar mr-1"></i>
                        3 Jan 2024
                    </span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Beasiswa Pendidikan untuk Anak Berprestasi</h3>
                <p class="text-gray-600 mb-4">
                    Pemerintah desa membuka program beasiswa pendidikan untuk anak-anak berprestasi dari keluarga kurang mampu. 
                    Pendaftaran dibuka hingga 31 Januari 2024.
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-money-bill-wave mr-1"></i>
                        <span>Nilai: Rp 2.000.000/tahun</span>
                    </div>
                    <button class="text-blue-600 hover:text-blue-800 font-medium">
                        Baca Selengkapnya →
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter Subscription -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-8 text-white text-center">
        <h3 class="text-2xl font-bold mb-4">Jangan Lewatkan Pengumuman Penting!</h3>
        <p class="text-blue-100 mb-6 max-w-2xl mx-auto">
            Berlangganan newsletter kami untuk mendapatkan notifikasi pengumuman terbaru langsung ke email Anda
        </p>
        <form class="max-w-md mx-auto flex gap-3">
            <input type="email" 
                   placeholder="Masukkan email Anda" 
                   class="flex-1 px-4 py-3 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300">
            <button type="submit" 
                    class="px-6 py-3 bg-white text-blue-600 font-medium rounded-lg hover:bg-gray-100 transition-colors">
                Berlangganan
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const priorityFilter = document.getElementById('priorityFilter');
    const categoryFilter = document.getElementById('categoryFilter');
    const announcementItems = document.querySelectorAll('.announcement-item');

    function filterAnnouncements() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedPriority = priorityFilter.value;
        const selectedCategory = categoryFilter.value;

        announcementItems.forEach(item => {
            const title = item.querySelector('h3').textContent.toLowerCase();
            const content = item.querySelector('p').textContent.toLowerCase();
            const priority = item.dataset.priority;
            const category = item.dataset.category;

            const matchesSearch = title.includes(searchTerm) || content.includes(searchTerm);
            const matchesPriority = !selectedPriority || priority === selectedPriority;
            const matchesCategory = !selectedCategory || category === selectedCategory;

            if (matchesSearch && matchesPriority && matchesCategory) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterAnnouncements);
    priorityFilter.addEventListener('change', filterAnnouncements);
    categoryFilter.addEventListener('change', filterAnnouncements);
});
</script>
@endsection
