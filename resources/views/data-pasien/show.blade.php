@extends('layouts.app')

@section('title', 'Detail Data Pasien')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Detail Data Pasien</h4>
                <div>
                    <a href="{{ route('data-pasien.edit', $dataPasien) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('data-pasien.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Nama Lengkap:</strong></div>
                    <div class="col-sm-9">{{ $dataPasien->nama }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3"><strong>NIK:</strong></div>
                    <div class="col-sm-9">{{ $dataPasien->nik }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Tanggal Lahir:</strong></div>
                    <div class="col-sm-9">{{ $dataPasien->tanggal_lahir->format('d F Y') }} ({{ $dataPasien->umur }} tahun)</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Jenis Kelamin:</strong></div>
                    <div class="col-sm-9">{{ $dataPasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Alamat:</strong></div>
                    <div class="col-sm-9">{{ $dataPasien->alamat }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3"><strong>No Telepon:</strong></div>
                    <div class="col-sm-9">{{ $dataPasien->no_telepon }}</div>
                </div>

                @if($dataPasien->email)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Email:</strong></div>
                    <div class="col-sm-9">{{ $dataPasien->email }}</div>
                </div>
                @endif

                @if($dataPasien->golongan_darah)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Golongan Darah:</strong></div>
                    <div class="col-sm-9">{{ $dataPasien->golongan_darah }}</div>
                </div>
                @endif

                @if($dataPasien->riwayat_penyakit)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Riwayat Penyakit:</strong></div>
                    <div class="col-sm-9">{{ $dataPasien->riwayat_penyakit }}</div>
                </div>
                @endif

                @if($dataPasien->alergi)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Alergi:</strong></div>
                    <div class="col-sm-9">{{ $dataPasien->alergi }}</div>
                </div>
                @endif

                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Dibuat:</strong></div>
                    <div class="col-sm-9">{{ $dataPasien->created_at->format('d/m/Y H:i') }}</div>
                </div>

                @if($dataPasien->updated_at != $dataPasien->created_at)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Diperbarui:</strong></div>
                    <div class="col-sm-9">{{ $dataPasien->updated_at->format('d/m/Y H:i') }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
