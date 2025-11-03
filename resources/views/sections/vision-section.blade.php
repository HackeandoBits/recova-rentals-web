@props(['style' => 'card']) {{-- 'card' o 'footer' --}}

<div class="@if($style === 'card') bg-[hsl(298,42%,15%)] text-white rounded-lg shadow-lg p-6 w-full h-full flex flex-col justify-start items-start @else space-y-6 @endif">

    {{-- Encabezado con icono tipo viñeta --}}
    <div class="flex items-center mb-4">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award mr-2 h-5 w-5 text-accent"><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path><circle cx="12" cy="8" r="6"></circle></svg>

        <h3 class="font-semibold tracking-tight text-2xl text-primary">
            Nuestra Visión
        </h3>
    </div>

    {{-- Contenido descriptivo --}}
    <div class="text-sm text-muted-foreground space-y-4">
        <p>
Ser la empresa líder en el noreste argentino en alquiler de equipos audiovisuales, reconocida por nuestra innovación tecnológica, excelencia en el servicio y compromiso con el éxito de cada evento que respaldamos.
        </p>
    </div>
</div>