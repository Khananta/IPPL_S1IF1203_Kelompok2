// 1. Konfigurasi Dasar Toast MacaBae (Global)
const MacaBaeToast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000, // Disetel ke 2.5 detik agar pustakawan sempat membaca pesan sukses
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

// 2. Fungsi Helper Global Utama (Dipakai oleh Blade)
function fireToast(iconType, message) {
    MacaBaeToast.fire({
        icon: iconType, // 'success', 'error', 'warning', 'info'
        title: message
    });
}

// 3. Cadangan Helper (Biar aman kalau ada script lama yang manggil showToast)
function showToast(icon, message) {
    fireToast(icon, message);
}

document.addEventListener('DOMContentLoaded', function () {
    // Menangkap semua klik pada form yang memiliki class 'form-hapus-macabae'
    document.body.addEventListener('submit', function (e) {
        if (e.target && e.target.classList.contains('form-hapus-macabae')) {
            e.preventDefault(); // Tahan dulu proses kirim data ke server
            
            const form = e.target;
            const namaData = form.getAttribute('data-nama') || 'data ini';

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Data "${namaData}" yang dihapus tidak dapat dikembalikan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2F3951', // Warna gelap serasi dengan tema dasar MacaBae
                cancelButtonColor: '#EF4444',  // Warna merah tegas
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                borderRadius: '1rem',
                customClass: {
                    popup: 'rounded-2xl shadow-lg border border-gray-100',
                    confirmButton: 'px-5 py-2.5 rounded-xl font-semibold text-sm',
                    cancelButton: 'px-5 py-2.5 rounded-xl font-semibold text-sm'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Jika klik "Ya", teruskan pengiriman data ke controller
                }
            });
        }
    });
});