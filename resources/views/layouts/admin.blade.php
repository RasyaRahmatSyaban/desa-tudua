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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        .sidebar {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        }
        
        .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(4px);
        }
        
        .sidebar-item.active {
            background: rgba(255, 255, 255, 0.2);
            border-right: 4px solid #fbbf24;
        }
        
        .card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-64 text-white flex-shrink-0">
            <div class="p-6">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-building text-2xl text-yellow-400"></i>
                    <div>
                        <h1 class="text-xl font-bold">Web Desa Digital</h1>
                        <p class="text-blue-200 text-sm">Admin Panel</p>
                    </div>
                </div>
            </div>
            
            <nav class="mt-8">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center px-6 py-3 text-white transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.berita.index') }}" class="sidebar-item flex items-center px-6 py-3 text-white transition-all duration-200 {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper w-5"></i>
                    <span class="ml-3">Berita</span>
                </a>
                
                <a href="{{ route('admin.pengumuman.index') }}" class="sidebar-item flex items-center px-6 py-3 text-white transition-all duration-200 {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn w-5"></i>
                    <span class="ml-3">Pengumuman</span>
                </a>
                
                <a href="{{ route('admin.penduduk.index') }}" class="sidebar-item flex items-center px-6 py-3 text-white transition-all duration-200 {{ request()->routeIs('admin.penduduk.*') ? 'active' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    <span class="ml-3">Data Penduduk</span>
                </a>
                
                <a href="{{ route('admin.kepala-keluarga.index') }}" class="sidebar-item flex items-center px-6 py-3 text-white transition-all duration-200 {{ request()->routeIs('admin.kepala-keluarga.*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie w-5"></i>
                    <span class="ml-3">Kepala Keluarga</span>
                </a>
                
                <a href="{{ route('admin.surat-masuk.index') }}" class="sidebar-item flex items-center px-6 py-3 text-white transition-all duration-200 {{ request()->routeIs('admin.surat-masuk.*') ? 'active' : '' }}">
                    <i class="fas fa-inbox w-5"></i>
                    <span class="ml-3">Surat Masuk</span>
                </a>
                
                <a href="{{ route('admin.surat-keluar.index') }}" class="sidebar-item flex items-center px-6 py-3 text-white transition-all duration-200 {{ request()->routeIs('admin.surat-keluar.*') ? 'active' : '' }}">
                    <i class="fas fa-paper-plane w-5"></i>
                    <span class="ml-3">Surat Keluar</span>
                </a>
                
                <a href="{{ route('admin.dana-masuk.index') }}" class="sidebar-item flex items-center px-6 py-3 text-white transition-all duration-200 {{ request()->routeIs('admin.dana-masuk.*') ? 'active' : '' }}">
                    <i class="fas fa-arrow-down text-green-400 w-5"></i>
                    <span class="ml-3">Dana Masuk</span>
                </a>
                
                <a href="{{ route('admin.dana-keluar.index') }}" class="sidebar-item flex items-center px-6 py-3 text-white transition-all duration-200 {{ request()->routeIs('admin.dana-keluar.*') ? 'active' : '' }}">
                    <i class="fas fa-arrow-up text-red-400 w-5"></i>
                    <span class="ml-3">Dana Keluar</span>
                </a>
                
                <a href="{{ route('admin.perangkat-desa.index') }}" class="sidebar-item flex items-center px-6 py-3 text-white transition-all duration-200 {{ request()->routeIs('admin.perangkat-desa.*') ? 'active' : '' }}">
                    <i class="fas fa-user-cog w-5"></i>
                    <span class="ml-3">Perangkat Desa</span>
                </a>
                
                <a href="{{ route('admin.pelayanan.index') }}" class="sidebar-item flex items-center px-6 py-3 text-white transition-all duration-200 {{ request()->routeIs('admin.pelayanan.*') ? 'active' : '' }}">
                    <i class="fas fa-concierge-bell w-5"></i>
                    <span class="ml-3">Pelayanan</span>
                </a>
                
                <a href="{{ route('admin.media.index') }}" class="sidebar-item flex items-center px-6 py-3 text-white transition-all duration-200 {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
                    <i class="fas fa-photo-video w-5"></i>
                    <span class="ml-3">Media</span>
                </a>
            </nav>
            
            <div class="absolute bottom-0 w-64 p-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-item flex items-center px-6 py-3 text-white transition-all duration-200 w-full text-left">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span class="ml-3">Logout</span>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-gray-600 text-sm">@yield('page-description', 'Kelola data desa dengan mudah')</p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'Administrator' }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email ?? 'admin@desa.id' }}</p>
                        </div>
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white"></i>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                        </div>
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    
    <script>
        // Auto hide flash messages
        setTimeout(function() {
            const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);
    </script>
</body>
</html>
