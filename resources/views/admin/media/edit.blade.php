@extends('layouts.admin')

@section('title', 'Edit Media')
@section('page-title', 'Edit Media')
@section('page-description', 'Ubah data media yang sudah ada')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.media.index') }}">Media</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Media</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Edit Media</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.media.update', $media->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Media <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                           id="judul" name="judul" value="{{ old('judul', $media->judul) }}" required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="tipe" class="form-label">Tipe Media <span class="text-danger">*</span></label>
                                    <select class="form-select @error('tipe') is-invalid @enderror" id="tipe" name="tipe" required>
                                        <option value="">Pilih Tipe</option>
                                        <option value="foto" {{ old('tipe', $media->tipe) == 'foto' ? 'selected' : '' }}>Foto</option>
                                        <option value="video" {{ old('tipe', $media->tipe) == 'video' ? 'selected' : '' }}>Video</option>
                                        <option value="dokumen" {{ old('tipe', $media->tipe) == 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                                    </select>
                                    @error('tipe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $media->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori">
                                        <option value="">Pilih Kategori</option>
                                        <option value="kegiatan" {{ old('kategori', $media->kategori) == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                        <option value="pembangunan" {{ old('kategori', $media->kategori) == 'pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                                        <option value="budaya" {{ old('kategori', $media->kategori) == 'budaya' ? 'selected' : '' }}>Budaya</option>
                                        <option value="sosial" {{ old('kategori', $media->kategori) == 'sosial' ? 'selected' : '' }}>Sosial</option>
                                        <option value="ekonomi" {{ old('kategori', $media->kategori) == 'ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                                        <option value="pendidikan" {{ old('kategori', $media->kategori) == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                        <option value="kesehatan" {{ old('kategori', $media->kategori) == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                        <option value="lainnya" {{ old('kategori', $media->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                           id="tanggal" name="tanggal" 
                                           value="{{ old('tanggal', $media->tanggal ? $media->tanggal->format('Y-m-d') : '') }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="file" class="form-label">File Media</label>
                                    <input type="file" class="form-control @error('file') is-invalid @enderror" 
                                           id="file" name="file" accept="image/*,video/*,.pdf,.doc,.docx">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah file. Format: JPG, PNG, MP4, PDF, DOC (Max: 10MB)</small>
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="aktif" {{ old('status', $media->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="tidak_aktif" {{ old('status', $media->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if($media->file_path)
                        <div class="mb-3">
                            <label class="form-label">File Saat Ini</label>
                            <div class="border rounded p-3">
                                @if($media->tipe == 'foto')
                                    <img src="{{ Storage::url($media->file_path) }}" alt="{{ $media->judul }}" 
                                         class="img-thumbnail" style="max-height: 200px;">
                                @elseif($media->tipe == 'video')
                                    <video controls style="max-height: 200px;">
                                        <source src="{{ Storage::url($media->file_path) }}" type="video/mp4">
                                        Browser Anda tidak mendukung video.
                                    </video>
                                @else
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-alt fa-2x text-primary me-2"></i>
                                        <div>
                                            <strong>{{ basename($media->file_path) }}</strong><br>
                                            <small class="text-muted">{{ $media->tipe }}</small>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <input type="text" class="form-control @error('tags') is-invalid @enderror" 
                                   id="tags" name="tags" value="{{ old('tags', $media->tags) }}" 
                                   placeholder="Pisahkan dengan koma (contoh: desa, kegiatan, pembangunan)">
                            @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
