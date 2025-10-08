{{-- Location: TopBanner + Header + LocationSection + Footer --}}
@extends('livewire.layout.app')

@section('content')
  <main style="padding-top: 140px">
    {{-- LocationSection --}}
    @include('sections.location-section')
  </main>
@endsection
