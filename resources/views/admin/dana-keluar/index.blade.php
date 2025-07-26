@extends('layouts.admin')

@section('title', 'Dana Keluar')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dana Keluar</h1>
        <a href="{{ route('admin.dana-keluar.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Dana Keluar
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
            <h6 class="m-0 font-weight-bold text-primary">Data Dana Keluar</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('admin.dana-keluar.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" 
                                   placeholder="Cari berdasarkan keperluan atau keterangan..." 
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
                    <form method="GET" action="{{ route('admin.dana-keluar.index') }}">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <select name="bulan" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua Bulan</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </form>
                </div>
                <div class="col-md-3">
                    <form method="GET" action="{{ route('admin.dana-keluar.index') }}">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="bulan" value="{{ request('bulan') }}">
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
                            <th>Tanggal</th>
                            <th>Keperluan</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($danaKeluar as $index => $dana)
                            <tr>
                                <td>{{ $danaKeluar->firstItem() + $index }}</td>
                                <td>{{ $dana->tanggal->format('d/m/Y') }}</td>
                                <td>{{ $dana->keperluan }}</td>
                                <td>Rp {{ number_format($dana->jumlah, 0, ',', '.') }}</td>
                                <td>{{ Str::limit($dana->keterangan, 50) }}</td>
                                <td>
                                    <a href="{{ route('admin.dana-keluar.show', $dana->id) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.dana-keluar.edit', $dana->id) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.dana-keluar.destroy', $dana->id) }}" 
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
                                <td colspan="6" class="text-center">Tidak ada data dana keluar</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    Menampilkan {{ $danaKeluar->firstItem() ?? 0 }} sampai {{ $danaKeluar->lastItem() ?? 0 }} 
                    dari {{ $danaKeluar->total() }} data
                </div>
                {{ $danaKeluar->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
