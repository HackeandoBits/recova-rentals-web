{{-- About: TopBanner + Header + AboutSection + Footer --}}
@extends('livewire.layout.app')

@section('content')
<main class="pt-14 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">

       <div class="mb-8">
        @include('sections.about-section')
    </div>
@php
$tarjetas = [
    ['col' => 'left', 'view' => 'sections.history-section', 'data' => ['style' => 'card']],
    ['col' => 'right', 'view' => 'sections.distinction-section', 'data' => ['style' => 'card']],
    ['col' => 'left', 'view' => 'sections.history-section', 'data' => ['style' => 'card']],
    ['col' => 'right', 'view' => 'sections.distinction-section', 'data' => ['style' => 'card']],
    // más tarjetas...
];
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    @foreach($tarjetas as $tarjeta)
       
            @include($tarjeta['view'], $tarjeta['data'])
        
    @endforeach
</div>



</main>
@endsection
