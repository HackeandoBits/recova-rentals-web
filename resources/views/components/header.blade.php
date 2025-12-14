<nav x-data="{ open: false }"
    class="fixed left-0 w-full z-40 bg-black text-white border-b border-[hsl(310,75%,60%)/0.2] shadow-md"
    style="top: var(--tb-h); height: var(--nav-h);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex items-center justify-center h-full relative">
            {{-- LINKS CENTRADOS (desktop) --}}
            <div class="hidden sm:flex space-x-8 text-sm font-medium">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate
                    class="text-white hover:text-[#e64ccc] transition duration-200" style="--glow: hsl(310,75%,60%);"
                    onmouseover="this.style.textShadow='0 0 8px var(--glow), 0 0 16px var(--glow)'"
                    onmouseout="this.style.textShadow='none'">
                    Inicio
                </x-nav-link>

                <x-nav-link :href="route('catalog')" :active="request()->routeIs('catalog')" wire:navigate
                    class="text-white hover:text-[#e64ccc] transition duration-200" style="--glow: hsl(310,75%,60%);"
                    onmouseover="this.style.textShadow='0 0 8px var(--glow), 0 0 16px var(--glow)'"
                    onmouseout="this.style.textShadow='none'">
                    Productos
                </x-nav-link>

                <x-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')" wire:navigate
                    class="text-white hover:text-[#e64ccc] transition duration-200" style="--glow: hsl(310,75%,60%);"
                    onmouseover="this.style.textShadow='0 0 8px var(--glow), 0 0 16px var(--glow)'"
                    onmouseout="this.style.textShadow='none'">
                    Galería
                </x-nav-link>

                <x-nav-link :href="route('location')" :active="request()->routeIs('location')" wire:navigate
                    class="text-white hover:text-[#e64ccc] transition duration-200" style="--glow: hsl(310,75%,60%);"
                    onmouseover="this.style.textShadow='0 0 8px var(--glow), 0 0 16px var(--glow)'"
                    onmouseout="this.style.textShadow='none'">
                    ¿Dónde estamos?
                </x-nav-link>

                <x-nav-link :href="route('about')" :active="request()->routeIs('about')" wire:navigate
                    class="text-white hover:text-[#e64ccc] transition duration-200" style="--glow: hsl(310,75%,60%);"
                    onmouseover="this.style.textShadow='0 0 8px var(--glow), 0 0 16px var(--glow)'"
                    onmouseout="this.style.textShadow='none'">
                    ¿Quiénes somos?
                </x-nav-link>
            </div>

            {{-- ACCIONES DERECHA (Carrito + Menú Hamburguesa) --}}
            <div class="absolute right-4 flex items-center gap-4">
                {{-- Carrito (visible siempre) --}}
                <div class="flex items-center">
                    <livewire:cart.cart-manager />
                </div>

                {{-- MENÚ HAMBURGUESA (solo mobile) --}}
                <button type="button" @click="open = ! open"
                    class="sm:hidden inline-flex items-center justify-center
                           rounded-md p-2 text-white hover:bg-white/10 focus:outline-none
                           focus:ring-2 focus:ring-offset-2 focus:ring-offset-black focus:ring-[#e64ccc]">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        {{-- ícono hamburguesa --}}
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        {{-- ícono X --}}
                        <path :class="{ 'inline-flex': open, 'hidden': !open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- MENÚ RESPONSIVE COMO OVERLAY CENTRADO --}}
    <div :class="{ 'flex': open, 'hidden': !open }"
        class="sm:hidden hidden fixed inset-0 z-50 bg-[hsl(298,42%,15%)]/95 backdrop-blur-md"
        @click.self="open = false">
        <div class="relative flex flex-col items-center justify-center w-full h-full space-y-6 text-center px-6">
            {{-- X arriba a la derecha --}}
            <button type="button" @click="open = false"
                class="absolute top-4 right-4 inline-flex items-center justify-center
                       rounded-full p-2 text-white hover:bg-white/10 focus:outline-none
                       focus:ring-2 focus:ring-offset-2 focus:ring-offset-[hsl(298,42%,15%)]
                       focus:ring-[#e64ccc]">
                ✕
            </button>

            <a href="{{ route('home') }}" wire:navigate
                class="block w-full py-3 text-center text-lg tracking-wide transition duration-200 hover:text-[hsl(310,75%,60%)] {{ request()->routeIs('home') ? 'text-[hsl(310,75%,60%)] font-semibold' : 'text-white' }}"
                @click="open = false">
                {{ __('Inicio') }}
            </a>

            <a href="{{ route('catalog') }}" wire:navigate
                class="block w-full py-3 text-center text-lg tracking-wide transition duration-200 hover:text-[hsl(310,75%,60%)] {{ request()->routeIs('catalog') ? 'text-[hsl(310,75%,60%)] font-semibold' : 'text-white' }}"
                @click="open = false">
                {{ __('Productos') }}
            </a>

            <a href="{{ route('gallery') }}" wire:navigate
                class="block w-full py-3 text-center text-lg tracking-wide transition duration-200 hover:text-[hsl(310,75%,60%)] {{ request()->routeIs('gallery') ? 'text-[hsl(310,75%,60%)] font-semibold' : 'text-white' }}"
                @click="open = false">
                {{ __('Galería') }}
            </a>

            <a href="{{ route('location') }}" wire:navigate
                class="block w-full py-3 text-center text-lg tracking-wide transition duration-200 hover:text-[hsl(310,75%,60%)] {{ request()->routeIs('location') ? 'text-[hsl(310,75%,60%)] font-semibold' : 'text-white' }}"
                @click="open = false">
                {{ __('¿Dónde estamos?') }}
            </a>

            <a href="{{ route('about') }}" wire:navigate
                class="block w-full py-3 text-center text-lg tracking-wide transition duration-200 hover:text-[hsl(310,75%,60%)] {{ request()->routeIs('about') ? 'text-[hsl(310,75%,60%)] font-semibold' : 'text-white' }}"
                @click="open = false">
                {{ __('¿Quiénes somos?') }}
            </a>



            {{-- Botón de cerrar extra, por si acaso --}}
            <button type="button" @click="open = false"
                class="mt-6 inline-flex items-center px-4 py-2 rounded-full border border-white/30
                       text-sm text-white/80 hover:bg-white/10 transition">
                Cerrar menú
            </button>
        </div>
    </div>
</nav>
