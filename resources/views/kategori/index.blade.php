@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-bold">Daftar Kategori</h5>
            <a href="{{ route('kategori.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Tambah Kategori
            </a>
        </div>

        {{-- Search --}}
        <form method="GET" action="{{ route('kategori.index') }}" class="mb-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0"
                            placeholder="Cari kategori..."
                            value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </a>
                </div>
            </div>
        </form>

        {{-- Tabel --}}
        <div class="card">
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Nama kategori</th>
                            <th>Jumlah barang</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $kat)
                        <tr>
                            <td class="fw-semibold">{{ $kat->nama_kategori }}</td>
                            <td>
                                <span class="badge badge-kategori" style="background:#e0f2fe; color:#0284c7;">
                                    <i class="bi bi-box-seam me-1"></i>{{ $kat->barangs_count }} barang
                                </span>
                            </td>
                            <td class="text-muted small">{{ $kat->created_at->format('j M Y') }}</td>
                            <td>
                                <a href="{{ route('kategori.edit', $kat->id) }}"
                                    class="btn btn-aksi btn-warning text-white me-1">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                                <button class="btn btn-aksi btn-danger"
                                    onclick="konfirmasiHapus({{ $kat->id }}, '{{ $kat->nama_kategori }}')">
                                    <i class="bi bi-trash me-1"></i>Hapus
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Tidak ada kategori ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="px-3 py-3 border-top text-muted small">
                    {{ $kategoris->count() }} kategori terdaftar
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
                        <h5 class="fw-bold">Hapus kategori?</h5>
                        <p class="text-muted mb-0">
                            Data <strong id="namaKategoriHapus"></strong> akan dihapus secara
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
        document.getElementById('namaKategoriHapus').innerText = nama;
        document.getElementById('formHapus').action = '{{ url("kategori") }}/' + id;
        new bootstrap.Modal(document.getElementById('modalHapus')).show();
    }
</script>
@endsection