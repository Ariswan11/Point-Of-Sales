<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <p class="text-uppercase small text-warning fw-bold mb-1">Laporan</p>
                <h2 class="h4 mb-0 fw-bold text-dark">Laporan Penjualan</h2>
            </div>
            <button type="button" class="btn btn-warning fw-semibold rounded-pill px-4" onclick="window.print()">
                <i class="bi bi-printer me-2"></i>Cetak Laporan
            </button>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('sales.report') }}" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label fw-semibold">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label fw-semibold">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-warning fw-semibold flex-fill">
                            Filter
                        </button>
                        <a href="{{ route('sales.report') }}" class="btn btn-outline-secondary flex-fill">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <p class="text-uppercase small text-muted mb-2">Periode</p>
                        <h3 class="h5 fw-bold mb-0">{{ \Carbon\Carbon::parse($startDate)->translatedFormat('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d M Y') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <p class="text-uppercase small text-muted mb-2">Total Penjualan</p>
                        <h3 class="h5 fw-bold mb-0">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header border-0 bg-white py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="h5 mb-0 fw-bold">Daftar Transaksi</h3>
                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">{{ $sales->count() }} transaksi</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">No</th>
                                <th>Nomor Faktur</th>
                                <th>Tanggal</th>
                                <th>Kasir</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Pembayaran</th>
                                <th>Kembalian</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sales as $index => $sale)
                                <tr>
                                    <td class="px-4">{{ $index + 1 }}</td>
                                    <td class="fw-semibold">{{ $sale->nomor_faktur }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sale->tanggal_penjualan)->translatedFormat('d M Y') }}</td>
                                    <td>{{ $sale->user->name }}</td>
                                    <td>{{ $sale->customer?->nama ?? 'Umum / Walk In' }}</td>
                                    <td>Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($sale->dibayar, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($sale->kembalian, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('sales.detail', $sale) }}" class="btn btn-sm btn-action-secondary">
                                            <i class="bi bi-eye"></i>
                                            <span>Detail</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">
                                        Tidak ada transaksi pada periode ini.
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
