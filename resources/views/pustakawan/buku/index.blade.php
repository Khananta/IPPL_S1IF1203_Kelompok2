@extends('layouts.app')

@section('title', 'Katalog & Aset Buku')

@section('content')
<div class="block w-full text-left clear-both" x-data="{ selectedBuku: [], selectAll: false, toggleAll() { this.selectedBuku = this.selectAll ? {{ json_encode($datas->pluck('id')->toArray()) }} : []; } }">

<div class="w-full bg-white p-4 rounded-2xl border border-gray shadow mb-6">
    <form action="{{ route('pustakawan.buku.index') }}" method="GET" class="w-full flex items-center gap-3">
        
        <div class="relative flex-1 flex items-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul buku, nama pengarang, atau nomor ISBN..." class="w-full pl-12 pr-4 py-2.5 bg-[#F8FAFC]/60 border border-gray-100 focus:border-[#4D9BE2]/50 focus:bg-white rounded-xl text-sm text-[#2F3951] placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-[#4D9BE2]/5 transition-all">
        </div>

        <div class="flex items-center gap-2 flex-shrink-0">
            <button type="submit" class="px-5 py-2.5 bg-[#2F3951] hover:bg-[#2F3951]/90 text-white rounded-xl font-semibold text-sm transition shadow-sm whitespace-nowrap">
                Cari Buku
            </button>
            
            @if(request('search'))
                <a href="{{ route('pustakawan.buku.index') }}" class="px-4 py-2.5 bg-rose-50 text-rose-500 hover:bg-rose-100 rounded-xl font-medium text-sm flex items-center justify-center transition whitespace-nowrap">
                    Reset
                </a>
            @endif
        </div>

    </form>
