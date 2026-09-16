import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const ensureSweetAlert = () => new Promise((resolve) => {
    if (window.Swal) {
        resolve(window.Swal);
        return;
    }

    const script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
    script.onload = () => resolve(window.Swal);
    script.onerror = () => resolve(null);
    document.body.appendChild(script);
});

document.addEventListener('DOMContentLoaded', async () => {
    const swal = await ensureSweetAlert();

    if (!swal) {
        return;
    }

    document.querySelectorAll('[data-swal-success]').forEach((element) => {
        const message = element.dataset.swalSuccess;

        if (message) {
            swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: message,
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#f59e0b',
                timer: 2500,
                timerProgressBar: true,
            });
        }
    });

    document.querySelectorAll('[data-swal-error]').forEach((element) => {
        const message = element.dataset.swalError;

        if (message) {
            swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: message,
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#dc3545',
            });
        }
    });

    document.querySelectorAll('[data-toggle-password]').forEach((toggleButton) => {
        const targetId = toggleButton.dataset.togglePassword;
        const passwordInput = document.getElementById(targetId);

        if (!passwordInput) {
            return;
        }

        toggleButton.addEventListener('click', () => {
            const isPasswordHidden = passwordInput.type === 'password';
            const iconElement = toggleButton.querySelector('i');

            passwordInput.type = isPasswordHidden ? 'text' : 'password';

            if (iconElement) {
                iconElement.classList.toggle('bi-eye', !isPasswordHidden);
                iconElement.classList.toggle('bi-eye-slash', isPasswordHidden);
            }

            toggleButton.setAttribute('aria-label', isPasswordHidden ? 'Sembunyikan password' : 'Tampilkan password');
        });
    });

    document.querySelectorAll('form[data-confirm-delete]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();

            swal.fire({
                title: 'Konfirmasi Hapus',
                text: form.dataset.confirmDelete || 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
