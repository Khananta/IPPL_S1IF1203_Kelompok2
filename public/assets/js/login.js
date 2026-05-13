document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const btnSubmit = document.getElementById('btnSubmit');

    if(loginForm) {
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(loginForm);
            const data = Object.fromEntries(formData);

            btnSubmit.disabled = true;
            btnSubmit.innerHTML = `<span class="animate-pulse">Memeriksa...</span>`;

            try {
                const response = await fetch("/login", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    showToast('success', 'Login berhasil! Mengalihkan...');
                    
                    setTimeout(() => {
                        window.location.href = result.redirect;
                    }, 1500);
                } else {
                    showToast('error', result.message || 'Gagal masuk aplikasi.');
                    
                    btnSubmit.disabled = false;
                    btnSubmit.innerText = 'Masuk';
                }

            } catch (error) {
                console.error(error);
                showToast('error', 'Terjadi kesalahan sistem.');
                btnSubmit.disabled = false;
                btnSubmit.innerText = 'Masuk';
            }
        });
    }
});

function togglePasswordLogin() {
    const passwordInput = document.getElementById('password');
    const eyeIconContainer = document.getElementById('eyeIconLogin');

    const eyeOpenSvg = `
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
    `;

    const eyeClosedSvg = `
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12c1.388 4.17 5.32 7.178 9.963 7.178 2.15 0 4.154-.504 5.922-1.402m1.944-2.072a10.477 10.477 0 001.934-3.704c-1.388-4.17-5.32-7.178-9.963-7.178z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5M3 3l18 18" />
        </svg>
    `;

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIconContainer.innerHTML = eyeClosedSvg;
    } else {
        passwordInput.type = 'password';
        eyeIconContainer.innerHTML = eyeOpenSvg;
    }
}
