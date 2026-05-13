<x-guest-layout>
    @section('title', 'Daftar Akun')
    <div class="flex min-h-screen">
        
        <div class="w-full md:w-1/2 flex flex-col justify-between bg-white px-8 py-10 sm:p-16 md:p-20 relative z-10 min-h-screen">
            
            <div class="w-full max-w-md mx-auto">
                <a href="/" class="flex items-center gap-2 mb-20 transition hover:opacity-80">
                    <img src="{{ asset('assets/img/brand/logo-macabae.png') }}" alt="Logo MacaBae" class="h-9">
                </a>

                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-[#2F3951] tracking-tight">Daftar Akun Baru ✨</h1>
                    <p class="text-gray-500 mt-2 text-sm">Bergabunglah untuk mulai menjelajahi ribuan buku digital.</p>
                </div>

            <form id="registerForm">
                @csrf
                
                <div id="step-1" class="space-y-5 transition-all duration-500 transform">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input id="name" type="text" name="name" required class="w-full px-5 py-3 rounded-xl border border-gray-200 outline-none focus:border-[#4D9BE2]" placeholder="Nama lengkap kamu">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input id="email" type="email" name="email" required class="w-full px-5 py-3 rounded-xl border border-gray-200 outline-none focus:border-[#4D9BE2]" placeholder="email@macabae.com">
                    </div>
                    <div class="pt-4">
                        <button type="button" id="btn-otp" onclick="handleSendOtp()" class="w-full relative overflow-hidden bg-[#4D9BE2] hover:bg-[#3E8AD1] text-white py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 group">
                            Lanjut & Kirim Kode OTP
                        </button>
                    </div>
                </div>

                <div id="step-2" class="hidden space-y-5 opacity-0 scale-95 transition-all duration-500 transform">
                    <div class="text-center mb-6">
                        <h3 class="font-bold text-gray-800">Verifikasi Email 📩</h3>
                        <p class="text-xs text-gray-500">Masukkan 6 digit kode yang dikirim ke email kamu.</p>
                    </div>
                    <div>
                        <input id="otp" type="text" maxlength="6" class="w-full text-center tracking-[10px] text-2xl font-bold px-5 py-3 rounded-xl border border-gray-200 outline-none focus:border-[#4D9BE2]" placeholder="000000">
                    </div>
                    <div class="pt-4">
                        <button type="button" onclick="handleVerifyOtp()" class="w-full relative overflow-hidden bg-[#4D9BE2] hover:bg-[#3E8AD1] text-white py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 group">
                            Verifikasi Kode
                        </button>
                        <button type="button" onclick="location.reload()" class="w-full mt-4 text-xs text-gray-400 hover:underline">Ganti Email</button>
                    </div>
                </div>

                <div id="step-3" class="hidden space-y-5 opacity-0 scale-95 transition-all duration-500 transform">
                    <div class="bg-green-50 p-3 rounded-xl mb-4">
                        <p class="text-xs text-green-600 text-center font-medium">✓ Email berhasil diverifikasi. Buat password kamu.</p>
                    </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Buat Password</label>
                    {{-- Wrapper Input dibuat relative agar icon mata memposisikan diri dengan pas --}}
                    <div class="relative group">
                        <input id="password" type="password" name="password" required 
                            class="w-full pl-5 pr-12 py-3 rounded-xl border border-gray-200 outline-none focus:border-[#4D9BE2] bg-white transition" 
                            placeholder="••••••••">
                        
                        <button type="button" onclick="toggleRegisterPassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#4D9BE2] transition px-1">
                            <span id="regEyeIcon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                    {{-- Wrapper Input Konfirmasi --}}
                    <div class="relative group">
                        <input id="password_confirmation" type="password" name="password_confirmation" required 
                            class="w-full pl-5 pr-12 py-3 rounded-xl border border-gray-200 outline-none focus:border-[#4D9BE2] bg-white transition" 
                            placeholder="••••••••">
                        
                        <button type="button" onclick="toggleRegisterPasswordConfirm()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#4D9BE2] transition px-1">
                            <span id="regConfirmEyeIcon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
                    <div class="pt-4">
                        <button type="button" onclick="handleFinalRegister()" class="w-full relative overflow-hidden bg-[#4D9BE2] hover:bg-[#3E8AD1] text-white py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 group">
                            Selesaikan Pendaftaran
                        </button>
                    </div>
                </div>
            </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-[#4D9BE2] font-semibold hover:underline transition">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="hidden md:block md:w-1/2 relative bg-gray-900 overflow-hidden min-h-screen">
            <img src="{{ asset('assets/img/auth/login-kanan.png') }}" 
                 alt="Wanita Membaca di Sofa MacaBae" 
                 class="absolute inset-0 w-full h-full object-cover scale-105 hover:scale-100 transition-transform duration-1000 ease-in-out z-0">
            
            <div class="absolute bottom-10 left-16 right-16 text-white z-10 max-w-xl">
                <h2 class="text-4xl font-bold leading-tight tracking-tight">Mulai petualanganmu hari ini 🚀</h2>
                <p class="mt-2 text-regular text-gray-100 font-medium">Bergabunglah dengan ribuan pembaca lainnya dan nikmati akses tanpa batas.</p>
            </div>

            <div class="absolute top-0 right-0 w-96 h-96 bg-[#4D9BE2]/30 rounded-full -mr-32 -mt-32 blur-3xl z-0"></div>
        </div>
    </div>
    <script src="{{ asset('assets/js/register-otp.js') }}"></script>
</x-guest-layout>