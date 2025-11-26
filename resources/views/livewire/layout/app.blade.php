<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Recova Rentals') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @livewireStyles
    @vite(['resources/css/app.css'])

    @vite(['resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-background text-foreground">

    <x-top-banner />
    <x-header />

    <main class="relative pt-[calc(var(--tb-h)+var(--nav-h))]">
        @yield('content')
    </main>

    <x-footer />

    @livewire('cart.cart-modal')

    @livewireScripts
</body>

</html>
