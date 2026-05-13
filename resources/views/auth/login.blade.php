    <x-guest-layout>
        @section('title', 'Masuk')
        <div class="flex min-h-screen">
            
            <div class="w-full md:w-1/2 flex flex-col justify-between bg-white px-8 py-10 sm:p-16 md:p-20 relative z-10 min-h-screen">
                
                {{-- Bagian Atas: Logo & Form --}}
                <div class="w-full max-w-md mx-auto">
                    <a href="/" class="flex items-center gap-2 mb-16 transition hover:opacity-80">
                        <img src="{{ asset('assets/img/brand/logo-macabae.png') }}" alt="Logo MacaBae" class="h-9">
                    </a>

                    <div class="mb-10">
                        <h1 class="text-3xl font-bold text-[#2F3951] tracking-tight">Selamat datang kembali 👋</h1>
                        <p class="text-gray-500 mt-2 text-sm">Masuk untuk melanjutkan aktivitas perpustakaanmu</p>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                                class="w-full px-5 py-3.5 rounded-xl border border-gray-200 focus:border-[#4D9BE2] focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition outline-none"
                                placeholder="masukan email kamu">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            {{-- Label tetap di atas --}}
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            
                            {{-- Input Wrapper --}}
                            <div class="relative group">
                                <input id="password" type="password" name="password" required 
                                    class="w-full pl-5 pr-12 py-3.5 rounded-xl border border-gray-200 focus:border-[#4D9BE2] focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition outline-none bg-white"
                                    placeholder="masukan kata password kamu">
                                
                                {{-- Button Icon Mata (Hanya tambah id & onclick, struktur/class tetap sama) --}}
                                <button type="button" onclick="togglePasswordLogin()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#4D9BE2] transition px-1">
                                    <span id="eyeIconLogin">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </span>
                                </button>
                            </div>

                            {{-- Container untuk Lupa Password di Bawah Input merapat ke Kanan --}}
                            @if (Route::has('password.request'))
                                <div class="flex justify-end">
                                    <a href="{{ route('password.request') }}" class="text-xs text-[#4D9BE2] hover:underline font-medium transition">
                                        Lupa password?
                                    </a>
                                </div>
                            @endif
                            
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <div class="pt-4">
                            <button type="submit" id="btnSubmit" class="w-full relative overflow-hidden bg-[#4D9BE2] hover:bg-[#3E8AD1] text-white py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 group">
                                {{-- Teks --}}
                                <span class="relative z-10">Masuk</span>
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-600">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-[#4D9BE2] font-semibold hover:underline transition">
                                Daftar sekarang
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="hidden md:block md:w-1/2 relative bg-gray-900 overflow-hidden min-h-screen">
                <img src="{{ asset('assets/img/auth/login-kanan.png') }}" 
                    alt="Wanita Membaca di Sofa MacaBae" 
                    class="absolute inset-0 w-full h-full object-cover scale-105 hover:scale-100 transition-transform duration-1000 ease-in-out z-0">
                
                {{-- Overlay Teks --}}
                <div class="absolute bottom-10 left-16 right-16 text-white z-10 max-w-xl">
                    <h2 class="text-4xl font-bold leading-tight tracking-tight">Baca dengan caramu sendiri 😉</h2>
                    <p class="mt-1 text-lg text-gray-100 font-regular">Rebahan, santai, dan tenggelam dalam cerita tanpa batas.</p>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/login.js') }}"></script>
    </x-guest-layout>