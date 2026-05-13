// 1. Fungsi Helper untuk Animasi Transisi antar Step (ID disamakan pakai tanda hubung '-')
function switchStep(oldStepId, newStepId) {
    const oldStep = document.getElementById(oldStepId);
    const newStep = document.getElementById(newStepId);

    if (!oldStep || !newStep) return console.error('ID Step tidak ditemukan di HTML!');

    oldStep.classList.add('opacity-0', 'scale-95');
    
    setTimeout(() => {
        oldStep.classList.add('hidden');
        newStep.classList.remove('hidden');
        
        setTimeout(() => {
            newStep.classList.remove('opacity-0', 'scale-95');
        }, 50);
    }, 500);
}

// 2. STEP 1: Mengirim OTP ke Email
async function handleSendOtp() {
    const email = document.getElementById('email').value;
    const name = document.getElementById('name').value;
    const btn = document.getElementById('btn-otp');
    
    if(!name || !email) return showToast('warning', 'Nama dan Email wajib diisi!');

    btn.disabled = true;
    btn.innerHTML = '<span class="animate-pulse">Mengirim Kode...</span>';

    try {
        const response = await fetch("/register/send-otp", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ email, name })
        });

        const data = await response.json();

        if (response.ok && data.success) {
            showToast('success', data.message);
            switchStep('step-1', 'step-2'); // Pindah ke step 2
        } else {
            showToast('error', data.message || 'Gagal mengirim OTP.');
            btn.disabled = false;
            btn.innerText = 'Lanjut & Kirim Kode OTP';
        }
    } catch (error) {
        console.error('Error Step 1:', error);
        showToast('error', 'Terjadi kesalahan koneksi ke server.');
        btn.disabled = false;
        btn.innerText = 'Lanjut & Kirim Kode OTP';
    }
}

// 3. STEP 2: Verifikasi OTP (Sudah Dibenarkan, Tidak Copy-Paste Error Lagi)
async function handleVerifyOtp() {
    const email = document.getElementById('email').value;
    const otp = document.getElementById('otp').value;
    const btnVerify = document.getElementById('btn-verify'); // Pastikan tombol step 2 punya id ini
    
    if(otp.length < 6) return showToast('warning', 'Masukkan 6 digit kode OTP dengan benar.');

    if (btnVerify) {
        btnVerify.disabled = true;
        btnVerify.innerHTML = '<span class="animate-pulse">Memverifikasi...</span>';
    }

    try {
        // Panggil fungsi verifyOnly di RegisteredUserController
        const response = await fetch("/register/verify-otp", { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ email, otp })
        });

        const data = await response.json();

        if (response.ok && data.success) {
            showToast('success', data.message || 'OTP Valid!');
            switchStep('step-2', 'step-3'); // Pindah ke step password
        } else {
            showToast('error', data.message || 'Kode OTP salah atau kedaluwarsa.');
            if (btnVerify) {
                btnVerify.disabled = false;
                btnVerify.innerText = 'Verifikasi Kode';
            }
        }
    } catch (error) {
        console.error('Error Step 2:', error);
        showToast('error', 'Terjadi gangguan koneksi sistem.');
        if (btnVerify) {
            btnVerify.disabled = false;
            btnVerify.innerText = 'Verifikasi Kode';
        }
    }
}

// 4. STEP 3: Submit Pendaftaran Final
async function handleFinalRegister() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const otp = document.getElementById('otp').value;
    const password = document.getElementById('password').value;
    const password_confirmation = document.getElementById('password_confirmation').value;
    const btnRegister = document.getElementById('btn-register'); // Pastikan tombol final punya id ini

    if(!password) return showToast('warning', 'Password tidak boleh kosong!');
    if(password !== password_confirmation) return showToast('warning', 'Konfirmasi password tidak cocok.');

    if (btnRegister) {
        btnRegister.disabled = true;
        btnRegister.innerHTML = '<span class="animate-pulse">Menyimpan Akun...</span>';
    }

    try {
        const response = await fetch("/register", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ name, email, otp, password, password_confirmation })
        });

        const data = await response.json();

        if (response.ok && data.success) {
            showToast('success', data.message || 'Pendaftaran berhasil!');
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 1500);
        } else {
            showToast('error', data.message || 'Pendaftaran gagal.');
            if (btnRegister) {
                btnRegister.disabled = false;
                btnRegister.innerText = 'Selesai & Daftar';
            }
        }
    } catch (error) {
        console.error('Error Step 3:', error);
        showToast('error', 'Terjadi kesalahan saat menyimpan akun.');
        if (btnRegister) {
            btnRegister.disabled = false;
            btnRegister.innerText = 'Selesai & Daftar';
        }
    }
}

// ==========================================
// TOGGLE PASSWORD EYE ICONS (TETAP SAMA)
// ==========================================
const eyeOpenSvg = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>`;
const eyeClosedSvg = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12c1.388 4.17 5.32 7.178 9.963 7.178 2.15 0 4.154-.504 5.922-1.402m1.944-2.072a10.477 10.477 0 001.934-3.704c-1.388-4.17-5.32-7.178-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5M3 3l18 18" /></svg>`;

function toggleRegisterPassword() {
    const input = document.getElementById('password');
    const container = document.getElementById('regEyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        container.innerHTML = eyeClosedSvg;
    } else {
        input.type = 'password';
        container.innerHTML = eyeOpenSvg;
    }
}

function toggleRegisterPasswordConfirm() {
    const input = document.getElementById('password_confirmation');
    const container = document.getElementById('regConfirmEyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        container.innerHTML = eyeClosedSvg;
    } else {
        input.type = 'password';
        container.innerHTML = eyeOpenSvg;
    }
}