</div>

    <div class="w-full bg-white rounded-2xl border border-grey shadow overflow-hidden">

        <div class="w-full px-6 py-6 border-b border-gray-100 flex flex-row items-center justify-between gap-4 bg-white">
            
            <div class="text-left py-1">
                <h2 class="text-lg font-bold text-[#2F3951] tracking-tight leading-tight">Katalog & Aset Buku</h2>
                <p class="text-gray-400 text-xs mt-2 leading-relaxed">Total data koleksi buku yang terdaftar di sistem.</p>
            </div>
            
            <div class="flex items-center gap-3 flex-shrink-0">
                
                <form action="{{ route('pustakawan.buku.destroy-multiple') }}" method="POST" class="form-hapus-macabae m-0 p-0" data-nama="Semua buku yang dipilih" x-show="selectedBuku.length > 0" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" style="display: none;">
                    @csrf
                    @method('DELETE')
                    <template x-for="id in selectedBuku">
                        <input type="hidden" name="ids[]" :value="id">
                    </template>
                    
                    <button type="submit" class="p-2.5 text-rose-500 bg-rose-50 hover:bg-rose-100 rounded-xl transition border border-rose-200/60 flex items-center justify-center shadow-sm" title="Hapus Buku Terpilih">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </form>

                <a href="{{ route('pustakawan.buku.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-[#4D9BE2] hover:bg-[#3D8BCF] text-white rounded-xl font-semibold text-xs shadow-sm transition-colors duration-200 whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75z" clip-rule="evenodd" />
                    </svg>
                    <span>Tambah Buku</span>
                </a>
            </div>

        </div>

        <div class="w-full overflow-x-auto custom-scrollbar">
            <table class="w-full table-auto text-left border-collapse border-gray-200 min-w-[950px]">
                <thead>
                    <tr class="bg-[#F8FAFC]/80 border-b border-gray-300 text-xs font-bold text-gray-400 uppercase tracking-wider">
                        <th class="py-4 px-4 text-center w-[4%]">
                            <input type="checkbox" x-model="selectAll" @change="toggleAll()" class="w-4 h-4 text-[#4D9BE2] border-gray-300 rounded focus:ring-[#4D9BE2]/50 focus:ring-2 transition cursor-pointer">
                        </th>
                        <th class="py-4 px-4 text-center w-[5%]">No</th>
                        <th class="py-4 px-6 w-[33%]">Informasi Detail Buku</th>
                        <th class="py-4 px-6 w-[15%]">Sektor Kategori</th>
                        <th class="py-4 px-6 w-[18%]">Penerbit & Tahun</th>
                        <th class="py-4 px-6 text-center w-[10%]">Stok Fisik</th>
                        <th class="py-4 px-6 w-[10%]">Posisi Rak</th>
                        <th class="py-4 px-6 text-center w-[5%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm text-[#2F3951]">
                    @forelse($datas as $buku)
                    <tr class="hover:bg-[#F8FAFC]/40 transition-colors group" :class="selectedBuku.includes({{ $buku->id }}) ? 'bg-[#4D9BE2]/5' : ''">
                        
                        <td class="py-4 px-4 text-center">
                            <input type="checkbox" value="{{ $buku->id }}" x-model="selectedBuku" @change="selectAll = (selectedBuku.length === {{ $datas->count() }})" class="w-4 h-4 text-[#4D9BE2] border-gray-300 rounded focus:ring-[#4D9BE2]/50 focus:ring-2 transition cursor-pointer">
                        </td>

                        <td class="py-4 px-4 text-center font-medium text-gray-400">
                            {{ $loop->iteration + ($datas->firstItem() - 1) }}
                        </td>
                        
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4 text-left">
                                <div class="min-w-0 flex-1 text-left">
                                    <h4 class="font-bold text-[#2F3951] text-base group-hover:text-[#4D9BE2] transition-colors line-clamp-1" title="{{ $buku->judul }}">{{ $buku->judul }}</h4>
                                    <p class="text-xs text-gray-400 mt-0.5 font-medium">Penulis: {{ $buku->pengarang }}</p>
                                    
                                    <div class="mt-2 flex items-center gap-2 flex-wrap">
                                        <span class="text-[10px] text-gray-500 font-mono bg-gray-50 px-2 py-1 rounded border border-gray-200 whitespace-nowrap">ISBN {{ $buku->isbn }}</span>
                                        
                                        @if($buku->status == 'aktif')
                                            <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded border border-emerald-200/60 whitespace-nowrap">
                                                Aktif
                                            </span>
                                        @elseif($buku->status == 'non aktif')
                                            <span class="text-[10px] font-bold text-rose-600 bg-rose-50 px-2 py-1 rounded border border-rose-200/60 whitespace-nowrap">
                                                Non Aktif
                                            </span>
                                        @else
                                            <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-2 py-1 rounded border border-amber-200/60 whitespace-nowrap">
                                                Dipinjam
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                        <td class="py-4 px-6">
                            <span class="inline-flex text-xs font-semibold bg-[#4D9BE2]/5 text-[#4D9BE2] px-2.5 py-1 rounded-md whitespace-nowrap">
                                {{ $buku->kategori->nama_kategori ?? 'Umum' }}
                            </span>
                        </td>
                        
                        <td class="py-4 px-6 text-gray-500 text-left">
                            <p class="font-semibold text-xs text-[#2F3951]">{{ $buku->penerbit ?? '-' }}</p>
                            <p class="text-[11px] text-gray-400 mt-0.5">Tahun Terbit: {{ $buku->tahun_terbit }}</p>
                        </td>
                        
                        <td class="py-4 px-6 text-center">
                            @if($buku->stok > 0)
                                <span class="inline-flex items-center justify-center text-xs font-bold text-emerald-500 bg-emerald-50/60 px-2.5 py-1 rounded-md min-w-[55px] whitespace-nowrap">
                                    {{ $buku->stok }} <span class="font-normal text-[10px] text-emerald-400 ml-0.5">Pcs</span>
                                </span>
                            @else
                                <span class="inline-flex items-center justify-center text-xs font-bold text-rose-500 bg-rose-50 border border-rose-100 px-2.5 py-1 rounded-md whitespace-nowrap">
                                    Habis
                                </span>
                            @endif
                        </td>
                        
                        <td class="py-4 px-6">
                            <div class="inline-flex items-center gap-1.5 text-[#2F3951] text-xs font-semibold bg-amber-50/50 px-2 py-1 rounded-md whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                Rak {{ $buku->lokasi_rak }}
                            </div>
                        </td>
                        
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('pustakawan.buku.edit', $buku->id) }}" class="p-1.5 text-gray-400 hover:text-[#4D9BE2] hover:bg-[#4D9BE2]/5 rounded-lg transition" title="Edit Data Buku">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                                
                                <form action="{{ route('pustakawan.buku.destroy', $buku->id) }}" method="POST" class="form-hapus-macabae inline m-0 p-0" data-nama="{{ $buku->judul }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition border-none cursor-pointer bg-transparent" title="Hapus Buku">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-8 text-gray-400 text-xs font-medium">
                            @if(request('search'))
                                Buku dengan kata kunci "{{ request('search') }}" tidak ditemukan.
                            @else
                                Belum ada data buku yang ditambahkan.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($datas->hasPages())
        <div class="p-4 border-t border-gray-50 bg-[#F8FAFC]/40 w-full clear-both">
            {{ $datas->links() }}
        </div>
        @endif
    </div>

</div>
@endsection