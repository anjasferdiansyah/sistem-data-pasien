@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data pasien anda')

@section('content')
    <div>
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
                    Selamat Datang, {{ auth()->user()->name }}! 👋
                </h2>
                <p class="text-blue-100 text-sm sm:text-base">Kelola data pasien dengan mudah dan efisien.</p>
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
                <a href="{{ route('data-pasien.index') }}" class="btn btn-ghost text-xs">
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
                        @forelse ($recentPatients as $patient)
                            <tr>
                                <td>
                                    <span class="badge badge-blue">#{{ $patient->id }}</span>
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full gradient-primary flex items-center justify-center text-white text-xs font-bold">
                                            {{ substr($patient->nama, 0, 1) }}
                                        </div>
                                        <span class="font-medium text-slate-800">{{ $patient->nama }}</span>
                                    </div>
                                </td>
                                <td>{{ $patient->alamat }}</td>
                                <td>
                                    <span class="font-medium">{{ $patient->umur }} thn</span>
                                </td>
                                <td>
                                    <span class="font-mono text-xs">{{ $patient->noHP }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-slate-500">
                                    Belum ada data pasien
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection