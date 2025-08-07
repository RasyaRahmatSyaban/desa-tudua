<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Web Desa Digital</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen font-['Inter',system-ui,-apple-system,sans-serif]">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div
            class="w-64 text-white flex-shrink-0 overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-700 shadow-2xl backdrop-blur-sm">
            <div class="p-6 bg-white/5 border-b border-white/10 backdrop-blur-sm">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-building text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Web Desa Digital</h1>
                        <p class="text-slate-300 text-sm">Admin Panel</p>
                    </div>
                </div>
            </div>

            <nav class="mt-4 px-2 pb-20">
                <a href="{{ route('admin.dashboard') }}"
                    class="relative mx-2 my-1 flex items-center px-4 py-2.5 text-white transition-all duration-300 rounded-xl overflow-hidden group hover:bg-white/10 hover:translate-x-1 hover:shadow-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg' : '' }}">
                    @if(request()->routeIs('admin.dashboard'))
                        <div class="absolute left-0 top-0 w-1 h-full bg-yellow-400 rounded-r-lg"></div>
                    @endif
                    <i
                        class="fas fa-tachometer-alt w-5 text-center opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></i>
                    <span class="ml-3 font-medium">Dashboard</span>
                </a>

                <a href="{{ route('admin.berita.index') }}"
                    class="relative mx-2 my-1 flex items-center px-4 py-2.5 text-white transition-all duration-300 rounded-xl overflow-hidden group hover:bg-white/10 hover:translate-x-1 hover:shadow-lg {{ request()->routeIs('admin.berita.*') ? 'bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg' : '' }}">
                    @if(request()->routeIs('admin.berita.*'))
                        <div class="absolute left-0 top-0 w-1 h-full bg-yellow-400 rounded-r-lg"></div>
                    @endif
                    <i
                        class="fas fa-newspaper w-5 text-center opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></i>
                    <span class="ml-3 font-medium">Berita</span>
                </a>

                <a href="{{ route('admin.pengumuman.index') }}"
                    class="relative mx-2 my-1 flex items-center px-4 py-2.5 text-white transition-all duration-300 rounded-xl overflow-hidden group hover:bg-white/10 hover:translate-x-1 hover:shadow-lg {{ request()->routeIs('admin.pengumuman.*') ? 'bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg' : '' }}">
                    @if(request()->routeIs('admin.pengumuman.*'))
                        <div class="absolute left-0 top-0 w-1 h-full bg-yellow-400 rounded-r-lg"></div>
                    @endif
                    <i
                        class="fas fa-bullhorn w-5 text-center opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></i>
                    <span class="ml-3 font-medium">Pengumuman</span>
                </a>

                <a href="{{ route('admin.penduduk.index') }}"
                    class="relative mx-2 my-1 flex items-center px-4 py-2.5 text-white transition-all duration-300 rounded-xl overflow-hidden group hover:bg-white/10 hover:translate-x-1 hover:shadow-lg {{ request()->routeIs('admin.penduduk.*') ? 'bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg' : '' }}">
                    @if(request()->routeIs('admin.penduduk.*'))
                        <div class="absolute left-0 top-0 w-1 h-full bg-yellow-400 rounded-r-lg"></div>
                    @endif
                    <i
                        class="fas fa-users w-5 text-center opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></i>
                    <span class="ml-3 font-medium">Penduduk</span>
                </a>

                <a href="{{ route('admin.surat-masuk.index') }}"
                    class="relative mx-2 my-1 flex items-center px-4 py-2.5 text-white transition-all duration-300 rounded-xl overflow-hidden group hover:bg-white/10 hover:translate-x-1 hover:shadow-lg {{ request()->routeIs('admin.surat-masuk.*') ? 'bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg' : '' }}">
                    @if(request()->routeIs('admin.surat-masuk.*'))
                        <div class="absolute left-0 top-0 w-1 h-full bg-yellow-400 rounded-r-lg"></div>
                    @endif
                    <i
                        class="fas fa-inbox w-5 text-center opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></i>
                    <span class="ml-3 font-medium">Surat Masuk</span>
                </a>

                <a href="{{ route('admin.surat-keluar.index') }}"
                    class="relative mx-2 my-1 flex items-center px-4 py-2.5 text-white transition-all duration-300 rounded-xl overflow-hidden group hover:bg-white/10 hover:translate-x-1 hover:shadow-lg {{ request()->routeIs('admin.surat-keluar.*') ? 'bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg' : '' }}">
                    @if(request()->routeIs('admin.surat-keluar.*'))
                        <div class="absolute left-0 top-0 w-1 h-full bg-yellow-400 rounded-r-lg"></div>
                    @endif
                    <i
                        class="fas fa-paper-plane w-5 text-center opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></i>
                    <span class="ml-3 font-medium">Surat Keluar</span>
                </a>

                <a href="{{ route('admin.dana-masuk.index') }}"
                    class="relative mx-2 my-1 flex items-center px-4 py-2.5 text-white transition-all duration-300 rounded-xl overflow-hidden group hover:bg-white/10 hover:translate-x-1 hover:shadow-lg {{ request()->routeIs('admin.dana-masuk.*') ? 'bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg' : '' }}">
                    @if(request()->routeIs('admin.dana-masuk.*'))
                        <div class="absolute left-0 top-0 w-1 h-full bg-yellow-400 rounded-r-lg"></div>
                    @endif
                    <i
                        class="fas fa-arrow-down text-green-400 w-5 text-center opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></i>
                    <span class="ml-3 font-medium">Dana Masuk</span>
                </a>

                <a href="{{ route('admin.dana-keluar.index') }}"
                    class="relative mx-2 my-1 flex items-center px-4 py-2.5 text-white transition-all duration-300 rounded-xl overflow-hidden group hover:bg-white/10 hover:translate-x-1 hover:shadow-lg {{ request()->routeIs('admin.dana-keluar.*') ? 'bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg' : '' }}">
                    @if(request()->routeIs('admin.dana-keluar.*'))
                        <div class="absolute left-0 top-0 w-1 h-full bg-yellow-400 rounded-r-lg"></div>
                    @endif
                    <i
                        class="fas fa-arrow-up text-red-400 w-5 text-center opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></i>
                    <span class="ml-3 font-medium">Dana Keluar</span>
                </a>

                <a href="{{ route('admin.perangkat-desa.index') }}"
                    class="relative mx-2 my-1 flex items-center px-4 py-2.5 text-white transition-all duration-300 rounded-xl overflow-hidden group hover:bg-white/10 hover:translate-x-1 hover:shadow-lg {{ request()->routeIs('admin.perangkat-desa.*') ? 'bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg' : '' }}">
                    @if(request()->routeIs('admin.perangkat-desa.*'))
                        <div class="absolute left-0 top-0 w-1 h-full bg-yellow-400 rounded-r-lg"></div>
                    @endif
                    <i
                        class="fas fa-user-cog w-5 text-center opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></i>
                    <span class="ml-3 font-medium">Perangkat Desa</span>
                </a>

                <a href="{{ route('admin.pelayanan.index') }}"
                    class="relative mx-2 my-1 flex items-center px-4 py-2.5 text-white transition-all duration-300 rounded-xl overflow-hidden group hover:bg-white/10 hover:translate-x-1 hover:shadow-lg {{ request()->routeIs('admin.pelayanan.*') ? 'bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg' : '' }}">
                    @if(request()->routeIs('admin.pelayanan.*'))
                        <div class="absolute left-0 top-0 w-1 h-full bg-yellow-400 rounded-r-lg"></div>
                    @endif
                    <i
                        class="fas fa-concierge-bell w-5 text-center opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></i>
                    <span class="ml-3 font-medium">Pelayanan</span>
                </a>

                <a href="{{ route('admin.media.index') }}"
                    class="relative mx-2 my-1 flex items-center px-4 py-2.5 text-white transition-all duration-300 rounded-xl overflow-hidden group hover:bg-white/10 hover:translate-x-1 hover:shadow-lg {{ request()->routeIs('admin.media.*') ? 'bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg' : '' }}">
                    @if(request()->routeIs('admin.media.*'))
                        <div class="absolute left-0 top-0 w-1 h-full bg-yellow-400 rounded-r-lg"></div>
                    @endif
                    <i
                        class="fas fa-photo-video w-5 text-center opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300"></i>
                    <span class="ml-3 font-medium">Media</span>
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="absolute bottom-0 w-64 p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="sidebar-item flex items-center px-4 py-3 text-white transition-all duration-300 w-full text-left rounded-lg hover:bg-red-500/20">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="ml-3 font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="main-header">
                <div class="flex items-center justify-between px-8 py-4">
                    <div class="slide-in">
                        <h2 class="text-2xl font-bold text-gray-800 mb-1">
                            @yield('page-title', 'Dashboard')
                        </h2>
                        <p class="text-gray-600 text-sm">
                            @yield('page-description', 'Kelola data desa dengan mudah')
                        </p>
                    </div>

                    <div class="flex items-center space-x-6">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                                <i class="fas fa-bell text-xl"></i>
                                <span
                                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
                            </button>
                        </div>

                        <!-- User Info -->
                        <div class="flex items-center space-x-4">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-700">
                                    {{ Auth::user()->name ?? 'Administrator' }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ Auth::user()->email ?? 'admin@desa.id' }}
                                </p>
                            </div>
                            <div class="user-avatar">
                                <i class="fas fa-user text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-8">
                <div class="slide-in">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Menu Toggle (for future mobile support) -->
    <button id="mobile-menu-toggle"
        class="fixed top-4 left-4 z-50 md:hidden bg-blue-600 text-white p-3 rounded-lg shadow-lg">
        <i class="fas fa-bars"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

            // Delete confirmation with modern styling
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data akan dihapus secara permanen dan tidak dapat dikembalikan.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        customClass: {
                            confirmButton: 'btn-danger',
                            cancelButton: 'bg-gray-500 hover:bg-gray-600'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading state
                            Swal.fire({
                                title: 'Menghapus...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            form.submit();
                        }
                    });
                });
            });

            // Media preview modals with enhanced styling
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
                            imageAlt: 'Gambar',
                            confirmButtonText: 'Tutup',
                            confirmButtonColor: '#3b82f6',
                            width: 'auto',
                            customClass: {
                                popup: 'rounded-2xl'
                            }
                        });
                    } else if (type === 'video') {
                        Swal.fire({
                            title: 'Pratinjau Video',
                            html: `
                                <video controls style="max-width:100%; height: auto; border-radius: 12px;">
                                    <source src="${url}" type="video/mp4">
                                    Browser Anda tidak mendukung video.
                                </video>
                            `,
                            width: 700,
                            padding: '2em',
                            confirmButtonText: 'Tutup',
                            confirmButtonColor: '#3b82f6',
                            customClass: {
                                popup: 'rounded-2xl'
                            }
                        });
                    } else if (type === 'dokumen') {
                        Swal.fire({
                            title: 'Pratinjau Dokumen',
                            html: `
                                <iframe src="${url}" style="width:100%; height:500px; border-radius: 12px; border: 1px solid #e5e7eb;" frameborder="0"></iframe>
                            `,
                            width: 900,
                            padding: '2em',
                            confirmButtonText: 'Tutup',
                            confirmButtonColor: '#3b82f6',
                            customClass: {
                                popup: 'rounded-2xl'
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Tipe media tidak dikenali!',
                            confirmButtonText: 'Tutup',
                            confirmButtonColor: '#ef4444'
                        });
                    }
                });
            });

            // Mobile menu toggle
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const sidebar = document.querySelector('.sidebar');

            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function () {
                    sidebar.classList.toggle('open');
                });
            }

            // Add loading states to buttons
            const submitButtons = document.querySelectorAll('button[type="submit"]');
            submitButtons.forEach(button => {
                button.addEventListener('click', function () {
                    if (!this.classList.contains('delete-btn')) {
                        const originalText = this.innerHTML;
                        this.innerHTML = '<span class="loading"></span> Memproses...';
                        this.disabled = true;

                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.disabled = false;
                        }, 2000);
                    }
                });
            });

            // Smooth animations for cards
            const cards = document.querySelectorAll('.card');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
</body>

</html>