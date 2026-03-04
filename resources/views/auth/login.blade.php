@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="login-bg flex items-center justify-center p-4" x-data="{
        email: '',
        password: '',
        error: '',
        loading: false,
        showPassword: false,
        login() {
            this.error = '';
            this.loading = true;

            // Simulate network delay
            setTimeout(() => {
                const result = AuthHelper.login(this.email, this.password);
                if (result.success) {
                    window.location.href = '/dashboard';
                } else {
                    this.error = result.message;
                    this.loading = false;
                }
            }, 800);
        }
    }" x-init="if(AuthHelper.isAuthenticated()) window.location.href = '/dashboard'">

        <div class="login-card relative z-10">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 rounded-2xl gradient-primary shadow-lg shadow-blue-500/30 mb-4 animate-float">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white mb-1">MediData</h1>
                <p class="text-slate-400 text-sm">Sistem Informasi Data Pasien</p>
            </div>

            <!-- Error Message -->
            <div x-show="error" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                class="mb-5 p-3 rounded-xl text-sm font-medium flex items-center gap-2"
                style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #fca5a5;">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span x-text="error"></span>
            </div>

            <!-- Login Form -->
            <form @submit.prevent="login" class="space-y-5">
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" id="login-email" x-model="email" placeholder="admin@example.com" required
                            class="w-full pl-11 pr-4 py-3 rounded-xl text-sm text-white transition-all duration-200 outline-none"
                            style="background: rgba(255, 255, 255, 0.06); border: 1.5px solid rgba(255, 255, 255, 0.1);"
                            onfocus="this.style.borderColor='rgba(59, 130, 246, 0.6)'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.15)'"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none'">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input :type="showPassword ? 'text' : 'password'" id="login-password" x-model="password"
                            placeholder="••••••••" required
                            class="w-full pl-11 pr-12 py-3 rounded-xl text-sm text-white transition-all duration-200 outline-none"
                            style="background: rgba(255, 255, 255, 0.06); border: 1.5px solid rgba(255, 255, 255, 0.1);"
                            onfocus="this.style.borderColor='rgba(59, 130, 246, 0.6)'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.15)'"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none'">
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-500 hover:text-slate-300 transition-colors">
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="login-submit" :disabled="loading"
                    class="w-full py-3 rounded-xl text-sm font-semibold text-white transition-all duration-300 relative overflow-hidden"
                    :class="loading ? 'opacity-70 cursor-not-allowed' : 'hover:-translate-y-0.5'"
                    style="background: linear-gradient(135deg, #3b82f6, #8b5cf6); box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);">
                    <span x-show="!loading" class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk
                    </span>
                    <span x-show="loading" class="flex items-center justify-center gap-2" style="display: none;">
                        <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </form>

            <!-- Info Box -->
            <div class="mt-6 p-3.5 rounded-xl text-center"
                style="background: rgba(59, 130, 246, 0.08); border: 1px solid rgba(59, 130, 246, 0.15);">
                <p class="text-xs text-slate-400">Demo Credentials</p>
                <p class="text-sm text-slate-300 font-mono mt-1">admin@example.com / password</p>
            </div>
        </div>

    </div>
@endsection