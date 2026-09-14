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
    <body class="bg-body-tertiary">
        <div class="min-vh-100">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white border-bottom shadow-sm">
                    <div class="container py-4">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="container py-4">
                {{ $slot }}
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
