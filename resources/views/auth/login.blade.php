@extends('layouts.guest')

@section('title', 'Login Admin')
@section('description', 'Halaman login untuk administrator desa')

@section('content')
    <!-- Hero Background with Overlay -->
    <section
        class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-800 pt-20 relative overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ asset('images/foto-bersama.jpg') }}')">
        </div>

        <!-- Overlay Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900/95 via-gray-800/90 to-gray-700/85"></div>

        <!-- Main Content -->
        <div class="relative z-10 max-w-md w-full pt-12">
            <!-- Login Form -->
            <div
                class="bg-gray-800/80 backdrop-blur-sm border border-gray-700/50 rounded-2xl shadow-2xl p-8 transition-all hover:shadow-3xl">
                @if(session('error'))
                    <div
                        class="bg-red-500/10 border border-red-400/30 text-red-300 px-4 py-3 rounded-xl mb-6 flex items-center">
                        <i class="fas fa-exclamation-circle mr-3 text-red-400"></i>
                        <span class="text-sm">{{ session('error') }}</span>
                    </div>
                @endif

                @if(session('success'))
                    <div
                        class="bg-green-500/10 border border-green-400/30 text-green-300 px-4 py-3 rounded-xl mb-6 flex items-center">
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
                            class="w-full px-4 py-4 border border-gray-600/50 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all text-sm bg-gray-700/50 text-white placeholder-gray-400"
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
                                class="w-full px-4 py-4 pr-12 border border-gray-600/50 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all text-sm bg-gray-700/50 text-white placeholder-gray-400"
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
                        <button type="button" onclick="openForgotModal()"
                            class="cursor-pointer text-sm text-yellow-400 hover:text-yellow-300 font-medium transition-colors">
                            Lupa password?
                        </button>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 py-4 px-4 rounded-xl font-bold hover:from-yellow-600 hover:to-yellow-700 hover:shadow-lg focus:ring-4 focus:ring-yellow-400/50 transition-all duration-200 flex items-center justify-center shadow-lg"
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
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-yellow-400 hover:text-yellow-300 font-semibold text-sm transition-all duration-300 hover:scale-105">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Forgot Password Modal -->
    <div id="forgotModal" class="fixed inset-0 bg-black/65 backdrop-blur-sm hidden items-center justify-center z-50">
        <div
            class="bg-gray-800/90 backdrop-blur-sm border border-gray-700/50 rounded-2xl shadow-2xl p-8 w-full max-w-md relative">
            <!-- Close Button -->
            <button onclick="closeForgotModal()"
                class="absolute top-3 right-3 text-gray-400 hover:text-red-400 transition-colors">
                <i class="fas fa-times"></i>
            </button>

            <h2 class="text-xl font-bold text-yellow-400 mb-4">Reset Password</h2>
            <p class="text-sm text-gray-300 mb-6">Masukkan email anda, password akan direset ke default.</p>

            <form method="POST" action="{{ route('reset-password') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="reset_email" class="block text-sm font-semibold text-gray-200 mb-2">
                        <i class="fas fa-envelope mr-2 text-yellow-400"></i>
                        Email
                    </label>
                    <input type="email" id="reset_email" name="email"
                        class="w-full px-4 py-3 border border-gray-600/50 rounded-xl bg-gray-700/50 text-white placeholder-gray-400 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all"
                        placeholder="admin@desa.id" required>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 py-3 px-4 rounded-xl font-bold hover:from-yellow-600 hover:to-yellow-700 hover:shadow-lg focus:ring-4 focus:ring-yellow-400/50 transition-all duration-200 flex items-center justify-center shadow-lg">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Reset Password
                </button>
            </form>
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
        document.getElementById('loginForm').addEventListener('submit', function () {
            const loginBtn = document.getElementById('loginBtn');
            const loginText = document.getElementById('loginText');
            const loginLoading = document.getElementById('loginLoading');

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
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Modal functions
        function openForgotModal() {
            document.getElementById('forgotModal').classList.remove('hidden');
            document.getElementById('forgotModal').classList.add('flex');
        }

        function closeForgotModal() {
            document.getElementById('forgotModal').classList.remove('flex');
            document.getElementById('forgotModal').classList.add('hidden');
        }

        // Close modal on outside click
        document.getElementById('forgotModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeForgotModal();
            }
        });
    </script>
@endsection