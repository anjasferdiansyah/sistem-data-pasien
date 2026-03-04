<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Sistem Data Pasien</title>
    <meta name="description" content="Sistem Informasi Data Pasien - Dashboard Management">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100" x-data="{ sidebarOpen: false }" x-init="checkAuth()">

    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 lg:hidden">
    </div>

    <!-- Sidebar -->
    <aside class="sidebar fixed top-0 left-0 h-full w-[270px] z-50 flex flex-col transition-transform duration-300"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">

        <!-- Logo -->
        <div class="p-6 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl gradient-primary flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-white font-bold text-lg leading-tight">MediData</h1>
                <p class="text-slate-400 text-xs">Sistem Data Pasien</p>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 mt-2 space-y-1">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-3 mb-3">Menu Utama</p>

            <a href="/dashboard" class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

            <a href="/pasien" class="sidebar-link {{ request()->is('pasien*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Data Pasien
            </a>

            <div class="!mt-6">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-3 mb-3">Pengaturan</p>

                <button @click="AuthHelper.logout()" class="sidebar-link w-full text-left">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </div>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 mx-4 mb-4 rounded-xl"
            style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.15);">
            <div class="flex items-center gap-3">
                <div
                    class="w-9 h-9 rounded-full gradient-primary flex items-center justify-center text-white font-bold text-sm">
                    A
                </div>
                <div>
                    <p class="text-white text-sm font-semibold" x-text="AuthHelper.getUser()?.name || 'Admin'"></p>
                    <p class="text-slate-400 text-xs" x-text="AuthHelper.getUser()?.email || ''"></p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="lg:ml-[270px] min-h-screen">
        <!-- Top Header -->
        <header class="sticky top-0 z-30 glass border-b border-slate-200/50">
            <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
                <!-- Mobile Menu Button -->
                <button @click="sidebarOpen = !sidebarOpen"
                    class="lg:hidden p-2 rounded-lg hover:bg-slate-100 transition-colors">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Page Title -->
                <div class="hidden lg:block">
                    <h2 class="text-lg font-bold text-slate-800">@yield('page-title', 'Dashboard')</h2>
                    <p class="text-xs text-slate-500">@yield('page-subtitle', 'Selamat datang di sistem data pasien')
                    </p>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center gap-2 text-sm text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span
                            x-text="new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })"></span>
                    </div>

                    <!-- User Avatar -->
                    <div class="flex items-center gap-2 pl-3 border-l border-slate-200">
                        <div
                            class="w-8 h-8 rounded-full gradient-primary flex items-center justify-center text-white font-bold text-xs">
                            A
                        </div>
                        <span class="hidden sm:inline text-sm font-medium text-slate-700"
                            x-text="AuthHelper.getUser()?.name || 'Admin'"></span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-4 sm:p-6 lg:p-8">
            @yield('content')
        </main>
    </div>

</body>

</html>