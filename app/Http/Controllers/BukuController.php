<?php

namespace App\Http\Controllers;

use App\Models\Buku; 
use App\Models\Kategori; 
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // Menampilkan daftar buku dengan fitur pencarian & pembagian halaman (Pagination)
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Mengembalikan nama variabel menjadi $datas agar sinkron dengan template Blade-mu
        $datas = Buku::with('kategori')
            ->when($search, function($query, $search) {
                return $query->where('judul', 'like', "%{$search}%")
                            ->orWhere('isbn', 'like', "%{$search}%")
                            ->orWhere('pengarang', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
        
        return view('pustakawan.buku.index', compact('datas'));
    }

    // Memproses penyimpanan buku baru ke database
    public function store(Request $request)
    {
        // 1. Validasi Input Lengkap & Aman (Termasuk Status Baru)
        $request->validate([
            'isbn'         => 'required|unique:bukus,isbn',
            'judul'        => 'required|string|max:255',
            'kategori_id'  => 'required|exists:kategoris,id',
            'pengarang'    => 'required|string|max:255',
            'penerbit'     => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1000|max:'.now()->year,
            'stok'         => 'required|integer|min:0',
            'lokasi_rak'   => 'required|string|max:255',
            'status'       => 'required|in:aktif,non aktif,dipinjam', // <--- VALIDASI BARU
        ]);

        // 2. Simpan ke Database menggunakan cara ringkas
        Buku::create([
            'isbn'         => $request->isbn,
            'judul'        => $request->judul,
            'pengarang'    => $request->pengarang,
            'penerbit'     => $request->penerbit ?? '-',
            'tahun_terbit' => $request->tahun_terbit ?? now()->year,
            'stok'         => $request->stok,
            'lokasi_rak'   => $request->lokasi_rak,
            'kategori_id'  => $request->kategori_id,
            'status'       => $request->status, // <--- BERHASIL DISIMPAN KE DB
        ]);

        // 3. Redirect kembali ke halaman utama dengan alert sukses
        return redirect()->route('pustakawan.buku.index')->with('success', 'Buku baru berhasil ditambahkan ke sistem MacaBae!');
    }

    // Menampilkan form tambah buku
    public function create(Request $request)
    {
        // Mengambil semua kategori untuk dilist di dropdown select
        $kategoris = Kategori::all();
        
        // Menangkap parameter 'kategori_id' jika dikirim dari tombol show kategori
        $selectedKategoriId = $request->query('kategori_id');

        return view('pustakawan.buku.create', compact('kategoris', 'selectedKategoriId'));
    }

    // Menampilkan form edit dengan data buku yang sudah ada
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        
        return view('pustakawan.buku.edit', compact('buku', 'kategoris'));
    }

    // Memproses perubahan data buku ke database
    public function update(Request $request, $id)
    {
        // Validasi diperketat agar data yang di-update tetap konsisten dengan aturan sistem
        $request->validate([
            'isbn'         => 'required|unique:bukus,isbn,'.$id, // Unik kecuali untuk ID buku ini sendiri
            'judul'        => 'required|string|max:255',
            'kategori_id'  => 'required|exists:kategoris,id',
            'pengarang'    => 'required|string|max:255',
            'penerbit'     => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1000|max:'.now()->year,
            'stok'         => 'required|integer|min:0',
            'lokasi_rak'   => 'required|string|max:255',
            'status'       => 'required|in:aktif,non aktif,dipinjam',
        ]);

        $buku = Buku::findOrFail($id);
        
        // Mengamankan nilai default jika field opsional dikosongkan saat edit
        $data = $request->all();
        $data['penerbit'] = $request->penerbit ?? '-';
        $data['tahun_terbit'] = $request->tahun_terbit ?? now()->year;

        $buku->update($data);

        return redirect()->route('pustakawan.buku.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    // Menghapus data buku dari sistem
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('pustakawan.buku.index')->with('success', 'Buku telah berhasil dihapus dari sistem MacaBae.');
    }
    
    // Menghapus banyak data sekaligus (Bulk Delete)
    public function destroyMultiple(Request $request)
    {
        // Memastikan ada ID yang dikirim
        $ids = $request->input('ids');
        
        if (!$ids || count($ids) === 0) {
            return redirect()->back()->with('error', 'Pilih minimal satu buku untuk dihapus.');
        }

        // Melakukan hapus massal sekaligus
        Buku::whereIn('id', $ids)->delete();

        return redirect()->route('pustakawan.buku.index')->with('success', 'Buku-buku terpilih berhasil dihapus massal!');
    }
}