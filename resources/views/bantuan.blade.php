@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">

        <h5 class="fw-bold mb-4">Panduan Penggunaan Sistem</h5>

        {{-- Cara Tambah Barang --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Cara menambah barang baru</h6>
                <ol class="mb-0">
                    <li class="mb-1">
                        Buka halaman <strong>Dashboard</strong>, klik tombol
                        <strong>+ Tambah Barang</strong> di kanan atas.
                    </li>
                    <li class="mb-1">
                        Unggah foto barang (opsional), lalu isi formulir: nama, kategori,
                        satuan, jumlah stok, harga, dan lainnya.
                    </li>
                    <li>
                        Klik <strong>Simpan Barang</strong>. Barang akan muncul di daftar dashboard.
                    </li>
                </ol>
            </div>
        </div>

        {{-- Cara Update Stok --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Cara update stok barang masuk</h6>
                <ol class="mb-0">
                    <li class="mb-1">
                        Temukan barang di dashboard menggunakan kolom pencarian atau filter kategori.
                    </li>
                    <li class="mb-1">
                        Klik tombol <strong>Edit</strong> pada baris barang tersebut.
                    </li>
                    <li>
                        Ubah nilai <strong>Jumlah stok</strong> sesuai kondisi saat ini,
                        lalu klik <strong>Simpan Barang</strong>.
                    </li>
                </ol>
            </div>
        </div>

        {{-- Cara Kelola Kategori --}}
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Cara mengelola kategori</h6>
                <ol class="mb-0">
                    <li class="mb-1">
                        Buka halaman <strong>Kategori</strong> dari navigasi atas.
                    </li>
                    <li class="mb-1">
                        Tambah, edit, atau hapus kategori sesuai kebutuhan toko.
                    </li>
                    <li>
                        Menghapus kategori tidak akan menghapus barang —
                        barang akan menjadi tidak berkategori.
                    </li>
                </ol>
            </div>
        </div>

        {{-- Info Satuan --}}
        <div class="alert alert-info mb-4">
            <i class="bi bi-info-circle me-2"></i>
            Satuan barang diisi bebas sesuai kebutuhan — misalnya:
            <strong>pcs, pack, box, kg, liter</strong>, dan lain-lain.
        </div>

        <hr>

        {{-- Info Developer --}}
        <div class="mt-4">
            <h6 class="fw-bold mb-3">Informasi Developer</h6>
            <table class="table table-bordered w-50">
                <tr>
                    <td class="text-muted" width="40%">Nama</td>
                    <td><strong>Chamillatul Luqiana Agustin</strong></td>
                </tr>
                <tr>
                    <td class="text-muted">NIM</td>
                    <td><strong>2241720020</strong></td>
                </tr>
                <tr>
                    <td class="text-muted">Kelas</td>
                    <td><strong>TI-4E</strong></td>
                </tr>
                <tr>
                    <td class="text-muted">Alamat</td>
                    <td><strong>JL. Notojoyo No. 109</strong></td>
                </tr>
                <tr>
                    <td class="text-muted">No. Telepon</td>
                    <td><strong>085331411712</strong></td>
                </tr>
                <tr>
                    <td class="text-muted">Email</td>
                    <td><strong>chamillaluqiana@gmail.com</strong></td>
                </tr>
            </table>
        </div>

    </div>
</div>

@endsection