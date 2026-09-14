<x-guest-layout>
    <div class="text-center mb-4">
        <p class="text-uppercase text-warning fw-bold small mb-2">Akses Sistem</p>
        <h1 class="h3 fw-bold mb-1">Masuk ke Dashboard</h1>
        <p class="text-secondary mb-0">Silakan masuk dengan email dan password Anda.</p>
    </div>

    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-3">
        @csrf

        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control form-control-lg mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="form-control form-control-lg mt-1"
                type="password"
                name="password"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
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

    @if (Route::has('register'))
        <div class="text-center mt-4 small text-secondary">
            Belum punya akun?
            <a href="{{ route('register') }}" class="fw-semibold text-dark text-decoration-none">Daftar sekarang</a>
        </div>
    @endif
</x-guest-layout>
