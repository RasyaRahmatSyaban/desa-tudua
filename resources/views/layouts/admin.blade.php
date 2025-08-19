<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Desa Digital</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="font-sans bg-gray-50">
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 shadow-xl border-r border-gray-700 flex-shrink-0">
            <!-- Logo Header -->
            <div class="px-6 py-5 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/morowali.png') }}" alt="kabupaten morowali"
                        class="w-10 h-10 object-fill">
                    <div>
                        <h1 class="text-lg font-bold text-white">Admin Tudua</h1>
                        <p class="text-xs text-gray-300">Kabupaten Morowali</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="px-4 py-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-yellow-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt w-5 text-center mr-3"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.berita.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.berita.*') ? 'bg-yellow-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-newspaper w-5 text-center mr-3"></i>
                    <span>Berita</span>
                </a>

                <a href="{{ route('admin.pengumuman.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.pengumuman.*') ? 'bg-yellow-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-bullhorn w-5 text-center mr-3"></i>
                    <span>Pengumuman</span>
                </a>

                <a href="{{ route('admin.penduduk.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.penduduk.*') ? 'bg-yellow-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-users w-5 text-center mr-3"></i>
                    <span>Penduduk</span>
                </a>

                <a href="{{ route('admin.surat-masuk.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.surat-masuk.*') ? 'bg-yellow-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-inbox w-5 text-center mr-3"></i>
                    <span>Surat Masuk</span>
                </a>

                <a href="{{ route('admin.surat-keluar.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.surat-keluar.*') ? 'bg-yellow-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-paper-plane w-5 text-center mr-3"></i>
                    <span>Surat Keluar</span>
                </a>

                <a href="{{ route('admin.dana-masuk.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dana-masuk.*') ? 'bg-yellow-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-arrow-down w-5 text-center mr-3 text-green-400"></i>
                    <span>Dana Masuk</span>
                </a>

                <a href="{{ route('admin.dana-keluar.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dana-keluar.*') ? 'bg-yellow-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-arrow-up w-5 text-center mr-3 text-red-400"></i>
                    <span>Dana Keluar</span>
                </a>

                <a href="{{ route('admin.perangkat-desa.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.perangkat-desa.*') ? 'bg-yellow-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-user-cog w-5 text-center mr-3"></i>
                    <span>Perangkat Desa</span>
                </a>

                <a href="{{ route('admin.pelayanan.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.pelayanan.*') ? 'bg-yellow-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-concierge-bell w-5 text-center mr-3"></i>
                    <span>Pelayanan</span>
                </a>

                <a href="{{ route('admin.media.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.media.*') ? 'bg-yellow-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-photo-video w-5 text-center mr-3"></i>
                    <span>Media</span>
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="absolute bottom-0 w-64 p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-3 py-2.5 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-200">
                        <i class="fas fa-sign-out-alt w-5 text-center mr-3"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">
                            @yield('page-title', 'Dashboard')
                        </h2>
                        <p class="text-sm text-gray-600 mt-1">
                            @yield('page-description', 'Kelola data desa dengan mudah')
                        </p>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- User Profile -->
                        <div class="flex items-center space-x-3">
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-800">
                                    {{ Auth::user()->name ?? 'Administrator' }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ Auth::user()->email ?? 'admin@desa.id' }}
                                </p>
                            </div>
                            <div class="w-8 h-8 bg-yellow-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="p-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Menu Button -->
    <button id="mobile-menu-toggle" class="fixed top-4 left-4 z-50 lg:hidden bg-gray-700 text-white p-3 rounded-lg">
        <i class="fas fa-bars"></i>
    </button>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // SweetAlert configurations
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: true,
                    confirmButtonColor: '#ef4444'
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'warning',
                    title: 'Terjadi Kesalahan!',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#f59e0b'
                });
            @endif

            // Delete confirmation
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data akan dihapus secara permanen.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Media preview modals
            const viewButtons = document.querySelectorAll('.viewModal');
            viewButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const type = button.getAttribute('data-type');
                    const url = button.getAttribute('data-url');

                    if (type === 'foto') {
                        Swal.fire({
                            title: 'Pratinjau Gambar',
                            imageUrl: url,
                            imageHeight: 500,
                            confirmButtonText: 'Tutup'
                        });
                    } else if (type === 'video') {
                        Swal.fire({
                            title: 'Pratinjau Video',
                            html: `<video controls style="max-width:100%; height: auto;"><source src="${url}" type="video/mp4">Browser Anda tidak mendukung video.</video>`,
                            width: 700,
                            confirmButtonText: 'Tutup'
                        });
                    } else if (type === 'dokumen') {
                        Swal.fire({
                            title: 'Pratinjau Dokumen',
                            html: `<iframe src="${url}" style="width:100%; height:500px;" frameborder="0"></iframe>`,
                            width: 900,
                            confirmButtonText: 'Tutup'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>