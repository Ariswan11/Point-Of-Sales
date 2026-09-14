<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-body-tertiary">
        <div class="min-vh-100 d-flex align-items-center justify-content-center px-3 py-5" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 45%, #23395d 100%);">
            <div class="card border-0 shadow-lg overflow-hidden" style="width: min(100%, 960px); border-radius: 1.5rem;">
                <div class="row g-0">
                    <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center text-white p-5" style="background: linear-gradient(160deg, rgba(255,193,7,0.2), rgba(15,23,42,0.85));">
                        <div class="text-center">
                            <div class="mx-auto d-flex align-items-center justify-content-center rounded-circle fw-bold border border-white border-opacity-25" style="width: 76px; height: 76px; background: rgba(255,255,255,0.08); font-size: 1.7rem;">
                                POS
                            </div>
                            <h2 class="mt-4 fw-bold mb-2">POS Mitra</h2>
                            <p class="mb-0 text-white-50">
                                Kelola produk, pelanggan, penjualan, dan laporan secara lebih cepat dan rapi.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="card-body p-4 p-md-5">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
