@props(['style' => 'card']) {{-- 'card' o 'footer' --}}

<div class="@if($style === 'card') bg-[hsl(298,42%,15%)] text-white rounded-lg shadow-lg p-6 w-full h-full flex flex-col justify-start items-start @else space-y-6 @endif">



        <h3 class="w-full font-semibold text-center text-2xl text-primary mb-2">

            Nuestro Equipo
        </h3>
        <p class="ml-auto text-center text-sm text-muted-foreground">Contamos con un equipo de profesionales apasionados por la tecnología audiovisual, con años de experiencia en la industria del entretenimiento y eventos corporativos. Cada miembro de nuestro equipo está certificado y en constante capacitación para ofrecer el mejor servicio.</p>
  
<div class="mt-4 w-full flex flex-wrap justify-center gap-3">
    <x-glow-button>Técnicos Certificados</x-glow-button>
    <x-glow-button>Operadores Especializados</x-glow-button>
    <x-glow-button>Diseñadores de Shows</x-glow-button>
    <x-glow-button>Soporte 24/7</x-glow-button>
</div>
    </div>



