<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') - Desa Digital</title>
    <meta name="description"
        content="@yield('description', 'Website resmi desa untuk informasi dan pelayanan masyarakat')">
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="font-sans">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 px-18 py-2 bg-gray-900/95 backdrop-blur-md transition-all duration-300 shadow-sm"
        id="navbar">
        <div class="w-full mx-auto flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                <img src="{{ asset('images/morowali.png') }}" alt="kabupaten morowali" class="w-10 h-10 object-fill">
                <div>
                    <h1 class="text-xl font-bold text-white">Desa Tudua</h1>
                    <p class="text-md font-medium text-gray-300">Kabupaten Morowali</p>
                </div>
            </a>
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('dashboard') }}"
                    class="relative text-gray-300 font-medium transition-all duration-300 hover:text-yellow-400 after:content-[''] after:absolute after:w-0 after:h-0.5 after:-bottom-1 after:left-0 after:bg-yellow-500 after:transition-all after:duration-300 hover:after:w-full hover:after:left-0 {{ request()->routeIs('home') ? 'text-yellow-400 after:w-full after:left-0' : '' }}">Beranda</a>
                <a href="{{ route('profil') }}"
                    class="relative text-gray-300 font-medium transition-all duration-300 hover:text-yellow-400 after:content-[''] after:absolute after:w-0 after:h-0.5 after:-bottom-1 after:left-0 after:bg-yellow-500 after:transition-all after:duration-300 hover:after:w-full hover:after:left-0 {{ request()->routeIs('profil') ? 'text-yellow-400 after:w-full after:left-0' : '' }}">Profil
                    Desa</a>
                <a href="{{ route('berita.index') }}"
                    class="relative text-gray-300 font-medium transition-all duration-300 hover:text-yellow-400 after:content-[''] after:absolute after:w-0 after:h-0.5 after:-bottom-1 after:left-0 after:bg-yellow-500 after:transition-all after:duration-300 hover:after:w-full hover:after:left-0 {{ request()->routeIs('berita.index*') ? 'text-yellow-400 after:w-full after:left-0' : '' }}">Berita</a>
                <a href="{{ route('arsip') }}"
                    class="relative text-gray-300 font-medium transition-all duration-300 hover:text-yellow-400 after:content-[''] after:absolute after:w-0 after:h-0.5 after:-bottom-1 after:left-0 after:bg-yellow-500 after:transition-all after:duration-300 hover:after:w-full hover:after:left-0 {{ request()->routeIs('arsip*') ? 'text-yellow-400 after:w-full after:left-0' : '' }}">Arsip</a>
                <a href="{{ route('data-penduduk') }}"
                    class="relative text-gray-300 font-medium transition-all duration-300 hover:text-yellow-400 after:content-[''] after:absolute after:w-0 after:h-0.5 after:-bottom-1 after:left-0 after:bg-yellow-500 after:transition-all after:duration-300 hover:after:w-full hover:after:left-0 {{ request()->routeIs('data-penduduk') ? 'text-yellow-400 after:w-full after:left-0' : '' }}">Data
                    Penduduk</a>
                <a href="{{ route('dana-desa') }}"
                    class="relative text-gray-300 font-medium transition-all duration-300 hover:text-yellow-400 after:content-[''] after:absolute after:w-0 after:h-0.5 after:-bottom-1 after:left-0 after:bg-yellow-500 after:transition-all after:duration-300 hover:after:w-full hover:after:left-0 {{ request()->routeIs('dana-desa') ? 'text-yellow-400 after:w-full after:left-0' : '' }}">Dana
                    Desa</a>
                <a href="{{ route('media') }}"
                    class="relative text-gray-300 font-medium transition-all duration-300 hover:text-yellow-400 after:content-[''] after:absolute after:w-0 after:h-0.5 after:-bottom-1 after:left-0 after:bg-yellow-500 after:transition-all after:duration-300 hover:after:w-full hover:after:left-0 {{ request()->routeIs('media') ? 'text-yellow-400 after:w-full after:left-0' : '' }}">Media</a>
                <a href="{{ route('pelayanan') }}"
                    class="relative text-gray-300 font-medium transition-all duration-300 hover:text-yellow-400 after:content-[''] after:absolute after:w-0 after:h-0.5 after:-bottom-1 after:left-0 after:bg-yellow-500 after:transition-all after:duration-300 hover:after:w-full hover:after:left-0 {{ request()->routeIs('pelayanan') ? 'text-yellow-400 after:w-full after:left-0' : '' }}">Pelayanan</a>
                <a href="{{ route('login') }}"
                    class="bg-yellow-600 text-white border-2 border-yellow-600 hover:bg-yellow-500 hover:border-yellow-500 px-4 py-2 rounded-lg font-semibold transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
            </div>
            <!-- Mobile Menu Button -->
            <button class="md:hidden text-gray-300 text-xl hover:text-white transition-colors duration-200"
                onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>
    <!-- Mobile Menu -->
    <div id="mobileMenu"
        class="fixed top-0 left-0 w-full h-full bg-gray-900 z-40 md:hidden transform -translate-x-full transition-transform duration-300 ease-in-out">
        <div class="p-6">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-building text-2xl text-yellow-500"></i>
                    <div>
                        <h1 class="text-xl font-bold text-white">Desa Digital</h1>
                        <p class="text-xs text-gray-300">Kabupaten Morowali</p>
                    </div>
                </div>
                <button onclick="toggleMobileMenu()"
                    class="text-gray-300 text-xl hover:text-white transition-colors duration-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="space-y-4">
                <a href="{{ route('dashboard') }}"
                    class="block py-3 text-gray-300 font-medium border-b border-gray-700 hover:text-yellow-400 transition-colors duration-200">Beranda</a>
                <a href="{{ route('profil') }}"
                    class="block py-3 text-gray-300 font-medium border-b border-gray-700 hover:text-yellow-400 transition-colors duration-200">Profil
                    Desa</a>
                <a href="{{ route('berita.index') }}"
                    class="block py-3 text-gray-300 font-medium border-b border-gray-700 hover:text-yellow-400 transition-colors duration-200">Berita</a>
                <a href="{{ route('arsip') }}"
                    class="block py-3 text-gray-300 font-medium border-b border-gray-700 hover:text-yellow-400 transition-colors duration-200">Arsip</a>
                <a href="{{ route('data-penduduk') }}"
                    class="block py-3 text-gray-300 font-medium border-b border-gray-700 hover:text-yellow-400 transition-colors duration-200">Data
                    Penduduk</a>
                <a href="{{ route('dana-desa') }}"
                    class="block py-3 text-gray-300 font-medium border-b border-gray-700 hover:text-yellow-400 transition-colors duration-200">Dana
                    Desa</a>
                <a href="{{ route('media') }}"
                    class="block py-3 text-gray-300 font-medium border-b border-gray-700 hover:text-yellow-400 transition-colors duration-200">Media</a>
                <a href="{{ route('pelayanan') }}"
                    class="block py-3 text-gray-300 font-medium border-b border-gray-700 hover:text-yellow-400 transition-colors duration-200">Pelayanan</a>
                <a href="{{ route('login') }}"
                    class="bg-yellow-600 text-white border-2 border-yellow-600 hover:bg-yellow-500 hover:border-yellow-500 px-4 py-3 rounded-lg font-semibold inline-block mt-4 transition-all duration-300">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login Admin
                </a>
            </div>
        </div>
    </div>
    <!-- Main Content -->
    <main class="">
        @yield('content')
    </main>
    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="w-full mx-auto px-18 pt-12 pb-7">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <i class="fas fa-building text-2xl text-yellow-500"></i>
                        <div>
                            <h3 class="text-xl font-bold">Desa Digital Tudua</h3>
                            <p class="text-gray-300 text-sm">Kabupaten Morowali</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">
                        Website resmi desa tudua untuk memberikan informasi terkini dan
                        pelayanan terbaik kepada masyarakat. Kami berkomitmen untuk transparansi dan kemudahan akses
                        informasi.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-yellow-500 transition-colors duration-200">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500 transition-colors duration-200">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500 transition-colors duration-200">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500 transition-colors duration-200">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                    </div>
                </div>
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-yellow-500">Menu Utama</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('dashboard') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Beranda</a>
                        </li>
                        <li><a href="{{ route('profil') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Profil
                                Desa</a>
                        </li>
                        <li><a href="{{ route('berita.index') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Berita</a>
                        </li>
                        <li><a href="{{ route('arsip') }}"
                                class="text-gray-300 hover:text-white transition-colors duration-200">Arsip</a>
                        </li>
                    </ul>
                </div>
                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-yellow-500">Pelayanan</h4>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <a href="https://maps.app.goo.gl/CqLQ2pw1Th8jsPT77" target="_blank"
                                class="text-yellow-500 hover:text-yellow-400 transition-colors duration-200">
                                <i class="fas fa-map-marker-alt mt-1"></i>
                            </a>
                            <div>
                                <p class="text-gray-300">Jalan Melati No. 2, Dusun 3, Desa Tudua, Kecamatan Bungku
                                    Tengah, Kabupaten Morowali</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-phone text-yellow-500"></i>
                            <p class="text-gray-300">(xxx) xxxx</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-yellow-500"></i>
                            <p class="text-gray-300">xxx@desa.example.id</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-400"> &copy; {{ date('Y') }} Desa Digital. Semua hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>
    <script>
        // Navbar scroll effect (dengan sedikit debounce)
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            const currentScroll = window.scrollY;

            if (Math.abs(currentScroll - lastScroll) > 5) { // debounce ringan
                if (currentScroll > 50) {
                    navbar.classList.remove('bg-gray-900/95');
                    navbar.classList.add('bg-gray-900/98', 'shadow-lg');
                } else {
                    navbar.classList.remove('bg-gray-900/98', 'shadow-lg');
                    navbar.classList.add('bg-gray-900/95');
                }
                lastScroll = currentScroll;
            }
        });

        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('translate-x-0');
            mobileMenu.classList.toggle('-translate-x-full');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', (event) => {
            const mobileMenu = document.getElementById('mobileMenu');
            const menuButton = event.target.closest('button');

            // Pastikan klik bukan di dalam mobileMenu atau tombol menu
            if (!mobileMenu.contains(event.target) && !menuButton && !mobileMenu.classList.contains('-translate-x-full')) {
                mobileMenu.classList.add('-translate-x-full');
                mobileMenu.classList.remove('translate-x-0');
            }
        });
    </script>
</body>

</html>