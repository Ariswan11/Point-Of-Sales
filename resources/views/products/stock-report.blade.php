<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <p class="text-uppercase small text-warning fw-bold mb-1">Laporan</p>
                <h2 class="h4 mb-0 fw-bold text-dark">Laporan Stok</h2>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('products.stock-report') }}" class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label for="search" class="form-label fw-semibold">Search</label>
                        <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Cari kode, nama, atau barcode">
                    </div>
                    <div class="col-md-4">
                        <label for="category_id" class="form-label fw-semibold">Filter Kategori</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-warning fw-semibold flex-fill">
                            Cari
                        </button>
                        <a href="{{ route('products.stock-report') }}" class="btn btn-outline-secondary flex-fill">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header border-0 bg-white py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="h5 mb-0 fw-bold">Daftar Stok Produk</h3>
                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">{{ $products->count() }} data</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td class="px-4 fw-semibold">{{ $product->kode_produk }}</td>
                                    <td>
                                        {{ $product->nama }}
                                        @if ($product->stok <= 5)
                                            <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill px-2 py-1 ms-2">Stok Rendah</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->category?->nama ?? '-' }}</td>
                                    <td>
                                        @if ($product->stok <= 5)
                                            <span class="text-danger fw-bold">{{ $product->stok }}</span>
                                        @else
                                            {{ $product->stok }}
                                        @endif
                                    </td>
                                    <td>{{ $product->satuan ?? '-' }}</td>
                                    <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        Tidak ada data produk.
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
