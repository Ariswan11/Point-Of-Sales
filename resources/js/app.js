import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.addEventListener('DOMContentLoaded', () => {
    const swal = window.Swal;

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
                title: 'Terjadi Kesalahan',
                text: message,
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#dc3545',
            });
        }
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
