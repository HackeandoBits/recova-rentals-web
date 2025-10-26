{{-- Sección Contacto --}}
@props(['style' => 'card']) {{-- 'card' o 'footer' --}}
<h2 class="text-2xl font-bold mb-8">Contacto</h2>
<div class="@if($style === 'card') bg-[hsl(298,42%,15%)] text-white rounded-lg shadow-lg p-6 @else space-y-6 @endif">
    <h4 class="font-semibold text-foreground mb-4">Contacto</h4>
    <div class="space-y-4 text-sm">
        <div class="flex items-start space-x-3">
            <i class="fas fa-phone text-accent mt-1"></i>
            <a href="tel:+543704567890" class="text-muted-foreground hover:text-accent">+54 370 456-7890</a>
        </div>
        <div class="flex items-start space-x-3">
            <i class="fas fa-envelope text-accent mt-1"></i>
            <a href="mailto:info@recovarentals.com" class="text-muted-foreground hover:text-accent">info@recovarentals.com</a>
        </div>
        <div class="flex items-start space-x-3">
            <i class="fas fa-map-marker-alt text-accent mt-1"></i>
            <a href="https://goo.gl/maps/example" target="_blank" class="text-muted-foreground hover:text-accent">
                Azopardo 811, Complejo La Nueva Recova, Formosa
            </a>
        </div>
        <div class="flex items-start space-x-3">
            <i class="fab fa-whatsapp text-accent mt-1"></i>
            <a href="https://wa.me/543704567890" target="_blank" class="text-muted-foreground hover:text-accent">
                WhatsApp 24/7
            </a>
        </div>
    </div>
</div>
