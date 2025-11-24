@props(['style' => 'card']) {{-- 'card' o 'footer' --}}

<div class="@if($style === 'card') bg-[hsl(298,42%,15%)] text-white rounded-lg shadow-lg p-6 w-full h-full flex flex-col justify-start items-start @else space-y-6 @endif">

    {{-- Encabezado con icono tipo viñeta --}}
    <div class="flex items-center mb-4">
        <svg xmlns="http://www.w3.org/2000/svg"
             width="24" height="24" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round"
             class="lucide lucide-target mr-2 h-5 w-5 text-accent">
            <circle cx="12" cy="12" r="10"></circle>
            <circle cx="12" cy="12" r="6"></circle>
            <circle cx="12" cy="12" r="2"></circle>
        </svg>

        <h3 class="font-semibold tracking-tight text-2xl text-primary">
            Nuestra Misión
        </h3>
    </div>

    {{-- Contenido descriptivo --}}
    <div class="text-sm text-muted-foreground space-y-4">
        <p>
            Buscamos crear experiencias de hospitalidad únicas, fusionando elegancia, confort y
            tecnología con un compromiso profundo por el entorno y la comunidad.
        </p>
    </div>
</div>

