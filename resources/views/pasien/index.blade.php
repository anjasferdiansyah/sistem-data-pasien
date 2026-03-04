@extends('layouts.app')

@section('title', 'Data Pasien')
@section('page-title', 'Data Pasien')
@section('page-subtitle', 'Kelola semua data pasien')

@section('content')
    <div>
        <!-- Toast Notification -->
        @if (session('success'))
            <div class="toast toast-success mb-6">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 animate-fade-in">
            <div>
                <h3 class="text-xl font-bold text-slate-800">Daftar Pasien</h3>
                <p class="text-sm text-slate-500 mt-0.5">Total: <span
                        class="font-semibold text-primary-600">{{ $dataPasien->total() }}</span> pasien</p>
            </div>
            <a href="{{ route('data-pasien.create') }}" class="btn btn-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Pasien
            </a>
        </div>

        <!-- Search Bar -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 mb-6 animate-fade-in-up"
            style="animation-delay: 0.1s; opacity: 0;">
            <form method="GET" action="{{ route('data-pasien.index') }}">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan nama, NIK, atau nomor telepon..." class="form-input !pl-12">
                </div>
            </form>
        </div>

        <!-- Data Table -->
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden animate-fade-in-up"
            style="animation-delay: 0.2s; opacity: 0;">
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pasien</th>
                            <th>NIK</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>No. Telepon</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataPasien as $patient)
                            <tr>
                                <td>
                                    <span class="badge badge-blue">#{{ $patient->id }}</span>
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-9 h-9 rounded-full gradient-primary flex items-center justify-center text-white text-xs font-bold shrink-0">
                                            {{ substr($patient->nama, 0, 1) }}
                                        </div>
                                        <span class="font-semibold text-slate-800">{{ $patient->nama }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="font-mono text-xs text-slate-600">{{ $patient->nik ?? '-' }}</span>
                                </td>
                                <td>
                                    <span class="text-sm text-slate-600">
                                        {{ $patient->tanggal_lahir ? $patient->tanggal_lahir->format('d/m/Y') : '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if($patient->jenis_kelamin == 'L')
                                        <span class="badge badge-blue">Laki-laki</span>
                                    @elseif($patient->jenis_kelamin == 'P')
                                        <span class="badge badge-green">Perempuan</span>
                                    @else
                                        <span class="text-slate-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center gap-1.5 text-slate-600">
                                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="truncate max-w-[140px]">{{ $patient->alamat }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="font-mono text-xs text-slate-600">{{ $patient->no_telepon ?? $patient->noHP }}</span>
                                </td>
                                <td>
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('data-pasien.show', $patient->id) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-sky-600 hover:bg-sky-50 transition-colors"
                                            title="Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('data-pasien.edit', $patient->id) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-amber-600 hover:bg-amber-50 transition-colors"
                                            title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('data-pasien.destroy', $patient->id) }}"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-500 hover:bg-red-50 transition-colors"
                                                title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="!py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-slate-300 mb-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="text-slate-500 font-medium">Tidak ada data ditemukan</p>
                                        <p class="text-slate-400 text-sm mt-1">Coba ubah kata kunci pencarian</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($dataPasien->hasPages())
                <div class="flex items-center justify-between p-4 border-t border-slate-100">
                    <p class="text-sm text-slate-500">
                        Menampilkan <span class="font-medium">{{ $dataPasien->firstItem() }}</span>
                        - <span class="font-medium">{{ $dataPasien->lastItem() }}</span>
                        dari <span class="font-medium">{{ $dataPasien->total() }}</span> data
                    </p>
                    {{ $dataPasien->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection