<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'kategori_id',
        'jumlah_stok',
        'stok_minimum',
        'satuan',
        'harga_jual',
        'harga_beli',
        'berat_ukuran',
        'lokasi_simpan',
        'deskripsi',
        'foto',
    ];

    // Relasi: 1 barang punya 1 kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
