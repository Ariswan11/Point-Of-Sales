<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="text-uppercase small text-warning fw-bold mb-1">Master Data</p>
                <h2 class="h4 mb-0 fw-bold text-dark">Edit Pelanggan</h2>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-lg-5">
                        <form action="{{ route('customers.update', $customer) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="nama" class="form-label fw-semibold">Nama Pelanggan</label>
                                <input type="text" class="form-control form-control-lg @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $customer->nama) }}" placeholder="Masukkan nama pelanggan" required>
                                @error('nama')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="telepon" class="form-label fw-semibold">Nomor Telepon</label>
                                <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon', $customer->telepon) }}" placeholder="Contoh: 08123456789">
                                @error('telepon')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $customer->email) }}" placeholder="Contoh: pelanggan@example.com">
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="alamat" class="form-label fw-semibold">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="4" placeholder="Masukkan alamat pelanggan">{{ old('alamat', $customer->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center gap-3">
                                <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-warning fw-semibold rounded-pill px-4">
                                    Update Pelanggan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
