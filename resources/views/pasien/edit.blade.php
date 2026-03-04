@extends('layouts.app')

@section('title', 'Edit Pasien')
@section('page-title', 'Edit Data Pasien')
@section('page-subtitle', 'Perbarui informasi data pasien')

@section('content')
    <div x-data="{
        patientId: {{ $id }},
        form: {
            nama: '',
            alamat: '',
            umur: '',
            noHP: ''
        },
        errors: {},
        loading: false,
        notFound: false,

        init() {
            const patient = PatientHelper.getById(this.patientId);
            if (patient) {
                this.form.nama = patient.nama;
                this.form.alamat = patient.alamat;
                this.form.umur = patient.umur;
                this.form.noHP = patient.noHP;
            } else {
                this.notFound = true;
            }
        },

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
                PatientHelper.update(this.patientId, {
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
            <span class="text-slate-800 font-medium">Edit Pasien</span>
        </div>

        <!-- Not Found State -->
        <template x-if="notFound">
            <div class="max-w-2xl">
                <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Data Tidak Ditemukan</h3>
                    <p class="text-sm text-slate-500 mb-6">Pasien dengan ID #<span x-text="patientId"></span> tidak
                        ditemukan dalam database.</p>
                    <a href="/pasien" class="btn btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Data Pasien
                    </a>
                </div>
            </div>
        </template>

        <!-- Form Card -->
        <template x-if="!notFound">
            <div class="max-w-2xl animate-fade-in-up">
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                    <!-- Card Header -->
                    <div class="p-6 border-b border-slate-100"
                        style="background: linear-gradient(135deg, #f8fafc, #f1f5f9);">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                                style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-slate-800">Edit Data Pasien <span
                                        class="text-primary-600" x-text="'#' + patientId"></span></h3>
                                <p class="text-xs text-slate-500">Perbarui informasi pasien di bawah ini</p>
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
                            <textarea id="alamat" x-model="form.alamat" placeholder="Masukkan alamat lengkap pasien"
                                rows="3" class="form-input"
                                :class="errors.alamat ? '!border-red-400 !shadow-red-100' : ''"></textarea>
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
                                <input type="text" id="noHP" x-model="form.noHP" placeholder="081234567890"
                                    class="form-input" :class="errors.noHP ? '!border-red-400 !shadow-red-100' : ''">
                                <p x-show="errors.noHP" class="mt-1.5 text-xs text-red-500 flex items-center gap-1"
                                    x-text="errors.noHP"></p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                            <button type="submit" :disabled="loading" class="btn btn-warning"
                                :class="loading ? 'opacity-70 cursor-not-allowed' : ''">
                                <template x-if="!loading">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Update Pasien
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
        </template>

    </div>
@endsection