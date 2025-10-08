<div {{ $attributes->merge([
    'class' => 'fixed top-0 left-0 w-full z-50 bg-[hsl(298,42%,15%)] text-white border-b border-[hsl(310,75%,60%)/0.3] flex justify-between items-center px-4',
]) }}
     style="min-height: var(--tb-h);">
    <!-- Izquierda: logo -->
    <div class="flex items-center space-x-14">
        <a href="{{ route('home') }}" wire:navigate class="hover:opacity-90 transition duration-200">
            <x-application-logo class="block h-9 w-auto text-white fill-current" />
        </a>
    </div>

    <!-- Derecha: redes -->
    <div class="flex items-center gap-4 text-sm text-gray-300">
        <a href="https://www.instagram.com/recovarentals/" target="_blank" class="hover:text-[hsl(310,75%,60%)] transition">
            <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="mailto:recovarentals@gmail.com" class="hover:text-[hsl(310,75%,60%)] transition">
            <i class="fa-solid fa-envelope"></i>
        </a>
    </div>
</div>