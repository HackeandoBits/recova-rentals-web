{{-- Location: TopBanner + Header + LocationSection + Footer --}}
@extends('layouts.app')

@section('content')
  <main style="padding-top: 140px">
    {{-- LocationSection --}}
    @include('sections.location-section')
  </main>
@endsection
