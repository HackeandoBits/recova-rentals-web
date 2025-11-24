{{-- Sección Our Location --}}
@props(['style' => 'card']) {{-- 'card' o 'footer' --}}

<div class="@if($style === 'card') bg-[hsl(298,42%,15%)] text-white rounded-lg p-6 @else space-y-6 @endif">
    <div class="flex items-center gap-2 mb-4">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-accent">
        <rect width="16" height="20" x="4" y="2" rx="2" ry="2"></rect>
        <path d="M9 22v-4h6v4"></path>
        <path d="M8 6h.01"></path>
        <path d="M16 6h.01"></path>
        <path d="M12 6h.01"></path>
        <path d="M12 10h.01"></path>
        <path d="M12 14h.01"></path>
        <path d="M16 10h.01"></path>
        <path d="M16 14h.01"></path>
        <path d="M8 10h.01"></path>
        <path d="M8 14h.01"></path>
    </svg>
    <h1 class="text-2xl font-bold text-foreground">Nuestra Ubicación</h1>
</div>

<div class="flex items-center gap-2 mb-2 px-1">
    <i class="fas fa-map-marker-alt text-accent"></i>
    <h2 class="font-bold text-foreground">Dirección</h2>    
</div>

    <p class="text-sm text-muted-foreground pb-8 px-5">
        Azopardo 811, Complejo La Nueva Recova, Formosa Capital
    </p>
    
<div class="flex items-center gap-2 px-1
            transition-all duration-300
            hover:[text-shadow:0_0_8px_hsl(310,75%,60%),0_0_16px_hsl(310,75%,50%)]
            cursor-pointer
            group">
    <livewire:relojito class="transition-transform duration-200 group-active:scale-200" size="40
" /> 
    <h2 class="font-bold text-foreground">Horarios de Atención</h2>    
</div>

<ul class="text-sm text-muted-foreground list-disc list-inside ml-4 mt-">
    <li> Lunes a Viernes: 9:00 - 18:00 </li>
    <li> Sábados: 9:00 - 14:00 </li>
    <li class="mb-6"> Domingos: Cerrado </li>
</ul>
<a href="https://www.google.com/maps?ll=-26.19166,-58.192881&z=17&t=m&hl=es&gl=AR&mapclient=embed&cid=5804608937959950504" target="_blank">
    <span class="inline-flex items-center justify-center border border-primary text-primary text-lg px-5 py-3 rounded-md
                 transition-all duration-300
                 hover:scale-105
                 hover:[text-shadow:0_0_8px_hsl(310,75%,60%),0_0_16px_hsl(310,75%,50%)]
                 hover:shadow-[0_0_10px_hsl(310,75%,60%)]">
    
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-navigation mr-2 h-4 w-4"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
      Ver en Google Maps
    </span>
</a>

</div>
 