<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Recova Rentals') }}</title>

    <!-- Fuente -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Vite assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="font-sans antialiased bg-background text-foreground">

  {{-- 1) TopBanner (bordó) fijo arriba --}}
  <x-top-banner />  {{-- fixed; height = var(--tb-h) --}}

  {{-- 2) Header (negro) fijo debajo del banner --}}
  <x-header /> {{-- fixed; top = var(--tb-h); height = var(--nav-h) --}}

  {{-- 3) Contenido: deja espacio para ambos (banner + nav) --}}
  <main class="relative pt-[calc(var(--tb-h)+var(--nav-h))]">
    @yield('content')
  </main>

  <x-footer />

  {{-- 👉 Modal global del carrito, vive al final del body --}}
  @livewire('cart.cart-modal')

  {{-- Scripts de Livewire --}}
  @livewireScripts
</body>
</html>
