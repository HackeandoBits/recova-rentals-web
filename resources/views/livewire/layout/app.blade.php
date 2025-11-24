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

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('cart', {
                items: [], // Inicializamos vacío, luego el plugin persist lo llenará

                add(item) {
                    if (!Array.isArray(this.items)) this.items = [];
                    // Use loose equality (==) to handle string/int ID mismatches
                    const existing = this.items.find(i => i.id == item.id);
                    if (existing) {
                        existing.quantity++;
                    } else {
                        this.items.push({
                            ...item,
                            quantity: 1
                        });
                    }
                },

                addCombo(itemsArray) {
                    if (!Array.isArray(this.items)) this.items = [];
                    itemsArray.forEach(newItem => {
                        const existing = this.items.find(i => i.id == newItem.id);
                        if (existing) {
                            existing.quantity += (newItem.quantity || 1);
                        } else {
                            this.items.push({
                                ...newItem,
                                quantity: (newItem.quantity || 1)
                            });
                        }
                    });
                },

                remove(id) {
                    if (!Array.isArray(this.items)) this.items = [];
                    this.items = this.items.filter(i => i.id != id);
                },

                updateQuantity(id, quantity) {
                    if (!Array.isArray(this.items)) this.items = [];
                    const item = this.items.find(i => i.id == id);
                    if (item) {
                        if (quantity <= 0) {
                            this.remove(id);
                        } else {
                            item.quantity = quantity;
                        }
                    }
                },

                clear() {
                    this.items = [];
                },

                get count() {
                    // Safety check: ensure items is an array
                    if (!Array.isArray(this.items)) return 0;
                    return this.items.reduce((acc, item) => acc + item.quantity, 0);
                }
            });
        });
    </script>

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
