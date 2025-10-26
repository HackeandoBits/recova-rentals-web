<nav x-data="{ open: false }"
     class="fixed left-0 w-full z-40 bg-black text-white border-b border-[hsl(310,75%,60%)/0.2] shadow-md"
     style="top: var(--tb-h); height: var(--nav-h);">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
    <div class="flex items-center justify-center h-full relative">
      <div class="flex space-x-8 text-sm font-medium">
        <x-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate class="text-white hover:text-[hsl(310,75%,60%)]">Inicio</x-nav-link>
        <x-nav-link :href="route('catalog')" :active="request()->routeIs('catalog')" wire:navigate class="text-white hover:text-[hsl(310,75%,60%)]">Productos</x-nav-link>
        <x-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')" wire:navigate class="text-white hover:text-[hsl(310,75%,60%)]">Galería</x-nav-link>
        <x-nav-link :href="route('location')" :active="request()->routeIs('location')" wire:navigate class="text-white hover:text-[hsl(310,75%,60%)]">¿Dónde estamos?</x-nav-link>
        <x-nav-link :href="route('about')" :active="request()->routeIs('about')" wire:navigate class="text-white hover:text-[hsl(310,75%,60%)]">¿Quiénes somos?</x-nav-link>
      </div>
  </div>

  {{-- Menú responsive  --}}
  <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[hsl(298,42%,15%)] border-t border-[hsl(310,75%,60%)/0.3]">
        <div class="pt-2 pb-3 space-y-1 text-center">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate class="hover:text-[hsl(310,75%,60%)] transition duration-200">
                {{ __('Inicio') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('catalog')" :active="request()->routeIs('catalog')" wire:navigate class="hover:text-[hsl(310,75%,60%)] transition duration-200">
                {{ __('Productos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')" wire:navigate class="hover:text-[hsl(310,75%,60%)] transition duration-200">
                {{ __('Galería') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('location')" :active="request()->routeIs('location')" wire:navigate class="hover:text-[hsl(310,75%,60%)] transition duration-200">
                {{ __('¿Dónde estamos?') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')" wire:navigate class="hover:text-[hsl(310,75%,60%)] transition duration-200">
                {{ __('¿Quiénes somos?') }}
            </x-responsive-nav-link>

            @auth
                <div class="border-t border-[hsl(310,75%,60%)/0.3] mt-4 pt-2">
                    <div class="text-sm">{{ auth()->user()->name }}</div>
                    <x-responsive-nav-link :href="route('profile.edit')" class="hover:text-[hsl(310,75%,60%)]">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>
                    <button wire:click="logout" class="w-full text-start">
                        <x-responsive-nav-link class="hover:text-[hsl(310,75%,60%)]">
                            {{ __('Cerrar sesión') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            @endauth

            @guest
                <div class="border-t border-[hsl(310,75%,60%)/0.3] mt-4 pt-2">
                    <x-responsive-nav-link :href="route('login')" class="hover:text-[hsl(310,75%,60%)]">
                        {{ __('Iniciar sesión') }}
                    </x-responsive-nav-link>
                </div>
            @endguest
        </div>
    </div>
</nav>