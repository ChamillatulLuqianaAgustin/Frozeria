@extends('layouts.app')

@section('content')

{{-- Cards Info --}}
<div class="row mb-4 g-3">
    {{-- Card Total Barang --}}
    <div class="col-md-3">
        <div class="card card-stat h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-box" style="background:#e0f2fe;">
                    <i class="bi bi-box-seam" style="color:#0284c7;"></i>
                </div>
                <div>
                    <div class="text-muted small">Total barang</div>
                    <div class="fs-3 fw-bold text-dark">{{ $totalBarang }}</div>
                </div>
            </div>
        </div>
    </div>
    {{-- Card Total Kategori --}}
    <div class="col-md-3">
        <div class="card card-stat h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-box" style="background:#dcfce7;">
                    <i class="bi bi-tags" style="color:#16a34a;"></i>
                </div>
                <div>
                    <div class="text-muted small">Total kategori</div>
                    <div class="fs-3 fw-bold text-dark">{{ $totalKategori }}</div>
                </div>
            </div>
        </div>
    </div>
    {{-- Card Stok Menipis (stok > 0 dan < 20) --}}
    <div class="col-md-3">
        <div class="card card-stat h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-box" style="background:#fef9c3;">
                    <i class="bi bi-exclamation-triangle" style="color:#ca8a04;"></i>
                </div>
                <div>
                    <div class="text-muted small">Stok menipis</div>
                    <div class="fs-3 fw-bold text-dark">{{ $stokMenipis }}</div>
                </div>
            </div>
        </div>
    </div>
    {{-- Card Stok Habis (stok = 0) --}}
    <div class="col-md-3">
        <div class="card card-stat h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-box" style="background:#fee2e2;">
                    <i class="bi bi-x-circle" style="color:#dc2626;"></i>
                </div>
                <div>
                    <div class="text-muted small">Stok habis</div>
                    <div class="fs-3 fw-bold text-dark">{{ $stokHabis }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Search & Filter --}}
<div class="card mb-4">
    <div class="card-body">
        {{-- Form GET agar parameter muncul di URL --}}
        <form method="GET" action="{{ route('barang.index') }}" class="row g-2 align-items-center">
            {{-- Input pencarian nama barang --}}
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0"
                        placeholder="Cari nama barang..."
                        value="{{ request('search') }}">
                </div>
            </div>
            {{-- Dropdown filter kategori --}}
            <div class="col-md-3">
                <select name="kategori_id" class="form-select">
                    <option value="">Semua kategori</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}"
                            {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- Tombol Cari dan Reset --}}
            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
                {{-- Reset = kembali ke URL tanpa parameter --}}
                <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                </a>
            </div>
            {{-- Tombol Tambah Barang di kanan --}}
            <div class="col-md-auto ms-auto">
                <a href="{{ route('barang.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Barang
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Tabel Barang --}}
<div class="card">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Nama barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Harga jual</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- @forelse = foreach tapi ada @empty jika data kosong --}}
                @forelse($barangs as $barang)
                <tr>
                    <td class="fw-semibold">{{ $barang->nama_barang }}</td>
                    <td>
                        {{-- Cek apakah barang punya kategori --}}
                        @if($barang->kategori)
                            <span class="badge badge-kategori"
                                style="background:#e0f2fe; color:#0284c7;">
                                {{ $barang->kategori->nama_kategori }}
                            </span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        {{-- Badge warna berbeda sesuai kondisi stok --}}
                        @if($barang->jumlah_stok == 0)
                            <span class="badge badge-kategori" style="background:#fee2e2; color:#dc2626;">
                                <i class="bi bi-x-circle me-1"></i>{{ $barang->jumlah_stok }}
                            </span>
                        @elseif($barang->jumlah_stok < 20)
                            <span class="badge badge-kategori" style="background:#fef9c3; color:#ca8a04;">
                                <i class="bi bi-exclamation-triangle me-1"></i>{{ $barang->jumlah_stok }}
                            </span>
                        @else
                            <span class="badge badge-kategori" style="background:#dcfce7; color:#16a34a;">
                                <i class="bi bi-check-circle me-1"></i>{{ $barang->jumlah_stok }}
                            </span>
                        @endif
                    </td>
                    <td class="text-muted">{{ $barang->satuan }}</td>
                    <td class="fw-semibold">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('barang.show', $barang->id) }}"
                            class="btn btn-aksi btn-primary me-1">
                            <i class="bi bi-eye me-1"></i>Detail
                        </a>
                        <a href="{{ route('barang.edit', $barang->id) }}"
                            class="btn btn-aksi btn-warning text-white me-1">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <button class="btn btn-aksi btn-danger"
                            onclick="konfirmasiHapus({{ $barang->id }}, '{{ $barang->nama_barang }}')">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                        Tidak ada barang ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-between align-items-center px-3 py-3 border-top">
            <div class="text-muted small">
                Menampilkan {{ $barangs->firstItem() ?? 0 }}–{{ $barangs->lastItem() ?? 0 }}
                dari {{ $barangs->total() }} barang
            </div>
            {{ $barangs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div class="modal fade" id="modalHapus" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px; border:none;">
            <div class="modal-body p-4">
                <div class="d-flex align-items-start gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                        style="width:48px; height:48px; background:#fee2e2;">
                        <i class="bi bi-exclamation-triangle text-danger fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Hapus barang?</h5>
                        <p class="text-muted mb-0 small">
                            Data <strong id="namaBarangHapus"></strong> akan dihapus secara
                            permanen dari sistem. Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="formHapus" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Ya, Hapus
                    </button>
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