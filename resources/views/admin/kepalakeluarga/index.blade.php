@extends('layouts.admin')

@section('title', 'Kepala Keluarga')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kepala Keluarga</h1>
        <a href="{{ route('admin.kepala-keluarga.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kepala Keluarga
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
            <h6 class="m-0 font-weight-bold text-primary">Data Kepala Keluarga</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <form method="GET" action="{{ route('admin.kepala-keluarga.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari nama, NIK, No KK..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <form method="GET" action="{{ route('admin.kepala-keluarga.index') }}">
                        <select name="dusun" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua Dusun</option>
                            <option value="Dusun 1" {{ request('dusun') == 'Dusun 1' ? 'selected' : '' }}>Dusun 1</option>
                            <option value="Dusun 2" {{ request('dusun') == 'Dusun 2' ? 'selected' : '' }}>Dusun 2</option>
                            <option value="Dusun 3" {{ request('dusun') == 'Dusun 3' ? 'selected' : '' }}>Dusun 3</option>
                        </select>
                    </form>
                </div>
                <div class="col-md-3">
                    <form method="GET" action="{{ route('admin.kepala-keluarga.index') }}">
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="pindah" {{ request('status') == 'pindah' ? 'selected' : '' }}>Pindah</option>
                            <option value="meninggal" {{ request('status') == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No KK</th>
                            <th>Nama Kepala Keluarga</th>
                            <th>NIK</th>
                            <th>Alamat</th>
                            <th>Jumlah Anggota</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kepalaKeluarga ?? [] as $index => $kk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kk->no_kk }}</td>
                            <td>{{ $kk->nama_kepala_keluarga }}</td>
                            <td>{{ $kk->nik_kepala_keluarga }}</td>
                            <td>{{ $kk->alamat }}</td>
                            <td>
                                <span class="badge badge-info">{{ $kk->jumlah_anggota ?? 0 }} orang</span>
                            </td>
                            <td>
                                @if($kk->status == 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @elseif($kk->status == 'pindah')
                                    <span class="badge badge-warning">Pindah</span>
                                @elseif($kk->status == 'meninggal')
                                    <span class="badge badge-danger">Meninggal</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.kepala-keluarga.show', $kk->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.kepala-keluarga.edit', $kk->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.kepala-keluarga.destroy', $kk->id) }}" method="POST" class="d-inline">
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
                            <td colspan="8" class="text-center">Tidak ada data kepala keluarga</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(isset($kepalaKeluarga) && $kepalaKeluarga->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $kepalaKeluarga->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
