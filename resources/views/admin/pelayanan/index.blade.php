@extends('layouts.admin')

@section('title', 'Data Pelayanan')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Data Pelayanan</h1>
            <p class="mb-0 text-muted">Kelola data pelayanan desa</p>
        </div>
        <a href="{{ route('admin.pelayanan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Pelayanan
        </a>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter & Search -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.pelayanan.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Pencarian</label>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Cari nama pelayanan..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            <option value="Administrasi" {{ request('kategori') == 'Administrasi' ? 'selected' : '' }}>Administrasi</option>
                            <option value="Kependudukan" {{ request('kategori') == 'Kependudukan' ? 'selected' : '' }}>Kependudukan</option>
                            <option value="Kesehatan" {{ request('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                            <option value="Pendidikan" {{ request('kategori') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                            <option value="Sosial" {{ request('kategori') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Tidak Aktif" {{ request('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-search me-1"></i>Filter
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama Pelayanan</th>
                            <th width="15%">Kategori</th>
                            <th width="20%">Persyaratan</th>
                            <th width="10%">Biaya</th>
                            <th width="10%">Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelayanans as $index => $pelayanan)
                        <tr>
                            <td>{{ $pelayanans->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-bold">{{ $pelayanan->nama }}</div>
                                <small class="text-muted">{{ Str::limit($pelayanan->deskripsi, 50) }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $pelayanan->kategori }}</span>
                            </td>
                            <td>
                                <small>{{ Str::limit($pelayanan->persyaratan, 60) }}</small>
                            </td>
                            <td>
                                @if($pelayanan->biaya > 0)
                                    <span class="text-success fw-bold">Rp {{ number_format($pelayanan->biaya, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-primary fw-bold">Gratis</span>
                                @endif
                            </td>
                            <td>
                                @if($pelayanan->status == 'Aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.pelayanan.show', $pelayanan->id) }}" 
                                       class="btn btn-sm btn-outline-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.pelayanan.edit', $pelayanan->id) }}" 
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pelayanan.destroy', $pelayanan->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                title="Hapus" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p>Tidak ada data pelayanan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($pelayanans->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $pelayanans->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
