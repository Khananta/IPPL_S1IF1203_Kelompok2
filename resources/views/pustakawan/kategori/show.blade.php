@extends('layouts.app')

@section('title', 'Koleksi Kategori ' . $kategori->nama_kategori)

@section('content')
<div class="block w-full text-left clear-both" x-data="{ selectedBuku: [], selectAll: false, toggleAll() { this.selectedBuku = this.selectAll ? {{ json_encode($bukus->pluck('id')->toArray()) }} : []; } }">
    <div class="w-full bg-white rounded-2xl border border-gray shadow overflow-hidden">
        <div class="w-full px-6 py-6 border-b border-gray-100 flex flex-row items-center justify-between gap-4 bg-white">
            
            <div class="text-left py-1">
                <h2 class="text-lg font-bold text-[#2F3951] tracking-tight leading-tight">Kategori {{ $kategori->nama_kategori }}</h2>
                <p class="text-gray-400 text-xs mt-2 leading-relaxed">Daftar koleksi buku yang terdaftar di dalam kategori ini.</p>
            </div>
            
            <div class="flex items-center gap-3 flex-shrink-0">
                <form action="{{ route('pustakawan.buku.destroy-multiple') }}" method="POST" class="form-hapus-macabae m-0 p-0" data-nama="Semua buku yang dipilih dari kategori ini" x-show="selectedBuku.length > 0" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" style="display: none;">
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

                <a href="{{ route('pustakawan.buku.create', ['kategori_id' => $kategori->id]) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-[#4D9BE2] hover:bg-[#3D8BCF] text-white rounded-xl font-semibold text-xs shadow-sm transition-colors duration-200 whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75z" clip-rule="evenodd" />
                    </svg>
                    <span>Tambah Buku</span>
                </a>

                <a href="{{ route('pustakawan.kategori.index') }}" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold rounded-xl text-xs transition-colors whitespace-nowrap">
                    Kembali
                </a>
            </div>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="text-gray-400 text-xs font-bold uppercase tracking-wider bg-[#F8FAFC]/80 border-b border-gray-200">
                        <th class="py-4 px-6 text-center w-12">
                            <input type="checkbox" x-model="selectAll" @change="toggleAll()" class="w-4 h-4 text-[#4D9BE2] border-gray-300 rounded focus:ring-[#4D9BE2]/50 focus:ring-2 transition cursor-pointer">
                        </th>
                        <th class="px-6 py-4 text-center w-16">No</th>
                        <th class="px-6 py-4">Judul Lengkap Buku</th>
                        <th class="px-6 py-4">Nomor ISBN</th>
                        <th class="px-6 py-4">Nama Pengarang</th>
                        <th class="px-6 py-4 text-center">Stok Fisik</th>
                        <th class="px-6 py-4 text-center">Posisi Rak</th>
                        <th class="px-6 py-4 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm text-[#2F3951]">
                    @forelse($bukus as $index => $buku)
                        <tr class="hover:bg-[#F8FAFC]/40 transition-colors group" :class="selectedBuku.includes({{ $buku->id }}) ? 'bg-[#4D9BE2]/5' : ''">
                            
                            <td class="py-4 px-6 text-center">
                                <input type="checkbox" value="{{ $buku->id }}" x-model="selectedBuku" @change="selectAll = (selectedBuku.length === {{ $bukus->count() }})" class="w-4 h-4 text-[#4D9BE2] border-gray-300 rounded focus:ring-[#4D9BE2]/50 focus:ring-2 transition cursor-pointer">
                            </td>

                            <td class="px-6 py-4 text-center font-medium text-gray-400">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 font-bold text-[#2F3951] group-hover:text-[#4D9BE2] transition-colors">
                                {{ $buku->judul }}
                            </td>
                            <td class="px-6 py-4 text-xs font-mono text-gray-500">
                                {{ $buku->isbn }}
                            </td>
                            <td class="px-6 py-4 text-gray-400 font-medium">
                                {{ $buku->pengarang }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-block px-2.5 py-1 {{ $buku->stok > 0 ? 'text-emerald-500 bg-emerald-50/60' : 'bg-rose-50 text-rose-500 border border-rose-100' }} rounded-lg text-xs font-bold shadow-sm">
                                    {{ number_format($buku->stok, 0, ',', '.') }} Pcs
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center font-semibold text-xs">
                                <div class="inline-flex items-center gap-1.5 bg-amber-50/50 px-2 py-1 rounded-md text-[#2F3951]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                    Rak {{ $buku->lokasi_rak }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
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
                            <td colspan="8" class="text-center py-16">
                                <div class="w-12 h-12 bg-gray-50 rounded flex items-center justify-center mx-auto text-gray-300 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18c2.305 0 4.408.867 6 2.292m-6-14.25V18" />
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-400 block font-medium">Belum ada koleksi buku yang terdaftar di dalam kategori <strong>{{ $kategori->nama_kategori }}</strong>.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection