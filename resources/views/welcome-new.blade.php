<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'POS Mitra') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            body {
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            }

            .hero-section {
                background: linear-gradient(135deg, #0d1b2a 0%, #1b263b 48%, #23395d 100%);
            }

            .feature-icon {
                width: 52px;
                height: 52px;
                border-radius: 14px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 1.4rem;
                background: rgba(255, 193, 7, 0.18);
                color: #ffc107;
            }
        </style>
    </head>
    <body class="bg-body-tertiary text-dark">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container py-2">
                <a class="navbar-brand fw-bold fs-4" href="{{ url('/') }}">
                    <span class="text-warning">POS</span> <span class="text-white">Mitra</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                        <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                        <li class="nav-item"><a class="nav-link" href="#manfaat">Manfaat</a></li>
                        <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a href="{{ url('/dashboard') }}" class="btn btn-warning fw-semibold px-3 ms-lg-2">Ke Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="btn btn-outline-light ms-lg-2">Masuk</a>
                                </li>
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <section class="hero-section text-white py-5 py-lg-6">
                <div class="container py-4 py-lg-5">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-6">
                            <div class="badge bg-warning text-dark fw-semibold px-3 py-2 mb-3 rounded-pill">
                                Aplikasi Point of Sale Modern
                            </div>
                            <h1 class="display-4 fw-bold lh-sm mb-3">
                                Kelola penjualan, stok, dan pelanggan dalam satu dashboard.
                            </h1>
                            <p class="fs-5 text-light-emphasis mb-4">
                                POS Mitra membantu toko, warung, dan bisnis retail mengelola transaksi lebih cepat,
                                memantau stok secara real-time, dan membuat laporan penjualan dengan mudah.
                            </p>

                            <div class="d-flex flex-wrap gap-3">
                                @if (Route::has('login'))
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="btn btn-warning btn-lg px-4 fw-semibold">Buka Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-warning btn-lg px-4 fw-semibold">Masuk Sekarang</a>
                                    @endauth
                                @endif
                            </div>

                            <div class="row mt-5 g-3">
                                <div class="col-sm-4">
                                    <div class="bg-white bg-opacity-10 border border-white border-opacity-10 rounded-4 p-3 h-100">
                                        <div class="fw-bold fs-4 text-warning">2.4K</div>
                                        <div class="small text-light-emphasis">Transaksi bulan ini</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="bg-white bg-opacity-10 border border-white border-opacity-10 rounded-4 p-3 h-100">
                                        <div class="fw-bold fs-4 text-warning">98%</div>
                                        <div class="small text-light-emphasis">Kepuasan pengguna</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="bg-white bg-opacity-10 border border-white border-opacity-10 rounded-4 p-3 h-100">
                                        <div class="fw-bold fs-4 text-warning">24/7</div>
                                        <div class="small text-light-emphasis">Akses dashboard</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="bg-white bg-opacity-10 border border-white border-opacity-10 rounded-5 p-3 shadow-lg">
                                <div class="bg-dark rounded-4 p-4 border border-secondary-subtle">
                                    <div class="d-flex justify-content-between align-items-center border-bottom border-secondary pb-3 mb-3">
                                        <div>
                                            <div class="small text-secondary">Ringkasan Hari Ini</div>
                                            <div class="fw-bold fs-4">Rp 18.450.000</div>
                                        </div>
                                        <span class="badge bg-success-subtle text-success-emphasis border border-success-subtle">+12.5%</span>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="bg-body-secondary rounded-4 p-3 h-100">
                                                <div class="small text-secondary">Penjualan</div>
                                                <div class="fw-bold fs-5 text-dark">326</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="bg-body-secondary rounded-4 p-3 h-100">
                                                <div class="small text-secondary">Produk</div>
                                                <div class="fw-bold fs-5 text-dark">124</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="bg-body-secondary rounded-4 p-3 h-100">
                                                <div class="small text-secondary">Pelanggan</div>
                                                <div class="fw-bold fs-5 text-dark">89</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="bg-body-secondary rounded-4 p-3 h-100">
                                                <div class="small text-secondary">Supplier</div>
                                                <div class="fw-bold fs-5 text-dark">15</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="small text-secondary">Penjualan Terakhir</span>
                                            <span class="small text-secondary">5 data</span>
                                        </div>
                                        <div class="list-group list-group-flush rounded-3 overflow-hidden">
                                            <div class="list-group-item bg-body-secondary border-0 px-3 py-2 d-flex justify-content-between align-items-center">
                                                <span>Produk A</span>
                                                <span class="fw-semibold">Rp 250.000</span>
                                            </div>
                                            <div class="list-group-item bg-body-secondary border-0 px-3 py-2 d-flex justify-content-between align-items-center">
                                                <span>Produk B</span>
                                                <span class="fw-semibold">Rp 170.000</span>
                                            </div>
                                            <div class="list-group-item bg-body-secondary border-0 px-3 py-2 d-flex justify-content-between align-items-center">
                                                <span>Produk C</span>
                                                <span class="fw-semibold">Rp 430.000</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="fitur" class="py-5 bg-white">
                <div class="container">
                    <div class="text-center mb-5">
                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-2 mb-3">
                            Fitur Utama
                        </span>
                        <h2 class="fw-bold mb-3">Semua kebutuhan operasional toko dalam satu tempat</h2>
                        <p class="text-secondary mx-auto" style="max-width: 720px;">
                            Aplikasi ini dirancang agar bisnis retail tetap cepat, rapi, dan efisien saat menangani penjualan, stok, pelanggan, dan supplier.
                        </p>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6 col-xl-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <div class="feature-icon mb-3">📦</div>
                                    <h5 class="fw-bold mb-2">Kelola Produk</h5>
                                    <p class="text-secondary mb-0">
                                        Tambah, edit, dan kategorikan produk dengan struktur data yang rapi.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <div class="feature-icon mb-3">💰</div>
                                    <h5 class="fw-bold mb-2">Transaksi Cepat</h5>
                                    <p class="text-secondary mb-0">
                                        Proses penjualan dengan cepat dan kelola detail pembelian secara lengkap.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <div class="feature-icon mb-3">👥</div>
                                    <h5 class="fw-bold mb-2">Pelanggan & Supplier</h5>
                                    <p class="text-secondary mb-0">
                                        Catat data pelanggan dan supplier untuk memudahkan transaksi berkala.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <div class="feature-icon mb-3">📊</div>
                                    <h5 class="fw-bold mb-2">Laporan & Dashboard</h5>
                                    <p class="text-secondary mb-0">
                                        Pantau performa usaha melalui dashboard yang menyajikan statistik penting.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="manfaat" class="py-5 bg-body-tertiary">
                <div class="container">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-6">
                            <h2 class="fw-bold mb-3">Kenapa bisnis Anda butuh POS yang terstruktur?</h2>
                            <ul class="list-group list-group-flush border rounded-4 overflow-hidden shadow-sm">
                                <li class="list-group-item py-3">
                                    <span class="fw-semibold">1.</span> Meminimalkan kesalahan pencatatan transaksi.
                                </li>
                                <li class="list-group-item py-3">
                                    <span class="fw-semibold">2.</span> Memudahkan admin memantau stok barang secara real-time.
                                </li>
                                <li class="list-group-item py-3">
                                    <span class="fw-semibold">3.</span> Menyediakan laporan penjualan yang lebih cepat dan akurat.
                                </li>
                                <li class="list-group-item py-3">
                                    <span class="fw-semibold">4.</span> Menjaga data pelanggan dan supplier tetap terorganisir.
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                <div class="card-body p-4 p-lg-5">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; font-size: 1.2rem; font-weight: 700;">
                                            ✓
                                        </div>
                                        <div>
                                            <div class="text-secondary small">Status Sistem</div>
                                            <div class="fw-bold fs-5">Siap digunakan</div>
                                        </div>
                                    </div>

                                    <div class="bg-success-subtle border border-success-subtle rounded-4 p-3 mb-3">
                                        <div class="small text-success-emphasis">Database</div>
                                        <div class="fw-semibold">Migrasi dan relasi model sudah tersedia.</div>
                                    </div>

                                    <div class="bg-primary-subtle border border-primary-subtle rounded-4 p-3 mb-3">
                                        <div class="small text-primary-emphasis">Autentikasi</div>
                                        <div class="fw-semibold">Login menggunakan akun yang tersimpan di database.</div>
                                    </div>

                                    <div class="bg-warning-subtle border border-warning-subtle rounded-4 p-3">
                                        <div class="small text-warning-emphasis">UI</div>
                                        <div class="fw-semibold">Tampilan telah diperbarui agar lebih rapi dan konsisten.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="kontak" class="py-5 bg-dark text-white">
                <div class="container">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2 mb-3">Mulai sekarang</span>
                            <h2 class="fw-bold mb-2">Siap menghadirkan sistem POS yang lebih profesional?</h2>
                            <p class="text-light-emphasis mb-0">
                                Gunakan aplikasi ini untuk mempercepat proses transaksi, mengelola stok secara lebih tertata, dan meningkatkan kontrol bisnis Anda.
                            </p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-warning btn-lg px-4 fw-semibold">Lanjut ke Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-warning btn-lg px-4 fw-semibold">Masuk ke Aplikasi</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
