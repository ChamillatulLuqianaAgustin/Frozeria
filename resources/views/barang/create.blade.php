@extends('layouts.app')

@section('content')

<div class="card">
    {{-- Header form --}}
    <div class="card-header d-flex align-items-center gap-2 py-3"
        style="background: linear-gradient(135deg, #1a1a2e, #16213e); border-radius: 12px 12px 0 0;">
        <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-light">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h5 class="mb-0 fw-bold text-white ms-1">
            Tambah Barang Baru
        </h5>
    </div>
    <div class="card-body p-4">

        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Upload Foto --}}
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary small text-uppercase">Foto barang</label>
                <div class="border rounded p-4 text-center" style="border-style: dashed !important;">
                    <div id="previewContainer" class="mb-2">
                        <i class="bi bi-image fs-1 text-muted" id="iconPreview"></i>
                        <img id="fotoPreview" src="#" alt="Preview"
                            class="img-fluid rounded d-none" style="max-height: 200px;">
                    </div>
                    <p class="text-muted small mb-2">Klik untuk memilih foto</p>
                    <p class="text-muted small mb-2">Format: JPG, PNG — Maks. 2 MB</p>
                    <label for="foto" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-upload"></i> Pilih Foto
                    </label>
                    <input type="file" id="foto" name="foto"
                        class="d-none @error('foto') is-invalid @enderror"
                        accept="image/jpg,image/jpeg,image/png">
                    @error('foto')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Nama Barang --}}
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small text-uppercase">
                    Nama barang <span class="text-danger">*</span>
                </label>
                <input type="text" name="nama_barang"
                    class="form-control @error('nama_barang') is-invalid @enderror"
                    value="{{ old('nama_barang') }}"
                    placeholder="Masukkan Nama Barang">
                @error('nama_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kategori & Satuan --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">
                        Kategori <span class="text-danger">*</span>
                    </label>
                    <select name="kategori_id"
                        class="form-select @error('kategori_id') is-invalid @enderror">
                        <option value="">Pilih kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}"
                                {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">
                        Satuan <span class="text-danger">*</span>
                    </label>
                    <select name="satuan"
                        class="form-select @error('satuan') is-invalid @enderror">
                        <option value="">Pilih satuan</option>
                        @foreach(['pcs', 'pack', 'box', 'kaleng', 'botol'] as $sat)
                            <option value="{{ $sat }}" {{ old('satuan') == $sat ? 'selected' : '' }}>
                                {{ $sat }}
                            </option>
                        @endforeach
                    </select>
                    @error('satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Jumlah Stok & Stok Minimum --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">
                        Jumlah stok <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="jumlah_stok"
                        class="form-control @error('jumlah_stok') is-invalid @enderror"
                        value="{{ old('jumlah_stok', 0) }}"
                        min="0">
                    @error('jumlah_stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">
                        Stok minimum <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="stok_minimum"
                        class="form-control @error('stok_minimum') is-invalid @enderror"
                        value="{{ old('stok_minimum', 0) }}"
                        min="0">
                    @error('stok_minimum')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Harga Jual & Harga Beli --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">
                        Harga jual (Rp) <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="harga_jual"
                        class="form-control @error('harga_jual') is-invalid @enderror"
                        value="{{ old('harga_jual') }}"
                        placeholder="0">
                    @error('harga_jual')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">
                        Harga beli (Rp) <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="harga_beli"
                        class="form-control @error('harga_beli') is-invalid @enderror"
                        value="{{ old('harga_beli') }}"
                        placeholder="0">
                    @error('harga_beli')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Berat & Lokasi --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">
                        Berat / ukuran <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <input type="number" name="berat_nilai"
                            class="form-control @error('berat_ukuran') is-invalid @enderror"
                            value="{{ old('berat_nilai') }}"
                            placeholder="Contoh: 500">
                        <select name="berat_satuan" class="form-select" style="max-width: 100px;">
                            @foreach(['gram', 'kg', 'ml', 'liter', 'ons'] as $sat)
                                <option value="{{ $sat }}" {{ old('berat_satuan') == $sat ? 'selected' : '' }}>
                                    {{ $sat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('berat_ukuran')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">
                        Lokasi simpan <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="lokasi_simpan"
                        class="form-control @error('lokasi_simpan') is-invalid @enderror"
                        value="{{ old('lokasi_simpan') }}"
                        placeholder="Masukkan Lokasi Simpan (Contoh: Rak A-3)">
                    @error('lokasi_simpan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary small text-uppercase">
                    Deskripsi <span class="text-danger">*</span>
                </label>
                <textarea name="deskripsi" rows="3"
                    class="form-control @error('deskripsi') is-invalid @enderror"
                    placeholder="Deskripsi Barang...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-lg me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i> Simpan Barang
                </button>
            </div>

        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('iconPreview').classList.add('d-none');
                document.getElementById('fotoPreview').src = e.target.result;
                document.getElementById('fotoPreview').classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection