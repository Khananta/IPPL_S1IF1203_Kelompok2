<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MacaBae</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F3F7FB; }
        .hero-gradient { background: radial-gradient(circle at top, rgba(77, 155, 226, 0.1) 0%, transparent 70%); }
        
        html {
            scroll-behavior: smooth;
        }

        .section-anchor {
            scroll-margin-top: 100px;
        }
    </style>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/brand/logo.png') }}">
    <script src="{{ asset('assets/js/navbar.js') }}"></script>
</head>
<body class="antialiased text-[#2F3951]">

    <nav class="fixed top-0 w-full bg-white/80 backdrop-blur-md z-[100] border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <img src="{{ asset('assets/img/brand/logo-macabae.png') }}" alt="Logo" class="h-8">
            </div>

            <div class="hidden md:flex gap-8 font-medium text-sm">
                <a href="#beranda" id="nav-beranda" class="nav-link text-blue-500 transition">Beranda</a>
                <a href="#kategori" id="nav-kategori" class="nav-link hover:text-blue-500 transition">Kategori</a>
                <a href="#katalog" id="nav-katalog" class="nav-link hover:text-blue-500 transition">Katalog Buku</a>
                <a href="#fitur" id="nav-fitur" class="nav-link hover:text-blue-500 transition">Fitur</a>
            </div>

        <div class="hidden md:flex gap-4 items-center">
            <a href="{{ route('login') }}" 
            class="relative text-[#4D9BE2] font-semibold text-sm px-4 group">
                <span>Masuk</span>
            </a>

            <a href="{{ route('register') }}" 
            class="bg-gradient-to-r from-[#4D9BE2] to-[#3584CC] text-white px-4 py-2.5 rounded-2xl font-semibold text-sm shadow-lg hover:shadow-xl hover:from-[#3584CC] hover:to-[#2A72B5] cursor-pointer transition-all duration-300 inline-flex items-center justify-center gap-1">
                <span>✨ Daftar sekarang</span>
            </a>
        </div>

            <div class="md:hidden">
                <button id="hamburger" class="relative w-10 h-10 text-gray-600 focus:outline-none group">
                    <div class="absolute w-6 transform -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2">
                        {{-- Garis Atas --}}
                        <span id="line-1" class="absolute h-0.5 w-6 bg-current transform transition duration-300 ease-in-out -translate-y-1.5 rounded-full"></span>
                        {{-- Garis Tengah --}}
                        <span id="line-2" class="absolute h-0.5 w-6 bg-current transform transition duration-300 ease-in-out rounded-full"></span>
                        {{-- Garis Bawah --}}
                        <span id="line-3" class="absolute h-0.5 w-6 bg-current transform transition duration-300 ease-in-out translate-y-1.5 rounded-full"></span>
                    </div>
                </button>
            </div>
        </div>

        <div id="mobile-menu" 
            class="absolute top-20 w-full left-0 bg-white/95 backdrop-blur-lg border-b border-gray-100 px-6 py-8 shadow-2xl space-y-5 md:hidden
                    {{-- Class untuk Animasi Awal (Tersembunyi tapi Smooth) --}}
                    opacity-0 scale-95 pointer-events-none transform transition-all duration-300 ease-out origin-top">
            
            <a href="#beranda" class="block font-medium text-gray-700 hover:text-blue-500 transition hover:translate-x-1">Beranda</a>
            <a href="#kategori" class="block font-medium text-gray-700 hover:text-blue-500 transition hover:translate-x-1">Kategori</a>
            <a href="#katalog" class="block font-medium text-gray-700 hover:text-blue-500 transition hover:translate-x-1">Katalog Buku</a>
            <a href="#fitur" class="block font-medium text-gray-700 hover:text-blue-500 transition hover:translate-x-1">Fitur</a>
            <hr class="border-gray-100">
            <div class="flex flex-col gap-3 pt-2">
                <a href="{{ route('login') }}" class="text-center py-3.5 text-[#4D9BE2] font-semibold border border-blue-100 rounded-2xl hover:bg-blue-50 transition">Masuk</a>
                <a href="{{ route('register') }}" class="text-center py-3.5 bg-gradient-to-b from-[#4D9BE2] to-[#7AA8D2] text-white rounded-2xl font-semibold shadow-lg hover:shadow-xl transition hover:-translate-y-0.5">Daftar sekarang</a>
            </div>
        </div>
    </nav>

    <section class="hero-gradient pt-32 pb-20 px-6 overflow-hidden" id="beranda">
        <div class="max-w-4xl mx-auto text-center">
            <div class="flex justify-center -space-x-2 mb-6">
                <img src="{{ asset('assets/img/landing/dummy-pengguna/dummy pengguna-1.png') }}" alt="Mockup MacaBae" class="w-8 h-8 rounded-full bg-gray-300 border-2 border-white">
                <img src="{{ asset('assets/img/landing/dummy-pengguna/dummy pengguna-2.png') }}" alt="Mockup MacaBae" class="w-8 h-8 rounded-full bg-gray-300 border-2 border-white">
                <img src="{{ asset('assets/img/landing/dummy-pengguna/dummy pengguna-3.png') }}" alt="Mockup MacaBae" class="w-8 h-8 rounded-full bg-gray-300 border-2 border-white">
                <span class="pl-4 text-sm font-semibold self-center">1k+ pengguna aktif</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-6 leFading-tight">📚 Akses Buku Perpustakaan <br> Jadi Lebih Mudah</h1>
            <p class="text-gray-500 mb-10">Cari, lihat detail, dan baca eBook tanpa login.</p>
            
            <div class="relative max-w-xl mx-auto mb-16">
                <input type="text" placeholder="Cari buku yang kamu mau" class="w-full py-4 px-12 rounded-2xl bg-white border border-gray-200 shadow-xl focus:ring-2 focus:ring-blue-400 outline-none">
                <span class="absolute left-4 top-4 text-blue-500">🔍</span>
            </div>

            <div class="relative mx-auto max-w-5xl">
                <img src="{{ asset('assets/img/landing/dashboard-dummy.png') }}" alt="Mockup MacaBae" class="rounded-3xl shadow-2xl border border-white">
            </div>
        </div>
    </section>

    <section class="section-anchor py-20 px-6" id="kategori">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-2">Temukan berbagai kategori <br> buku yang menarik 💫</h2>
                <p class="text-gray-500">20+ kategori buku berbeda</p>
            </div>
            
            <div class="flex flex-wrap justify-center gap-4 max-w-4xl mx-auto">
                @php 
                    $tags = ['E-Book', 'Self Improvement', 'Novel', 'Fiksi', 'Komik', 'Non-Fiksi', 'Sejarah & Budaya', 'Sains', 'Teknologi', 'Agama & Filsafat', '20+ kategori menarik']; 
                @endphp
                
                @foreach($tags as $tag)
                    @if($tag === '20+ kategori menarik')
                        <span class="px-6 py-3 bg-gradient-to-r from-[#4D9BE2] to-[#3584CC] text-white rounded-2xl shadow-sm font-semibold hover:shadow-md hover:from-[#3584CC] hover:to-[#2A72B5] cursor-pointer transition-all duration-300">
                            {{ $tag }}
                        </span>
                    @else
                        <span class="px-6 py-3 bg-white text-gray-700 rounded-2xl shadow-sm border border-gray-100 font-medium hover:shadow-md cursor-pointer transition duration-300">
                            {{ $tag }}
                        </span>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-anchor py-20 bg-white" id="katalog">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-2">Banyak buku Favorit & Terpopuler</h2>
                <p class="text-gray-500">Banyak pilihan buku yang menarik untuk dibaca</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach(range(1, 12) as $index)
                    <div class="aspect-[3/4] bg-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-100">
                        <img 
                            src="{{ asset('assets/img/landing/dummy-buku/dummy-buku-' . $index . '.png') }}" 
                            alt="Sampul Buku MacaBae {{ $index }}" 
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                            onerror="this.src='https://placehold.co/300x400?text=Buku+MacaBae'"
                        >
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-anchor py-20 px-6" id="fitur">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-2">Mudah, Cepat, dan Nyaman</h2>
                <p class="text-gray-500">Nikmati pengalaman perpustakaan digital tanpa ribet.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-2 rounded-3xl border border-gray-100 shadow-sm flex flex-col">
                    <div class="bg-blue-50 h-48 rounded-2xl mb-6 flex items-center justify-center">
                        <div class="w-2/3 bg-white rounded-xl shadow-lg p-4 text-[10px]">
                            <p class="font-bold">Notifikasi</p>
                            <p class="mt-2 font-bold mb-1">📚 Peminjaman berhasil</p>
                            <p>Buku Atomic Habits berhasil dipinjam. Kembalikan sebelum 25 Juni 2025.</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold mb-2">🔔 Notifikasi Pintar</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Dapatkan pengingat jatuh tempo dan informasi penting seputar peminjaman.</p>
                    </div>
                </div>

                <div class="bg-white p-2 rounded-3xl border border-gray-100 shadow-sm">
                    <div class="bg-blue-50 h-48 rounded-2xl mb-6 flex items-center justify-center p-6">
                        <div class="w-full bg-white rounded-xl shadow-lg p-3 flex items-center gap-2">
                           <span class="text-blue-500">🔍</span><span class="text-xs text-gray-300 italic">Cari buku...</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold mb-2">🔍 Pencarian Buku Mudah</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Cari buku berdasarkan judul, penulis, atau kategori dengan cepat.</p>
                    </div>
                </div>

                <div class="bg-white p-2 rounded-3xl border border-gray-100 shadow-sm">
                    <div class="bg-blue-50 h-48 rounded-2xl mb-6 flex items-center justify-center">
                        <div class="w-2/3 bg-white rounded-xl shadow-lg p-4 text-[10px]">
                            <p class="font-bold">Detail buku</p>
                            <p class="mt-2 font-bold">Penerbit</p>
                            <p>Gramedia Pustaka Utama</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold mb-2">📚 Detail Buku Lengkap</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Lihat sinopsis, kategori, ulasan, dan jenis buku sebelum membaca.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gradient-to-b from-[#4D9BE2] to-[#7AA8D2] pt-20 pb-10 px-6 text-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <img src="{{ asset('assets/img/brand/logo-macabae-putih.png') }}" alt="Logo">
                    </div>
                    <p class="text-blue-50 text-sm leading-relaxed mb-6">MacaBae adalah sistem perpustakaan digital untuk memudahkan akses, pencarian, dan peminjaman buku.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Menu</h4>
                    <ul class="space-y-4 text-blue-50 text-sm">
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#">Katalog Buku</a></li>
                        <li><a href="#">Informasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Layanan</h4>
                    <ul class="space-y-4 text-blue-50 text-sm">
                        <li><a href="#">Pencarian Buku</a></li>
                        <li><a href="#">Baca E-Book</a></li>
                        <li><a href="#">Peminjaman Buku</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Kontak</h4>
                    <ul class="space-y-4 text-blue-50 text-sm">
                        <li>📍 Purwokerto, Jawa Tengah</li>
                        <li>📧 macabae@gmail.com</li>
                        <li>📞 +62 812 3456 789</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/20 pt-8 flex flex-col md:row justify-between items-center gap-4 text-xs text-blue-100">
                <p>© 2026 MacaBae – Sistem Perpustakaan Digital</p>
                <div class="flex gap-6">
                    <span>Terms & Conditions</span>
                    <span>Privacy Policy</span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>