@extends('layouts.admin')

@section('title', 'Edit Pelayanan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.pelayanan.index') }}">Pelayanan</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Pelayanan</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Edit Pelayanan</h4>
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

                    <form action="{{ route('admin.pelayanan.update', $pelayanan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="nama_layanan" class="form-label">Nama Layanan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_layanan') is-invalid @enderror" 
                                           id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan', $pelayanan->nama_layanan) }}" required>
                                    @error('nama_layanan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="administrasi" {{ old('kategori', $pelayanan->kategori) == 'administrasi' ? 'selected' : '' }}>Administrasi</option>
                                        <option value="kependudukan" {{ old('kategori', $pelayanan->kategori) == 'kependudukan' ? 'selected' : '' }}>Kependudukan</option>
                                        <option value="perizinan" {{ old('kategori', $pelayanan->kategori) == 'perizinan' ? 'selected' : '' }}>Perizinan</option>
                                        <option value="sosial" {{ old('kategori', $pelayanan->kategori) == 'sosial' ? 'selected' : '' }}>Sosial</option>
                                        <option value="kesehatan" {{ old('kategori', $pelayanan->kategori) == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                        <option value="pendidikan" {{ old('kategori', $pelayanan->kategori) == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                        <option value="lainnya" {{ old('kategori', $pelayanan->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $pelayanan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="persyaratan" class="form-label">Persyaratan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('persyaratan') is-invalid @enderror" 
                                      id="persyaratan" name="persyaratan" rows="5" required 
                                      placeholder="Tuliskan setiap persyaratan dalam baris baru">{{ old('persyaratan', $pelayanan->persyaratan) }}</textarea>
                            <small class="text-muted">Tuliskan setiap persyaratan dalam baris baru</small>
                            @error('persyaratan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prosedur" class="form-label">Prosedur <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('prosedur') is-invalid @enderror" 
                                      id="prosedur" name="prosedur" rows="5" required 
                                      placeholder="Tuliskan setiap langkah prosedur dalam baris baru">{{ old('prosedur', $pelayanan->prosedur) }}</textarea>
                            <small class="text-muted">Tuliskan setiap langkah prosedur dalam baris baru</small>
                            @error('prosedur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="waktu_pelayanan" class="form-label">Waktu Pelayanan</label>
                                    <input type="text" class="form-control @error('waktu_pelayanan') is-invalid @enderror" 
                                           id="waktu_pelayanan" name="waktu_pelayanan" 
                                           value="{{ old('waktu_pelayanan', $pelayanan->waktu_pelayanan) }}" 
                                           placeholder="contoh: 1-3 hari kerja">
                                    @error('waktu_pelayanan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="biaya" class="form-label">Biaya</label>
                                    <input type="text" class="form-control @error('biaya') is-invalid @enderror" 
                                           id="biaya" name="biaya" value="{{ old('biaya', $pelayanan->biaya) }}" 
                                           placeholder="contoh: Gratis atau Rp 10.000">
                                    @error('biaya')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="aktif" {{ old('status', $pelayanan->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="tidak_aktif" {{ old('status', $pelayanan->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        <option value="maintenance" {{ old('status', $pelayanan->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                                    <input type="text" class="form-control @error('penanggung_jawab') is-invalid @enderror" 
                                           id="penanggung_jawab" name="penanggung_jawab" 
                                           value="{{ old('penanggung_jawab', $pelayanan->penanggung_jawab) }}">
                                    @error('penanggung_jawab')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kontak" class="form-label">Kontak</label>
                                    <input type="text" class="form-control @error('kontak') is-invalid @enderror" 
                                           id="kontak" name="kontak" value="{{ old('kontak', $pelayanan->kontak) }}" 
                                           placeholder="Nomor telepon atau email">
                                    @error('kontak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jam_pelayanan" class="form-label">Jam Pelayanan</label>
                                    <input type="text" class="form-control @error('jam_pelayanan') is-invalid @enderror" 
                                           id="jam_pelayanan" name="jam_pelayanan" 
                                           value="{{ old('jam_pelayanan', $pelayanan->jam_pelayanan) }}" 
                                           placeholder="contoh: Senin-Jumat 08:00-16:00">
                                    @error('jam_pelayanan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi Pelayanan</label>
                                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                           id="lokasi" name="lokasi" value="{{ old('lokasi', $pelayanan->lokasi) }}" 
                                           placeholder="contoh: Kantor Desa, Ruang Pelayanan">
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan Tambahan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                      id="catatan" name="catatan" rows="3" 
                                      placeholder="Informasi tambahan yang perlu diketahui">{{ old('catatan', $pelayanan->catatan) }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.pelayanan.index') }}" class="btn btn-secondary">
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
