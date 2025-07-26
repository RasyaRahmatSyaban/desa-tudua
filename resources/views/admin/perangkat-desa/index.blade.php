@extends('layouts.admin')

@section('title', 'Perangkat Desa')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perangkat Desa</h1>
        <a href="{{ route('admin.perangkat-desa.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Perangkat Desa
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Perangkat Desa</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <form method="GET" action="{{ route('admin.perangkat-desa.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari nama, jabatan..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <form method="GET" action="{{ route('admin.perangkat-desa.index') }}">
                        <select name="jabatan" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua Jabatan</option>
                            <option value="Kepala Desa" {{ request('jabatan') == 'Kepala Desa' ? 'selected' : '' }}>Kepala Desa</option>
                            <option value="Sekretaris Desa" {{ request('jabatan') == 'Sekretaris Desa' ? 'selected' : '' }}>Sekretaris Desa</option>
                            <option value="Kepala Urusan" {{ request('jabatan') == 'Kepala Urusan' ? 'selected' : '' }}>Kepala Urusan</option>
                            <option value="Kepala Dusun" {{ request('jabatan') == 'Kepala Dusun' ? 'selected' : '' }}>Kepala Dusun</option>
                            <option value="Staf" {{ request('jabatan') == 'Staf' ? 'selected' : '' }}>Staf</option>
                        </select>
                    </form>
                </div>
                <div class="col-md-3">
                    <form method="GET" action="{{ route('admin.perangkat-desa.index') }}">
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="non-aktif" {{ request('status') == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>NIP</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($perangkatDesa ?? [] as $index => $perangkat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($perangkat->foto)
                                    <img src="{{ asset('storage/' . $perangkat->foto) }}" alt="Foto" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 4px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $perangkat->nama }}</td>
                            <td>{{ $perangkat->jabatan }}</td>
                            <td>{{ $perangkat->nip ?? '-' }}</td>
                            <td>{{ $perangkat->telepon ?? '-' }}</td>
                            <td>
                                @if($perangkat->status == 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-secondary">Non-Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.perangkat-desa.show', $perangkat->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.perangkat-desa.edit', $perangkat->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.perangkat-desa.destroy', $perangkat->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data perangkat desa</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(isset($perangkatDesa) && $perangkatDesa->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $perangkatDesa->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
