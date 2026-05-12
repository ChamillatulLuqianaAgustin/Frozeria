<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Barang::with('kategori');

        // Search by nama
        if ($request->search) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        // Filter by kategori
        if ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Pagination
        $barangs   = $query->paginate(10)->appends($request->query());
        $kategoris = Kategori::all();

        // Info cards
        $totalBarang    = Barang::count();
        $totalKategori  = Kategori::count();
        $stokMenipis    = Barang::where('jumlah_stok', '>', 0)
                                ->where('jumlah_stok', '<', 20)
                                ->count();
        $stokHabis      = Barang::where('jumlah_stok', 0)->count();

        // Kirim semua variabel ke view barang/index.blade.php
        return view('barang.index', compact(
            'barangs', 'kategoris',
            'totalBarang', 'totalKategori',
            'stokMenipis', 'stokHabis'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua kategori untuk dropdown di form
        $kategoris = Kategori::all();
        return view('barang.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'  => 'required|string|max:255',
            'kategori_id'  => 'nullable|exists:kategori,id',
            'jumlah_stok'  => 'required|integer|min:0',
            'stok_minimum' => 'nullable|integer|min:0',
            'satuan'       => 'required|string|max:50',
            'harga_jual'   => 'nullable|numeric',
            'harga_beli'   => 'nullable|numeric',
            'berat_ukuran' => 'nullable|string|max:100',
            'lokasi_simpan'=> 'nullable|string|max:100',
            'deskripsi'    => 'nullable|string',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        // Gabungkan berat_nilai + berat_satuan jadi berat_ukuran
        if ($request->berat_nilai && $request->berat_satuan) {
            $data['berat_ukuran'] = $request->berat_nilai . ' ' . $request->berat_satuan;
        }
        unset($data['berat_nilai'], $data['berat_satuan']);

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang'  => 'required|string|max:255',
            'kategori_id'  => 'nullable|exists:kategori,id',
            'jumlah_stok'  => 'required|integer|min:0',
            'stok_minimum' => 'nullable|integer|min:0',
            'satuan'       => 'required|string|max:50',
            'harga_jual'   => 'nullable|numeric',
            'harga_beli'   => 'nullable|numeric',
            'berat_ukuran' => 'nullable|string|max:100',
            'lokasi_simpan'=> 'nullable|string|max:100',
            'deskripsi'    => 'nullable|string',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');

        // Jika ada foto baru diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama kalau ada
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        if ($request->berat_nilai && $request->berat_satuan) {
            $data['berat_ukuran'] = $request->berat_nilai . ' ' . $request->berat_satuan;
        }
        unset($data['berat_nilai'], $data['berat_satuan']);

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        if ($barang->foto) {
            Storage::disk('public')->delete($barang->foto);
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
