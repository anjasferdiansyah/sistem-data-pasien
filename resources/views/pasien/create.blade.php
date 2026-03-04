@extends('layouts.app')

@section('title', 'Tambah Pasien')
@section('page-title', 'Tambah Pasien Baru')
@section('page-subtitle', 'Isi formulir untuk menambahkan data pasien baru')

@section('content')
    <div>
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-6 animate-fade-in">
            <a href="{{ route('data-pasien.index') }}" class="hover:text-primary-600 transition-colors">Data Pasien</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-slate-800 font-medium">Tambah Baru</span>
        </div>

        <!-- Form Card -->
        <div class="max-w-2xl animate-fade-in-up">
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                <!-- Card Header -->
                <div class="p-6 border-b border-slate-100" style="background: linear-gradient(135deg, #f8fafc, #f1f5f9);">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl gradient-primary flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-800">Formulir Pasien Baru</h3>
                            <p class="text-xs text-slate-500">Lengkapi semua field yang diperlukan</p>
                        </div>
                    </div>
                </div>

                <!-- Form Body -->
                <form method="POST" action="{{ route('data-pasien.store') }}" class="p-6 space-y-5">
                    @csrf

                    <!-- Nama & NIK -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Nama -->
                        <div>
                            <label for="nama" class="form-label">
                                Nama Pasien <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                placeholder="Masukkan nama lengkap pasien" required
                                class="form-input {{ $errors->has('nama') ? '!border-red-400 !shadow-red-100' : '' }}">
                            @error('nama')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIK -->
                        <div>
                            <label for="nik" class="form-label">
                                NIK <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nik" name="nik" value="{{ old('nik') }}" placeholder="16 digit NIK"
                                maxlength="16" required
                                class="form-input font-mono {{ $errors->has('nik') ? '!border-red-400 !shadow-red-100' : '' }}">
                            @error('nik')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Tanggal Lahir & Jenis Kelamin -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="form-label">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                required
                                class="form-input {{ $errors->has('tanggal_lahir') ? '!border-red-400 !shadow-red-100' : '' }}">
                            @error('tanggal_lahir')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="jenis_kelamin" class="form-label">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required
                                class="form-input {{ $errors->has('jenis_kelamin') ? '!border-red-400 !shadow-red-100' : '' }}">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="form-label">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat" name="alamat" placeholder="Masukkan alamat lengkap pasien" rows="3" required
                            class="form-input {{ $errors->has('alamat') ? '!border-red-400 !shadow-red-100' : '' }}">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No Telepon & Email -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- No Telepon -->
                        <div>
                            <label for="no_telepon" class="form-label">
                                Nomor Telepon <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                                placeholder="081234567890" required
                                class="form-input {{ $errors->has('no_telepon') ? '!border-red-400 !shadow-red-100' : '' }}">
                            @error('no_telepon')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="contoh@email.com"
                                class="form-input {{ $errors->has('email') ? '!border-red-400 !shadow-red-100' : '' }}">
                            @error('email')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Golongan Darah -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="golongan_darah" class="form-label">Golongan Darah</label>
                            <select id="golongan_darah" name="golongan_darah"
                                class="form-input {{ $errors->has('golongan_darah') ? '!border-red-400 !shadow-red-100' : '' }}">
                                <option value="">Pilih Golongan Darah</option>
                                <option value="A" {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O</option>
                            </select>
                            @error('golongan_darah')
                                <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Riwayat Penyakit -->
                    <div>
                        <label for="riwayat_penyakit" class="form-label">Riwayat Penyakit</label>
                        <textarea id="riwayat_penyakit" name="riwayat_penyakit"
                            placeholder="Tuliskan riwayat penyakit pasien (opsional)" rows="3"
                            class="form-input {{ $errors->has('riwayat_penyakit') ? '!border-red-400 !shadow-red-100' : '' }}">{{ old('riwayat_penyakit') }}</textarea>
                        @error('riwayat_penyakit')
                            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alergi -->
                    <div>
                        <label for="alergi" class="form-label">Alergi</label>
                        <textarea id="alergi" name="alergi" placeholder="Tuliskan alergi yang dimiliki pasien (opsional)"
                            rows="3"
                            class="form-input {{ $errors->has('alergi') ? '!border-red-400 !shadow-red-100' : '' }}">{{ old('alergi') }}</textarea>
                        @error('alergi')
                            <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                        <button type="submit" class="btn btn-primary">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Pasien
                            </span>
                        </button>
                        <a href="{{ route('data-pasien.index') }}" class="btn btn-ghost">Batal</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection