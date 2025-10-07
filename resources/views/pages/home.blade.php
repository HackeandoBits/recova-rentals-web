{{-- Home: TopBanner + Header + HeroSection + Footer + CartModal --}}
@extends('layouts.app')

@section('content')
  <main style="padding-top: 140px">
    {{-- HeroSection --}}
    @include('sections.hero-section')
  </main>

  {{-- CartModal (idéntico a estructura de Lovable: abierto desde el header) --}}
  @include('partials.cart-modal')
@endsection
