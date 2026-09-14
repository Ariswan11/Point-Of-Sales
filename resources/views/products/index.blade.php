<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <p class="text-uppercase small text-warning fw-bold mb-1">Master Data</p>
                <h2 class="h4 mb-0 fw-bold text-dark">Produk</h2>
            </div>
            <a href="{{ route('products.create') }}" class="btn btn-warning fw-semibold rounded-pill px-4">
                <i class="bi bi-plus-lg me-2"></i>Tambah Produk
            </a>
        </div>
    </x-slot>

    <div class="container py-4">
        <div data-swal-success="{{ session('success') }}" style="display:none"></div>

        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('products.index') }}" class="row g-3 align-items-end">
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
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary flex-fill">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header border-0 bg-white py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="h5 mb-0 fw-bold">Daftar Produk</h3>
                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">{{ $products->count() }} data</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $index => $product)
                                <tr>
                                    <td class="px-4">{{ $index + 1 }}</td>
                                    <td class="fw-semibold">{{ $product->kode_produk }}</td>
                                    <td>{{ $product->nama }}</td>
                                    <td>{{ $product->category?->nama ?? '-' }}</td>
                                    <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                                    <td>{{ $product->stok }}</td>
                                    <td>{{ $product->satuan }}</td>
                                    <td>
                                        @if ($product->status === 'aktif')
                                            <span class="badge bg-success-subtle text-success-emphasis rounded-pill px-2 py-1">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill px-2 py-1">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                Edit
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" data-confirm-delete="Apakah Anda yakin ingin menghapus produk ini?">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted py-4">
                                        Belum ada data produk.
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
