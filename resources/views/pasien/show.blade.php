@extends('layouts.app')

@section('title', 'Detail Pasien')
@section('page-title', 'Detail Pasien')
@section('page-subtitle', 'Informasi lengkap data pasien')

@section('content')
    <div>
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-6 animate-fade-in">
            <a href="{{ route('data-pasien.index') }}" class="hover:text-primary-600 transition-colors">Data Pasien</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-slate-800 font-medium">Detail Pasien</span>
        </div>

        <!-- Detail Card -->
        <div class="max-w-2xl animate-fade-in-up">
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                <!-- Card Header -->
                <div class="p-6 border-b border-slate-100" style="background: linear-gradient(135deg, #f8fafc, #f1f5f9);">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-14 h-14 rounded-2xl gradient-primary flex items-center justify-center text-white text-xl font-bold">
                                {{ substr($dataPasien->nama, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800">{{ $dataPasien->nama }}</h3>
                                <p class="text-sm text-slate-500">
                                    <span class="badge badge-blue">#{{ $dataPasien->id }}</span>
                                    @if($dataPasien->jenis_kelamin == 'L')
                                        <span class="badge badge-blue ml-1">Laki-laki</span>
                                    @elseif($dataPasien->jenis_kelamin == 'P')
                                        <span class="badge badge-green ml-1">Perempuan</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('data-pasien.edit', $dataPasien) }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-amber-700 bg-amber-50 rounded-lg hover:bg-amber-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <a href="{{ route('data-pasien.index') }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-slate-600 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Detail Body -->
                <div class="p-6 space-y-0 divide-y divide-slate-100">

                    <!-- Informasi Pribadi -->
                    <div class="py-4 first:pt-0">
                        <p class="text-xs font-semibold text-primary-600 uppercase tracking-wide mb-3">Informasi Pribadi</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-slate-400 mb-0.5">Nama Lengkap</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $dataPasien->nama }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 mb-0.5">NIK</p>
                                <p class="text-sm font-mono font-semibold text-slate-800">{{ $dataPasien->nik ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 mb-0.5">Tanggal Lahir</p>
                                <p class="text-sm font-semibold text-slate-800">
                                    {{ $dataPasien->tanggal_lahir ? $dataPasien->tanggal_lahir->format('d F Y') : '-' }}
                                    @if($dataPasien->tanggal_lahir)
                                        <span class="text-slate-500 font-normal">({{ $dataPasien->tanggal_lahir->age }}
                                            tahun)</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 mb-0.5">Jenis Kelamin</p>
                                <p class="text-sm font-semibold text-slate-800">
                                    @if($dataPasien->jenis_kelamin == 'L') Laki-laki
                                    @elseif($dataPasien->jenis_kelamin == 'P') Perempuan
                                    @else -
                                    @endif
                                </p>
                            </div>
                            @if($dataPasien->golongan_darah)
                                <div>
                                    <p class="text-xs text-slate-400 mb-0.5">Golongan Darah</p>
                                    <p class="text-sm font-semibold text-slate-800">{{ $dataPasien->golongan_darah }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Kontak -->
                    <div class="py-4">
                        <p class="text-xs font-semibold text-primary-600 uppercase tracking-wide mb-3">Kontak</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-slate-400 mb-0.5">Alamat</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $dataPasien->alamat }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 mb-0.5">No. Telepon</p>
                                <p class="text-sm font-mono font-semibold text-slate-800">
                                    {{ $dataPasien->no_telepon ?? '-' }}</p>
                            </div>
                            @if($dataPasien->email)
                                <div>
                                    <p class="text-xs text-slate-400 mb-0.5">Email</p>
                                    <p class="text-sm font-semibold text-slate-800">{{ $dataPasien->email }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Riwayat Medis -->
                    @if($dataPasien->riwayat_penyakit || $dataPasien->alergi)
                        <div class="py-4">
                            <p class="text-xs font-semibold text-primary-600 uppercase tracking-wide mb-3">Riwayat Medis</p>
                            <div class="grid grid-cols-1 gap-4">
                                @if($dataPasien->riwayat_penyakit)
                                    <div>
                                        <p class="text-xs text-slate-400 mb-0.5">Riwayat Penyakit</p>
                                        <p class="text-sm text-slate-800 leading-relaxed">{{ $dataPasien->riwayat_penyakit }}</p>
                                    </div>
                                @endif
                                @if($dataPasien->alergi)
                                    <div>
                                        <p class="text-xs text-slate-400 mb-0.5">Alergi</p>
                                        <p class="text-sm text-slate-800 leading-relaxed">{{ $dataPasien->alergi }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Timestamps -->
                    <div class="py-4 last:pb-0">
                        <p class="text-xs font-semibold text-primary-600 uppercase tracking-wide mb-3">Informasi Sistem</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-slate-400 mb-0.5">Dibuat</p>
                                <p class="text-sm text-slate-700">{{ $dataPasien->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            @if($dataPasien->updated_at != $dataPasien->created_at)
                                <div>
                                    <p class="text-xs text-slate-400 mb-0.5">Terakhir Diperbarui</p>
                                    <p class="text-sm text-slate-700">{{ $dataPasien->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection