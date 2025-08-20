@extends('layouts.guest')

@section('title', 'Login Admin')
@section('description', 'Halaman login untuk administrator desa')

@section('content')
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, rgba(17, 24, 39, 0.95) 0%, rgba(31, 41, 55, 0.9) 50%, rgba(55, 65, 81, 0.85) 100%);
        }

        .glass-effect {
            background: rgba(31, 41, 55, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-primary {
            background: linear-gradient(45deg, #EAB308, #F59E0B);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            box-shadow: 0 10px 15px -3px rgba(234, 179, 8, 0.3);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }

        .floating-animation {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }

        @keyframes pulse-glow {
            from {
                box-shadow: 0 0 20px rgba(234, 179, 8, 0.3);
            }

            to {
                box-shadow: 0 0 30px rgba(234, 179, 8, 0.5);
            }
        }
    </style>

    <!-- Hero Background with Overlay -->
    <section
        class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-800 pt-20 relative overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ asset('images/foto-bersama.jpg') }}')">
        </div>

        <!-- Overlay Gradient -->
        <div class="absolute inset-0 hero-gradient"></div>

        <!-- Main Content -->
        <div class="relative z-10 max-w-md w-full pt-12">
            <!-- Login Form -->
            <div class="glass-effect rounded-2xl shadow-2xl p-8 card-hover">
                @if(session('error'))
                    <div
                        class="bg-red-500/10 border border-red-400/30 text-red-300 px-4 py-3 rounded-xl mb-6 flex items-center backdrop-blur-sm">
                        <i class="fas fa-exclamation-circle mr-3 text-red-400"></i>
                        <span class="text-sm">{{ session('error') }}</span>
                    </div>
                @endif

                @if(session('success'))
                    <div
                        class="bg-green-500/10 border border-green-400/30 text-green-300 px-4 py-3 rounded-xl mb-6 flex items-center backdrop-blur-sm">
                        <i class="fas fa-check-circle mr-3 text-green-400"></i>
                        <span class="text-sm">{{ session('success') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('auth.login') }}" id="loginForm" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-200 mb-3">
                            <i class="fas fa-envelope mr-2 text-yellow-400"></i>
                            Email Address
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-4 border border-gray-600/50 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all text-sm bg-gray-700/50 text-white placeholder-gray-400 backdrop-blur-sm"
                            placeholder="admin@desa.id" required autocomplete="email">
                        @error('email')
                            <p class="text-red-400 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-200 mb-3">
                            <i class="fas fa-lock mr-2 text-yellow-400"></i>
                            Password
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="w-full px-4 py-4 pr-12 border border-gray-600/50 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all text-sm bg-gray-700/50 text-white placeholder-gray-400 backdrop-blur-sm"
                                placeholder="Masukkan password" required autocomplete="current-password">
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-yellow-400 transition-colors">
                                <i id="passwordIcon" class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-400 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember"
                                class="h-4 w-4 text-yellow-500 focus:ring-yellow-400 border-gray-600 rounded bg-gray-700/50">
                            <label for="remember" class="ml-3 block text-sm text-gray-300">
                                Ingat saya
                            </label>
                        </div>
                        <a href="#" class="text-sm text-yellow-400 hover:text-yellow-300 font-medium transition-colors">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full btn-primary text-gray-900 py-4 px-4 rounded-xl font-bold hover:shadow-2xl focus:ring-4 focus:ring-yellow-400/50 transition-all duration-200 flex items-center justify-center shadow-lg"
                        id="loginBtn">
                        <span id="loginText">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login ke Panel Admin
                        </span>
                        <span id="loginLoading" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Memproses...
                        </span>
                    </button>
                </form>

                <!-- Divider -->
                <div class="mt-8 pt-6 border-t border-gray-600/30">
                    <div class="text-center">
                        <p class="text-sm text-gray-400 mb-4 flex items-center justify-center">
                            <i class="fas fa-shield-alt mr-2 text-yellow-400"></i>
                            Hanya administrator yang dapat mengakses panel ini
                        </p>
                        <a href="{{route('dashboard') }}"
                            class="inline-flex items-center text-yellow-400 hover:text-yellow-300 font-semibold text-sm transition-all duration-300 hover:transform hover:scale-105">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
            loginBtn.classList.add('opacity-75');
            loginText.classList.add('hidden');
            loginLoading.classList.remove('hidden');
        });

        // Auto-hide flash messages
        setTimeout(function () {
            const alerts = document.querySelectorAll('.bg-red-500\\/10, .bg-green-500\\/10');
            alerts.forEach(function (alert) {
                alert.style.transition = 'all 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(function () {
                    alert.remove();
                }, 500);
            });
        }, 5000);

        // Add shake animation on error
        @if($errors->any())
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.querySelector('.glass-effect');
                form.style.animation = 'shake 0.5s ease-in-out';

                // Remove animation class after animation completes
                setTimeout(() => {
                    form.style.animation = '';
                }, 500);
            });

            // Add shake keyframes
            const style = document.createElement('style');
            style.textContent = `
                                                                                                                                                        @keyframes shake {
                                                                                                                                                            0%, 100% { transform: translateX(0); }
                                                                                                                                                            25% { transform: translateX(-5px); }
                                                                                                                                                            75% { transform: translateX(5px); }
                                                                                                                                                        }
                                                                                                                                                    `;
            document.head.appendChild(style);
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

        // Enhanced form validation with visual feedback
        document.getElementById('email').addEventListener('blur', function () {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email && !emailRegex.test(email)) {
                this.classList.add('border-red-500', 'bg-red-900/20');
                this.classList.remove('border-gray-600/50');
            } else if (email) {
                this.classList.add('border-green-500', 'bg-green-900/20');
                this.classList.remove('border-gray-600/50', 'border-red-500', 'bg-red-900/20');
            } else {
                this.classList.remove('border-red-500', 'border-green-500', 'bg-red-900/20', 'bg-green-900/20');
                this.classList.add('border-gray-600/50');
            }
        });

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function () {
            const password = this.value;

            if (password.length >= 8) {
                this.classList.add('border-green-500', 'bg-green-900/20');
                this.classList.remove('border-gray-600/50', 'border-yellow-500', 'bg-yellow-900/20');
            } else if (password.length >= 4) {
                this.classList.add('border-yellow-500', 'bg-yellow-900/20');
                this.classList.remove('border-gray-600/50', 'border-green-500', 'bg-green-900/20');
            } else {
                this.classList.remove('border-green-500', 'border-yellow-500', 'bg-green-900/20', 'bg-yellow-900/20');
                this.classList.add('border-gray-600/50');
            }
        });

        // Smooth focus transitions
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function () {
                this.parentElement.classList.add('scale-105');
            });

            input.addEventListener('blur', function () {
                this.parentElement.classList.remove('scale-105');
            });
        });
    </script>
@endsection