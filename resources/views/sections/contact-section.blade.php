{{-- Sección Contacto --}}
@props(['style' => 'card']) {{-- 'card' o 'footer' --}}

<div class="@if($style === 'card') bg-[hsl(298,42%,15%)] text-white rounded-lg p-6 @else space-y-6 @endif">
    <h4 class="text-2xl font-semibold text-foreground mb-4">Contacto</h4>
    <div class="space-y-4 text-sm">
        <div class="flex items-start space-x-3">
            <i class="fas fa-phone text-accent mt-1"></i>
            <a href="tel:+543704567890" class="text-muted-foreground hover:text-accent">+54 370 420-2097</a>
        </div>
        <div class="flex items-start space-x-3">
            <i class="fas fa-envelope text-accent mt-1"></i>
            <a href="mailto:info@recovarentals.com" class="text-muted-foreground hover:text-accent">info@recovarentals.com</a>
        </div>

        <div class="flex items-start space-x-3">
            <i class="fab fa-whatsapp text-accent mt-1"></i>
            <a href="https://wa.me/543704202097" target="_blank" class="text-muted-foreground hover:text-accent">
                WhatsApp 24/7
            </a>
        </div>
    </div>
</div>
