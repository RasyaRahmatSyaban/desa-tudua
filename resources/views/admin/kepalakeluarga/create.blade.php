@extends('layouts.admin')

@section('title', 'Tambah Kepala Keluarga')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Kepala Keluarga</h1>
        <a href="{{ route('admin.kepala-keluarga.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Kepala Keluarga</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kepala-keluarga.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_kk">Nomor Kartu Keluarga <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('no_kk') is-invalid @enderror" 
                                   id="no_kk" name="no_kk" value="{{ old('no_kk') }}" required>
                            @error('no_kk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nik_kepala_keluarga">NIK Kepala Keluarga <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nik_kepala_keluarga') is-invalid @enderror" 
                                   id="nik_kepala_keluarga" name="nik_kepala_keluarga" value="{{ old('nik_kepala_keluarga') }}" required>
                            @error('nik_kepala_keluarga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nama_kepala_keluarga">Nama Kepala Keluarga <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_kepala_keluarga') is-invalid @enderror" 
                           id="nama_kepala_keluarga" name="nama_kepala_keluarga" value="{{ old('nama_kepala_keluarga') }}" required>
                    @error('nama_kepala_keluarga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                              id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rt">RT <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rt') is-invalid @enderror" 
                                   id="rt" name="rt" value="{{ old('rt') }}" required>
                            @error('rt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rw">RW <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rw') is-invalid @enderror" 
                                   id="rw" name="rw" value="{{ old('rw') }}" required>
                            @error('rw')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dusun">Dusun <span class="text-danger">*</span></label>
                            <select class="form-control @error('dusun') is-invalid @enderror" id="dusun" name="dusun" required>
                                <option value="">Pilih Dusun</option>
                                <option value="Dusun 1" {{ old('dusun') == 'Dusun 1' ? 'selected' : '' }}>Dusun 1</option>
                                <option value="Dusun 2" {{ old('dusun') == 'Dusun 2' ? 'selected' : '' }}>Dusun 2</option>
                                <option value="Dusun 3" {{ old('dusun') == 'Dusun 3' ? 'selected' : '' }}>Dusun 3</option>
                            </select>
                            @error('dusun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_pos">Kode Pos</label>
                            <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" 
                                   id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}">
                            @error('kode_pos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_anggota">Jumlah Anggota Keluarga</label>
                            <input type="number" class="form-control @error('jumlah_anggota') is-invalid @enderror" 
                                   id="jumlah_anggota" name="jumlah_anggota" value="{{ old('jumlah_anggota', 1) }}" min="1">
                            @error('jumlah_anggota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_terdaftar">Tanggal Terdaftar</label>
                            <input type="date" class="form-control @error('tanggal_terdaftar') is-invalid @enderror" 
                                   id="tanggal_terdaftar" name="tanggal_terdaftar" value="{{ old('tanggal_terdaftar', date('Y-m-d')) }}">
                            @error('tanggal_terdaftar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="pindah" {{ old('status') == 'pindah' ? 'selected' : '' }}>Pindah</option>
                                <option value="meninggal" {{ old('status') == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                            </select>
                            @error('status')
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
                    <a href="{{ route('admin.kepala-keluarga.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
