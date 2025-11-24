{{-- Sección Service Area --}}
@props(['style' => 'card']) {{-- 'card' o 'footer' --}}

<div class="@if($style === 'card') bg-[hsl(298,42%,15%)] text-white rounded-lg shadow-lg p-6 @else space-y-6 @endif">
    <h1 class="text-2xl font-bold text-foreground mb-4">Áreas de Servicio</h1>

    <ul class="list-disc list-inside text-sm text-muted-foreground space-y-2">
        <li><strong>Cobertura Principal:</strong></li>
        <li>Formosa Capital y alrededores</li>
        <li>Interior de la Provincia de Formosa</li>
        <li>Resistencia y Corrientes</li>
        <li>Consultar para otras ubicaciones</li>
    </ul>
    <p class="mt-2">* Realizamos entregas en un radio de 300km desde nuestra base</p>
</div>
