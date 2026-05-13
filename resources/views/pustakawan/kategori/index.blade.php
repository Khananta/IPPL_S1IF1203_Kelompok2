@extends('layouts.app')

@section('title', 'Manajemen Kategori Buku')

@section('content')
<div class="block w-full text-left clear-both" x-data="{ openCreate: false }">

    <div class="w-full bg-white p-4 rounded-2xl border border-gray shadow mb-6">
        <form action="{{ route('pustakawan.kategori.index') }}" method="GET" class="w-full flex items-center gap-3">
            
            <div class="relative flex-1 flex items-center">
                <div class="absolute left-4 text-gray-400 pointer-events-none flex items-center">
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..." class="w-full pl-12 pr-4 py-2.5 bg-[#F8FAFC]/60 border border-gray-100 focus:border-[#4D9BE2]/50 focus:bg-white rounded-xl text-sm text-[#2F3951] placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-[#4D9BE2]/5 transition-all">
            </div>

            <div class="flex items-center gap-2 flex-shrink-0">
                <button type="submit" class="px-5 py-2.5 bg-[#2F3951] hover:bg-[#2F3951]/90 text-white rounded-xl font-semibold text-sm transition shadow-sm whitespace-nowrap">
                    Cari Kategori
                </button>
                
                @if(request('search'))
                    <a href="{{ route('pustakawan.kategori.index') }}" class="px-5 py-2.5 text-gray-600 rounded-xl font-semibold text-sm transition whitespace-nowrap">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div x-show="openCreate" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2"
         class="w-full bg-white p-5 rounded-2xl border border-gray shadow mb-6" style="display: none;">
         
        <form action="{{ route('pustakawan.kategori.store') }}" method="POST" class="w-full flex items-center gap-3">
            @csrf
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 pointer-events-none">
                </div>
                <input type="text" name="nama_kategori" required placeholder="Masukkan nama klasifikasi baru (Contoh: Informatika, Sains, Novel)..." style="background-color: #FCFCFC" class="w-full pl-12 pr-4 py-2.5 border border-gray-200 focus:border-[#4D9BE2]/50 focus:bg-white rounded-xl text-sm text-[#2F3951] focus:outline-none focus:ring-4 focus:ring-[#4D9BE2]/5 transition-all">
            </div>
            <div class="flex-shrink-0">
                <button type="submit" class="px-6 py-2.5 bg-[#4D9BE2] hover:bg-[#3D8BCF] text-white font-bold rounded-xl text-sm transition shadow-sm whitespace-nowrap">
                    Simpan kategori
                </button>
            </div>
        </form>
    </div>

    <div class="w-full bg-white rounded-2xl border border-gray shadow overflow-hidden">
        
        <div class="w-full px-6 py-6 border-b border-gray-100 flex flex-row items-center justify-between gap-4 bg-white">
            <div class="text-left">
                <h2 class="text-lg font-bold text-[#2F3951] tracking-tight leading-tight">Kategori Buku</h2>
                <p class="text-gray-400 text-xs mt-2 leading-relaxed">Total data klasifikasi jenis buku yang terdaftar di sistem MacaBae.</p>
            </div>
            
            <div class="flex items-center flex-shrink-0">
                <button type="button" @click="openCreate = !openCreate" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-[#4D9BE2] hover:bg-[#3D8BCF] text-white rounded-xl font-semibold text-xs shadow-sm transition-colors duration-200 whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/xl" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75z" clip-rule="evenodd" />
                    </svg>
                    <span>Tambah Kategori</span>
                </button>
            </div>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-[#F8FAFC]/80 border-b border-gray-100 text-[#2F3951] text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4 text-gray-400 text-center w-16">No</th>
                        <th class="px-6 py-4 text-gray-400">Nama Klasifikasi Kategori</th>
                        <th class="px-6 py-4 text-gray-400 text-center w-48">Jumlah Koleksi</th>
                        <th class="px-6 py-4 text-gray-400 text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($kategoris as $kat)
                    <tr class="hover:bg-[#F8FAFC]/40 transition-colors text-sm text-[#2F3951]">
                        <td class="px-6 py-4 text-center font-medium text-gray-400">
                            {{ $loop->iteration + ($kategoris->firstItem() - 1) }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('pustakawan.kategori.show', $kat->id) }}" class="font-semibold text-[#2F3951] hover:text-[#4D9BE2] hover:underline flex items-center gap-2 group transition-all">
                                {{ $kat->nama_kategori }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-block px-3 py-1 rounded-lg text-xs font-bold text-emerald-600">
                                {{ number_format($kat->bukus_count, 0, ',', '.') }} Buku
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('pustakawan.kategori.edit', $kat->id) }}" class="p-2 text-gray-400 hover:text-amber-500 rounded-lg hover:bg-amber-50/50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </a>

                                <form action="{{ route('pustakawan.kategori.destroy', $kat->id) }}" method="POST" class="form-hapus-macabae inline m-0 p-0" data-nama="{{ $kat->nama_kategori }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-rose-500 rounded-lg hover:bg-rose-50/50 transition-colors">
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
                        <td colspan="4" class="text-center py-8">
                            <span class="text-sm text-gray-400">
                                @if(request('search'))
                                    Kategori dengan kata kunci "{{ request('search') }}" tidak ditemukan.
                                @else
                                    Belum ada data kategori yang ditambahkan.
                                @endif
                            </span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kategoris->hasPages())
        <div class="p-4 border-t border-gray-50 bg-[#F8FAFC]/40 w-full clear-both">
            {{ $kategoris->links() }}
        </div>
        @endif
    </div>
</div>
@endsection