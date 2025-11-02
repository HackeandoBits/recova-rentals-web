{{-- Location: TopBanner + Header + OurLocationSection + ContactSection + Map + Footer --}}
@extends('livewire.layout.app')

@section('content')
<main class="flex gap-5 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 mb-14">
     
    {{-- Columna izquierda --}}
    <div class="flex flex-col gap-5 flex-[1]">
        {{-- Card superior: Our Location --}}
        <div class="bg-[hsl(298,42%,15%)] text-white rounded-lg shadow-lg ">
            @include('sections.our-location-section')
        </div>

        {{-- Card inferior: Contacto --}}
        <div class="bg-[hsl(298,42%,15%)] text-white rounded-lg shadow-lg">
             @include('sections.service-area-section')
            
        </div>
    </div>

    {{-- Columna derecha --}}
    <div class="flex flex-col gap-5 flex-[2]">
        {{-- Card superior: Mapa --}}
        <div class="rounded-lg shadow-lg overflow-hidden flex-1">
            @include('sections.location-section', ['style' => 'card'])
        </div>

        {{-- Card inferior: Áreas de Servicio --}}
        <div class="flex flex-col">
           @include('sections.contact-section')
        </div>
    </div>


</main>
@endsection
