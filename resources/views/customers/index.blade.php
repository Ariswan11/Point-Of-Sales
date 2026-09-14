<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <p class="text-uppercase small text-warning fw-bold mb-1">Master Data</p>
                <h2 class="h4 mb-0 fw-bold text-dark">Pelanggan</h2>
            </div>
            <a href="{{ route('customers.create') }}" class="btn btn-warning fw-semibold rounded-pill px-4">
                <i class="bi bi-plus-lg me-2"></i>Tambah Pelanggan
            </a>
        </div>
    </x-slot>

    <div class="container py-4">
        <div data-swal-success="{{ session('success') }}" style="display:none"></div>

        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('customers.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-9">
                        <label for="search" class="form-label fw-semibold">Search</label>
                        <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Cari nama, telepon, email, atau alamat">
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-warning fw-semibold flex-fill">
                            Cari
                        </button>
                        <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary flex-fill">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header border-0 bg-white py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="h5 mb-0 fw-bold">Daftar Pelanggan</h3>
                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">{{ $customers->count() }} data</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">No</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $index => $customer)
                                <tr>
                                    <td class="px-4">{{ $index + 1 }}</td>
                                    <td class="fw-semibold">{{ $customer->nama }}</td>
                                    <td>{{ $customer->telepon ?: '-' }}</td>
                                    <td>{{ $customer->email ?: '-' }}</td>
                                    <td>{{ $customer->alamat ?: '-' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-action-primary">
                                                <i class="bi bi-pencil-square"></i>
                                                <span>Edit</span>
                                            </a>
                                            <form action="{{ route('customers.destroy', $customer) }}" method="POST" data-confirm-delete="Apakah Anda yakin ingin menghapus pelanggan ini?">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-action-danger">
                                                    <i class="bi bi-trash3"></i>
                                                    <span>Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Belum ada data pelanggan.
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
