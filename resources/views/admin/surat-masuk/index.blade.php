@extends('layouts.admin')

@section('title', 'Surat Masuk')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Surat Masuk</h1>
        <a href="{{ route('admin.surat-masuk.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Surat Masuk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Surat Masuk</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('admin.surat-masuk.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" 
                                   placeholder="Cari berdasarkan nomor surat, pengirim, atau perihal..." 
                                   value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <form method="GET" action="{{ route('admin.surat-masuk.index') }}">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="belum_dibaca" {{ request('status') == 'belum_dibaca' ? 'selected' : '' }}>Belum Dibaca</option>
                            <option value="sudah_dibaca" {{ request('status') == 'sudah_dibaca' ? 'selected' : '' }}>Sudah Dibaca</option>
                            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </form>
                </div>
                <div class="col-md-3">
                    <form method="GET" action="{{ route('admin.surat-masuk.index') }}">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="status" value="{{ request('status') }}">
                        <select name="tahun" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua Tahun</option>
                            @for($year = date('Y'); $year >= 2020; $year--)
                                <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
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
                            <th>Tanggal Masuk</th>
                            <th>No. Surat</th>
                            <th>Pengirim</th>
                            <th>Perihal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suratMasuk as $index => $surat)
                            <tr>
                                <td>{{ $suratMasuk->firstItem() + $index }}</td>
                                <td>{{ $surat->tanggal_masuk->format('d/m/Y') }}</td>
                                <td>{{ $surat->nomor_surat }}</td>
                                <td>{{ $surat->pengirim }}</td>
                                <td>{{ Str::limit($surat->perihal, 40) }}</td>
                                <td>
                                    @if($surat->status == 'belum_dibaca')
                                        <span class="badge badge-danger">Belum Dibaca</span>
                                    @elseif($surat->status == 'sudah_dibaca')
                                        <span class="badge badge-warning">Sudah Dibaca</span>
                                    @elseif($surat->status == 'diproses')
                                        <span class="badge badge-info">Diproses</span>
                                    @else
                                        <span class="badge badge-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.surat-masuk.show', $surat->id) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.surat-masuk.edit', $surat->id) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.surat-masuk.destroy', $surat->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data surat masuk</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    Menampilkan {{ $suratMasuk->firstItem() ?? 0 }} sampai {{ $suratMasuk->lastItem() ?? 0 }} 
                    dari {{ $suratMasuk->total() }} data
                </div>
                {{ $suratMasuk->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
