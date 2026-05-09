@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2 py-3"
                style="background: linear-gradient(135deg, #1a1a2e, #16213e); border-radius: 12px 12px 0 0;">
                <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-outline-light">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h5 class="mb-0 fw-bold text-white ms-1">
                    Tambah Kategori
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary small text-uppercase">
                            Nama kategori <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="nama_kategori"
                            class="form-control form-control-lg @error('nama_kategori') is-invalid @enderror"
                            value="{{ old('nama_kategori') }}"
                            placeholder="Contoh: Seafood, Sayuran, Siap Saji...">
                        @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary small text-uppercase">
                            Deskripsi <span class="text-danger">*</span>
                        </label>
                        <textarea name="deskripsi" rows="4"
                            class="form-control @error('deskripsi') is-invalid @enderror"
                            placeholder="Deskripsi kategori ini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                        <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection