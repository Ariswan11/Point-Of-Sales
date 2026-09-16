<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <p class="text-uppercase small text-warning fw-bold mb-1">Manajemen</p>
                <h2 class="h4 mb-0 fw-bold text-dark">Kelola User</h2>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div data-swal-success="{{ session('success') }}" style="display:none"></div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header border-0 bg-white py-3 px-4">
                <div class="d-flex justify-content-between align-items-center gap-3">
                    <h3 class="h5 mb-0 fw-bold">Daftar User</h3>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-dark rounded-pill px-3 py-2">{{ $users->count() }} user</span>
                        <a href="{{ route('users.create') }}" class="btn btn-warning fw-semibold rounded-pill px-3">
                            <i class="bi bi-person-plus"></i>
                            <span>Tambah User</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index => $user)
                                <tr>
                                    <td class="px-4">{{ $index + 1 }}</td>
                                    <td class="fw-semibold">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role === 'admin')
                                            <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill px-2 py-1">Admin</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill px-2 py-1">Kasir</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-action-primary">
                                            <i class="bi bi-person-gear"></i>
                                            <span>Edit Role</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Belum ada data user.
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
