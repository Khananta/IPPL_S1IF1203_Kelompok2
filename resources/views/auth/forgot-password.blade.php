<x-guest-layout>
    @section('title', 'Lupa Password')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#F8FAFC] antialiased">
        
        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white border border-gray-100 shadow-sm rounded-[32px]">
            
            <div class="flex justify-center mb-8">
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('assets/img/brand/logo-macabae.png') }}" alt="Logo MacaBae" class="h-9">
                </a>
            </div>

            <div class="mb-4 text-center">
                <h2 class="text-xl font-bold text-[#2F3951]">Pulihkan Kata Sandi 👋</h2>
                <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                    {{ __('Lupa kata sandi? Tidak masalah. Cukup masukkan alamat email kamu di bawah ini, dan kami akan mengirimkan tautan pemulihan.') }}
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" id="forgotPasswordForm" class="space-y-6 mt-6">
                @csrf

                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Alamat Email</label>
                    <div class="relative">
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                            class="w-full px-5 py-3.5 rounded-xl border border-gray-200 focus:border-[#4D9BE2] focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition outline-none bg-white text-gray-700 placeholder-gray-400 text-sm"
                            placeholder="masukan email terdaftar kamu">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <button type="submit" id="btnSubmitForgot"
                        class="w-full bg-gradient-to-r from-[#4D9BE2] to-[#3584CC] text-white py-3.5 rounded-xl font-semibold text-sm shadow-lg hover:shadow-xl hover:from-[#3584CC] hover:to-[#2A72B5] transition-all duration-300 inline-flex items-center justify-center gap-2">
                        <span>{{ __('Kirim Tautan Pemulihan') }}</span>
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-[#4D9BE2] transition-colors">
                    ← Kembali ke halaman masuk
                </a>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/app-toast.js') }}"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const forgotForm = document.getElementById('forgotPasswordForm');
        const btnSubmit = document.getElementById('btnSubmitForgot');

        if (forgotForm) {
            forgotForm.addEventListener('submit', async function(e) {
                e.preventDefault(); // Mencegah halaman reload kaku

                const formData = new FormData(forgotForm);
                const data = Object.fromEntries(formData);

                // Ubah tombol jadi loading state
                btnSubmit.disabled = true;
                btnSubmit.innerHTML = `<span class="animate-pulse">Mengirim Tautan...</span>`;

                try {
                    const response = await fetch(forgotForm.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();

                    if (response.ok && result.success) {
                        // Panggil Toast Global Sukses
                        showToast('success', result.message);
                        
                        // Kosongkan input email jika berhasil
                        document.getElementById('email').value = '';
                    } else {
                        // Panggil Toast Global Gagal (Email tidak terdaftar)
                        showToast('error', result.message || 'Gagal memproses permintaan.');
                    }
                } catch (error) {
                    console.error('Error Forgot Password:', error);
                    showToast('error', 'Terjadi gangguan koneksi ke server.');
                } finally {
                    // Kembalikan tombol ke semula apa pun hasilnya
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = '<span>Kirim Tautan Pemulihan</span>';
                }
            });
        }
    });
    </script>
</x-guest-layout>