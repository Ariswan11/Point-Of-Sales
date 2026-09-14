<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="text-uppercase small text-warning fw-bold mb-1">Transaksi</p>
                <h2 class="h4 mb-0 fw-bold text-dark">Pembelian Barang</h2>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-lg-5">
                        <form action="{{ route('purchases.store') }}" method="POST">
                            @csrf

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="supplier_id" class="form-label fw-semibold">Supplier</label>
                                    <select class="form-select @error('supplier_id') is-invalid @enderror" id="supplier_id" name="supplier_id" required>
                                        <option value="">Pilih Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="produk_id" class="form-label fw-semibold">Produk</label>
                                    <select class="form-select @error('produk_id') is-invalid @enderror" id="produk_id" name="produk_id" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" {{ old('produk_id') == $product->id ? 'selected' : '' }}>
                                                {{ $product->nama }} (Stok: {{ $product->stok }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('produk_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
                                    <input type="number" min="1" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" required>
                                    @error('jumlah')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="harga_beli" class="form-label fw-semibold">Harga Beli</label>
                                    <input type="number" min="0" step="0.01" class="form-control @error('harga_beli') is-invalid @enderror" id="harga_beli" name="harga_beli" value="{{ old('harga_beli') }}" required>
                                    @error('harga_beli')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="dibayar" class="form-label fw-semibold">Jumlah Dibayar</label>
                                    <input type="number" min="0" step="0.01" class="form-control @error('dibayar') is-invalid @enderror" id="dibayar" name="dibayar" value="{{ old('dibayar', 0) }}">
                                    @error('dibayar')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="catatan" class="form-label fw-semibold">Catatan</label>
                                    <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="3" placeholder="Catatan tambahan (opsional)">{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center gap-3 mt-4">
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-warning fw-semibold rounded-pill px-4">
                                    Simpan Pembelian
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
