@extends('layouts.guest')

@section('title', 'Pelayanan Desa')
@section('description', 'Berbagai layanan administrasi dan surat-menyurat yang tersedia di desa')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-purple-600 to-purple-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Pelayanan Desa</h1>
            <p class="text-xl text-purple-100 max-w-2xl mx-auto">
                Layanan administrasi dan surat-menyurat untuk kemudahan masyarakat
            </p>
        </div>
    </div>
</section>

<!-- Jam Pelayanan -->
<section class="py-8 bg-white border-b">
    <div class="max-w-7xl mx-auto px-4">
        <div class="bg-blue-50 rounded-lg p-6">
            <div class="flex items-center justify-center space-x-8">
                <div class="text-center">
                    <i class="fas fa-clock text-blue-600 text-2xl mb-2"></i>
                    <h3 class="font-semibold text-gray-900">Jam Pelayanan</h3>
                    <p class="text-gray-600">Senin - Jumat: 08:00 - 15:00</p>
                    <p class="text-gray-600">Sabtu: 08:00 - 12:00</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-phone text-blue-600 text-2xl mb-2"></i>
                    <h3 class="font-semibold text-gray-900">Kontak</h3>
                    <p class="text-gray-600">(021) 1234-5678</p>
                    <p class="text-gray-600">pelayanan@desa.id</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-map-marker-alt text-blue-600 text-2xl mb-2"></i>
                    <h3 class="font-semibold text-gray-900">Lokasi</h3>
                    <p class="text-gray-600">Kantor Desa</p>
                    <p class="text-gray-600">Jl. Raya Desa No. 123</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Layanan Utama -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Layanan Utama</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Berbagai layanan administrasi yang dapat Anda akses di kantor desa
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $layanan = [
                [
                    'nama' => 'Surat Keterangan Domisili',
                    'deskripsi' => 'Surat keterangan tempat tinggal untuk berbagai keperluan administrasi',
                    'persyaratan' => ['KTP Asli', 'KK Asli', 'Surat Pengantar RT/RW'],
                    'waktu' => '1 hari kerja',
                    'biaya' => 'Gratis',
                    'icon' => 'home'
                ],
                [
                    'nama' => 'Surat Keterangan Usaha',
                    'deskripsi' => 'Surat keterangan untuk keperluan pengajuan kredit atau izin usaha',
                    'persyaratan' => ['KTP Asli', 'KK Asli', 'Foto Tempat Usaha'],
                    'waktu' => '2 hari kerja',
                    'biaya' => 'Gratis',
                    'icon' => 'briefcase'
                ],
                [
                    'nama' => 'Surat Keterangan Tidak Mampu',
                    'deskripsi' => 'Surat keterangan untuk bantuan sosial atau beasiswa',
                    'persyaratan' => ['KTP Asli', 'KK Asli', 'Surat Pengantar RT/RW', 'Foto Rumah'],
                    'waktu' => '1 hari kerja',
                    'biaya' => 'Gratis',
                    'icon' => 'hand-holding-heart'
                ],
                [
                    'nama' => 'Surat Pengantar Nikah',
                    'deskripsi' => 'Surat pengantar untuk keperluan pernikahan di KUA',
                    'persyaratan' => ['KTP Asli', 'KK Asli', 'Akta Kelahiran', 'Pas Foto 4x6'],
                    'waktu' => '1 hari kerja',
                    'biaya' => 'Gratis',
                    'icon' => 'heart'
                ],
                [
                    'nama' => 'Surat Keterangan Kelahiran',
                    'deskripsi' => 'Surat keterangan untuk pengurusan akta kelahiran',
                    'persyaratan' => ['KTP Orangtua', 'KK Asli', 'Surat Keterangan Lahir dari Bidan/RS'],
                    'waktu' => '1 hari kerja',
                    'biaya' => 'Gratis',
                    'icon' => 'baby'
                ],
                [
                    'nama' => 'Surat Keterangan Kematian',
                    'deskripsi' => 'Surat keterangan untuk pengurusan akta kematian',
                    'persyaratan' => ['KTP Almarhum', 'KK Asli', 'Surat Keterangan Kematian dari RS/Dokter'],
                    'waktu' => '1 hari kerja',
                    'biaya' => 'Gratis',
                    'icon' => 'cross'
                ]
            ];
            @endphp
            
            @foreach($layanan as $item)
            <div class="card-hover bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-{{ $item['icon'] }} text-blue-600 text-xl"></i>
                    </div>
                    
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $item['nama'] }}</h3>
                    <p class="text-gray-600 mb-4">{{ $item['deskripsi'] }}</p>
                    
                    <div class="space-y-3">
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-2">Persyaratan:</h4>
                            <ul class="text-sm text-gray-600 space-y-1">
                                @foreach($item['persyaratan'] as $syarat)
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                    {{ $syarat }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                            <div class="text-sm">
                                <span class="text-gray-500">Waktu:</span>
                                <span class="font-medium text-gray-900">{{ $item['waktu'] }}</span>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-500">Biaya:</span>
                                <span class="font-medium text-green-600">{{ $item['biaya'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Prosedur Pelayanan -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Prosedur Pelayanan</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Langkah-langkah mudah untuk mendapatkan layanan di desa
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @php
            $prosedur = [
                [
                    'step' => '1',
                    'title' => 'Persiapan Dokumen',
                    'description' => 'Siapkan dokumen yang diperlukan sesuai jenis layanan yang dibutuhkan',
                    'icon' => 'file-alt'
                ],
                [
                    'step' => '2',
                    'title' => 'Datang ke Kantor Desa',
                    'description' => 'Kunjungi kantor desa pada jam pelayanan dengan membawa dokumen lengkap',
                    'icon' => 'building'
                ],
                [
                    'step' => '3',
                    'title' => 'Pengajuan Permohonan',
                    'description' => 'Isi formulir permohonan dan serahkan dokumen kepada petugas',
                    'icon' => 'edit'
                ],
                [
                    'step' => '4',
                    'title' => 'Pengambilan Surat',
                    'description' => 'Ambil surat yang sudah jadi sesuai waktu yang telah ditentukan',
                    'icon' => 'check-circle'
                ]
            ];
            @endphp
            
            @foreach($prosedur as $index => $item)
            <div class="text-center">
                <div class="relative">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-xl font-bold">{{ $item['step'] }}</span>
                    </div>
                    @if($index < count($prosedur) - 1)
                    <div class="hidden md:block absolute top-8 left-full w-full h-0.5 bg-blue-200 transform -translate-y-0.5"></div>
                    @endif
                </div>
                
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-{{ $item['icon'] }} text-blue-600"></i>
                </div>
                
                <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ $item['title'] }}</h3>
                <p class="text-gray-600">{{ $item['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Layanan Online -->
<section class="py-16 bg-blue-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Layanan Online</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Beberapa layanan dapat diakses secara online untuk kemudahan Anda
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="card-hover bg-white p-8 rounded-lg shadow-md text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-download text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Download Formulir</h3>
                <p class="text-gray-600 mb-6">
                    Unduh formulir permohonan surat untuk diisi terlebih dahulu di rumah
                </p>
                <button class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                    <i class="fas fa-download mr-2"></i>Download
                </button>
            </div>
            
            <div class="card-hover bg-white p-8 rounded-lg shadow-md text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-calendar-check text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Cek Status Permohonan</h3>
                <p class="text-gray-600 mb-6">
                    Pantau status permohonan surat Anda secara online
                </p>
                <button class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                    <i class="fas fa-search mr-2"></i>Cek Status
                </button>
            </div>
            
            <div class="card-hover bg-white p-8 rounded-lg shadow-md text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-headset text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Bantuan & Konsultasi</h3>
                <p class="text-gray-600 mb-6">
                    Hubungi kami untuk bantuan dan konsultasi layanan
                </p>
                <button class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                    <i class="fas fa-phone mr-2"></i>Hubungi
                </button>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Pertanyaan Umum</h2>
            <p class="text-gray-600">
                Jawaban untuk pertanyaan yang sering diajukan tentang layanan desa
            </p>
        </div>
        
        <div class="space-y-4">
            @php
            $faq = [
                [
                    'question' => 'Apakah semua layanan gratis?',
                    'answer' => 'Ya, semua layanan administrasi desa tidak dikenakan biaya alias gratis sesuai dengan peraturan yang berlaku.'
                ],
                [
                    'question' => 'Berapa lama waktu pengurusan surat?',
                    'answer' => 'Waktu pengurusan bervariasi tergantung jenis surat, umumnya 1-3 hari kerja. Untuk surat yang mendesak bisa diproses pada hari yang sama.'
                ],
                [
                    'question' => 'Apakah bisa diwakilkan?',
                    'answer' => 'Beberapa jenis surat bisa diwakilkan dengan membawa surat kuasa dan fotokopi KTP pemberi kuasa. Namun untuk surat tertentu harus datang langsung.'
                ],
                [
                    'question' => 'Bagaimana jika dokumen hilang?',
                    'answer' => 'Jika dokumen persyaratan hilang, Anda bisa menggunakan fotokopi yang dilegalisir atau membuat surat keterangan kehilangan terlebih dahulu.'
                ],
                [
                    'question' => 'Apakah ada layanan di hari libur?',
                    'answer' => 'Untuk keperluan mendesak, kami menyediakan layanan darurat. Silakan hubungi nomor kontak yang tersedia.'
                ]
            ];
            @endphp
            
            @foreach($faq as $index => $item)
            <div class="border border-gray-200 rounded-lg">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 focus:outline-none focus:bg-gray-50"
                        onclick="toggleFaq({{ $index }})">
                    <span class="font-medium text-gray-900">{{ $item['question'] }}</span>
                    <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-200" id="icon-{{ $index }}"></i>
                </button>
                <div class="hidden px-6 pb-4" id="answer-{{ $index }}">
                    <p class="text-gray-600">{{ $item['answer'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
function toggleFaq(index) {
    const answer = document.getElementById(`answer-${index}`);
    const icon = document.getElementById(`icon-${index}`);
    
    if (answer.classList.contains('hidden')) {
        answer.classList.remove('hidden');
        icon.classList.add('rotate-180');
    } else {
        answer.classList.add('hidden');
        icon.classList.remove('rotate-180');
    }
}
</script>
@endsection
