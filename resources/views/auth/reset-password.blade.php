<x-guest-layout>
    @section('title', 'Atur Ulang Password')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#F8FAFC] antialiased">
        
        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white border border-gray-100 shadow-sm rounded-[32px]">
            
            {{-- Branding Logo MacaBae --}}
            <div class="flex justify-center mb-8">
                <a href="/" class="flex items-center gap-3">
                    <span class="text-3xl font-bold text-[#2F3951] tracking-tight">MacaBae<span class="text-[#4D9BE2]">.</span></span>
                </a>
            </div>

            <div class="mb-8 text-center">
                <h2 class="text-xl font-bold text-[#2F3951]">Atur Ulang Kata Sandi 👋</h2>
                <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                    {{ __('Silakan buat kata sandi baru yang kuat untuk mengamankan kembali akun MacaBae kamu.') }}
                </p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email Kamu</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required readonly
                        class="w-full px-5 py-3.5 rounded-xl border border-gray-100 bg-gray-50 text-gray-400 text-sm outline-none cursor-not-allowed">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-gray-700">Kata Sandi Baru</label>
                    <div class="relative group">
                        <input id="password" type="password" name="password" required autofocus
                            class="w-full pl-5 pr-12 py-3.5 rounded-xl border border-gray-200 focus:border-[#4D9BE2] focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition outline-none bg-white text-sm"
                            placeholder="buat kata sandi baru">
                        
                        <button type="button" onclick="toggleResetPass('password', 'eyeIcon1')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#4D9BE2] transition px-1">
                            <span id="eyeIcon1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Konfirmasi Kata Sandi</label>
                    <div class="relative group">
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full pl-5 pr-12 py-3.5 rounded-xl border border-gray-200 focus:border-[#4D9BE2] focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition outline-none bg-white text-sm"
                            placeholder="ulangi kata sandi baru">
                        
                        <button type="button" onclick="toggleResetPass('password_confirmation', 'eyeIcon2')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#4D9BE2] transition px-1">
                            <span id="eyeIcon2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-[#4D9BE2] to-[#3584CC] text-white py-3.5 rounded-xl font-semibold text-sm shadow-lg hover:shadow-xl hover:from-[#3584CC] hover:to-[#2A72B5] transition-all duration-300">
                        {{ __('Simpan Kata Sandi Baru') }}
                    </button>
                </div>
            </form>

        </div>
    </div>

    {{-- Script Sederhana untuk Mata (Reusable) --}}
    <script>
        function toggleResetPass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const iconContainer = document.getElementById(iconId);

            const eyeOpen = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>`;
            const eyeClosed = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12c1.388 4.17 5.32 7.178 9.963 7.178 2.15 0 4.154-.504 5.922-1.402m1.944-2.072a10.477 10.477 0 001.934-3.704c-1.388-4.17-5.32-7.178-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5M3 3l18 18" /></svg>`;

            if (input.type === 'password') {
                input.type = 'text';
                iconContainer.innerHTML = eyeClosed;
            } else {
                input.type = 'password';
                iconContainer.innerHTML = eyeOpen;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/app-toast.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cari form berdasarkan ID baru
    const resetForm = document.querySelector('form[action="{{ route('password.store') }}"]');
    if (resetForm) resetForm.setAttribute('id', 'resetPasswordForm');
    
    const btnSubmit = resetForm ? resetForm.querySelector('button[type="submit"]') : null;
    if (btnSubmit) btnSubmit.setAttribute('id', 'btnSubmitReset');

    if (resetForm && btnSubmit) {
        resetForm.addEventListener('submit', async function(e) {
            e.preventDefault(); // Cegah reload halaman

            const formData = new FormData(resetForm);
            const data = Object.fromEntries(formData);

            // Loading state tombol
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = `<span class="animate-pulse">Menyimpan Sandi Baru...</span>`;

            try {
                const response = await fetch(resetForm.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    // Tampilkan Toast Sukses
                    showToast('success', result.message);
                    
                    // Alihkan ke halaman login setelah 1.5 detik
                    setTimeout(() => {
                        window.location.href = result.redirect;
                    }, 1500);
                } else {
                    // Tampilkan Toast Gagal (Misal: token expired / password konfirmasi beda)
                    showToast('error', result.message || 'Gagal memperbarui kata sandi.');
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = 'Simpan Kata Sandi Baru';
                }
            } catch (error) {
                console.error('Error Reset Password:', error);
                showToast('error', 'Terjadi gangguan koneksi ke server.');
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = 'Simpan Kata Sandi Baru';
            }
        });
    }
});
</script>
</x-guest-layout>