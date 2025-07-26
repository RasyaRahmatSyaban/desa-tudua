@extends('layouts.admin')

@section('title', 'Tambah Surat Keluar')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Surat Keluar</h1>
        <a href="{{ route('admin.surat-keluar.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Surat Keluar</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.surat-keluar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_surat">Nomor Surat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" 
                                   id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" required>
                            @error('nomor_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_surat">Tanggal Surat <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_surat') is-invalid @enderror" 
                                   id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat') }}" required>
                            @error('tanggal_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tujuan">Tujuan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('tujuan') is-invalid @enderror" 
                                   id="tujuan" name="tujuan" value="{{ old('tujuan') }}" required>
                            @error('tujuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat_tujuan">Alamat Tujuan</label>
                            <input type="text" class="form-control @error('alamat_tujuan') is-invalid @enderror" 
                                   id="alamat_tujuan" name="alamat_tujuan" value="{{ old('alamat_tujuan') }}">
                            @error('alamat_tujuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="perihal">Perihal <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('perihal') is-invalid @enderror" 
                           id="perihal" name="perihal" value="{{ old('perihal') }}" required>
                    @error('perihal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="isi_surat">Isi Surat <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('isi_surat') is-invalid @enderror" 
                              id="isi_surat" name="isi_surat" rows="8" required>{{ old('isi_surat') }}</textarea>
                    @error('isi_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="penandatangan">Penandatangan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('penandatangan') is-invalid @enderror" 
                                   id="penandatangan" name="penandatangan" value="{{ old('penandatangan') }}" required>
                            @error('penandatangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jabatan_penandatangan">Jabatan Penandatangan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('jabatan_penandatangan') is-invalid @enderror" 
                                   id="jabatan_penandatangan" name="jabatan_penandatangan" value="{{ old('jabatan_penandatangan') }}" required>
                            @error('jabatan_penandatangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="terkirim" {{ old('status') == 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                                <option value="diterima" {{ old('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file_surat">File Surat (PDF)</label>
                            <input type="file" class="form-control-file @error('file_surat') is-invalid @enderror" 
                                   id="file_surat" name="file_surat" accept=".pdf">
                            <small class="form-text text-muted">Upload file PDF maksimal 2MB</small>
                            @error('file_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                              id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.surat-keluar.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
