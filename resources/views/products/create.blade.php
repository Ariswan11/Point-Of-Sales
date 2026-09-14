<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="text-uppercase small text-warning fw-bold mb-1">Master Data</p>
                <h2 class="h4 mb-0 fw-bold text-dark">Tambah Produk</h2>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-lg-5">
                        <form action="{{ route('products.store') }}" method="POST">
                            @csrf

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="kode_produk" class="form-label fw-semibold">Kode Produk</label>
                                    <input type="text" class="form-control @error('kode_produk') is-invalid @enderror" id="kode_produk" name="kode_produk" value="{{ old('kode_produk') }}" placeholder="Contoh: P001" required>
                                    @error('kode_produk')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="nama" class="form-label fw-semibold">Nama Produk</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama produk" required>
                                    @error('nama')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="kategori_id" class="form-label fw-semibold">Kategori</label>
                                    <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                                        <option value="">Pilih kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="barcode" class="form-label fw-semibold">Barcode</label>
                                    <input type="text" class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode" value="{{ old('barcode') }}" placeholder="Opsional">
                                    @error('barcode')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="harga_beli" class="form-label fw-semibold">Harga Beli</label>
                                    <input type="number" min="0" step="0.01" class="form-control @error('harga_beli') is-invalid @enderror" id="harga_beli" name="harga_beli" value="{{ old('harga_beli') }}" required>
                                    @error('harga_beli')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="harga_jual" class="form-label fw-semibold">Harga Jual</label>
                                    <input type="number" min="0" step="0.01" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual" name="harga_jual" value="{{ old('harga_jual') }}" required>
                                    @error('harga_jual')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="stok" class="form-label fw-semibold">Stok</label>
                                    <input type="number" min="0" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok', 0) }}" required>
                                    @error('stok')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="satuan" class="form-label fw-semibold">Satuan</label>
                                    <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" value="{{ old('satuan') }}" placeholder="Contoh: pcs, box, kg" required>
                                    @error('satuan')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="status" class="form-label fw-semibold">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi produk">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center gap-3 mt-4">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-warning fw-semibold rounded-pill px-4">
                                    Simpan Produk
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
