@extends('layouts.app')

@section('title', 'Tambah Pasien')
@section('page-title', 'Tambah Pasien Baru')
@section('page-subtitle', 'Isi formulir untuk menambahkan data pasien baru')

@section('content')
    <div x-data="{
        form: {
            nama: '',
            alamat: '',
            umur: '',
            noHP: ''
        },
        errors: {},
        loading: false,

        validate() {
            this.errors = {};
            if (!this.form.nama.trim()) this.errors.nama = 'Nama pasien wajib diisi';
            if (!this.form.alamat.trim()) this.errors.alamat = 'Alamat wajib diisi';
            if (!this.form.umur || this.form.umur < 0 || this.form.umur > 150) this.errors.umur = 'Umur harus antara 0-150';
            if (!this.form.noHP.trim()) this.errors.noHP = 'Nomor HP wajib diisi';
            else if (!/^[0-9]{10,15}$/.test(this.form.noHP.replace(/\s/g, ''))) this.errors.noHP = 'Format nomor HP tidak valid (10-15 digit)';
            return Object.keys(this.errors).length === 0;
        },

        submit() {
            if (!this.validate()) return;
            this.loading = true;

            setTimeout(() => {
                PatientHelper.create({
                    nama: this.form.nama.trim(),
                    alamat: this.form.alamat.trim(),
                    umur: parseInt(this.form.umur),
                    noHP: this.form.noHP.trim()
                });
                window.location.href = '/pasien';
            }, 500);
        }
    }">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-6 animate-fade-in">
            <a href="/pasien" class="hover:text-primary-600 transition-colors">Data Pasien</a>
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
                <form @submit.prevent="submit" class="p-6 space-y-5">
                    <!-- Nama -->
                    <div>
                        <label for="nama" class="form-label">
                            Nama Pasien <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" x-model="form.nama" placeholder="Masukkan nama lengkap pasien"
                            class="form-input" :class="errors.nama ? '!border-red-400 !shadow-red-100' : ''">
                        <p x-show="errors.nama" class="mt-1.5 text-xs text-red-500 flex items-center gap-1"
                            x-text="errors.nama"></p>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="form-label">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat" x-model="form.alamat" placeholder="Masukkan alamat lengkap pasien" rows="3"
                            class="form-input" :class="errors.alamat ? '!border-red-400 !shadow-red-100' : ''"></textarea>
                        <p x-show="errors.alamat" class="mt-1.5 text-xs text-red-500 flex items-center gap-1"
                            x-text="errors.alamat"></p>
                    </div>

                    <!-- Umur & No HP (side by side) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Umur -->
                        <div>
                            <label for="umur" class="form-label">
                                Umur <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" id="umur" x-model="form.umur" placeholder="0" min="0" max="150"
                                    class="form-input" :class="errors.umur ? '!border-red-400 !shadow-red-100' : ''">
                                <span
                                    class="absolute inset-y-0 right-3 flex items-center text-sm text-slate-400">tahun</span>
                            </div>
                            <p x-show="errors.umur" class="mt-1.5 text-xs text-red-500 flex items-center gap-1"
                                x-text="errors.umur"></p>
                        </div>

                        <!-- No HP -->
                        <div>
                            <label for="noHP" class="form-label">
                                Nomor HP <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="noHP" x-model="form.noHP" placeholder="081234567890" class="form-input"
                                :class="errors.noHP ? '!border-red-400 !shadow-red-100' : ''">
                            <p x-show="errors.noHP" class="mt-1.5 text-xs text-red-500 flex items-center gap-1"
                                x-text="errors.noHP"></p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                        <button type="submit" :disabled="loading" class="btn btn-primary"
                            :class="loading ? 'opacity-70 cursor-not-allowed' : ''">
                            <template x-if="!loading">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Pasien
                                </span>
                            </template>
                            <template x-if="loading">
                                <span class="flex items-center gap-2">
                                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                    </svg>
                                    Menyimpan...
                                </span>
                            </template>
                        </button>
                        <a href="/pasien" class="btn btn-ghost">Batal</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection