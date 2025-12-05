<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen flex">

        {{-- ====================== SIDEBAR (MOBILE + DESKTOP) ====================== --}}
        <aside class="bg-white border-r fixed inset-y-0 left-0 overflow-y-auto z-50 md:block">
            @include('layouts.navigation')
        </aside>

        {{-- ====================== CONTENT WRAPPER ====================== --}}
        <div class="flex-1 flex flex-col md:ml-64 min-h-screen">

            {{-- Page Header --}}
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Main Content --}}
            <main class="p-0">
                {{ $slot }}
            </main>

        </div>
    </div>

    @stack('scripts')
</body>
</html>