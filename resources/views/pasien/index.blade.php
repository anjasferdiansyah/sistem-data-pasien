@extends('layouts.app')

@section('title', 'Data Pasien')
@section('page-title', 'Data Pasien')
@section('page-subtitle', 'Kelola semua data pasien')

@section('content')
    <div x-data="{
        patients: [],
        filteredPatients: [],
        searchQuery: '',
        deleteId: null,
        showDeleteModal: false,
        toast: { show: false, message: '', type: 'success' },
        currentPage: 1,
        perPage: 5,

        init() {
            this.loadPatients();
        },

        loadPatients() {
            this.patients = PatientHelper.getAll();
            this.filterPatients();
        },

        filterPatients() {
            if (this.searchQuery.trim() === '') {
                this.filteredPatients = [...this.patients];
            } else {
                this.filteredPatients = PatientHelper.search(this.searchQuery);
            }
            this.currentPage = 1;
        },

        get paginatedPatients() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.filteredPatients.slice(start, start + this.perPage);
        },

        get totalPages() {
            return Math.ceil(this.filteredPatients.length / this.perPage);
        },

        confirmDelete(id) {
            this.deleteId = id;
            this.showDeleteModal = true;
        },

        deletePatient() {
            PatientHelper.delete(this.deleteId);
            this.showDeleteModal = false;
            this.deleteId = null;
            this.loadPatients();
            this.showToast('Data pasien berhasil dihapus!', 'success');
        },

        showToast(message, type = 'success') {
            this.toast = { show: true, message, type };
            setTimeout(() => { this.toast.show = false; }, 3000);
        }
    }">

        <!-- Toast Notification -->
        <div x-show="toast.show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-8" :class="'toast toast-' + toast.type" style="display: none;">
            <svg x-show="toast.type === 'success'" class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-text="toast.message"></span>
        </div>

        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 animate-fade-in">
            <div>
                <h3 class="text-xl font-bold text-slate-800">Daftar Pasien</h3>
                <p class="text-sm text-slate-500 mt-0.5">Total: <span class="font-semibold text-primary-600"
                        x-text="filteredPatients.length"></span> pasien</p>
            </div>
            <a href="/pasien/create" class="btn btn-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Pasien
            </a>
        </div>

        <!-- Search Bar -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 mb-6 animate-fade-in-up"
            style="animation-delay: 0.1s; opacity: 0;">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" id="search-patient" x-model="searchQuery" @input="filterPatients()"
                    placeholder="Cari berdasarkan nama, alamat, atau nomor HP..." class="form-input !pl-12">
            </div>
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
                            <th>Alamat</th>
                            <th>Umur</th>
                            <th>No. HP</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="patient in paginatedPatients" :key="patient.id">
                            <tr>
                                <td>
                                    <span class="badge badge-blue" x-text="'#' + patient.id"></span>
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full gradient-primary flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                                            x-text="patient.nama.charAt(0)"></div>
                                        <span class="font-semibold text-slate-800" x-text="patient.nama"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center gap-1.5 text-slate-600">
                                        <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span x-text="patient.alamat"></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-green" x-text="patient.umur + ' thn'"></span>
                                </td>
                                <td>
                                    <span class="font-mono text-xs text-slate-600" x-text="patient.noHP"></span>
                                </td>
                                <td>
                                    <div class="flex items-center justify-center gap-2">
                                        <a :href="'/pasien/' + patient.id + '/edit'"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-amber-600 hover:bg-amber-50 transition-colors"
                                            title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <button @click="confirmDelete(patient.id)"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-500 hover:bg-red-50 transition-colors"
                                            title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>

                        <!-- Empty State -->
                        <template x-if="filteredPatients.length === 0">
                            <tr>
                                <td colspan="6" class="!py-12 text-center">
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
                        </template>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div x-show="totalPages > 1" class="flex items-center justify-between p-4 border-t border-slate-100">
                <p class="text-sm text-slate-500">
                    Menampilkan <span class="font-medium" x-text="((currentPage - 1) * perPage) + 1"></span>
                    - <span class="font-medium" x-text="Math.min(currentPage * perPage, filteredPatients.length)"></span>
                    dari <span class="font-medium" x-text="filteredPatients.length"></span> data
                </p>
                <div class="flex items-center gap-1">
                    <button @click="currentPage = Math.max(1, currentPage - 1)" :disabled="currentPage === 1"
                        :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-slate-100'"
                        class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <template x-for="page in totalPages" :key="page">
                        <button @click="currentPage = page"
                            :class="currentPage === page ? 'gradient-primary text-white shadow-md' : 'text-slate-600 hover:bg-slate-100'"
                            class="w-9 h-9 rounded-lg flex items-center justify-center text-sm font-medium transition-all"
                            x-text="page">
                        </button>
                    </template>

                    <button @click="currentPage = Math.min(totalPages, currentPage + 1)"
                        :disabled="currentPage === totalPages"
                        :class="currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-slate-100'"
                        class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="showDeleteModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="modal-backdrop" style="display: none;">
            <div class="modal-content" @click.outside="showDeleteModal = false">
                <div class="flex items-center justify-center w-14 h-14 rounded-full mx-auto mb-4"
                    style="background: #fef2f2;">
                    <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 text-center mb-2">Hapus Data Pasien?</h3>
                <p class="text-sm text-slate-500 text-center mb-6">Data yang dihapus tidak dapat dikembalikan. Apakah Anda
                    yakin ingin melanjutkan?</p>
                <div class="flex gap-3">
                    <button @click="showDeleteModal = false" class="btn btn-ghost flex-1">Batal</button>
                    <button @click="deletePatient()" class="btn btn-danger flex-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>

    </div>
@endsection