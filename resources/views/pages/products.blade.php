{{-- Products: TopBanner + Header + ProductsSection + Footer + CartModal --}}
@extends('livewire.layout.app')

@section('content')
  <main style="padding-top: 140px">
    {{-- ProductsSection: usando Livewire para datos reales y prop onAddToCart --}}
    <section class="container mx-auto px-4 py-8">
      <h1 class="text-2xl font-bold mb-4">Catálogo</h1>
      {{-- si querés, podés meter búsqueda/filtros arriba para replicar el UI exacto --}}
      <livewire:catalog.item-list />
    </section>
  </main>

  {{-- CartModal (como en Lovable) --}}
  @include('partials.cart-modal')
@endsection
