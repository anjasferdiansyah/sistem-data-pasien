@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data pasien anda')

@section('content')
    <div x-data="{
        stats: {},
        recentPatients: [],
        init() {
            this.stats = PatientHelper.getStats();
            this.recentPatients = PatientHelper.getAll().slice(-5).reverse();
        }
    }">

        <!-- Greeting Banner -->
        <div class="gradient-primary rounded-2xl p-6 sm:p-8 mb-8 relative overflow-hidden animate-fade-in">
            <div class="absolute right-0 top-0 w-64 h-64 opacity-10">
                <svg viewBox="0 0 200 200" fill="currentColor" class="text-white">
                    <path
                        d="M100 0C44.77 0 0 44.77 0 100s44.77 100 100 100 100-44.77 100-100S155.23 0 100 0zm0 180c-44.11 0-80-35.89-80-80s35.89-80 80-80 80 35.89 80 80-35.89 80-80 80z" />
                    <path
                        d="M100 40c-33.14 0-60 26.86-60 60s26.86 60 60 60 60-26.86 60-60-26.86-60-60-60zm0 100c-22.09 0-40-17.91-40-40s17.91-40 40-40 40 17.91 40 40-17.91 40-40 40z" />
                </svg>
            </div>
            <div class="relative z-10">
                <h2 class="text-xl sm:text-2xl font-bold text-white mb-1">
                    Selamat Datang, <span x-text="AuthHelper.getUser()?.name || 'Admin'"></span>! 👋
                </h2>
                <p class="text-blue-100 text-sm sm:text-base">Kelola data pasien dengan mudah dan efisien.</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <!-- Total Pasien -->
            <div class="stat-card blue animate-fade-in-up delay-100">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                        style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-slate-800" x-text="stats.totalPatients"></p>
                <p class="text-sm text-slate-500 mt-1">Total Pasien</p>
            </div>

            <!-- Rata-rata Umur -->
            <div class="stat-card purple animate-fade-in-up delay-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                        style="background: linear-gradient(135deg, #f3e8ff, #e9d5ff);">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-slate-800"><span x-text="stats.avgAge"></span> thn</p>
                <p class="text-sm text-slate-500 mt-1">Rata-rata Umur</p>
            </div>

            <!-- Pasien Termuda -->
            <div class="stat-card green animate-fade-in-up delay-300">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                        style="background: linear-gradient(135deg, #dcfce7, #bbf7d0);">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-slate-800"><span x-text="stats.youngest"></span> thn</p>
                <p class="text-sm text-slate-500 mt-1">Umur Termuda</p>
            </div>

            <!-- Pasien Tertua -->
            <div class="stat-card orange animate-fade-in-up delay-400">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                        style="background: linear-gradient(135deg, #fef3c7, #fde68a);">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-slate-800"><span x-text="stats.oldest"></span> thn</p>
                <p class="text-sm text-slate-500 mt-1">Umur Tertua</p>
            </div>
        </div>

        <!-- Recent Patients Table -->
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden animate-fade-in-up"
            style="animation-delay: 0.5s; opacity: 0;">
            <div class="flex items-center justify-between p-5 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Pasien Terbaru</h3>
                    <p class="text-xs text-slate-500 mt-0.5">5 data pasien terakhir yang ditambahkan</p>
                </div>
                <a href="/pasien" class="btn btn-ghost text-xs">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pasien</th>
                            <th>Alamat</th>
                            <th>Umur</th>
                            <th>No. HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="patient in recentPatients" :key="patient.id">
                            <tr>
                                <td>
                                    <span class="badge badge-blue" x-text="'#' + patient.id"></span>
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full gradient-primary flex items-center justify-center text-white text-xs font-bold"
                                            x-text="patient.nama.charAt(0)"></div>
                                        <span class="font-medium text-slate-800" x-text="patient.nama"></span>
                                    </div>
                                </td>
                                <td x-text="patient.alamat"></td>
                                <td>
                                    <span class="font-medium" x-text="patient.umur + ' thn'"></span>
                                </td>
                                <td>
                                    <span class="font-mono text-xs" x-text="patient.noHP"></span>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection