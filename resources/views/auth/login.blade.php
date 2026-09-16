<x-guest-layout>
    <div class="text-center mb-4">
        <p class="text-uppercase text-warning fw-bold small mb-2">Akses Sistem</p>
        <h1 class="h3 fw-bold mb-1">Masuk ke Dashboard</h1>
        <p class="text-secondary mb-0">Silakan masuk dengan email dan password Anda.</p>
    </div>

    <x-auth-session-status class="mb-3" :status="session('status')" />

    @if ($errors->has('email'))
        <div data-swal-error="{{ $errors->first('email') ?: 'Email atau password salah.' }}" style="display:none"></div>
    @endif

    @if ($errors->has('password'))
        <div data-swal-error="{{ $errors->first('password') ?: 'Email atau password salah.' }}" style="display:none"></div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="mt-3">
        @csrf

        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control form-control-lg mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        </div>

        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <div class="position-relative mt-1">
                <input id="password"
                    class="form-control form-control-lg pe-5"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
                <button type="button"
                    class="btn btn-link position-absolute end-0 top-50 translate-middle-y me-2 p-0 text-secondary"
                    data-toggle-password="password"
                    aria-label="Tampilkan password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between gap-3 mt-4">
            <label for="remember_me" class="d-flex align-items-center text-secondary">
                <input id="remember_me" type="checkbox" class="form-check-input me-2" name="remember">
                <span class="small">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="small text-decoration-none text-dark fw-semibold" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-warning w-100 fw-semibold py-2 mt-4">
            {{ __('Log in') }}
        </button>
    </form>

</x-guest-layout>
