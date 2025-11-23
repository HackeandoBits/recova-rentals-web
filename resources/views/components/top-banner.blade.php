<div {{ $attributes->merge([
    'class' =>
        'fixed top-0 left-0 w-full z-50 bg-[hsl(298,42%,10%)] text-white border-b border-white/5 flex justify-between items-center px-4 overflow-hidden',
]) }}
    style="min-height: var(--tb-h);">

    {{-- Efecto Shimmer (Neon Glow - Rebote) --}}
    <div
        class="absolute inset-0 animate-[shimmer_5s_linear_infinite_alternate] bg-gradient-to-r from-transparent via-fuchsia-500 to-transparent z-0 pointer-events-none blur-xl opacity-80 w-full">
    </div>

    <div class="relative z-10 flex justify-between items-center w-full">
        <!-- Izquierda: logo -->
        <div class="flex items-center space-x-14">
            <a href="{{ route('home') }}" wire:navigate class="hover:opacity-90 transition duration-200">
                <x-application-logo class="block h-9 w-auto text-white fill-current" />
            </a>
        </div>

        <!-- Derecha: redes -->
        <div class="flex items-center gap-4 text-sm text-gray-300">
            <a href="https://www.instagram.com/recovarentals/" target="_blank"
                class="hover:text-[hsl(310,75%,60%)] transition">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="mailto:recovarentals@gmail.com" class="hover:text-[hsl(310,75%,60%)] transition">
                <i class="fa-solid fa-envelope"></i>
            </a>
        </div>
    </div>
</div>
