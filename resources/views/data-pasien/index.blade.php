@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Pasien</h2>
    <a href="{{ route('data-pasien.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Pasien
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataPasien as $index => $pasien)
                        <tr>
                            <td>{{ $dataPasien->firstItem() + $index }}</td>
                            <td>{{ $pasien->nama }}</td>
                            <td>{{ $pasien->nik }}</td>
                            <td>{{ $pasien->tanggal_lahir->format('d/m/Y') }}</td>
                            <td>{{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $pasien->no_telepon }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('data-pasien.show', $pasien) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('data-pasien.edit', $pasien) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('data-pasien.destroy', $pasien) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data pasien</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $dataPasien->links() }}
        </div>
    </div>
</div>
@endsection
