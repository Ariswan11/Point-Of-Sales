<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <p class="text-uppercase small text-warning fw-bold mb-1">Overview</p>
                <h2 class="h4 mb-0 fw-bold text-dark">Dashboard</h2>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3 py-2">
                    POS System
                </span>
                <span class="badge bg-dark text-white rounded-pill px-3 py-2">
                    Live
                </span>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 45%, #23395d 100%);">
            <div class="card-body p-4 p-lg-5 text-white">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <div class="d-inline-flex align-items-center gap-2 bg-white bg-opacity-10 border border-white border-opacity-10 rounded-pill px-3 py-2 mb-3">
                            <span class="rounded-circle bg-warning" style="width: 10px; height: 10px; display: inline-block;"></span>
                            <span class="small text-white-50">Status sistem aktif</span>
                        </div>
                        <h3 class="fw-bold mb-2 display-6">Selamat datang di POS Mitra</h3>
                        <p class="text-white-50 mb-0" style="max-width: 620px;">
                            Pantau penjualan, stok barang, pelanggan, dan performa bisnis Anda dari satu dashboard yang lebih rapi dan modern.
                        </p>
                    </div>

                    <div class="col-lg-4">
                        <div class="bg-white bg-opacity-10 border border-white border-opacity-10 rounded-4 p-3">
                            <div class="small text-white-50">Pendapatan hari ini</div>
                            <div class="fw-bold fs-3 mt-2">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</div>
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <span class="small text-white-50">Transaksi</span>
                                <span class="badge bg-success-subtle text-success-emphasis rounded-pill px-2 py-1">+12.5%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="rounded-4 p-3 bg-primary-subtle text-primary">
                                <i class="bi bi-box-seam fs-4"></i>
                            </div>
                            <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill px-2 py-1">Produk</span>
                        </div>
                        <div class="text-muted small">Total Produk</div>
                        <div class="fs-3 fw-bold mt-1">{{ $stats['products'] }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="rounded-4 p-3 bg-success-subtle text-success">
                                <i class="bi bi-tags fs-4"></i>
                            </div>
                            <span class="badge bg-success-subtle text-success-emphasis rounded-pill px-2 py-1">Kategori</span>
                        </div>
                        <div class="text-muted small">Total Kategori</div>
                        <div class="fs-3 fw-bold mt-1">{{ $stats['categories'] }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="rounded-4 p-3 bg-warning-subtle text-warning">
                                <i class="bi bi-people fs-4"></i>
                            </div>
                            <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-2 py-1">Pelanggan</span>
                        </div>
                        <div class="text-muted small">Total Pelanggan</div>
                        <div class="fs-3 fw-bold mt-1">{{ $stats['customers'] }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="rounded-4 p-3 bg-info-subtle text-info">
                                <i class="bi bi-truck fs-4"></i>
                            </div>
                            <span class="badge bg-info-subtle text-info-emphasis rounded-pill px-2 py-1">Supplier</span>
                        </div>
                        <div class="text-muted small">Total Supplier</div>
                        <div class="fs-3 fw-bold mt-1">{{ $stats['suppliers'] }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="rounded-4 p-3 bg-danger-subtle text-danger">
                                <i class="bi bi-receipt fs-4"></i>
                            </div>
                            <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill px-2 py-1">Transaksi</span>
                        </div>
                        <div class="text-muted small">Total Transaksi</div>
                        <div class="fs-3 fw-bold mt-1">{{ $stats['sales'] }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="rounded-4 p-3 bg-secondary-subtle text-secondary">
                                <i class="bi bi-currency-dollar fs-4"></i>
                            </div>
                            <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill px-2 py-1">Pendapatan</span>
                        </div>
                        <div class="text-muted small">Total Pendapatan</div>
                        <div class="fs-3 fw-bold mt-1">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 mt-4 overflow-hidden">
            <div class="card-header border-0 bg-white py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="h5 mb-0 fw-bold">Ringkasan Penjualan</h3>
                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">5 data terbaru</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">Tanggal</th>
                                <th>No. Faktur</th>
                                <th>Pelanggan</th>
                                <th>Kasir</th>
                                <th class="text-end px-4">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentSales as $sale)
                                <tr>
                                    <td class="px-4">{{ $sale->tanggal_penjualan->format('d M Y') }}</td>
                                    <td>{{ $sale->nomor_faktur }}</td>
                                    <td>{{ $sale->customer?->nama ?? 'Umum' }}</td>
                                    <td>{{ $sale->user?->name ?? '-' }}</td>
                                    <td class="text-end fw-semibold px-4">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Belum ada data penjualan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
