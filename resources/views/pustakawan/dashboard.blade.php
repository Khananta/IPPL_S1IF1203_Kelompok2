@extends('layouts.app')

@section('title', 'Dashboard Pustakawan')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-[#2F3951]">Selamat Bertugas, {{ explode(' ', Auth::user()->name ?? 'Pustakawan')[0] }}! 👋</h1>
        <p class="text-gray-500 text-sm mt-1">Sistem Manajemen Perpustakaan MacaBae berjalan dengan optimal hari ini.</p>
    </div>
</div>

<div class="mb-8">
    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Arus Sirkulasi & Validasi</h4>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="bg-white p-6 rounded-2xl border border-rose-100 flex items-center justify-between shadow hover:border-rose-300 transition-all duration-300 group">
            <div class="space-y-1">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Menunggu Konfirmasi</p>
                <h3 class="text-3xl font-bold text-[#2F3951]">{{ $butuhVerifikasi }}</h3>
                <p class="text-xs text-rose-500 font-medium">Pengajuan baru</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center text-rose-500 transition-transform group-hover:scale-110 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-amber-100 flex items-center justify-between shadow hover:border-amber-300 transition-all duration-300 group">
            <div class="space-y-1">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Peminjaman Aktif</p>
                <h3 class="text-3xl font-bold text-[#2F3951]">{{ $sedangDipinjam }}</h3>
                <p class="text-xs text-amber-500 font-medium">Buku di luar</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500 transition-transform group-hover:scale-110 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-red-100 flex items-center justify-between shadow hover:border-red-300 transition-all duration-300 group">
            <div class="space-y-1">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Melebihi Batas Waktu</p>
                <h3 class="text-3xl font-bold text-red-600">{{ $totalTerlambat }}</h3>
                <p class="text-xs text-red-500 font-medium">Belum kembali</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-500 transition-transform group-hover:scale-110 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
            </div>
        </div>

    </div>
</div>

<div class="mb-10">
    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Aset & Keanggotaan Perpustakaan</h4>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        
        <div class="bg-white p-6 rounded-2xl border border-blue-100 flex items-center justify-between shadow hover:border-blue-300 transition-all duration-300 group">
            <div class="space-y-1">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Judul Buku</p>
                <h3 class="text-3xl font-bold text-[#2F3951]">{{ number_format($totalBuku) }}</h3>
                <p class="text-xs text-[#4D9BE2] font-medium">Total judul</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-[#4D9BE2] transition-transform group-hover:scale-110 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-indigo-100 flex items-center justify-between shadow hover:border-indigo-300 transition-all duration-300 group">
            <div class="space-y-1">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Eksemplar</p>
                <h3 class="text-3xl font-bold text-[#2F3951]">{{ number_format($totalStok) }}</h3>
                <p class="text-xs text-indigo-500 font-medium">Total fisik buku</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-500 transition-transform group-hover:scale-110 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-purple-100 flex items-center justify-between shadow hover:border-purple-300 transition-all duration-300 group">
            <div class="space-y-1">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Kategori</p>
                <h3 class="text-3xl font-bold text-[#2F3951]">{{ $totalKategori }}</h3>
                <p class="text-xs text-purple-500 font-medium">Total kategori</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center text-purple-500 transition-transform group-hover:scale-110 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l7.399 7.399a2.25 2.25 0 003.182 0l4.319-4.319a2.25 2.25 0 000-3.182l-7.399-7.399A2.25 2.25 0 009.568 3Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-sky-100 flex items-center justify-between shadow hover:border-sky-300 transition-all duration-300 group">
            <div class="space-y-1">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Anggota Aktif</p>
                <h3 class="text-3xl font-bold text-[#2F3951]">{{ $totalMember }}</h3>
                <p class="text-xs text-sky-500 font-medium">Member terdaftar</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-sky-50 flex items-center justify-center text-sky-500 transition-transform group-hover:scale-110 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </div>
        </div>

    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-500 p-6 shadow">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-bold text-base text-[#2F3951]">Log Sirkulasi Terbaru</h3>
                <p class="text-xs text-gray-400 mt-1">Pantauan riwayat transaksi real-time.</p>
            </div>
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
        </div>

        <div class="space-y-4">
            @forelse($aktivitasTerbaru as $log)
                <div class="flex items-center justify-between p-3.5 bg-[#F8FAFC]/60 rounded-xl border border-gray-50 hover:bg-[#F8FAFC] transition-colors">
                    <div class="flex items-center gap-3 min-w-0">
                        @if($log->status == 'menunggu_konfirmasi')
                            <div class="w-3 h-3 rounded-full bg-rose-400 flex-shrink-0"></div>
                        @elseif($log->status == 'dipinjam')
                            <div class="w-3 h-3 rounded-full bg-amber-400 flex-shrink-0"></div>
                        @elseif($log->status == 'dikembalikan')
                            <div class="w-3 h-3 rounded-full bg-emerald-400 flex-shrink-0"></div>
                        @else
                            <div class="w-3 h-3 rounded-full bg-gray-400 flex-shrink-0"></div>
                        @endif

                        <div class="truncate">
                            <p class="text-sm font-semibold text-[#2F3951] truncate">
                                {{ $log->nama_member }} <span class="font-normal text-gray-400">mengajukan</span> "{{ $log->judul_buku }}"
                            </p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div>
                        @if($log->status == 'menunggu_konfirmasi')
                            <span class="text-[10px] uppercase font-bold bg-rose-50 text-rose-600 px-2.5 py-1 rounded-md">Verifikasi</span>
                        @elseif($log->status == 'dipinjam')
                            <span class="text-[10px] uppercase font-bold bg-amber-50 text-amber-600 px-2.5 py-1 rounded-md">Dibawa</span>
                        @elseif($log->status == 'dikembalikan')
                            <span class="text-[10px] uppercase font-bold bg-emerald-50 text-emerald-600 px-2.5 py-1 rounded-md">Selesai</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center">
                    <p class="text-sm text-gray-400 text-center">Belum ada aktivitas hari ini.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-[#AAAAAA]/10 p-6 flex flex-col justify-between shadow">
        <div>
            <h3 class="font-bold text-base text-[#2F3951]">Aksi Cepat Petugas</h3>
            <p class="text-xs text-gray-400 mt-1 leading-relaxed">Akses pintasan langsung untuk mempercepat alur kerja harian pelayanan MacaBae.</p>
            
            <div class="space-y-3 mt-6">
                <a href="{{ route('pustakawan.buku.index') }}" class="shadow flex items-center gap-3 p-3 mb-3 bg-white hover:bg-[#4D9BE2]/5 rounded-xl border border-gray-500 transition shadow-sm font-medium text-sm text-[#2F3951]">
                    <span class="w-8 h-8 bg-[#4D9BE2]/10 text-[#4D9BE2] rounded-lg flex items-center justify-center font-bold text-lg">+</span>
                    Kelola & Tambah Buku
                </a>
                
                <a href="#" class="shadow flex items-center gap-3 p-3 bg-white hover:bg-rose-50/50 rounded-xl border border-gray-500 transition shadow-sm font-medium text-sm text-[#2F3951] relative">
                    <span class="w-8 h-8 bg-rose-50 text-rose-500 rounded-lg flex items-center justify-center font-bold text-lg">✓</span>
                    Validasi Peminjaman
                    @if($butuhVerifikasi > 0)
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 bg-rose-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center animate-bounce">
                            {{ $butuhVerifikasi }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </div>

</div>
@endsection