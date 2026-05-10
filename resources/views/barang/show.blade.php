@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3"
        style="background: linear-gradient(135deg, #1a1a2e, #16213e); border-radius: 12px 12px 0 0;">
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-light">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h5 class="mb-0 fw-bold text-white ms-1">
                Detail Barang
            </h5>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-warning text-white">
                <i class="bi bi-pencil me-1"></i> Edit Barang
            </a>
            <button class="btn btn-sm btn-danger"
                onclick="konfirmasiHapus({{ $barang->id }}, '{{ $barang->nama_barang }}')">
                <i class="bi bi-trash me-1"></i> Hapus
            </button>
        </div>
    </div>
    <div class="card-body p-4">

        {{-- Foto & Nama --}}
        <div class="d-flex align-items-start gap-4 mb-4">
            <div class="border rounded p-2" style="width: 120px; height: 120px;">
                @if($barang->foto)
                    <img src="{{ url('storage/' . $barang->foto) }}"
                        alt="Foto {{ $barang->nama_barang }}"
                        class="img-fluid rounded" style="width:100%; height:100%; object-fit:cover;">
                @else
                    <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                        <i class="bi bi-image fs-1"></i>
                    </div>
                @endif
            </div>
            <div>
                <h4 class="fw-bold mb-1">{{ $barang->nama_barang }}</h4>
                @if($barang->kategori)
                    <span class="badge bg-secondary">{{ $barang->kategori->nama_kategori }}</span>
                @else
                    <span class="text-muted">Tidak berkategori</span>
                @endif
            </div>
        </div>

        {{-- Detail Info --}}
        <div class="row g-3">
            <div class="col-md-6">
                <div class="border rounded p-3">
                    <div class="text-muted small">Jumlah stok</div>
                    <div class="fw-bold">{{ $barang->jumlah_stok }} {{ $barang->satuan }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded p-3">
                    <div class="text-muted small">Stok minimum</div>
                    <div class="fw-bold">{{ $barang->stok_minimum ?? '-' }} {{ $barang->satuan }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded p-3">
                    <div class="text-muted small">Harga jual</div>
                    <div class="fw-bold">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded p-3">
                    <div class="text-muted small">Harga beli</div>
                    <div class="fw-bold">Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded p-3">
                    <div class="text-muted small">Berat / ukuran</div>
                    <div class="fw-bold">{{ $barang->berat_ukuran ?? '-' }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded p-3">
                    <div class="text-muted small">Lokasi simpan</div>
                    <div class="fw-bold">{{ $barang->lokasi_simpan ?? '-' }}</div>
                </div>
            </div>
            <div class="col-12">
                <div class="border rounded p-3">
                    <div class="text-muted small">Deskripsi</div>
                    <div class="fw-bold">{{ $barang->deskripsi ?? '-' }}</div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div class="modal fade" id="modalHapus" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex align-items-start gap-3">
                    <i class="bi bi-exclamation-triangle text-warning fs-3"></i>
                    <div>
                        <h5 class="fw-bold">Hapus barang?</h5>
                        <p class="text-muted mb-0">
                            Data <strong id="namaBarangHapus"></strong> akan dihapus secara
                            permanen dari sistem. Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="formHapus" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function konfirmasiHapus(id, nama) {
        document.getElementById('namaBarangHapus').innerText = nama;
        document.getElementById('formHapus').action = '{{ url("barang") }}/' + id;
        new bootstrap.Modal(document.getElementById('modalHapus')).show();
    }
</script>
@endsection