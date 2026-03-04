@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="login-bg flex items-center justify-center p-4">
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
            @if ($errors->has('email'))
                <div class="mb-5 p-3 rounded-xl text-sm font-medium flex items-center gap-2"
                    style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #fca5a5;">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $errors->first('email') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                            placeholder="admin@example.com" required autocomplete="email" autofocus
                            class="w-full pl-11 pr-4 py-3 rounded-xl text-sm text-white transition-all duration-200 outline-none"
                            style="background: rgba(255, 255, 255, 0.06); border: 1.5px solid rgba(255, 255, 255, 0.1);"
                            onfocus="this.style.borderColor='rgba(59, 130, 246, 0.6)'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.15)'"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none'">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" 
                            placeholder="••••••••" required autocomplete="current-password"
                            class="w-full pl-11 pr-12 py-3 rounded-xl text-sm text-white transition-all duration-200 outline-none"
                            style="background: rgba(255, 255, 255, 0.06); border: 1.5px solid rgba(255, 255, 255, 0.1);"
                            onfocus="this.style.borderColor='rgba(59, 130, 246, 0.6)'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.15)'"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none'">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" 
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="remember" class="ml-2 block text-sm text-slate-300">
                        Ingat saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                    class="w-full py-3 rounded-xl text-sm font-semibold text-white transition-all duration-300 relative overflow-hidden hover:-translate-y-0.5"
                    style="background: linear-gradient(135deg, #3b82f6, #8b5cf6); box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk
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