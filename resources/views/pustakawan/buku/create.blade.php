@extends('layouts.app')

@section('title', 'Tambah Buku Baru')

@section('content')
<div class="w-full flex flex-col text-left md:px-2 max-w mx-auto Box-border">

    <div class="w-full mb-6">
        <h2 class="text-lg font-bold text-[#2F3951] tracking-tight leading-tight">Tambah Koleksi Buku</h2>
        <p class="text-gray-400 text-xs mt-2 leading-relaxed">Daftarkan aset buku baru ke dalam database sistem perpustakaan MacaBae.</p>
    </div>

    <div class="w-full bg-white rounded-2xl border border-gray-200 shadow overflow-hidden">
        
        <form action="{{ route('pustakawan.buku.store') }}" method="POST" class="p-6 md:p-8 w-full m-0 flex flex-col gap-6">
            @csrf

            <div class="w-full flex flex-col text-left">
                <h3 class="text-xs font-bold text-[#2F3951] uppercase text-gray-400 tracking-wider mb-4 flex items-center">
                    <span class="w-1 h-3.5 bg-[#4D9BE2] rounded-full"></span>
                    Informasi Utama Buku
                </h3>
                
                <div class="gap-5 w-full">
                    <div class="flex flex-col text-left w-full">
                        <label for="judul" class="text-[11px] font-bold uppercase tracking-wider mb-2">Judul Lengkap Buku <span class="text-rose-500">*</span></label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required placeholder="Contoh: Bumi Manusia" style="background-color: #FCFCFC" class="w-full mb-4 px-4 py-2.5 bg-[ border border-gray-200 focus:border-[#4D9BE2]/50 focus:bg-white rounded-xl text-sm text-[#2F3951] placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-[#4D9BE2]/5 transition-all">
                        @error('judul') <span class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col text-left w-full">
                        <label for="isbn" class="text-[11px] font-bold uppercase tracking-wider mb-2">Nomor Standar ISBN <span class="text-rose-500">*</span></label>
                        <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}" required placeholder="Contoh: 9786022916628" style="background-color: #FCFCFC" class="w-full px-4 py-2.5 border border-gray-200 focus:border-[#4D9BE2]/50 focus:bg-white rounded-xl text-sm text-[#2F3951] placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-[#4D9BE2]/5 transition-all">
                        @error('isbn') <span class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="w-full flex flex-col text-left pt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 w-full">
                    <div class="flex flex-col text-left w-full">
                        <label for="pengarang" class="text-[11px] font-bold uppercase tracking-wider mb-2">Nama Pengarang / Penulis <span class="text-rose-500">*</span></label>
                        <input type="text" name="pengarang" id="pengarang" value="{{ old('pengarang') }}" required placeholder="Contoh: Pramoedya Ananta Toer" style="background-color: #FCFCFC" class="w-full px-4 py-2.5 border border-gray-200 focus:border-[#4D9BE2]/50 focus:bg-white rounded-xl text-sm text-[#2F3951] placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-[#4D9BE2]/5 transition-all">
                        @error('pengarang') <span class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div class="flex flex-col text-left">
                            <label for="penerbit" class="text-[11px] font-bold uppercase tracking-wider mb-2">Penerbit</label>
                            <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit') }}" placeholder="Contoh: Lentera Dipantara" style="background-color: #FCFCFC" class="w-full px-4 py-2.5 border border-gray-200 focus:border-[#4D9BE2]/50 focus:bg-white rounded-xl text-sm text-[#2F3951] placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-[#4D9BE2]/5 transition-all">
                        </div>
                        <div class="flex flex-col text-left">
                            <label for="tahun_terbit" class="text-[11px] font-bold uppercase tracking-wider mb-2">Tahun Terbit <span class="text-rose-500">*</span></label>
                            <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit', 2026) }}" required placeholder="2026" style="background-color: #FCFCFC" class="w-full px-4 py-2.5 border border-gray-200 focus:border-[#4D9BE2]/50 focus:bg-white rounded-xl text-sm text-[#2F3951] placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-[#4D9BE2]/5 transition-all">
                            @error('tahun_terbit') <span class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full flex flex-col text-left pt-8">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4 flex items-center">
                    <span class="w-1 h-3.5 bg-[#4D9BE2] rounded-full"></span>
                    Inventaris & Lokasi Rak
                </h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 w-full">
                    <div class="flex flex-col text-left w-full">
                        <label for="kategori_id" class="text-[11px] font-bold uppercase tracking-wider mb-2">Kategori <span class="text-rose-500">*</span></label>
                        <div class="relative w-full">
                            <select name="kategori_id" style="background-color: #FCFCFC" id="kategori_id" required class="w-full px-4 py-2.5 border border-gray-200 focus:border-[#4D9BE2]/50 focus:bg-white rounded-xl text-sm text-[#2F3951] focus:outline-none focus:ring-4 focus:ring-[#4D9BE2]/5 transition-all appearance-none cursor-pointer">
                                <option value="" disabled selected>Pilih Kategori...</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>
                        @error('kategori_id') <span class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col text-left w-full">
                        <label for="stok" class="text-[11px] font-bold uppercase tracking-wider mb-2">Jumlah Stok Buku <span class="text-rose-500">*</span></label>
                        <input type="number" name="stok" id="stok" value="{{ old('stok', 0) }}" min="0" required placeholder="0" style="background-color: #FCFCFC" class="w-full px-4 py-2.5 border border-gray-200 focus:border-[#4D9BE2]/50 focus:bg-white rounded-xl text-sm text-[#2F3951] placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-[#4D9BE2]/5 transition-all">
                        @error('stok') <span class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col text-left w-full">
                        <label for="lokasi_rak" class="text-[11px] font-bold uppercase tracking-wider mb-2">Posisi Rak Penyimpanan <span class="text-rose-500">*</span></label>
                        <input type="text" name="lokasi_rak" id="lokasi_rak" value="{{ old('lokasi_rak') }}" required placeholder="Contoh: R-A1" style="background-color: #FCFCFC" class="w-full px-4 py-2.5 border border-gray-200 focus:border-[#4D9BE2]/50 focus:bg-white rounded-xl text-sm text-[#2F3951] placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-[#4D9BE2]/5 transition-all">
                        @error('lokasi_rak') <span class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col text-left w-full">
                        <label for="status" class="text-[11px] font-bold uppercase tracking-wider mb-2">Status Visibilitas Buku <span class="text-rose-500">*</span></label>
                        <select name="status" id="status" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-[#2F3951] focus:outline-none focus:ring-4 focus:ring-[#4D9BE2]/5 transition-all">
                            <option value="aktif" {{ old('status', $buku->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif (Muncul di Member)</option>
                            <option value="non aktif" {{ old('status', $buku->status ?? '') == 'non aktif' ? 'selected' : '' }}>Non Aktif (Sembunyikan dari Member)</option>
                            <option value="dipinjam" {{ old('status', $buku->status ?? '') == 'dipinjam' ? 'selected' : '' }}>Sedang Dipinjam</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="w-full flex items-center justify-end gap-3 pt-5 mt-2">
                <a href="{{ route('pustakawan.buku.index') }}" class="px-5 py-2.5 text-gray-500 font-bold rounded-xl text-xs transition-colors whitespace-nowrap">
                    Kembali
                </a>
                
                <button type="submit" class="px-6 py-2.5 bg-[#4D9BE2] hover:bg-[#3D8BCF] text-white font-bold rounded-xl text-xs shadow-sm transition-colors duration-200 whitespace-nowrap">
                    Simpan Data Buku
                </button>
            </div>

        </form>
    </div>
</div>
@endsection