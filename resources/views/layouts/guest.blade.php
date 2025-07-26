<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') - Desa Digital</title>
    <meta name="description" content="@yield('description', 'Website resmi desa untuk informasi dan pelayanan masyarakat')">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }
        
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: #3b82f6;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background: #3b82f6;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            transform: translateY(-1px);
        }
        
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .mobile-menu.active {
            transform: translateX(0);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="navbar fixed top-0 left-0 right-0 z-50 px-4 py-3">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <i class="fas fa-building text-2xl text-blue-600"></i>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Desa Digital</h1>
                    <p class="text-xs text-gray-600">Kabupaten Example</p>
                </div>
            </div>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="nav-link text-gray-700 font-medium {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('profil') }}" class="nav-link text-gray-700 font-medium {{ request()->routeIs('profil') ? 'active' : '' }}">Profil Desa</a>
                <a href="{{ route('berita') }}" class="nav-link text-gray-700 font-medium {{ request()->routeIs('berita*') ? 'active' : '' }}">Berita</a>
                <a href="{{ route('pengumuman') }}" class="nav-link text-gray-700 font-medium {{ request()->routeIs('pengumuman*') ? 'active' : '' }}">Pengumuman</a>
                <a href="{{ route('data-penduduk') }}" class="nav-link text-gray-700 font-medium {{ request()->routeIs('data-penduduk') ? 'active' : '' }}">Data Penduduk</a>
                <a href="{{ route('dana-desa') }}" class="nav-link text-gray-700 font-medium {{ request()->routeIs('dana-desa') ? 'active' : '' }}">Dana Desa</a>
                <a href="{{ route('kontak') }}" class="nav-link text-gray-700 font-medium {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
                
                <a href="{{ route('login') }}" class="btn-primary text-white px-4 py-2 rounded-lg font-medium">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login Admin
                </a>
            </div>
            
            <!-- Mobile Menu Button -->
            <button class="md:hidden text-gray-700" onclick="toggleMobileMenu()">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </nav>
    
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu fixed top-0 left-0 w-full h-full bg-white z-40 md:hidden">
        <div class="p-6">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-building text-2xl text-blue-600"></i>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Desa Digital</h1>
                        <p class="text-xs text-gray-600">Kabupaten Example</p>
                    </div>
                </div>
                <button onclick="toggleMobileMenu()" class="text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="space-y-4">
                <a href="{{ route('home') }}" class="block py-3 text-gray-700 font-medium border-b">Beranda</a>
                <a href="{{ route('profil') }}" class="block py-3 text-gray-700 font-medium border-b">Profil Desa</a>
                <a href="{{ route('berita') }}" class="block py-3 text-gray-700 font-medium border-b">Berita</a>
                <a href="{{ route('pengumuman') }}" class="block py-3 text-gray-700 font-medium border-b">Pengumuman</a>
                <a href="{{ route('data-penduduk') }}" class="block py-3 text-gray-700 font-medium border-b">Data Penduduk</a>
                <a href="{{ route('dana-desa') }}" class="block py-3 text-gray-700 font-medium border-b">Dana Desa</a>
                <a href="{{ route('kontak') }}" class="block py-3 text-gray-700 font-medium border-b">Kontak</a>
                <a href="{{ route('login') }}" class="btn-primary text-white px-4 py-3 rounded-lg font-medium inline-block mt-4">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login Admin
                </a>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <i class="fas fa-building text-2xl text-blue-400"></i>
                        <div>
                            <h3 class="text-xl font-bold">Desa Digital</h3>
                            <p class="text-gray-400 text-sm">Kabupaten Example</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">
                        Website resmi desa untuk memberikan informasi terkini dan pelayanan terbaik kepada masyarakat. 
                        Kami berkomitmen untuk transparansi dan kemudahan akses informasi.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Menu Utama</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('profil') }}" class="text-gray-300 hover:text-white transition-colors">Profil Desa</a></li>
                        <li><a href="{{ route('berita') }}" class="text-gray-300 hover:text-white transition-colors">Berita</a></li>
                        <li><a href="{{ route('pengumuman') }}" class="text-gray-300 hover:text-white transition-colors">Pengumuman</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-blue-400 mt-1"></i>
                            <div>
                                <p class="text-gray-300">Jl. Raya Desa No. 123</p>
                                <p class="text-gray-300">Kec. Example, Kab. Example</p>
                                <p class="text-gray-300">Provinsi Example 12345</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-phone text-blue-400"></i>
                            <p class="text-gray-300">(021) 1234-5678</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-blue-400"></i>
                            <p class="text-gray-300">info@desa.example.id</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    &copy; {{ date('Y') }} Desa Digital. Semua hak cipta dilindungi. 
                    Dikembangkan dengan <i class="fas fa-heart text-red-500"></i> untuk masyarakat desa.
                </p>
            </div>
        </div>
    </footer>
    
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('active');
        }
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobileMenu');
            const menuButton = event.target.closest('button');
            
            if (!mobileMenu.contains(event.target) && !menuButton) {
                mobileMenu.classList.remove('active');
            }
        });
    </script>
</body>
</html>
