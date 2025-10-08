{{-- Home: TopBanner + Header + HeroSection + Footer + CartModal --}}
@extends('livewire.layout.app')

@section('content')
  
  @include('sections.hero-section')

  {{-- CartModal (idéntico a estructura de Lovable: abierto desde el header) --}}
  @include('partials.cart-modal')
@endsection
