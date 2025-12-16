<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Recova Rentals') }}</title>
    <meta name="description"
        content="Alquiler de mobiliario, iluminación, sonido y técnica para eventos en Formosa Capital. Combos de equipos profesionales para fiestas y espectáculos.">
    <meta name="google-site-verification" content="J571Jio8lVMCieENL5OZGpXx1x61TJn-k0A9RVYh2Iw" />
    <link rel="canonical" href="{{ config('app.url') }}/{{ request()->path() === '/' ? '' : request()->path() }}" />
    <link rel="icon" href="{{ asset('images/branding/recova-favicon.png') }}" type="image/png">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ config('app.url') }}" />
    <meta property="og:title" content="{{ config('app.name') }}" />
    <meta property="og:description" content="Alquiler de mobiliario y técnica para eventos." />
    <meta property="og:image" content="{{ asset('images/branding/recova-og-image.png') }}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ config('app.url') }}" />
    <meta property="twitter:title" content="{{ config('app.name') }}" />
    <meta property="twitter:description" content="Alquiler de mobiliario y técnica para eventos." />
    <meta property="twitter:image" content="{{ asset('images/branding/recova-og-image.png') }}" />

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
