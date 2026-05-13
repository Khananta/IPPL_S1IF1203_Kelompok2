<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Buku;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * 1. HALAMAN UTAMA KATEGORI
     * Menampilkan semua kategori + menghitung jumlah buku di dalamnya secara otomatis
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $kategoris = Kategori::withCount('bukus')
            ->when($search, function($query, $search) {
                return $query->where('nama_kategori', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('pustakawan.kategori.index', compact('kategoris'));
    }

    /**
     * Halaman Create (Dikosongkan karena form tambah sudah menyatu di halaman index)
     */
    public function create()
    {
        //
    }

    /**
     * 2. PROSES SIMPAN KATEGORI BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('pustakawan.kategori.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * 3. FITUR KLIK KATEGORI: MUNCULKAN BUKU TERKAIT
     * Ini fungsi yang akan berjalan ketika nama kategori di tabel kamu klik!
     */
    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        
        // Mengambil buku yang memiliki kategori_id sesuai dengan kategori yang diklik
        $bukus = Buku::where('kategori_id', $id)->get();

        return view('pustakawan.kategori.show', compact('kategori', 'bukus'));
    }

    /**
     * 4. HALAMAN EDIT KATEGORI
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('pustakawan.kategori.edit', compact('kategori'));
    }

    /**
     * 5. PROSES UPDATE KATEGORI
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $kategori->id,
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('pustakawan.kategori.index')->with('success', 'Nama kategori berhasil diperbarui!');
    }

    /**
     * 6. PROSES HAPUS KATEGORI (+ Proteksi Data)
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        
        // Proteksi: Jika kategori masih dipakai oleh buku, jangan izinkan dihapus biar gak error
        if ($kategori->bukus()->count() > 0) {
            return redirect()->route('pustakawan.kategori.index')->with('error', 'Kategori tidak bisa dihapus karena masih memiliki koleksi buku!');
        }

        $kategori->delete();
        return redirect()->route('pustakawan.kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}