@extends('layouts.admin')

@section('title', 'Edit Surat Masuk')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Surat Masuk</h1>
        <a href="{{ route('admin.surat-masuk.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Surat Masuk</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.surat-masuk.update', $suratMasuk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_surat">Nomor Surat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" 
                                   id="nomor_surat" name="nomor_surat" 
                                   value="{{ old('nomor_surat', $suratMasuk->nomor_surat) }}" required>
                            @error('nomor_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pengirim">Pengirim <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('pengirim') is-invalid @enderror" 
                                   id="pengirim" name="pengirim" 
                                   value="{{ old('pengirim', $suratMasuk->pengirim) }}" required>
                            @error('pengirim')
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
                                   value="{{ old('perihal', $suratMasuk->perihal) }}" required>
                            @error('perihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_terima">Tanggal Terima <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_terima') is-invalid @enderror" 
                                   id="tanggal_terima" name="tanggal_terima" 
                                   value="{{ old('tanggal_terima', $suratMasuk->tanggal_terima ? \Carbon\Carbon::parse($suratMasuk->tanggal_terima)->format('Y-m-d') : '') }}" required>
                            @error('tanggal_terima')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="file">File Surat</label>
                    @if($suratMasuk->file)
                        <div class="mb-2">
                            <a href="{{ $suratMasuk->file }}" target="_blank" class="btn btn-sm btn-info">
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
                    <a href="{{ route('admin.surat-masuk.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
