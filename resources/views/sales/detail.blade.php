<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <p class="text-uppercase small text-warning fw-bold mb-1">Laporan</p>
                <h2 class="h4 mb-0 fw-bold text-dark">Detail Transaksi</h2>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('sales.report') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    Kembali
                </a>
                <a href="{{ route('sales.receipt', $sale) }}" class="btn btn-warning fw-semibold rounded-pill px-4">
                    Cetak Struk
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted">Nomor Transaksi</label>
                        <div class="fw-bold">{{ $sale->nomor_faktur }}</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted">Tanggal</label>
                        <div>{{ \Carbon\Carbon::parse($sale->tanggal_penjualan)->translatedFormat('d M Y') }}</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted">Kasir</label>
                        <div>{{ $sale->user->name }}</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted">Pelanggan</label>
                        <div>{{ $sale->customer?->nama ?? 'Umum / Walk In' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header border-0 bg-white py-3 px-4">
                <h3 class="h5 mb-0 fw-bold">Daftar Produk</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale->saleDetails as $detail)
                                <tr>
                                    <td class="px-4">{{ $detail->product->nama ?? '-' }}</td>
                                    <td>{{ $detail->jumlah }}</td>
                                    <td>Rp {{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 mt-4">
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted">Catatan</label>
                        <div>{{ $sale->catatan ?: '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column gap-2 align-items-md-end">
                            <div class="d-flex justify-content-between w-100" style="max-width: 260px;">
                                <span>Total</span>
                                <strong>Rp {{ number_format($sale->total, 0, ',', '.') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between w-100" style="max-width: 260px;">
                                <span>Pembayaran</span>
                                <strong>Rp {{ number_format($sale->dibayar, 0, ',', '.') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between w-100" style="max-width: 260px;">
                                <span>Kembalian</span>
                                <strong>Rp {{ number_format($sale->kembalian, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
