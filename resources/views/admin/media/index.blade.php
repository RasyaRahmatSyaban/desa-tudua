@extends('layouts.admin')

@section('title', 'Media Gallery')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Media Gallery</h1>
            <p class="mb-0 text-muted">Kelola foto dan video kegiatan desa</p>
        </div>
        <a href="{{ route('admin.media.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Upload Media
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
            <form method="GET" action="{{ route('admin.media.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Pencarian</label>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Cari judul media..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tipe Media</label>
                        <select name="tipe" class="form-select">
                            <option value="">Semua Tipe</option>
                            <option value="foto" {{ request('tipe') == 'foto' ? 'selected' : '' }}>Foto</option>
                            <option value="video" {{ request('tipe') == 'video' ? 'selected' : '' }}>Video</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            <option value="Kegiatan" {{ request('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                            <option value="Pembangunan" {{ request('kategori') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                            <option value="Budaya" {{ request('kategori') == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                            <option value="Sosial" {{ request('kategori') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                            <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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

    <!-- Media Grid -->
    <div class="row">
        @forelse($medias as $media)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="position-relative">
                    @if($media->tipe == 'foto')
                        <img src="{{ asset('storage/' . $media->file_path) }}" 
                             class="card-img-top" style="height: 200px; object-fit: cover;" 
                             alt="{{ $media->judul }}">
                        <span class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-success">
                                <i class="fas fa-image me-1"></i>Foto
                            </span>
                        </span>
                    @else
                        <div class="bg-dark d-flex align-items-center justify-content-center" 
                             style="height: 200px;">
                            <i class="fas fa-play-circle text-white" style="font-size: 3rem;"></i>
                        </div>
                        <span class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-danger">
                                <i class="fas fa-video me-1"></i>Video
                            </span>
                        </span>
                    @endif
                </div>
                
                <div class="card-body">
                    <h6 class="card-title">{{ $media->judul }}</h6>
                    <p class="card-text small text-muted">
                        {{ Str::limit($media->deskripsi, 80) }}
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            {{ $media->created_at->format('d M Y') }}
                        </small>
                        <span class="badge bg-info">{{ $media->kategori }}</span>
                    </div>
                </div>
                
                <div class="card-footer bg-transparent">
                    <div class="btn-group w-100" role="group">
                        <button type="button" class="btn btn-sm btn-outline-info" 
                                data-bs-toggle="modal" data-bs-target="#viewModal{{ $media->id }}">
                            <i class="fas fa-eye"></i>
                        </button>
                        <a href="{{ route('admin.media.edit', $media->id) }}" 
                           class="btn btn-sm btn-outline-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.media.destroy', $media->id) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Modal -->
        <div class="modal fade" id="viewModal{{ $media->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $media->judul }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @if($media->tipe == 'foto')
                            <img src="{{ asset('storage/' . $media->file_path) }}" 
                                 class="img-fluid mb-3" alt="{{ $media->judul }}">
                        @else
                            <video controls class="w-100 mb-3">
                                <source src="{{ asset('storage/' . $media->file_path) }}" type="video/mp4">
                                Browser Anda tidak mendukung video.
                            </video>
                        @endif
                        
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Kategori:</strong> {{ $media->kategori }}<br>
                                <strong>Tipe:</strong> {{ ucfirst($media->tipe) }}<br>
                                <strong>Tanggal:</strong> {{ $media->created_at->format('d F Y') }}
                            </div>
                            <div class="col-md-6">
                                <strong>Ukuran File:</strong> {{ number_format(Storage::size('public/' . $media->file_path) / 1024, 2) }} KB
                            </div>
                        </div>
                        
                        @if($media->deskripsi)
                            <hr>
                            <strong>Deskripsi:</strong>
                            <p>{{ $media->deskripsi }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada media</h5>
                    <p class="text-muted">Upload foto atau video pertama Anda</p>
                    <a href="{{ route('admin.media.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Upload Media
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($medias->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $medias->links() }}
        </div>
    @endif
</div>
@endsection
