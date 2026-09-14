<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-0 fw-bold text-dark">Dashboard</h2>
            </div>
            <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill px-3 py-2">
                POS System
            </span>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small">Total Produk</div>
                                <div class="fs-3 fw-bold mt-2">{{ $stats['products'] }}</div>
                            </div>
                            <div class="rounded-circle bg-primary-subtle p-3 text-primary">
                                <i class="bi bi-box-seam fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small">Total Kategori</div>
                                <div class="fs-3 fw-bold mt-2">{{ $stats['categories'] }}</div>
                            </div>
                            <div class="rounded-circle bg-success-subtle p-3 text-success">
                                <i class="bi bi-tags fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small">Total Pelanggan</div>
                                <div class="fs-3 fw-bold mt-2">{{ $stats['customers'] }}</div>
                            </div>
                            <div class="rounded-circle bg-warning-subtle p-3 text-warning">
                                <i class="bi bi-people fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small">Total Supplier</div>
                                <div class="fs-3 fw-bold mt-2">{{ $stats['suppliers'] }}</div>
                            </div>
                            <div class="rounded-circle bg-info-subtle p-3 text-info">
                                <i class="bi bi-truck fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small">Total Transaksi</div>
                                <div class="fs-3 fw-bold mt-2">{{ $stats['sales'] }}</div>
                            </div>
                            <div class="rounded-circle bg-danger-subtle p-3 text-danger">
                                <i class="bi bi-receipt fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small">Total Pendapatan</div>
                                <div class="fs-3 fw-bold mt-2">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</div>
                            </div>
                            <div class="rounded-circle bg-secondary-subtle p-3 text-secondary">
                                <i class="bi bi-currency-dollar fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white border-0 py-3">
                <h3 class="h5 mb-0 fw-bold">Ringkasan Penjualan</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>No. Faktur</th>
                                <th>Pelanggan</th>
                                <th>Kasir</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentSales as $sale)
                                <tr>
                                    <td>{{ $sale->tanggal_penjualan->format('d M Y') }}</td>
                                    <td>{{ $sale->nomor_faktur }}</td>
                                    <td>{{ $sale->customer?->nama ?? 'Umum' }}</td>
                                    <td>{{ $sale->user?->name ?? '-' }}</td>
                                    <td class="text-end fw-semibold">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
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
