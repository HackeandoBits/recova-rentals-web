{{-- Location: TopBanner + Header + LocationSection + Footer --}}
@extends('livewire.layout.app')

@section('content')
<main style="padding-top: 14px" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="grid grid-cols-1 md:grid-cols-[1fr_2fr] gap-5">
        {{-- Card izquierda: mapa --}}
        <div class="flex flex-col justify-center">
            @include('sections.contact-section')
        </div>

        {{-- Card derecha: contacto --}}
        <div class="flex flex-col justify-center">
            @include('sections.location-section', ['style' => 'card'])
        </div>
    </div>

</main>
@endsection
