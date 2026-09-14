<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="text-uppercase small text-warning fw-bold mb-1">Manajemen</p>
                <h2 class="h4 mb-0 fw-bold text-dark">Edit Role User</h2>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-lg-5">
                        <form action="{{ route('users.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold">Nama</label>
                                <input type="text" class="form-control" id="name" value="{{ $user->name }}" disabled>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
                            </div>

                            <div class="mb-4">
                                <label for="role" class="form-label fw-semibold">Role</label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="kasir" {{ old('role', $user->role) === 'kasir' ? 'selected' : '' }}>Kasir</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center gap-3">
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-warning fw-semibold rounded-pill px-4">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
