@extends('layouts.app')

@section('title', 'Edit Kategori Buku')

@section('content')
<div class="w-full flex flex-col text-left md:px-2 max-w mx-auto box-border">
    
    <div class="w-full mb-6">
        <h1 class="text-xl font-bold text-[#2F3951] tracking-tight">Edit Kategori Buku</h1>
        <p class="text-gray-400 text-xs mt-0.5">Ubah nama klasifikasi sektor agar sesuai dengan pendataan baru.</p>
    </div>

    <div class="w-full max-w-xl bg-white rounded-2xl border border-gray-200 shadow overflow-hidden">
        <form action="{{ route('pustakawan.kategori.update', $kategori->id) }}" method="POST" class="p-6 flex flex-col gap-5">
            @csrf
            @method('PUT')

            <div class="flex flex-col text-left w-full">
                <label for="nama_kategori" class="text-[11px] font-bold uppercase tracking-wider mb-2 text-[#2F3951]">Nama Kategori Buku <span class="text-rose-500">*</span></label>
                <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required placeholder="Contoh: Novel, Komik" style="background-color: #FCFCFC" class="w-full px-4 py-2.5 border border-gray-200 focus:border-[#4D9BE2]/50 focus:bg-white rounded-xl text-sm text-[#2F3951] focus:outline-none focus:ring-4 focus:ring-[#4D9BE2]/5 transition-all">
                @error('nama_kategori') <span class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</span> @enderror
            </div>

            <div class="w-full flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('pustakawan.kategori.index') }}" class="px-5 py-2.5 text-gray-500 font-bold rounded-xl text-xs transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-[#4D9BE2] hover:bg-[#3D8BCF] text-white font-bold rounded-xl text-xs transition-all shadow-sm">
                    Perbarui Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection