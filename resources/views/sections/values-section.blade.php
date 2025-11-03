@php
    $tarjetas = [
        [
            'titulo' => 'Innovación Tecnológica',
            'contenido' => 'Utilizamos equipos de última generación para garantizar la mejor experiencia audiovisual.',
            'icono' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-zap h-12 w-12 text-accent mx-auto mb-4 group-hover:scale-110 transition-transform duration-300"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"></path></svg>'
        ],
                [
            'titulo' => 'Desarrollo y Crecimiento',
            'contenido' => 'Evolucionamos constantemente, explorando nuevas herramientas y narrativas para expandir nuestro universo.',
            'icono' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up h-12 w-12 text-accent mx-auto mb-4 group-hover:scale-110 transition-transform duration-300"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>'
        ],
        [
            'titulo' => 'Nuestro Enfoque',
            'contenido' => 'Combinamos tecnología, arte y propósito para crear experiencias que conecten emocionalmente.',
            'icono' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cpu h-12 w-12 text-accent mx-auto mb-4 group-hover:scale-110 transition-transform duration-300"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"/><rect x="9" y="9" width="6" height="6"/><path d="M15 2v2"/><path d="M15 20v2"/><path d="M2 15h2"/><path d="M2 9h2"/><path d="M20 9h2"/><path d="M20 15h2"/><path d="M9 2v2"/><path d="M9 20v2"/></svg>'
        ],
        [
            'titulo' => 'Proyección Futura',
            'contenido' => 'Aspiramos a integrar nuestras obras con realidades aumentadas y experiencias sensoriales interactivas.',
            'icono' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles h-12 w-12 text-accent mx-auto mb-4 group-hover:scale-110 transition-transform duration-300"><path d="M12 3v18"/><path d="M5 9l14 6"/><path d="M5 15l14-6"/></svg>'
        ],
    ];
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
    @foreach($tarjetas as $tarjeta)
        <div class="group bg-[hsl(298,42%,15%)] text-white rounded-lg shadow-lg p-6 w-full h-full flex flex-col justify-start items-start transition-transform duration-300 hover:scale-[1.02]">

            {{-- Ícono SVG inline --}}
            <div class="mb-4 w-full flex justify-center">
                {!! $tarjeta['icono'] !!}
            </div>

            {{-- Título --}}
            <h3 class="font-semibold tracking-tight text-2xl text-primary text-center w-full mb-2">
                {{ $tarjeta['titulo'] }}
            </h3>

            {{-- Contenido --}}
            <div class="text-sm text-muted-foreground space-y-4 text-center">
                <p>{{ $tarjeta['contenido'] }}</p>
            </div>
        </div>
    @endforeach
</div>
