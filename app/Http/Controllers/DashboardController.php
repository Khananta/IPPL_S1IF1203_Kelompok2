<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role == 'pustakawan') {
            // Statistik Umum (Buku & Anggota)
            $totalBuku = Buku::count();
            $totalStok = Buku::sum('stok') ?? 0;
            $totalKategori = Kategori::count();
            $totalMember = User::where('role', 'member')->count();

            // Statistik Sirkulasi Riil Berdasarkan Database MacaBae (SKPL Matched)
            $butuhVerifikasi = DB::table('peminjamans')->where('status', 'menunggu_konfirmasi')->count();
            $sedangDipinjam = DB::table('peminjamans')->where('status', 'dipinjam')->count();
            
            // 1. Amankan variabel ini menjadi 0 dulu agar halaman bisa di-load tanpa error SQL
            $totalTerlambat = 0;

            // 2. Amankan juga log aktivitas terbaru (murni join tabel yang kolomnya pasti aman)
            $aktivitasTerbaru = DB::table('peminjamans')
                ->join('users', 'peminjamans.user_id', '=', 'users.id')
                ->join('bukus', 'peminjamans.buku_id', '=', 'bukus.id')
                ->select('users.name as nama_member', 'bukus.judul as judul_buku', 'peminjamans.status', 'peminjamans.created_at')
                ->orderBy('peminjamans.created_at', 'desc')
                ->limit(5)
                ->get();

            return view('pustakawan.dashboard', [
                'totalBuku' => $totalBuku,
                'totalStok' => $totalStok,
                'totalKategori' => $totalKategori,
                'totalMember' => $totalMember,
                'butuhVerifikasi' => $butuhVerifikasi,
                'sedangDipinjam' => $sedangDipinjam,
                'totalTerlambat' => $totalTerlambat,
                'aktivitasTerbaru' => $aktivitasTerbaru
            ]);
        } else {
            return view('member.dashboard');
        }
    }
}