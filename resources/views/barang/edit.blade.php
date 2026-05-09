@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header d-flex align-items-center gap-2 py-3"
        style="background: linear-gradient(135deg, #1a1a2e, #16213e); border-radius: 12px 12px 0 0;">
        <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-light">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h5 class="mb-0 fw-bold text-white ms-1">
            Edit Barang
        </h5>
    </div>
    <div class="card-body p-4">

        <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT')

            {{-- Upload Foto --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Foto barang</label>
                <div class="border rounded p-4 text-center" style="border-style: dashed !important;">
                    <div class="mb-2">
                        @if($barang->foto)
                            <img id="fotoPreview"
                                src="{{ asset('storage/' . $barang->foto) }}"
                                alt="Foto {{ $barang->nama_barang }}"
                                class="img-fluid rounded" style="max-height: 200px;">
                        @else
                            <i class="bi bi-image fs-1 text-muted" id="iconPreview"></i>
                            <img id="fotoPreview" src="#" alt="Preview"
                                class="img-fluid rounded d-none" style="max-height: 200px;">
                        @endif
                    </div>
                    <p class="text-muted small mb-2">Klik untuk mengganti foto</p>
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
                <label class="form-label fw-semibold">Nama barang <span class="text-danger">*</span></label>
                <input type="text" name="nama_barang"
                    class="form-control @error('nama_barang') is-invalid @enderror"
                    value="{{ old('nama_barang', $barang->nama_barang) }}"
                    placeholder="Ayam nugget crispy">
                @error('nama_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kategori & Satuan --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori_id"
                        class="form-select @error('kategori_id') is-invalid @enderror">
                        <option value="">Pilih kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}"
                                {{ old('kategori_id', $barang->kategori_id) == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Satuan <span class="text-danger">*</span></label>
                    <input type="text" name="satuan"
                        class="form-control @error('satuan') is-invalid @enderror"
                        value="{{ old('satuan', $barang->satuan) }}"
                        placeholder="pcs">
                    @error('satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Jumlah Stok & Stok Minimum --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Jumlah stok <span class="text-danger">*</span></label>
                    <input type="number" name="jumlah_stok"
                        class="form-control @error('jumlah_stok') is-invalid @enderror"
                        value="{{ old('jumlah_stok', $barang->jumlah_stok) }}"
                        min="0">
                    @error('jumlah_stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Stok minimum <span class="text-danger">*</span></label>
                    <input type="number" name="stok_minimum"
                        class="form-control @error('stok_minimum') is-invalid @enderror"
                        value="{{ old('stok_minimum', $barang->stok_minimum) }}"
                        min="0">
                    @error('stok_minimum')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Harga Jual & Harga Beli --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Harga jual (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga_jual"
                        class="form-control @error('harga_jual') is-invalid @enderror"
                        value="{{ old('harga_jual', $barang->harga_jual) }}"
                        placeholder="35000">
                    @error('harga_jual')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Harga beli (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga_beli"
                        class="form-control @error('harga_beli') is-invalid @enderror"
                        value="{{ old('harga_beli', $barang->harga_beli) }}"
                        placeholder="28000">
                    @error('harga_beli')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Berat & Lokasi --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Berat / ukuran <span class="text-danger">*</span></label>
                    <input type="text" name="berat_ukuran"
                        class="form-control @error('berat_ukuran') is-invalid @enderror"
                        value="{{ old('berat_ukuran', $barang->berat_ukuran) }}"
                        placeholder="500 gram">
                    @error('berat_ukuran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Lokasi simpan <span class="text-danger">*</span></label>
                    <input type="text" name="lokasi_simpan"
                        class="form-control @error('lokasi_simpan') is-invalid @enderror"
                        value="{{ old('lokasi_simpan', $barang->lokasi_simpan) }}"
                        placeholder="Rak A-3">
                    @error('lokasi_simpan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                <textarea name="deskripsi" rows="3"
                    class="form-control @error('deskripsi') is-invalid @enderror"
                    placeholder="Deskripsi barang...">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Preview foto baru sebelum upload
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Sembunyikan icon kalau ada
                const icon = document.getElementById('iconPreview');
                if (icon) icon.classList.add('d-none');
                // Tampilkan preview
                const preview = document.getElementById('fotoPreview');
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection