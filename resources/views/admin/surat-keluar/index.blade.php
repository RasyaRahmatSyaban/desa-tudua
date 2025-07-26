@extends('layouts.admin')

@section('title', 'Surat Keluar')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Surat Keluar</h1>
        <a href="{{ route('admin.surat-keluar.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Surat Keluar
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
            <h6 class="m-0 font-weight-bold text-primary">Data Surat Keluar</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <form method="GET" action="{{ route('admin.surat-keluar.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari nomor surat, tujuan..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <form method="GET" action="{{ route('admin.surat-keluar.index') }}">
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="terkirim" {{ request('status') == 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                            <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        </select>
                    </form>
                </div>
                <div class="col-md-3">
                    <form method="GET" action="{{ route('admin.surat-keluar.index') }}">
                        <select name="tahun" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua Tahun</option>
                            @for($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal</th>
                            <th>Tujuan</th>
                            <th>Perihal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suratKeluar ?? [] as $index => $surat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $surat->nomor_surat }}</td>
                            <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d/m/Y') }}</td>
                            <td>{{ $surat->tujuan }}</td>
                            <td>{{ Str::limit($surat->perihal, 50) }}</td>
                            <td>
                                @if($surat->status == 'draft')
                                    <span class="badge badge-secondary">Draft</span>
                                @elseif($surat->status == 'terkirim')
                                    <span class="badge badge-warning">Terkirim</span>
                                @elseif($surat->status == 'diterima')
                                    <span class="badge badge-success">Diterima</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.surat-keluar.show', $surat->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.surat-keluar.edit', $surat->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.surat-keluar.destroy', $surat->id) }}" method="POST" class="d-inline">
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
                            <td colspan="7" class="text-center">Tidak ada data surat keluar</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(isset($suratKeluar) && $suratKeluar->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $suratKeluar->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
