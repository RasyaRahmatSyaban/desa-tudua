@extends('layouts.admin')

@section('title', 'Edit Surat Keluar')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Surat Keluar</h1>
        <a href="{{ route('admin.surat-keluar.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Surat Keluar</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.surat-keluar.update', $suratKeluar->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_surat">Nomor Surat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" 
                                   id="nomor_surat" name="nomor_surat" 
                                   value="{{ old('nomor_surat', $suratKeluar->nomor_surat) }}" required>
                            @error('nomor_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="penerima">Penerima <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('penerima') is-invalid @enderror" 
                                   id="penerima" name="penerima" 
                                   value="{{ old('penerima', $suratKeluar->penerima) }}" required>
                            @error('penerima')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="perihal">Perihal <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('perihal') is-invalid @enderror" 
                                   id="perihal" name="perihal" 
                                   value="{{ old('perihal', $suratKeluar->perihal) }}" required>
                            @error('perihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_kirim">Tanggal Kirim <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_kirim') is-invalid @enderror" 
                                   id="tanggal_kirim" name="tanggal_kirim" 
                                   value="{{ old('tanggal_kirim', $suratKeluar->tanggal_kirim ? \Carbon\Carbon::parse($suratKeluar->tanggal_kirim)->format('Y-m-d') : '') }}" required>
                            @error('tanggal_kirim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="file">File Surat</label>
                    @if($suratKeluar->file)
                        <div class="mb-2">
                            <a href="{{ $suratKeluar->file }}" target="_blank" class="btn btn-sm btn-info">
                                <i class="fas fa-file-pdf"></i> Lihat File Saat Ini
                            </a>
                        </div>
                    @endif
                    <input type="file" class="form-control-file @error('file') is-invalid @enderror" 
                           id="file" name="file" accept=".pdf,.doc,.docx">
                    <small class="form-text text-muted">Upload file baru jika ingin mengganti (PDF, DOC, DOCX - Max 5MB)</small>
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
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
