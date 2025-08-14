@extends('layouts.guest')

@section('title', 'Login Admin')
@section('description', 'Halaman login untuk administrator desa')

@section('content')
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-50 pt-28">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="flex justify-center mb-6">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-user-shield text-white text-2xl"></i>
                    </div>
                </div>
                <h2 class="text-3xl font-semibold text-slate-800 mb-2">Login Administrator</h2>
                <p class="text-slate-600">Masuk ke panel admin desa digital</p>
            </div>

            <!-- Login Form -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                        <span class="text-sm">{{ session('error') }}</span>
                    </div>
                @endif

                @if(session('success'))
                    <div
                        class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                        <i class="fas fa-check-circle mr-2 text-emerald-500"></i>
                        <span class="text-sm">{{ session('success') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('auth.login') }}" id="loginForm" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-slate-400"></i>
                            Email Address
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm bg-slate-50 focus:bg-white"
                            placeholder="admin@desa.id" required autocomplete="email">
                        @error('email')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                            <i class="fas fa-lock mr-2 text-slate-400"></i>
                            Password
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="w-full px-4 py-3 pr-12 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm bg-slate-50 focus:bg-white"
                                placeholder="Masukkan password" required autocomplete="current-password">
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                                <i id="passwordIcon" class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-slate-600">
                                Ingat saya
                            </label>
                        </div>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-4 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:ring-blue-200 transition-all duration-200 flex items-center justify-center shadow-sm"
                        id="loginBtn">
                        <span id="loginText">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login
                        </span>
                        <span id="loginLoading" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Memproses...
                        </span>
                    </button>
                </form>

                <!-- Divider -->
                <div class="mt-8 pt-6 border-t border-slate-200">
                    <div class="text-center">
                        <p class="text-sm text-slate-500 mb-4">
                            <i class="fas fa-info-circle mr-1"></i>
                            Hanya administrator yang dapat mengakses panel ini
                        </p>
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm transition-colors">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                passwordIcon.className = 'fas fa-eye';
            }
        }

        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const loginBtn = document.getElementById('loginBtn');
            const loginText = document.getElementById('loginText');
            const loginLoading = document.getElementById('loginLoading');

            // Show loading state
            loginBtn.disabled = true;
            loginText.classList.add('hidden');
            loginLoading.classList.remove('hidden');

            // Simulate processing time (remove in production)
            setTimeout(() => {
                // Form will submit normally
            }, 1000);
        });

        // Auto-hide flash messages
        setTimeout(function () {
            const alerts = document.querySelectorAll('.bg-red-50, .bg-emerald-50');
            alerts.forEach(function (alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function () {
                    alert.remove();
                }, 500);
            });
        }, 5000);

        // Add shake animation on error
        @if($errors->any())
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('loginForm');
                form.classList.add('animate-pulse');
                setTimeout(() => {
                    form.classList.remove('animate-pulse');
                }, 500);
            });
        @endif

        // Keyboard shortcuts
        document.addEventListener('keydown', function (e) {
            // Alt + L to focus email
            if (e.altKey && e.key === 'l') {
                e.preventDefault();
                document.getElementById('email').focus();
            }

            // Alt + P to focus password
            if (e.altKey && e.key === 'p') {
                e.preventDefault();
                document.getElementById('password').focus();
            }
        });

        // Form validation
        document.getElementById('email').addEventListener('blur', function () {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email && !emailRegex.test(email)) {
                this.classList.add('border-red-300', 'bg-red-50');
                this.classList.remove('border-slate-300', 'bg-slate-50');
            } else {
                this.classList.remove('border-red-300', 'bg-red-50');
                this.classList.add('border-slate-300', 'bg-slate-50');
            }
        });
    </script>
@endsection