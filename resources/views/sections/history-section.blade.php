{{-- Sección History --}}
@props(['style' => 'card']) {{-- 'card' o 'footer' --}}

<div class="@if($style === 'card') bg-[hsl(298,42%,15%)] text-white rounded-lg shadow-lg p-6 @else space-y-6 @endif">
    <h3 class="font-semibold tracking-tight text-2xl text-primary mb-4">Nuestra Historia</h3>
    
    <div class="text-sm text-muted-foreground space-y-4">
        <p>Fundada en 2019 en el corazón de Formosa, <strong class="text-accent">Recova Rentals</strong> nació de la pasión por la tecnología audiovisual y el entretenimiento. Comenzamos como un pequeño emprendimiento familiar con la visión de democratizar el acceso a equipos profesionales de alta calidad en nuestra región.</p>

        <p>Ubicados estratégicamente en el <strong class="text-accent">Complejo La Nueva Recova</strong>, hemos crecido hasta convertirnos en la empresa líder en alquiler de equipos para eventos en el noreste argentino, sirviendo desde íntimas celebraciones familiares hasta festivales masivos con miles de asistentes.</p>

        <p>Nuestro compromiso va más allá del simple alquiler de equipos. Somos <strong class="text-primary">socios estratégicos</strong> de nuestros clientes, brindando asesoramiento técnico, diseño de shows personalizados y soporte completo para garantizar el éxito de cada evento.</p>
    </div>
</div>
