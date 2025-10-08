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

      <div class="absolute right-4 flex items-center space-x-4">
        @auth
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-white hover:text-[hsl(310,75%,60%)]">
                {{ auth()->user()->name }}
                <svg class="ml-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
              </button>
            </x-slot>
            <x-slot name="content">
              <x-dropdown-link :href="route('profile.edit')">Perfil</x-dropdown-link>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-start">
                  <x-dropdown-link>Cerrar sesión</x-dropdown-link>
                </button>
              </form>
            </x-slot>
          </x-dropdown>
        @endauth

        @guest
          <x-nav-link :href="route('login')" class="text-white hover:text-[hsl(310,75%,60%)]">Iniciar sesión</x-nav-link>
        @endguest
      </div>
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