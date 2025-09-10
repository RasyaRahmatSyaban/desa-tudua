<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Web Desa Digital</title>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-slate-100 font-sans antialiased text-gray-900">
    <div class="flex h-screen bg-slate-100">
        <!-- Sidebar -->
        <div class="w-64 bg-slate-800 shadow-xl border-r border-slate-700 flex-shrink-0">
            <!-- Logo Header -->
            <div class="px-6 py-5 border-b border-slate-700">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('images/morowali.png') }}" alt="kabupaten morowali"
                        class="w-10 h-10 object-fill">
                    <div>
                        <h1 class="text-lg font-bold text-white">Desa Tudua</h1>
                        <p class="text-xs font-medium text-gray-300">Kabupaten Morowali</p>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="px-4 py-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <i
                        class="fas fa-tachometer-alt w-5 text-center mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-blue-100' : 'text-slate-400' }}"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.berita.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.berita.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <i
                        class="fas fa-newspaper w-5 text-center mr-3 {{ request()->routeIs('admin.berita.*') ? 'text-blue-100' : 'text-slate-400' }}"></i>
                    <span>Berita</span>
                </a>

                <a href="{{ route('admin.pengumuman.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.pengumuman.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <i
                        class="fas fa-bullhorn w-5 text-center mr-3 {{ request()->routeIs('admin.pengumuman.*') ? 'text-blue-100' : 'text-slate-400' }}"></i>
                    <span>Pengumuman</span>
                </a>

                <a href="{{ route('admin.penduduk.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.penduduk.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <i
                        class="fas fa-users w-5 text-center mr-3 {{ request()->routeIs('admin.penduduk.*') ? 'text-blue-100' : 'text-slate-400' }}"></i>
                    <span>Penduduk</span>
                </a>

                <a href="{{ route('admin.surat-masuk.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.surat-masuk.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <i
                        class="fas fa-inbox w-5 text-center mr-3 {{ request()->routeIs('admin.surat-masuk.*') ? 'text-blue-100' : 'text-slate-400' }}"></i>
                    <span>Surat Masuk</span>
                </a>

                <a href="{{ route('admin.surat-keluar.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.surat-keluar.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <i
                        class="fas fa-paper-plane w-5 text-center mr-3 {{ request()->routeIs('admin.surat-keluar.*') ? 'text-blue-100' : 'text-slate-400' }}"></i>
                    <span>Surat Keluar</span>
                </a>

                <a href="{{ route('admin.dana-masuk.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dana-masuk.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <i
                        class="fas fa-arrow-down w-5 text-center mr-3 {{ request()->routeIs('admin.dana-masuk.*') ? 'text-emerald-300' : 'text-emerald-400' }}"></i>
                    <span>Dana Masuk</span>
                </a>

                <a href="{{ route('admin.dana-keluar.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dana-keluar.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <i
                        class="fas fa-arrow-up w-5 text-center mr-3 {{ request()->routeIs('admin.dana-keluar.*') ? 'text-rose-300' : 'text-rose-400' }}"></i>
                    <span>Dana Keluar</span>
                </a>

                <a href="{{ route('admin.perangkat-desa.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.perangkat-desa.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <i
                        class="fas fa-user-cog w-5 text-center mr-3 {{ request()->routeIs('admin.perangkat-desa.*') ? 'text-blue-100' : 'text-slate-400' }}"></i>
                    <span>Perangkat Desa</span>
                </a>

                <a href="{{ route('admin.pelayanan.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.pelayanan.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <i
                        class="fas fa-concierge-bell w-5 text-center mr-3 {{ request()->routeIs('admin.pelayanan.*') ? 'text-blue-100' : 'text-slate-400' }}"></i>
                    <span>Pelayanan</span>
                </a>

                <a href="{{ route('admin.media.index') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.media.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <i
                        class="fas fa-photo-video w-5 text-center mr-3 {{ request()->routeIs('admin.media.*') ? 'text-blue-100' : 'text-slate-400' }}"></i>
                    <span>Media</span>
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="absolute bottom-0 w-64 p-4 border-t border-slate-700">
                <div class="flex flex-row justify-between items-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-3 py-2.5 text-sm font-medium text-slate-300 rounded-lg hover:bg-slate-700 hover:text-white cursor-pointer transition-all duration-200">
                            <i class="fas fa-sign-out-alt w-5 text-center mr-3 text-slate-400"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                    <a href="{{ route('admin.users.index') }}"><i
                            class="fa-solid fa-user-gear text-slate-400 px-3 py-2.5 rounded-lg hover:bg-slate-700 hover:text-white cursor-pointer"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white/80 backdrop-blur-sm border-b border-slate-200 px-6 py-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-slate-800">
                            @yield('page-title', 'Dashboard')
                        </h2>
                        <p class="text-sm text-slate-600 mt-1">
                            @yield('page-description', 'Kelola data desa dengan mudah')
                        </p>
                    </div>

                    <div class="relative flex items-center space-x-4 group">
                        <!-- User Profile (Trigger) -->
                        <div class="flex cursor-pointer items-center space-x-3 pl-4 border-l border-slate-200">
                            <div class="text-right">
                                <p class="text-sm font-medium text-slate-800">
                                    {{ Auth::user()->name ?? 'Administrator' }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    {{ Auth::user()->email ?? 'admin@desa.id' }}
                                </p>
                            </div>
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-lg">
                                <i class="fas fa-user text-black text-sm"></i>
                            </div>
                        </div>

                        <div
                            class="absolute right-0 top-full mt-2 min-w-[160px] bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-1">
                                <a href="{{ route('admin.users.edit', Auth::user()->id) }}"
                                    class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150">
                                    <i class="fa-solid fa-gear mr-3 text-gray-400"></i>
                                    <span>Pengaturan</span>
                                </a>

                                <div class="border-t border-gray-100"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex cursor-pointer items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150 text-left">
                                        <i class="fa-solid fa-right-from-bracket mr-3 text-gray-400"></i>
                                        <span>Keluar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto bg-slate-50">
                <div class="p-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Menu Toggle -->
    <button id="mobile-menu-toggle"
        class="fixed top-4 left-4 z-50 lg:hidden bg-slate-700 text-white p-3 rounded-lg shadow-xl hover:bg-slate-600 transition-all duration-200">
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