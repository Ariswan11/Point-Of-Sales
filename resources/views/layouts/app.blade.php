<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-body-tertiary app-shell-body">
        <div class="app-shell d-flex min-vh-100">
            @include('layouts.navigation')

            <div class="app-main flex-grow-1">
                <header class="topbar navbar sticky-top">
                    <div class="container-fluid px-4 py-2 d-flex justify-content-between align-items-center">
                        <div class="topbar-title-wrap">
                            <p class="topbar-label"><span class="topbar-pulse"></span> Ruang kerja utama</p>
                            <h1 class="topbar-title">{{ config('app.name', 'POS Mitra') }}</h1>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <span class="topbar-role">
                                <i class="bi bi-shield-check"></i>
                                {{ ucfirst(Auth::user()->role ?? 'user') }}
                            </span>

                            <div class="dropdown">
                                <a class="topbar-user-btn dropdown-toggle d-flex align-items-center gap-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="topbar-avatar">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                    <span class="topbar-user-name">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            <i class="bi bi-person-circle"></i>
                                            Profile
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-box-arrow-right"></i>
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </header>

                @isset($header)
                    <header class="sub-header">
                        <div class="container-fluid px-4 py-4">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                @if (session('swal_success'))
                    <div data-swal-success="{{ session('swal_success') }}" style="display:none"></div>
                @endif

                <main class="container-fluid px-4 py-4">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
