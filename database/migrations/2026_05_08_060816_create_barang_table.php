<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->foreignId('kategori_id')
                ->nullable()
                ->constrained('kategori')
                ->nullOnDelete();
            $table->integer('jumlah_stok')->default(0);
            $table->integer('stok_minimum')->default(0);
            $table->string('satuan');
            $table->decimal('harga_jual', 15, 2)->nullable();
            $table->decimal('harga_beli', 15, 2)->nullable();
            $table->string('berat_ukuran')->nullable();
            $table->string('lokasi_simpan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
