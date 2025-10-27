{{-- About: TopBanner + Header + AboutSection + Footer --}}
@extends('livewire.layout.app')

@section('content')
<main class="pt-14 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">

    {{-- AboutSection: título o componente futuro --}}
    <div class="mb-8">
        @include('sections.about-section')
    </div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    {{-- Columna izquierda --}}
    <div class="flex flex-col gap-5">
        @include('sections.history-section', ['style' => 'card'])
        
    </div>

    {{-- Columna derecha --}}
    <div class="flex flex-col gap-5">
      @include('sections.distinction-section', ['style' => 'card'])
    </div>
</div>


</main>
@endsection
